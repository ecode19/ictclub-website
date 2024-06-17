<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

// use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm (){

        return view('auth.login');
    }

    function login(Request $request)
    {
        $data = $request->validate([
            'registration_number' => 'required',
            'password' => 'required',
        ], [
            'registration_number.required' => 'The registration number field is required',
            'password.required' => 'The password field is required'
        ]);

        if (Auth::attempt($data)) {
            $user = Auth::user();

            if ($user->usertype == 'admin') {
                $admin = $user->admin;
                if ($admin) {
                    $department = $admin->department->dept_name;

                    if ($department == 'programming') {
                        toast('Welcome to Programming department', 'success')->position('top')->autoClose('6000');
                        return redirect('admin/departments/programming/dashboard/');
                    }

                    if ($department == 'cyber security') {
                        toast('Welcome to Cyber Security department', 'success')->position('top')->autoClose('6000');
                        return redirect('admin/departments/cyber-security/dashboard/');
                    }
                    if ($department == 'graphics designing') {
                        toast('Welcome to Cyber Graphics department', 'success')->position('top')->autoClose('6000');
                        return redirect('admin/departments/graphics-designing/dashboard/');
                    }
                    
                    if ($department == 'root') {
                        toast('Successfully logged in', 'success')->position('top')->autoClose('6000');
                        return redirect('admin/AdminDashboard/');
                    }
                } else {
                    // Handle the case where the admin record is not found
                    toast('User is not an admin', 'error')->autoClose('6000');
                    return redirect('/login');
                }
            } else if ($user->usertype == 'user') {
                return redirect('user/Dashboard');
            }
        }

        toast('Incorrect registration number or password', 'error')->autoClose('6000');
        return redirect('/login');
    }


    // function login(Request $request)
    // {
    //     $data = $request->validate([
    //         'registration_number' => 'required',
    //         'password' => 'required',
    //     ], [
    //         'registration_number' => 'The registration number field is required',
    //         'password' => 'The password field is required'
    //     ]);

    //     if (Auth::attempt($data)) {
    //         $user = Auth::user(); // Get the authenticated user

    //         if ($user->usertype == 'admin') {
    //             $admin = $user->admin; // Get the admin associated with the user

    //             if ($admin) {
    //                 if ($admin->department && $admin->department->dept_name == 'programming') {
    //                     Alert::success('Ujumbe', ' Karibu katika kitivo cha programming');
    //                     return redirect('admin/departments/programing');
    //                 }

    //                 if ($admin->department && $admin->department->dept_name == 'cyber security') {
    //                     toast('Successfully logged in', 'success')->position('top')->autoClose('6000');
    //                     return redirect('admin/departments/programming');
    //                 }
    //             }
    //         }
    //         if ($user->usertype == 'user') {
    //             return redirect('user/Dashboard');
    //         } else {
    //             return redirect('/login')->with('fail', 'Something went wrong');
    //         }
    //     } else {
    //         toast('Incorrect registration number or password', 'error')->autoClose('6000');
    //         return redirect('/login');
    //     }
    // }
}
