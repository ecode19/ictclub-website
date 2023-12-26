<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;

use Auth;

class UserController extends Controller
{
    //
     public function Dashboard(){

        $userName = Auth::user()->fullname;
        return view ('user/Dashboard', compact('userName'));
    }
}