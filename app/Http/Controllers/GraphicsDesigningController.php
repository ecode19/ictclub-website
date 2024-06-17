<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\admin;
use App\Models\event;
use App\Models\Comment;
use App\Models\resource;
use Illuminate\Http\Request;
use App\Models\Registration_number;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Rules\ValidRegistrationNumber;
use App\Rules\UniqueRegistrationNumber;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class GraphicsDesigningController extends Controller
{
    public function searchByRegNumber(Request $request)
    {
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
            Alert::error('Attention', "Member records does not exist in our database.")->autoClose('7000');
            return redirect()->back();
        }
    }

    public function graphicsDepartment()
    {
        $authicatedUser = Auth::user();
        $graphicsMembers = User::where('category', 'graphics designing')
            ->where('usertype', '!=', 'admin')
            ->get();

        $totalGraphicsMembers = User::where('category', 'graphics designing')
            ->where('id', '!=', $authicatedUser->id)
            ->where('usertype', '!=', 'admin')
            ->count();

        //fetching all active members under programming department
        $totalActiveMembers = user::where('payment_status', 'active')
            ->where('category', 'graphics designing')
            ->where('usertype', '!=', 'admin')
            ->where('id', '!=', $authicatedUser->id)
            ->count();

        $activeMembers = user::where('payment_status', 'active')
            ->where('category', 'graphics designing')
            ->where('usertype', '!=', 'admin')
            ->where('id', '!=', $authicatedUser->id)
            ->get();

        //fetching all inactive members under programming department
        $totalInactiveMembers = user::where('payment_status', 'inactive')
            ->where('category', 'graphics designing')
            ->where('id', '!=', $authicatedUser->id)
            ->count();

        $inactiveMembers = user::where('payment_status', 'inactive')
            ->where('category', 'graphics designing')
            ->where('id', '!=', $authicatedUser->id)
            ->get();

        $totalRescources = resource::all()->count();
        return view(
            'admin.departments.graphics-design.dashboard',
            compact(
                'graphicsMembers',
                'totalGraphicsMembers',
                'authicatedUser',
                'totalActiveMembers',
                'activeMembers',
                'inactiveMembers',
                'totalRescources',
                'totalInactiveMembers'
            )
        );
    }

    //registering cyber security member
    public function register()
    {

        return view('admin.departments.graphics-design.register-member');
    }

    public function newGraphicsgMember(Request $request)
    {

        $request->validate([
            'registration_number' => ['required', 'unique:users', new ValidRegistrationNumber],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'course' => ['required'],
            'category' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'registration_number.required' => 'Please enter Registration number is require',
            'registration_number.unique' => 'Registration number already exist',
            'fullname.required' => 'Please enter member fullname',
            'email.required' => 'The E-mail field is required',
            'email.unique' => 'This email is already registered',
            'course.required' => 'Course filled is required',
            'category.required' => 'Please select category from the list',
            'password.required' => 'Password filled is required'

        ]);

        $graphicsMember = new User();

        $graphicsMember->registration_number = $request->registration_number;
        $graphicsMember->fullname =  $request->fullname;
        $graphicsMember->email = $request->email;
        $graphicsMember->course = $request->course;
        $graphicsMember->category = $request->category;
        $graphicsMember->password = $request->password;

        $graphicsMember->save();
        Alert::success('Message', 'Member successfully registered')->position('bottom-end')->autoClose('6000');
        return redirect(route('graphics.register.member'))->with('message', 'Member Successfully Registered');
    }
    public function memberUpdateView($id)
    {

        $memberInfo = User::findOrFail($id);
        return view('admin.departments.graphics-design.graphics-member-update', compact('memberInfo'));
    }
    //function to update member informations
    public function edit(Request $request, $id)
    {

        $member = User::find($id);

        $member->update($request->input());

        Alert::success('Message', 'Information updated successfully');
        return redirect()->route('graphics.members');
    }
    //return view for programming members
    public function graphicsMembers()
    {
        $graphicsMembers = user::where('category', 'graphics designing')
            ->where('usertype', '!=', 'admin')
            ->get();
        return view('admin.departments.graphics-design.graphics-members', compact('graphicsMembers'));
    }
    //deleting programming member
    public function memberDestroy($id)
    {

        $memberDestroy = User::findOrFail($id);
        if (File::exists($memberDestroy->profile_picture)) {
            File::delete($memberDestroy->profile_picture);
        }

        $memberDestroy->delete();
        Alert::success('Message', 'Member delete successfully');
        return redirect()->back();
    }
    //registering registration numbers
    public function registerNumbers()
    {
        $totalProgrammingMembers = user::where('category', 'graphics designing')
            ->where('usertype', '!=', 'admin')
            ->count();
        return view('admin.departments.graphics-design.registration-numbers', compact('totalProgrammingMembers'));
    }
    //returning event view for creating an event
    public function createEvent()
    {

        $events = event::all();
        return view('admin.departments.graphics-design.create-event', compact('events'));
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

        Alert::success('Message', 'Your event has been created successfully and is now live.');
        return redirect()->back();
    }
    //particular event details
    public function graphicsEventDetails($id)
    {

        $eventDetails = event::findOrFail($id);
        return view('admin.departments.graphics-design.graphics-eventDetails', compact('eventDetails'));
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
        return view('admin.departments.graphics-design.post-resources', compact('resources'));
    }
    //this function retruns the list of all resources under programming department
    public function graphicsResources()
    {
        $graphicsResources = resource::all();
        return view('admin.departments.graphics-design.graphics-resources', compact('graphicsResources'));
    }
    //posting graphics resources
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
    //THIS FUNCTION UPDATE THE EXISTING RESOURCE INFORMATION
    public function updateResourceInfo(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'category' => ['required'],
            'file' => ['required', 'mimes:pdf', 'max:3000'],
            'thumbnail' => ['required', 'mimes:png,jpeg,jpg', 'max:1000'],
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
            'thumbnail.mimes' => 'thumbnail can only be of type jpeg, jpg or png',
            'thumbnail.max' => 'maximum thumbnail size is 3MB'
        ]);

        $resource = resource::findOrFail($id);

        //PROCESSING A PDF FILE
        $file = $request->file('file');
        $fileName = time() . "_" . $file->getClientOriginalName();

        //storing the uploaded file in storage/app/public/uploads/pdfs
        $file->storeAs('public/uploads/pdfs', $fileName);

        //PROCESSING THUMBNAIL
        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailName = $thumbnailFile->getClientOriginalName();
            $fileName = time() . '-' . $thumbnailName;
            $path = 'images/resourcesThumbnails';

            //checking if thumbnail is existing then replace it
            if ($request->file('thumbnail')) {
                $existingThumbnail = public_path($path . '/' . $resource->thumbnail);
                if (File::exists($existingThumbnail)) {
                    File::delete($existingThumbnail);
                }
            }
            //move and saving new uploaded file
            $thumbnailFile->move($path, $fileName);
            $resource->thumbnail = $fileName;
        }

        $resource->title = $request->title;
        $resource->description = $request->description;
        $resource->category = $request->category;
        $resource->file_name = $file->getClientOriginalName();
        $resource->file_path = $fileName;
        //saving updated resource data
        $resource->save();

        Alert::success('Message', 'Resource data Saved Successfully')->autoClose('6000');
        return redirect()->back();
    }

    public function resourceUpdateView($id)
    {
        $resources = resource::find($id);

        return view('admin.departments.graphics-design.update-resource', compact('resources'));
    }
    public function graphicsFinancial()
    {
        return view('admin.departments.graphics-design.financial');
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
    public function graphicsMessages()
    {
        $comments = Comment::where('category', 'graphics_designing')->get();
        return view('admin.departments.graphics-design.graphics-messages', compact('comments'));
    }
    //deleting message
    public function messageDestroy($id)
    {

        $commentDestroy = Comment::findOrFail($id);

        $commentDestroy->delete();

        Alert::success('Message', 'Comment deleted successfully')->autoClose('5000');
        return redirect()->back();
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
    //previewing uploaded files
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

    // public function searchByRegNumber(Request $request)
    // {
    //     $request->validate([
    //         'registration_number' => 'required'
    //     ], [
    //         'registration_number' => 'please enter a valid registration number to start search'
    //     ]);

    //     $searchNumber = $request->input('registration_number');

    //     // Perform the search using Eloquent ORM
    //     // $user = User::where('registration_number', $searchNumber)->first();
    //     $user = User::where('registration_number', $searchNumber)
    //         ->where('usertype', '!=', 'admin')
    //         ->where('category', '=', 'cyber security')
    //         ->select('id', 'registration_number', 'fullname', 'course', 'category', 'email', 'created_at')->first();
    //     $totalResults = User::where('registration_number', $searchNumber)->select('id', 'registration_number', 'fullname', 'course', 'category', 'email', 'created_at')->count();

    //     // Check if a user with the given registration number exists
    //     if ($user) {
    //         // Return the user as JSON response
    //         // return response()->json($user);

    //         return view('admin.departments.search-result', compact('user', 'totalResults'));
    //     } else {
    //         // Return an error message if no user found
    //         // return response()->json(['error' => 'User not found'], 404);
    //         Alert::error('Ooops!', "Member records does not exist in our cyber security department database.")->autoClose('6000');
    //         return redirect()->back();
    //     }
    // }
}
