<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;

use Auth;

class UserController extends Controller
{
    //
    public function Dashboard(){
        $userInfo = Auth::user();

        // Fetch users with the same category as the logged-in user
        $usersInSameCategory = User::where('category', $userInfo->category)
            ->where('id', '<>', $userInfo->id) // Exclude the logged-in user from the results
            ->get();

        return view('user/Dashboard', compact('userInfo', 'usersInSameCategory'));
    }
    public function announcement(){

         return view('user/announcement');
    }

    public function event(){

        $user = Auth::user()->payment_status;
        return view('user/event', compact('user'));
    }

    public function membershipCard(){

        return view('user/membershipCard');
    }

    public function resourcesView(){

         return view('user/resourcesView');
    }

    public function profileUpdate(){

         return view('user/profileUpdate');
    }

    public function accessDenied(){

         return view('user/accessDenied');
    }
}
