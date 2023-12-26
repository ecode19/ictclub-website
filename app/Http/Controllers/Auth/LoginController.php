<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Auth;

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
   protected function login(Request $request)
{
    $data = $request->validate([
        'registration_number' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($data)) {
        $user = Auth::user(); // Get the authenticated user

        if ($user->usertype == 'admin') {
            return redirect('admin/AdminDashboard');
        }

        if ($user->usertype == 'user') {
            return redirect('user/Dashboard');
        } else {
            return redirect('/login')->with('message', 'Something went Wrong');
        }
    } else {
        return redirect('/login');
    }
}

}
