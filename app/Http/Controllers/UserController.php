<?php

namespace App\Http\Controllers;

use App\Models\resource;
use App\Models\user;
use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function Dashboard()
    {
        $authenticatedUser = Auth::user();

        // Fetch users with the same category as the logged-in user
        $fellowMembers = User::where('category', $authenticatedUser->category)
            ->where('id', '!=', $authenticatedUser->id) //exclude logged in user
            ->get();

        return view('user/Dashboard', compact('authenticatedUser', 'fellowMembers'));
    }

    //returns announcement page with Event Details from Events Table
    public function announcement()
    {
        $events = Event::all();
        return view('user/announcement', compact('events'));
    }

    //returns the more Detailed page of a specific event
    public function showEventDetails($id)
    {


        $similarEvents = Event::all(); //other related event to specific opened event page
        $showEventDetails = Event::find($id);
        $innerEvent = Event::find($id); //fetching data of a specific event using ID

        return view('user/EventDetails', compact('showEventDetails', 'similarEvents', 'innerEvent'));
    }

    public function showInner($id)
    {

        $innerEvent = Event::find($id);
        return view('user/EventDetails', compact('innerEvent'));
    }

    public function event()
    {

        $user = Auth::user()->payment_status;
        return view('user/event', compact('user'));
    }

    //This function return User membership card Information
    public function membershipCard()
    {

        return view('user/membership-card');
    }

    //This function returns User Resources Page
    public function resources()
    {

        $resources = Resource::all();
        return view('user/resources', compact('resources'));
    }

    //previewing uploaded files
    public function documentPreview($fileName)
    {

        $document = resource::all()->where('file_path', $fileName);

        if (!$document) {

            Alert::error('Message', 'something went wrong');
            return redirect()->back();
        }

        //getting the storage path for our document file

        $filePath = storage_path('app/public/uploads/pdfs/' . $fileName);

        if (!file_exists($filePath)) {

            Alert::error('Message', 'Document does not exist in our server.')->autoClose('6000');
            return redirect()->back();
        }

        // Return a response to display the PDF in the browser
        return response()->file($filePath);
    }

    public function profileUpdate($id)
    {

        $userInfo = User::find($id);

        return view('user/profile-update', compact('userInfo'));
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

        return redirect()->route('member.dashboard')->with('success', 'Profile updated successfully');
    }

    public function discusionForum()
    {

        $userInfo = Auth::user();
        return view('user/discusion-forum', compact('userInfo'));
    }

    public function accessDenied()
    {

        return view('user/accessDenied');
    }
}
