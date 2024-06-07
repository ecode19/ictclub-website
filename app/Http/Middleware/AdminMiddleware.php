<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    //     public function handle(Request $request, Closure $next): Response
    //     {
    //         if (!Auth::check()) {

    //             Alert::error('Access Denied', 'Please log in to access this page.');
    //             return redirect('/login');
    //         }
    //         $usertype = Auth::user();
    //         if ($usertype->usertype == 'admin') {
    //             $admin = $usertype->admin;
    //             if ($admin) {
    //                 $department = $admin->department->dept_name;
    //                 if ($department == 'root') {
    //                     return $next($request);
    //                 }
    //             }
    //         } else {

    //             Alert::error('Access Denied', "You don't have access to this page.")->autoClose('5000');
    //             return redirect()->back();
    //         }
    //     }
    // }

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {

            Alert::error('Access Denied', 'You need to log in to access this page. Please log in to continue.');
            return redirect('/login');
        }
        $user = Auth::user();

        // Check if the user is an admin
        if ($user->usertype == 'admin') {
            // Check if the admin has admin records and a department assigned
            if ($user->admin && $user->admin->department) {
                $departmentName = $user->admin->department->dept_name;

                // Check if the department is 'programming' or root
                if ($departmentName == 'root') {
                    return $next($request);
                } else {
                    Auth::logout();
                    // If the user is not an admin or does not meet the requirements, redirect with an error message
                    Alert::error('Access Denied', 'You have been logged out. This page is restricted to authorized personnel only.');
                    return redirect('/login');
                }
            }
        }
    }
}
