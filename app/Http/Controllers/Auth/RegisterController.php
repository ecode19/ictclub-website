<?php

namespace App\Http\Controllers\Auth;
use App\Rules\ValidRegistrationNumber;
use App\Rules\NoCommonPasswords;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'registration_number' => ['required', 'unique:users', new ValidRegistrationNumber],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'course' => ['required'],
            'category' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed', new NoCommonPasswords],
        ], [
            'registration_number.required' => 'registration number field is required',
            'registration_number.unique' => 'Member with this registration number already exist.',
            'email.required' => 'email field is required',
            'email.unique' => 'This email has already been taken',
            'password.min' => 'password should have more that 8 characters',
            'password.required' => 'Password is required',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'registration_number' => $data['registration_number'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'course' => $data['course'],
            'category' => $data['category'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
