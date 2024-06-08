<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\resource;
use App\Models\event;
use Illuminate\Http\Request;
use App\Models\Registration_number;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CyberSecurityController extends Controller
{
    public function cyberSecurityDepartment()
    {

        $authenticatedUser = Auth::user();
        $cyberSecurityMembers = User::where('category', 'cyber security')
            ->where('usertype', '!=', 'admin')
            ->get();

        $totalCyberSecurityMembers = user::where('category', 'cyber security')
            ->where('id', '!=', $authenticatedUser->id)
            ->count();

        //fetching all active members under programming department
        $activeMembers = user::where('payment_status', 'active')
            ->where('category', 'cyber security')
            ->where('usertype', '!=', 'root')
            ->where('id', '!=', $authenticatedUser->id)
            ->count();

        //fetching all inactive members under cyber department department
        $inactiveMembers = user::where('payment_status', 'inactive')
            ->where('category', 'cyber security')
            ->where('id', '!=', $authenticatedUser->id)
            ->get();
        $totalinactiveMembers = user::where('payment_status', 'inactive')
            ->where('category', 'cyber security')
            ->where('id', '!=', $authenticatedUser->id)
            ->count();

        $totalRescources = resource::all()->count();

        return view('admin.departments.cyber-security.dashboard', compact('authenticatedUser', 'totalCyberSecurityMembers', 'activeMembers', 'inactiveMembers', 'totalinactiveMembers', 'cyberSecurityMembers', 'totalRescources'));
    }
    //registering cyber security member
    public function register()
    {

        return view('admin.departments.cyber-security.register-member');
    }
    public function cyberMembers()
    {
        $cybersecurityMembers = user::where('category', 'cyber security')
            ->where('usertype', '!=', 'admin')
            ->get();
        return view('admin.departments.cyber-security.cyber-security-members', compact('cybersecurityMembers'));
    }
    //deleting cyber security member
    public function memberDestroy($id)
    {

        $memberDestroy = User::findOrFail($id);
        $memberDestroy->delete();

        Alert::success('Message', 'Member delete successfully');
        return redirect()->back();
    }
    //registering registration numbers
    public function registerNumbers()
    {
        $totalCyberSecurityMembers = user::where('category', 'cyber security')
            ->where('usertype', '!=', 'admin')
            ->count();
        return view('admin.departments.cyber-security.registration-numbers', compact('totalCyberSecurityMembers'));
    }
    //returning event view for creating an event
    public function createEvent()
    {

        $events = event::all();
        return view('admin.departments.cyber-security.create-event', compact('events'));
    }
    //posting an event
    public function eventUpload(Request $request)
    {
        $request->validate([
            'event_name' => ['required'],
            'event_date' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:9048',
            'event_description' => ['required'],
        ], [
            'event_name' => 'Please type event name',
            'event_date' => 'Please select event date',
            'image.required' => 'Please select event an image for the event',
            'image.max' => 'Image should not be more than 9MB',
            'image.mime' => 'Selected image should be of type png or jpg'
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

        Alert::success('Message', 'Event has been created successfully');
        return redirect()->back();
    }
    //particular event details
    public function cyberEventDetails($id)
    {

        $eventDetails = event::findOrFail($id);
        return view('admin.departments.cyber-security.cyber-eventDetails', compact('eventDetails'));
    }
    public function eventDestroy($id)
    {

        $eventDestroy = event::findOrFail($id);
        $eventDestroy->delete();

        Alert::success('Message', 'Event deleted successfully');
        return redirect()->back();
    }
    //returning view for posting resources
    public function resources()
    {
        $resources = resource::all()->take('2');
        return view('admin.departments.cyber-security.post-resources', compact('resources'));
    }
    //this function retruns the list of all resources under cyber security department
    public function cyberResources()
    {
        $cyberResources = resource::all();
        return view('admin.departments.cyber-security.cyber-resources', compact('cyberResources'));
    }
    //posting cyber security resources
    public function uploadResource(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'category' => ['required'],
            'file' => ['required', 'mimes:pdf', 'max:3000'],
            'thumbnail' => ['required', 'mimes:jpg,png', 'max:1000'],
        ], [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string value.',
            'description.required' => 'The description field is required.',
            'description.max' => 'The title field must not exceed 255 characters.',
            'category.required' => 'Please select a category for the resource.',
            'file.required' => 'Please select a resource file to upload.',
            'file.mimes' => 'Only files of type PDF are allowed.',
            'file.max' => 'The uploaded file exceeds the maximum size of 3MB. Please select a smaller file.',
            'thumbnail.required' => 'please select a resource thumbnail',
            'thumbnail.mimes' => 'thumbnail can only be of type jpg or png',
            'thumbnail.max' => 'maximum thumbnail size is 20MB'
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

    public function resourceUpdateView($id)
    {
        $resources = resource::find($id);

        return view('admin.departments.cyber-security.update-resource', compact('resources'));
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

    //messages from website under cyber department
    public function cyberMessages()
    {
        $comments = Comment::where('category', 'cyber_security')->get();
        return view('admin.departments.cyber-security.cyberSecurity-messages', compact('comments'));
    }
    //deleting message
    public function messageDestroy($id)
    {

        $commentDestroy = Comment::findOrFail($id);

        $commentDestroy->delete();

        Alert::success('Message', 'Comment deleted successfully')->autoClose('5000');
        return redirect()->back();
    }
    //SHOULD BE REMOVED FROMs
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'registration_numbers.*' => ['required', 'string', 'max:255'],
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
            Alert::error('error', 'Some entered have been exluded as they already exist in our records.');
            return redirect()->back()->withErrors($errors); // Flash error messages to the session
        } else {
            Alert::success('Success', 'Registration numbers stored successfully.');
            return redirect()->back();
        }
    }


    public function searchByRegNumber(Request $request)
    {
        $request->validate([
            'registration_number' => 'required'
        ], [
            'registration_number' => 'please enter a valid registration number to start search'
        ]);

        $searchNumber = $request->input('registration_number');

        // Perform the search using Eloquent ORM
        // $user = User::where('registration_number', $searchNumber)->first();
        $user = User::where('registration_number', $searchNumber)
            ->where('usertype', '!=', 'admin')
            ->where('category', '=', 'cyber security')
            ->select('id', 'registration_number', 'fullname', 'course', 'category', 'email', 'created_at')->first();
        $totalResults = User::where('registration_number', $searchNumber)->select('id', 'registration_number', 'fullname', 'course', 'category', 'email', 'created_at')->count();

        // Check if a user with the given registration number exists
        if ($user) {
            // Return the user as JSON response
            // return response()->json($user);

            return view('admin.departments.search-result', compact('user', 'totalResults'));
        } else {
            // Return an error message if no user found
            // return response()->json(['error' => 'User not found'], 404);
            Alert::error('Ooops!', "Member records does not exist in our cyber security department database.")->autoClose('6000');
            return redirect()->back();
        }
    }
}
