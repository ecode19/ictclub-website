<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\event;
use App\Models\resource;
use App\Models\department;
use App\Models\Comment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Dompddf\Dompdf;
use Dompdf\Options;
use Imagick;

class AdminController extends Controller
{

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
        return view('admin/AdminDashboard', compact('adminName', 'allMembers', 'activeMembers', 'inactiveMembers', 'members', 'totalDepartments', 'authenticatedAdmin'));
    }

    // yajra datatables functionalities not completed
    // public function getAllUsers(){

    //     return Datatables::of(user::query())->make(true);
    // }

    public function post()
    {

        return view('admin/post_event');
    }
    // public function addMember()
    // {

    //     return view('admin/add_member');
    // }
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
        $comments = Comment::where('category', 'cyber_security')->get();
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

        $resources = Resource::all();
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


        //file proccessing
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('images/resourcesThumbnails/'), $thumbnailName);
        }

        //get the uploaded file
        $file = $request->file('file');

        //generating unique name of the uploaded file
        $fileName = time() . "_" . $file->getClientOriginalName();

        //storing the uploaded file in storage/app/public/uploads/pdfs
        $file->storeAs('public/uploads/pdfs', $fileName);
        // $file->storeAs('public', $fileName);

        //saving the information on to the database
        $newResource = new resource();

        $newResource->title = $request->title;
        $newResource->description = $request->description;
        $newResource->category = $request->category;
        $newResource->file_name = $file->getClientOriginalName();
        $newResource->file_path = $fileName;
        $newResource->thumbnail = $thumbnailName;

        $newResource->save();

        Alert::success('Ujumbe', 'Mchakato Umefanikiwa');
        return redirect()->back();
    }


    //previewing uploaded files
    public function documentPreview($fileName)
    {

        $document = resource::where('file_path', $fileName)->first();

        if (!$document) {

            Alert::error('Message', 'something went wrong');
            return redirect()->back();
        }

        //getting the storage path for our document file

        $filePath = storage_path('app/public/uploads/pdfs/' . $fileName);

        if (!file_exists($filePath)) {

            Alert::error('Message', 'Document does not exist in our server');
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

        $departments = Department::where('dept_name', '!=', 'root')->get();

        return view('admin/departments', compact('departments'));
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
        ]);

        department::create([
            'dept_name' => $request->input('dept_name'),
            'dept_description' => $request->input('dept_description'),
        ]);

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
}
