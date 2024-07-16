<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{
    public function clubMembers()
    {

        $memmbers = User::where('usertype', '!=', 'admin')->get();
        $programmingMembers = User::where('category', 'programming')->get();
        return [$memmbers, $programmingMembers];
    }
}
