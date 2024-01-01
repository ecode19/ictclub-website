<?php

namespace App\Http\Controllers;
use App\Models\resource;
use App\Models\user;
use App\Models\event;
use Illuminate\Http\Request;

use Auth;

class UserController extends Controller
{
    //
    public function Dashboard()
    {
        $userInfo = Auth::user();

        // Fetch users with the same category as the logged-in user
        $usersInSameCategory = User::where('category', $userInfo->category)
            ->where('id', '<>', $userInfo->id) // Exclude the logged-in user from the results
            ->get();

        return view('user/Dashboard', compact('userInfo', 'usersInSameCategory'));
    }

    //this function returns announcement page with Event Details from Events Table
    public function announcement()
    {
        $events = Event::all();
        return view('user/announcement', compact('events'));
    }

    // This function returns the more Detailed page of a specific event
    public function showEventDetails($id){


        $similarEvents = Event::all(); //other related event to specific opened event page
        $showEventDetails = Event::find($id);
        $innerEvent = Event::find($id);//fetching data of a specific event using ID

        return view('user/EventDetails', compact('showEventDetails','similarEvents', 'innerEvent'));
    }

    public function showInner($id){

        $innerEvent = Event::find($id);
        return view('user/EventDetails', compact( 'innerEvent'));
    }

    public function event()
    {

        $user = Auth::user()->payment_status;
        return view('user/event', compact('user'));
    }

    //This function return User membership card Information
    public function membershipCard()
    {

        return view('user/membershipCard');
    }

    //This function returns User Resources Page
    public function resourcesView()
    {

        $resources = Resource::all();
        return view('user/resourcesView', compact('resources'));
    }

    public function profileUpdate($id)
    {

        $userInfo = User::find($id);

        return view('user/profileUpdate', compact('userInfo'));
    }

    public function updateProfile(Request $request)
    {

//        dd($request->all());
        $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:9048',
        ]);

         //Retrieve the authenticated user
        $user = auth()->user();

        // Processing file
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profilePictures'), $imageName);

            // Update the user's profile picture in the database
            $user->update([
                'profile_picture' => $imageName,
            ]);
        }

        return redirect()->route('Dashboard')->with('success', 'Profile updated successfully');
    }

    public function discusionForum(){

        $userInfo = Auth::user();
        return view ('user/discusion_forum', compact('userInfo'));
    }

    public function accessDenied(){

         return view('user/accessDenied');
    }
}
