<?php

namespace App\Http\Controllers;

use Imagick;
use DataTables;
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\Image\ImageLoader;
use App\Models\User;
use App\Models\admin;
use App\Models\event;
use App\Models\Comment;
use App\Models\resource;
use App\Models\department;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function showAssignForm()
    {
        $authenticatedUser = Auth::User();
        $users = User::all();
        $departments = department::all();
        return view('admin/assign-admin', compact('users', 'departments', 'authenticatedUser'));
    }

    public function assignAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:admins',
            'department_id' => 'required|exists:departments,id',
        ], [
            'user_id.unique' => 'This member is already an admin and has a department assigned. If you want to assign another department to this user, please delete the existing assignment first and then assign the new department.'
        ]);

        $user = User::find($request->user_id);
        $admin = new admin();
        $admin->user_id = $user->id;
        $admin->department_id = $request->department_id;

        //reset usertype to admin
        $user->usertype = 'admin';
        $user->save();
        //saving admins records
        $admin->save();
        Alert::success('Message', 'Admin assigned successfully');
        return redirect()->route('showAssignForm')->with('success', 'Admin assigned successfully!');
    }

    public function deleteAdmin($id)
    {
        // Find the admin record using the provided ID
        $admin = admin::findOrFail($id);
        // Find the associated user using the user_id from the admin record
        $user = User::findOrFail($admin->user_id);
        // Reset the usertype to 'user'
        $user->usertype = 'user';
        $user->save();
        // Delete the admin record
        $admin->delete();
        Alert::success('Message', 'Admin deleted successfully');
        return redirect()->back();
    }

    //Defining Admin Methods
    public function Dashboard()
    {
        $authenticatedAdmin = Auth::user();
        $adminName = Auth::user()->fullname;
        $allMembers = User::all()->count(); //fetching total number of members from the database
        $activeMembers = user::where('payment_status', 'active')->count(); // fetching all active members
        $inactiveMembers = user::where('payment_status', 'inactive')->count(); //fetching all inactive members
        $totalDepartments = Department::all()->count();
        $members = User::where('id', '!=', $authenticatedAdmin->id)->get();
        return view('admin/AdminDashboard', compact(
            'adminName',
            'allMembers',
            'activeMembers',
            'inactiveMembers',
            'members',
            'totalDepartments',
            'authenticatedAdmin',
        ));
    }

    // yajra datatables functionalities not completed
    // public function getAllUsers(){

    //     return Datatables::of(user::query())->make(true);
    // }

    public function post()
    {

        return view('admin/post_event');
    }

    public function addMember()
    {
        return view('admin.add_Member');
    }

    public function newMember(Request $request)
    {

        $request->validate([
            'registration_number' => ['required', 'unique:users'],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'course' => ['required'],
            'category' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([

            'registration_number' => $request->input('registration_number'),
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'course' => $request->input('course'),
            'category' => $request->input('category'),
            'password' => $request->input('password'),
        ]);

        return redirect(route('AdminDashboard'))->with('message', 'Member Successfully Registered');
    }
    //deleting cyber security member
    public function memberDestroy($id)
    {

        $memberDestroy = User::findOrFail($id);
        $memberDestroy->delete();

        Alert::success('Message', 'Member delete successfully');
        return redirect()->back();
    }
    //messages from website
    public function comments()
    {
        $comments = Comment::all();
        return view('admin/comments', compact('comments'));
    }
    //deleting message
    public function commentDestroy($id)
    {

        $commentDestroy = Comment::findOrFail($id);

        $commentDestroy->delete();

        Alert::success('Message', 'Comment deleted successfully')->autoClose('5000');
        return redirect()->back();
    }
    //The following functions relates to resource repository view
    public function Repository()
    {

        $resources = Resource::latest()->Limit(3)->get();
        return view('admin/resource_repository', compact('resources'));
    }

    public function storeResource(Request $request)
    {

        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'category' => ['required'],
            'file_path' => ['required', 'file'],
        ]);

        // Store the uploaded file
        $file = $request->file('file_path');
        $filePath = $file->store('resource_files', 'public');

        Resource::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'file_path' => $filePath,
        ]);

        return redirect(route('resource_repository'))->with('message', 'Resource Posted Successfully');
    }
    public function uploadResource(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'category' => ['required'],
            'file' => ['required', 'mimes:pdf', 'max:3000'], // max:3000 is 3MB in kilobytes
            'thumbnail' => ['required', 'mimes:jpg,png', 'max:1000'],
        ], [
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string value.',
            'description.required' => 'The description is required.',
            'description.max' => 'The title must not exceed 255 characters.',
            'category.required' => 'Please select a category for the resource.',
            'file.required' => 'Please select a file to upload.',
            'file.mimes' => 'Only files of type "application/pdf" are allowed.',
            'file.max' => 'The uploaded file exceeds the maximum size of 3MB. Please select a smaller file.',
            'thumbnail.required' => 'please select find thumbnail',
            'thumbnail.mimes' => 'thumbnail can only be of type jpg or png',
            'thumbnail.max' => 'maximum thumbnail size is 1MB'
        ]);


        //PROCESSING A THUMBNAIL
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('images/resourcesThumbnails/'), $thumbnailName);
        }

        //PROCESSING AND STORING A PDF FILE
        $file = $request->file('file');
        $fileName = time() . "_" . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/uploads/pdfs', $fileName);


        //saving the information on to the database
        $newResource = new resource();

        $newResource->title = $request->title;
        $newResource->description = $request->description;
        $newResource->category = $request->category;
        $newResource->file_name = $fileName;
        $newResource->file_path = $filePath;
        $newResource->thumbnail = $thumbnailName;

        $newResource->save();

        Alert::success('Ujumbe', 'Mchakato Umefanikiwa');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $resource = Resource::findOrFail($id);

        // Delete the file from storage if it exists
        if (Storage::exists($resource->file_path)) {
            Storage::delete($resource->file_path);
        }

        // Delete the resource record from the database
        $resource->delete();

        Alert::success('Message', 'Selected resource has been deleted successfully');
        return redirect()->back();
    }
    public function documentPreview($fileName)
    {
        // Ensure you are fetching the document using the correct field
        $document = Resource::where('file_name', $fileName)->first();

        if (!$document) {
            Alert::error('Message', 'Something went wrong');
            return redirect()->back();
        }

        // Get the storage path for the document file
        $filePath = storage_path('app/public/uploads/pdfs/' . $fileName);

        if (!file_exists($filePath)) {
            Alert::error('Message', 'Document does not exist on our server');
            return redirect()->back();
        }

        // Return a response to display the PDF in the browser
        return response()->file($filePath);
    }

    // reserved function for previewing first page of the uploaded pdf as

    // public function documentPreview($fileName)
    // {
    //     $document = Resource::where('file_path', $fileName)->first();

    //     if (!$document) {
    //         Alert::error('Message', 'Something went wrong');
    //         return redirect()->back();
    //     }

    //     $filePath = storage_path('app/public/uploads/pdfs/' . $fileName);

    //     if (!file_exists($filePath)) {
    //         Alert::error('Message', 'Document does not exist in our server');
    //         return redirect()->back();
    //     }

    //   // Generate a preview image of the first page of the PDF
    // $previewPath = storage_path('app/public/uploads/pdfs/' . $fileName . '.png');
    // if (!file_exists($previewPath)) {
    //     $imagick = new Imagick();
    //     $imagick->setResolution(300, 300); // Set the resolution (e.g., 300 DPI)
    //     $imagick->readImage($filePath . '[0]'); // [0] to extract the first page
    //     $imagick->setImageFormat('png');
    //     $imagick->setImageCompressionQuality(100); // Set the compression quality (100 for maximum quality)
    //     $imagick->writeImage($previewPath);
    //     $imagick->clear();
    //     $imagick->destroy();
    //     }

    //     // Return a response to display the preview image in the browser
    //     return response()->file($previewPath);
    // }


    // public function documentPreview($fileName)
    // {
    //     // Find the PDF record by file name
    //     $pdf = resource::where('file_path', $fileName)->first();

    //     if (!$pdf) {
    //         return response()->json(['error' => 'PDF not found'], 404);
    //     }

    //     // Get the storage path for the PDF file
    //     $filePath = storage_path('app/public/' . $pdf->file_path);

    //     // Check if the file exists
    //     if (!file_exists($filePath)) {
    //         return response()->json(['error' => 'PDF file not found'], 404);
    //     }

    //     // Return a response to display the PDF in the browser
    //     return response()->file($filePath);
    // }

    public function memberList()
    {

        $members = User::all();

        return view('admin.member_list', compact('members'));
    }

    public function departments()
    {
        $departments = Department::with('admins.user')->where('dept_name', '!=', 'root')->get();
        return view('admin.departments', compact('departments'));
    }
    public function departmentDestroy($id)
    {
        $departmentDestroy = department::findOrFail($id);
        $departmentDestroy->delete();

        Alert::success('Message', 'Department Successfully deleted');
        return redirect()->back();
    }
    public function addDepartment(Request $request)
    {

        return view('admin/add_department');
    }

    public function newDepartment(Request $request)
    {

        $request->validate([
            'dept_name' => ['required', 'unique:departments'],
            'dept_description' => ['required', 'string'],
        ], [
            'dept_name.required' => 'Please enter Department name',
            'dept_name.unique' => 'The department is already registered',
            'dept_description.required' => 'Please enter department description',
        ]);

        $newDepartment = new department();

        $newDepartment->dept_name = $request->dept_name;
        $newDepartment->dept_description = $request->dept_description;

        $newDepartment->save();

        return redirect(route('departments'))->with('message', 'New Department Added');
    }

    public function update($id)
    {

        $members = User::find($id);
        // return redirect()->with('message', 'Information Updated Successfully');
        return view('admin.update', compact('members'));
    }

    public function edit(Request $request, $id)
    {

        $member = User::find($id);

        $member->update($request->input());

        Alert::success('Message', 'Information updated successfully');
        return redirect()->route('AdminDashboard');
    }

    public function eventUpload(Request $request)
    {
        $request->validate([
            'event_name' => ['required'],
            'event_date' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:9048',
            'event_description' => ['required'],
        ]);

        // Handle File Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/events'), $imageName);
        } else {
            $imageName = null;
        }

        // Create Event
        Event::create([
            'event_name' => $request->input('event_name'),
            'event_date' => $request->input('event_date'),
            'image' => $imageName,
            'event_description' => $request->input('event_description'),
        ]);

        return redirect()->route('AdminDashboard')->with('message', 'Event Created Successfully');
    }
    public  function Events()
    {

        $events = Event::all();

        return view('admin/events', compact('events'));
    }
    public function financialPanel()
    {
        return view('admin.financial');
    }
    public function allRegisteredMembersPDF()
    {
        $users = User::all();
        $totalNumber = User::all()->count();
        $currentDateTime = now()->format('Y-m-d');
        $authenticatedUser = Auth::user()->fullname;

        $htmlContent = '<h3 style="text-align: center;">All ICT CLUB REGISTERED MEMBERS</h3>';
        $htmlContent .= '<table border="1" style="border-collapse: collapse; width: 100%; font-family: Franklin Gothic Medium, Arial Narrow, Arial, sans-serif;">';
        $htmlContent .= '<thead style="background-color: #d8c9f3;">';
        $htmlContent .= '<tr>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">S/N</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Name</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">REGISTRATION NUMBER</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">DATE REGISTERED</th>';
        $htmlContent .= '</tr>';
        $htmlContent .= '</thead>';
        $htmlContent .= '<tbody>';

        $counter = 1;
        foreach ($users as $user) {
            $htmlContent .= '<tr>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $counter++ . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $user->fullname . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $user->registration_number . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $user->created_at->format('Y-m-d') . '</td>';
            $htmlContent .= '</tr>';
        }

        $htmlContent .= '</tbody>';
        $htmlContent .= '</table>';

        // Add text below the table
        $htmlContent .= '<p><strong>Total: </strong> </strong>' . $totalNumber . '</p>';
        $htmlContent .= '<p style="text-align: center; font-size: 12px; margin-top: 10px;">Printed on: ' . $currentDateTime . '</p>';
        $htmlContent .= '<p style="text-align: center; font-size: 12px;">Printed by: ' . $authenticatedUser . '</p>';
        $htmlContent .= '<p style="text-align: center; font-weight: bold; margin-top: 20px;">Mwecau ICT Club</p>';

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdf->setOptions($options);

        $pdf->loadHtml($htmlContent);


        $pdf->render();

        // Add watermark as image
        $canvas = $pdf->getCanvas();
        $imagePath = public_path('img/mwecau.png'); // Adjust path to your watermark image
        $imgWidth = 200; // Adjust the width of the watermark
        $imgHeight = 200; // Adjust the height of the watermark
        $canvas->set_opacity(0.3, "Multiply"); // Set the opacity of the watermark
        $x = ($canvas->get_width() - $imgWidth) / 2;
        $y = ($canvas->get_height() - $imgHeight) / 2;
        $canvas->image($imagePath, $x, $y, $imgWidth, $imgHeight);

        // Output the generated PDF file
        return $pdf->stream('Mwecau ICT Club Registered Members.pdf');
    }
}
