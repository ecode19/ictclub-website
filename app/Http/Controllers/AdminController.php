<?php

namespace App\Http\Controllers;

use Imagick;
use DataTables;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\admin;
use App\Models\event;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\resource;
use App\Models\department;
use App\Models\Team_member;
use Illuminate\Http\Request;
use Dompdf\Image\ImageLoader;
use App\Models\Registration_number;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Rules\UniqueRegistrationNumber;
use Illuminate\Support\Facades\Storage;
use Illuminate\Cache\RateLimiting\Limit;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function showAssignForm()
    {
        $authenticatedUser = Auth::User();
        $users = User::all();
        $departments = department::all();
        $admins = Admin::with('department')->get();
        return view('admin/assign-admin', compact(
            'users',
            'departments',
            'authenticatedUser',
            'admins'
        ));
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
    //deleting member
    public function memberDestroy($id)
    {

        $memberDestroy = User::findOrFail($id);
        $memberDestroy->delete();

        Alert::success('Message', 'Member delete successfully');
        return redirect()->back();
    }
    public function activeMemberList()
    {

        $activeMembers = User::where('payment_status', 'active')
        ->where('usertype', '!=', 'admin')
        ->get();
        return view('admin.active-members', compact('activeMembers'));
    }
    public function inactiveMemberList()
    {

        $inactiveMembers = User::where('payment_status', 'inactive')
        ->where('usertype', '!=', 'admin')
        ->get();
        return view('admin.inactive-members', compact('inactiveMembers'));
    }
    //registering registration numbers
    public function registerNumbers()
    {
        $totalNumbers = registration_number::all()
            ->count();
        return view('admin.registration-numbers', compact('totalNumbers'));
    }
    //here department registers member registration before member sign up.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'registration_numbers.*' => ['required', 'string', 'max:255', new UniqueRegistrationNumber],
        ]);

        $existingNumbers = []; // Array to store existing registration numbers
        $errors = []; // Array to store error messages

        foreach ($validatedData['registration_numbers'] as $registrationNumber) {
            // Check if registration number already exists
            if (Registration_number::where('registration_number', $registrationNumber)->exists()) {
                $errors[] = "Registration number '$registrationNumber' already exists.";
                $existingNumbers[] = $registrationNumber; // Optional: Store existing numbers for user feedback
            } else {
                // Store the registration number in the database if it's unique
                Registration_number::create(['registration_number' => $registrationNumber]);
            }
        }

        if (count($errors) > 0) {
            // Handle errors: display them or redirect with error message
            Alert::error('error', 'Some entered have been exluded as they already exist in our records.')->autoClose('8000');
            return redirect()->back()->withErrors($errors); // Flash error messages to the session
        } else {
            Alert::success('Success', 'Registration numbers stored successfully.');
            return redirect()->back();
        }
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

        $resources = Resource::latest()
        ->with('user')
        ->Limit(3)
        ->get();
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

        $newResource->user_id = Auth::id();
        $newResource->title = $request->title;
        $newResource->description = $request->description;
        $newResource->category = $request->category;
        $newResource->file_name = $fileName;
        $newResource->file_path = $filePath;
        $newResource->thumbnail = $thumbnailName;

        $newResource->save();

        Alert::success('Message', 'Resource Posted Successfully');
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
        $users = user::where('usertype', '!=', 'admin')->get();
        $payments = payment::with('user')->get();
        return view('admin.financial', compact('payments', 'users'));
    }
    public function addMemberPaymentDetails(Request $request)
    {

        $request->validate([
            'user_id' => ['required', 'unique:payments,user_id'],
            'date_paid' => ['required'],
            'expiration_date' => ['required'],
        ], [
            'user_id.required' => 'Please Select user',
            'user_id.unique' => 'This Member has payment records. Please re-check and confirm',
            'date_paid' => 'Please select a valid date of the payment',
            'expiration_date' => 'Please enter the date of expirataion'
        ]);

        $user = User::find($request->user_id); //finding a user by id

        $newPayment = new payment();
        $newPayment->user_id = $request->user_id;
        $newPayment->payment_status = 'active';
        $newPayment->date_paid = $request->date_paid;
        $newPayment->expiration_date = $request->expiration_date;
        $newPayment->amount = '2000';

        //directly updating usertype in users table
        $user->payment_status = 'active';
        $user->save();
        //saving other payment details
        $newPayment->save();
        Alert::success('Message', 'Payment Information successfully added');
        return redirect()->back();
    }
    //updating member payment informations
    public function changePaymentInfoView($id)
    {

        $payments = payment::findOrFail($id);
        return view('admin.update-user-financial-details', compact('payments'));
    }
    public function changePaymentExpirationDate(Request $request)
    {

        $request->validate([
            'date_paid' => ['required'],
            'expiration_date' => ['required']
        ]);

        $newExpirationDate = new payment();

        //checking if user have payment records
        // if(exists->$newExpirtaionDate->user_id)

        $newExpirationDate->user_id = $request->user_id;
        $newExpirationDate->payment_status = 'active';
        $newExpirationDate->date_paid = $request->date_paid;
        $newExpirationDate->expiration_date = $request->expiration_date;
        $newExpirationDate->amount = '2000';

        //saving
        $newExpirationDate->save();
        Alert::success('Message', 'Successfully updated');
        return redirect()->back();
    }
    //managing website routes
    public function teamMember()
    {

        $teamMembers = team_member::all();
        return view('admin/team-member', compact('teamMembers'));
    }
    //team members function
    public function addTeamMember(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string',  'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'professionalism' => ['string', 'max:70'],
            'email' => ['required', 'email', 'unique:team_members'],
            'x' => ['nullable', 'url'],
            'whatsApp' => ['nullable', 'url'],
            'facebook' => ['nullable', 'url'],
            'profile_image' => ['required', 'mimes: jpg,png', 'max:1024'],
        ], [
            'name.required' => 'Team member name is required',
            'name.max' => 'Team member name too long',
            'title.required' => 'Team member title is required',
            'title.max' => 'Team member title too long',
            'x.url' => 'Please enter a valid url',
            'whatsApp.url' => 'Please enter a valid url',
            'facebook.url' => 'Please enter a valid url',
            'profile_iamge.required' => 'Please select profile required',
            'profile_image.mime' => 'You can only upload .jpg or .pgn file',
            'profile_image.max' => 'Image to upload should not exceed 1MB',
        ]);

        $newTeamMember = new team_member();
        //profile image proccessing
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $profileImageName = time() . '_' . $profileImage->getClientOriginalName();
            $profileImage->move(public_path('images/profilePictures'), $profileImageName);

            $newTeamMember->profile_image = $profileImageName;
        }

        $newTeamMember->name = $request->name;
        $newTeamMember->title = $request->title;
        $newTeamMember->professionalism = $request->professionalism;
        $newTeamMember->email = $request->email;
        $newTeamMember->x = $request->x;
        $newTeamMember->whatsApp = $request->whatsApp;
        $newTeamMember->facebook = $request->facebook;

        $newTeamMember->save();
        Alert::success('Message', 'Successfully Added');
        return redirect()->back();
    }
    public function editTeamMember($id){

        $member = team_member::findOrFail($id);
        return view('admin.edit-team-member', compact('member'));
    }
    public function updateTeamMember(Request $request, $id){

        $updateTeamMember = team_member::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string',  'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'professionalism' => ['string', 'max:100'],
            'email' => ['required', 'email'],
            'x' => ['nullable', 'url'],
            'whatsApp' => ['nullable', 'url'],
            'facebook' => ['nullable', 'url'],
            'profile_image' => ['mimes: jpg,png', 'max:1024'],
        ], [
            'name.required' => 'Team member name is required',
            'name.max' => 'Team member name too long',
            'title.max' => 'Team member title too long',
            'x.url' => 'Please enter a valid url',
            'whatsApp.url' => 'Please enter a valid url',
            'facebook.url' => 'Please enter a valid url',
            'profile_iamge.required' => 'Please select profile required',
            'profile_image.mime' => 'You can only upload .jpg or .pgn file',
            'profile_image.max' => 'Image to upload should not exceed 1MB',
        ]);

        if($request->hasFile('profile_image')){
            $profileImage = $request->file('profile_image');
            $profileImageName = time() . '_' . $profileImage->getClientOriginalName();
            $profileImage->move(public_path('images/profilePictures'), $profileImageName);

            //checking and deleting the existing profile image
            $existingProfileImage = public_path('images/profilePictures' . DIRECTORY_SEPARATOR . $updateTeamMember->profile_image);
            if(File::exists($existingProfileImage)){
                File::delete($existingProfileImage);
            }
            $updateTeamMember->profile_image = $profileImageName;
        }

        //saving other details

        $updateTeamMember->name = $request->name;
        $updateTeamMember->title = $request->title;
        $updateTeamMember->professionalism = $request->professionalism;
        $updateTeamMember->email = $request->email;
        $updateTeamMember->x = $request->x;
        $updateTeamMember->whatsApp = $request->whatsApp;
        $updateTeamMember->facebook = $request->facebook;

        $updateTeamMember->update();
        Alert::success('Message', 'Successfully updated');
        return redirect()->back();
    }
    //document related routes
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
        $imagePath = public_path('img/logo.png'); // Adjust path to your watermark image
        $imgWidth = 200; // Adjust the width of the watermark
        $imgHeight = 230; // Adjust the height of the watermark
        $canvas->set_opacity(0.3, "Multiply"); // Set the opacity of the watermark
        $x = ($canvas->get_width() - $imgWidth) / 2;
        $y = ($canvas->get_height() - $imgHeight) / 2;
        $canvas->image($imagePath, $x, $y, $imgWidth, $imgHeight);

        // Output the generated PDF file
        return $pdf->stream('Mwecau ICT Club Registered Members.pdf');
    }
    public function activeMembers()
    {
        $activeMembers = User::where('payment_status', 'active')->get();
        $totalNumber = User::where('payment_status', 'active')->count();
        $currentDateTime = now()->format('Y-m-d');
        $authenticatedUser = Auth::user()->fullname;

        $htmlContent = '<h3 style="text-align: center;">ICT CLUB active Members</h3>';
        $htmlContent .= '<table border="1" style="border-collapse: collapse; width: 100%; font-family: Franklin Gothic Medium, Arial Narrow, Arial, sans-serif;">';
        $htmlContent .= '<thead style="background-color: gray; color: white;">';
        $htmlContent .= '<tr>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">S/N</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Name</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Registration Number</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Status</th>';
        $htmlContent .= '</tr>';
        $htmlContent .= '</thead>';
        $htmlContent .= '<tbody>';

        $counter = 1;
        foreach ($activeMembers as $activeMember) {
            $htmlContent .= '<tr>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $counter++ . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $activeMember->fullname . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $activeMember->registration_number . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px color: #ddd;">' . $activeMember->payment_status . '</td>';
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
        $imagePath = public_path('img/logo.png'); // Adjust path to your watermark image
        $imgWidth = 200; // Adjust the width of the watermark
        $imgHeight = 230; // Adjust the height of the watermark
        $canvas->set_opacity(0.3, "Multiply"); // Set the opacity of the watermark
        $x = ($canvas->get_width() - $imgWidth) / 2;
        $y = ($canvas->get_height() - $imgHeight) / 2;
        $canvas->image($imagePath, $x, $y, $imgWidth, $imgHeight);

        // Output the generated PDF file
        return $pdf->stream('ICT Club active members.pdf');
    }
    public function inactiveMembers()
    {
        $inactiveMembers = User::where('payment_status', 'inactive')->get();
        $totalNumber = User::where('payment_status', 'inactive')->count();
        $currentDateTime = now()->format('Y-m-d');
        $authenticatedUser = Auth::user()->fullname;

        $htmlContent = '<h3 style="text-align: center; color: red;">ICT CLUB inactive Members</h3>';
        $htmlContent .= '<table border="1" style="border-collapse: collapse; width: 100%; font-family: Franklin Gothic Medium, Arial Narrow, Arial, sans-serif;">';
        $htmlContent .= '<thead style="background-color: gray; color: white;">';
        $htmlContent .= '<tr>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">S/N</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Name</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Registration Number</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px">Status</th>';
        $htmlContent .= '</tr>';
        $htmlContent .= '</thead>';
        $htmlContent .= '<tbody>';

        $counter = 1;
        foreach ($inactiveMembers as $inactiveMember) {
            $htmlContent .= '<tr>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $counter++ . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $inactiveMember->fullname . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $inactiveMember->registration_number . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd; color: red;">' . $inactiveMember->payment_status . '</td>';
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
        $imagePath = public_path('img/logo.png'); // Adjust path to your watermark image
        $imgWidth = 200; // Adjust the width of the watermark
        $imgHeight = 230; // Adjust the height of the watermark
        $canvas->set_opacity(0.3, "Multiply"); // Set the opacity of the watermark
        $x = ($canvas->get_width() - $imgWidth) / 2;
        $y = ($canvas->get_height() - $imgHeight) / 2;
        $canvas->image($imagePath, $x, $y, $imgWidth, $imgHeight);

        // Output the generated PDF file
        return $pdf->stream('ICT Club inactive members.pdf');
    }
    public function departmentList()
    {
        $departments = Department::with('admins.user')
            ->get();
        $totalNumber = Department::where('dept_name', '!=', 'root')->count();
        $currentDateTime = now()->format('Y-m-d');
        $authenticatedUser = Auth::user()->fullname;

        $htmlContent = '<h3 style="text-align: center;">ICT CLUB Departments</h3>';
        $htmlContent .= '<table border="1" style="border-collapse: collapse; width: 100%; font-family: Franklin Gothic Medium, Arial Narrow, Arial, sans-serif;">';
        $htmlContent .= '<thead style="background-color: gray; color: white;">';
        $htmlContent .= '<tr>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">S/N</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Name</th>';
        $htmlContent .= '</tr>';
        $htmlContent .= '</thead>';
        $htmlContent .= '<tbody>';

        $counter = 1;
        foreach ($departments as $department) {
            $htmlContent .= '<tr>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $counter++ . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $department->dept_name . '</td>';
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
        $imagePath = public_path('img/logo.png'); // path to watermark image
        $imgWidth = 200; // Adjust the width of the watermark
        $imgHeight = 230; // Adjust the height of the watermark
        $canvas->set_opacity(0.3, "Multiply"); // Set the opacity of the watermark
        $x = ($canvas->get_width() - $imgWidth) / 2;
        $y = ($canvas->get_height() - $imgHeight) / 2;
        $canvas->image($imagePath, $x, $y, $imgWidth, $imgHeight);

        // Output the generated PDF file
        return $pdf->stream('ICT Club Departments.pdf');
    }
    public function cyberMembers()
    {
        $cyberMembers = User::where('category', 'cyber security')->get();
        $totalNumber = User::where('category', 'cyber security')->count();
        $currentDateTime = now()->format('Y-m-d');
        $authenticatedUser = Auth::user()->fullname;

        $htmlContent = '<h3 style="text-align: center;">ICT Club Cyber Security Members</h3>';
        $htmlContent .= '<table border="1" style="border-collapse: collapse; width: 100%; font-family: Franklin Gothic Medium, Arial Narrow, Arial, sans-serif;">';
        $htmlContent .= '<thead style="background-color: gray; color: white;">';
        $htmlContent .= '<tr>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">S/N</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Name</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Registration Number</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Date registered</th>';
        $htmlContent .= '</tr>';
        $htmlContent .= '</thead>';
        $htmlContent .= '<tbody>';

        $counter = 1;
        foreach ($cyberMembers as $cyberMember) {
            $htmlContent .= '<tr>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $counter++ . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $cyberMember->fullname . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $cyberMember->registration_number . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $cyberMember->created_at->format('Y-m-d') . '</td>';
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
        $imagePath = public_path('img/logo.png'); // Adjust path to your watermark image
        $imgWidth = 200; // Adjust the width of the watermark
        $imgHeight = 230; // Adjust the height of the watermark
        $canvas->set_opacity(0.3, "Multiply"); // Set the opacity of the watermark
        $x = ($canvas->get_width() - $imgWidth) / 2;
        $y = ($canvas->get_height() - $imgHeight) / 2;
        $canvas->image($imagePath, $x, $y, $imgWidth, $imgHeight);

        // Output the generated PDF file
        return $pdf->stream('ICT club cyber security members.pdf');
    }
    public function programmingMembers()
    {
        $programmingMembers = User::where('category', 'programming')->get();
        $totalNumber = User::where('category', 'programming')->count();
        $currentDateTime = now()->format('Y-m-d');
        $authenticatedUser = Auth::user()->fullname;

        $htmlContent = '<h3 style="text-align: center;">ICT Club Programming Members</h3>';
        $htmlContent .= '<table border="1" style="border-collapse: collapse; width: 100%; font-family: Franklin Gothic Medium, Arial Narrow, Arial, sans-serif;">';
        $htmlContent .= '<thead style="background-color: gray; color: white;">';
        $htmlContent .= '<tr>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">S/N</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Name</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Registration Number</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Date registered</th>';
        $htmlContent .= '</tr>';
        $htmlContent .= '</thead>';
        $htmlContent .= '<tbody>';

        $counter = 1;
        foreach ($programmingMembers as $programmingMember) {
            $htmlContent .= '<tr>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $counter++ . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $programmingMember->fullname . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $programmingMember->registration_number . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $programmingMember->created_at->format('Y-m-d') . '</td>';
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
        $imagePath = public_path('img/logo.png'); // Adjust path to your watermark image
        $imgWidth = 200; // Adjust the width of the watermark
        $imgHeight = 230; // Adjust the height of the watermark
        $canvas->set_opacity(0.3, "Multiply"); // Set the opacity of the watermark
        $x = ($canvas->get_width() - $imgWidth) / 2;
        $y = ($canvas->get_height() - $imgHeight) / 2;
        $canvas->image($imagePath, $x, $y, $imgWidth, $imgHeight);

        // Output the generated PDF file
        return $pdf->stream('ICT club programming members.pdf');
    }
    public function graphicsMembers()
    {
        $graphicsMembers = User::where('category', 'graphics designing')->get();
        $totalNumber = User::where('category', 'graphics designing')->count();
        $currentDateTime = now()->format('Y-m-d');
        $authenticatedUser = Auth::user()->fullname;

        $htmlContent = '<h3 style="text-align: center;">ICT Club Graphics Members</h3>';
        $htmlContent .= '<table border="1" style="border-collapse: collapse; width: 100%; font-family: Franklin Gothic Medium, Arial Narrow, Arial, sans-serif;">';
        $htmlContent .= '<thead style="background-color: gray; color: white;">';
        $htmlContent .= '<tr>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">S/N</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Name</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Registration Number</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Date registered</th>';
        $htmlContent .= '</tr>';
        $htmlContent .= '</thead>';
        $htmlContent .= '<tbody>';

        $counter = 1;
        foreach ($graphicsMembers as $graphicsMember) {
            $htmlContent .= '<tr>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $counter++ . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $graphicsMember->fullname . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $graphicsMember->registration_number . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $graphicsMember->created_at->format('Y-m-d') . '</td>';
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
        $imagePath = public_path('img/logo.png'); // Adjust path to your watermark image
        $imgWidth = 200; // Adjust the width of the watermark
        $imgHeight = 230; // Adjust the height of the watermark
        $canvas->set_opacity(0.3, "Multiply"); // Set the opacity of the watermark
        $x = ($canvas->get_width() - $imgWidth) / 2;
        $y = ($canvas->get_height() - $imgHeight) / 2;
        $canvas->image($imagePath, $x, $y, $imgWidth, $imgHeight);

        // Output the generated PDF file
        return $pdf->stream('ICT club graphics members.pdf');
    }
    public function verifiedNumbers()
    {
        $registrationNumbers = Registration_number::all();
        $totalNumber = Registration_number::all()->count();
        $currentDateTime = now()->format('Y-m-d');
        $authenticatedUser = Auth::user()->fullname;

        $htmlContent = '<h3 style="text-align: center;">All ICT CLUB Vefiried Numbers</h3>';
        $htmlContent .= '<table border="1" style="border-collapse: collapse; width: 100%; font-family: Franklin Gothic Medium, Arial Narrow, Arial, sans-serif;">';
        $htmlContent .= '<thead style="background-color: #033392; color: white;">';
        $htmlContent .= '<tr>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">S/N</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Registration Number</th>';
        $htmlContent .= '<th style="padding: 8px; text-align: left; border: 1px ">Date Verified</th>';
        $htmlContent .= '</tr>';
        $htmlContent .= '</thead>';
        $htmlContent .= '<tbody>';

        $counter = 1;
        foreach ($registrationNumbers as $registrationNumber) {
            $htmlContent .= '<tr>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $counter++ . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $registrationNumber->registration_number . '</td>';
            $htmlContent .= '<td style="padding: 8px; text-align: left; border: 1px solid #ddd;">' . $registrationNumber->created_at->format('Y-m-d') . '</td>';
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
        $imagePath = public_path('img/logo.png'); // Adjust path to your watermark image
        $imgWidth = 200; // Adjust the width of the watermark
        $imgHeight = 230; // Adjust the height of the watermark
        $canvas->set_opacity(0.3, "Multiply"); // Set the opacity of the watermark
        $x = ($canvas->get_width() - $imgWidth) / 2;
        $y = ($canvas->get_height() - $imgHeight) / 2;
        $canvas->image($imagePath, $x, $y, $imgWidth, $imgHeight);

        // Output the generated PDF file
        return $pdf->stream('ICT Club Verified Numbers.pdf');
    }
}
