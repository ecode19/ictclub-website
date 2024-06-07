<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CyberSecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user is an admin
            if ($user->usertype == 'admin') {
                // Check if the admin has admin records and a department assigned
                if ($user->admin && $user->admin->department) {
                    $departmentName = $user->admin->department->dept_name;

                    // Check if the department is 'programming' or root
                    if ($departmentName === 'cyber security' || $departmentName === 'root') {
                        return $next($request);
                    }
                }
            }

            // If the user is not an admin or does not meet the requirements, redirect with an error message
            Alert::error('Access Denied', 'Sorry, only Cyber Security admins have access to this service.');
            return redirect()->back();
        }

        // If the user is not authenticated, redirect to the login page
        return redirect()->route('login');
    }
}
