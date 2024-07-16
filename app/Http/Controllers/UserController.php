<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\user;
use App\Models\event;
use App\Models\resource;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }
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

    //This function returns User Resources Page
    public function resources()
    {
        $authenticatedUser = Auth::user();
        $resources = Resource::where('category', '=', $authenticatedUser->category)
            ->with('user')
            ->get();
        return view('user/resources', compact('resources', 'authenticatedUser'));
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
        // Validate the request
        $request->validate([
            'course' => ['required'],
            'profile_picture' => 'image|mimes:png|max:1024',
        ], [
            'profile_picture.max' => 'Profile picture should not exceed 1MB'
        ]);

        // Retrieve the authenticated user
        $user = auth()->user();

        // Processing file
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Move the new file
            $image->move(public_path('images/profilePictures'), $imageName);

            // Check for existing profile picture and delete it
            $existingProfilePicture = public_path('images/profilePictures' . DIRECTORY_SEPARATOR . $user->profile_picture);
            if (File::exists($existingProfilePicture)) {
                File::delete($existingProfilePicture);
            }

            // Update user profile picture
            $user->profile_picture = $imageName;
        }

        $user->course = $request->course;
        // Save the user
        $user->save();

        // Show success alert
        Alert::success('Congrats', 'Successfully updated')->autoClose('5000');

        // Redirect with success message
        return redirect()->route('member.dashboard');
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
    public function generateMembershipCard()
    {
        $user = Auth::user();

        $profilePicture = $user->profile_picture ? asset('images/profilePictures/' . $user->profile_picture) : asset('img/logo.jpg');
        $registrationNumber = $user->registration_number;
        $fullname = $user->fullname;
        $course = $user->course;
        $category = $user->category;
        $validUntil = Carbon::parse($user->payment_date)->addMonths(3)->format('Y-m-d');
        $currentDateTime = now()->format('Y-m-d');

        $htmlContent = '
        <div style="border: 1px solid #000; padding: 20px; width: 300px; text-align: center; font-family: Arial, sans-serif;">
            <div style="background-color: #333; color: #fff; padding: 10px 0;">
                <h6 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Club Member</h6>
            </div>
            <div style="margin: 20px 0;">
                <h6 style="margin: 0; text-decoration: underline; font-size: 1.25rem; font-weight: bold;">Informations</h6>
            </div>
            <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
                <img src="' . $profilePicture . '" style="border-radius: 50%; width: 130px; height: 130px;" alt="Profile Picture">
            </div>
            <div style="text-align: left;">
                <p><strong>RegNo:</strong> ' . $registrationNumber . '</p>
                <p><strong>Full Name: </strong> ' . $fullname . '</p>
                <p><strong>Course:</strong> ' . $course . '</p>
                <p><strong>Category: </strong> ' . $category . '</p>
                <p><strong>Valid Until: </strong> ' . $validUntil . '</p>
            </div>
        </div>';

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdf->setOptions($options);

        $pdf->loadHtml($htmlContent);
        $pdf->render();

        return $pdf->stream('Membership_Card.pdf');
    }
    // public function generateMembershipCard(Request $request)
    // {
    //     $user = auth()->user();

    //     $profilePicture = $user->profile_picture ? asset('images/profilePictures/' . $user->profile_picture) : asset('img/logo.jpg');
    //     $registrationNumber = $user->registration_number;
    //     $fullname = $user->fullname;
    //     $course = $user->course;
    //     $category = $user->category;

    //     $data = [
    //         'profilePicture' => $profilePicture,
    //         'registrationNumber' => $registrationNumber,
    //         'fullname' => $fullname,
    //         'course' => $course,
    //         'category' => $category,
    //     ];

    //     $pdf = PDF::loadView('user.membership_card_pdf', $data);
    //     return $pdf->download('membership_card.pdf');
    // }
}
