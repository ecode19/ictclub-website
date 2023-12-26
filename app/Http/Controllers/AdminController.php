<?php

namespace App\Http\Controllers;
use App\Models\user;
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
    $members = User::all();
        return view ('admin/Dashboard', compact('adminName', 'allMembers', 'activeMembers', 'inactiveMembers','members'));
    }
    public function post(){

        return view ('admin/post_event');
    }

    public function addMember(){

        return view ('admin/add_member');
    }

     public function Repository(){

        return view ('admin/resource_repository');
    }

     public function memberList(){

        $members = User::all();

        return view ('admin.member_list', compact('members'));
    }

    public function departments(){

        return view ('admin/departments');
    }

    public function addDepartment(){

        return view ('admin/add_department');
    }

    public function update($id){

        $members = User::find($id);
        // return redirect()->with('message', 'Information Updated Successfully');
        return view ('admin.update', compact('members'));
    }

    public function edit(){

        $members = User::find($id);

    // Use $request instead of $request::all()
    $members->update($request->all());
    $members->save();
    return redirect()->route('Dashboard')->with('message', 'Details Successfully Updated');
    }


}
