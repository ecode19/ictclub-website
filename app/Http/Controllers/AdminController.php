<?php

namespace App\Http\Controllers;
use App\Models\user;
use App\Models\event;
use App\Models\resource;
use App\Models\department;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{

    //Defining Admin Methods
    public function Dashboard(){

        $adminName = Auth::user()->fullname;

    $allMembers = User::all()->count();//fetching total number of members from the database
    $activeMembers = user::where('payment_status', 'active')->count(); // fetching all active members
    $inactiveMembers = user::where('payment_status', 'inactive')->count(); //fetching all inactive members
        $totalDepartments = Department::all()->count();
    $members = User::all();
        return view ('admin/AdminDashboard', compact('adminName', 'allMembers', 'activeMembers', 'inactiveMembers','members','totalDepartments'));
    }
    public function post(){

        return view ('admin/post_event');
    }

    public function addMember(){

        return view ('admin/add_member');
    }

    public function newMember(Request $request){

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
            'email'=>$request->input('email'),
            'course'=>$request->input('course'),
            'category'=>$request->input('category'),
            'password'=>$request->input('password'),
        ]);

        return redirect(route('AdminDashboard'))->with('message', 'Member Successfully Registered');
    }

    //The following functions relates to resource repository view
     public function Repository(){

         $resources = Resource::all();
        return view ('admin/resource_repository', compact('resources'));
    }

    public function storeResource(Request $request){

        $request->validate([
            'title' => ['required'],
            'description'=>['required'],
            'category'=>['required'],
            'file_path'=>['required', 'file'],
        ]);

        // Store the uploaded file
        $file = $request->file('file_path');
        $filePath = $file->store('resource_files', 'public');

        Resource::create([
            'title' =>$request->input('title'),
            'description'=>$request->input('description'),
            'category'=>$request->input('category'),
            'file_path' =>$filePath,
        ]);

        return redirect(route('resource_repository'))->with('message', 'Resource Posted Successfully');
    }
     public function memberList(){

        $members = User::all();

        return view ('admin.member_list', compact('members'));
    }

    public function departments(){

        $departments = Department::all();

        return view ('admin/departments', compact('departments'));
    }

    public function addDepartment(Request $request){

        return view ('admin/add_department');
    }

    public function newDepartment(Request $request){

        $request->validate([
            'dept_name' => ['required', 'unique:departments'],
            'dept_description' => ['required' ,'string'],
        ]);

        department::create([
            'dept_name' => $request->input('dept_name'),
            'dept_description' => $request->input('dept_description'),
        ]);

        return redirect(route('departments'))->with('message', 'New Department Added');
    }

    public function update($id){

        $members = User::find($id);
        // return redirect()->with('message', 'Information Updated Successfully');
        return view ('admin.update', compact('members'));
    }

    public function edit(Request $request, $id){

        $member = User::find($id);

        $member->update($request->input());


        return redirect()->route('AdminDashboard')->with('message', 'Information Updated Successfully');
    }

    public function eventUpload(Request $request){
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
    public  function Events(){

        $events = Event::all();

        return view('admin/events', compact('events'));
    }
}
