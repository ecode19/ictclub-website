<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {

            return redirect('/login')->with('message', 'Access Denied');
        }

        $usertype = Auth::user();
        if ($usertype->usertype == 'user' ) {
             return $next($request);
        }

        if ($usertype->usertype == 'admin' ) {
             return redirect('/admin');
        }

        return $next($request);
    }
}
