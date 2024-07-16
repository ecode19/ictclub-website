<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Models\Payment;

class PaymentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Check the user's latest payment status from the payments table
            $latestPayment = $user->Payments()->latest()->first();
            if ($latestPayment) {
                // Check if the payment is still valid
                if (Carbon::now()->gte($latestPayment->expiration_date)) {
                    // Update the user's payment_status to 'inactive'
                    $user->payment_status = 'inactive';
                    $user->save();

                    // Redirect the user to a payment page or return an error message
                    Alert::warning('Payment Information Outdated', 'Apologies, but it appears that your payment information is no longer up-to-date.
                                     To continue using our services, please kindly contact the administrator to update your payment status.
                                      We appreciate your understanding and cooperation in this matter.')
                        ->autoClose(10000);
                        return redirect()->back();
                    // return redirect()->route('accessDenied');
                }
            } else {
                // If the user has no payment record, redirect them to the payment page
                Alert::error('Access Denied', 'We don\'t have a payment record associated with your account. Please contact the administrator to update your payment status.')->autoClose('10000');
                return redirect()->back();
            }
        }

        return $next($request);
    }
    // public function handle(Request $request, Closure $next): Response
    // {

    //     // Check if the user is authenticated
    //     if (Auth::check()) {
    //         // Get the authenticated user
    //         $user = Auth::user();

    //         // Check the user's latest payment status from the payments table
    //         $latestPayment = $user->payments()->latest()->first();
    //         if ($latestPayment) {
    //             // Calculate the payment validity period (5 minutes)
    //             $paymentValidUntil = Carbon::parse($latestPayment->date_paid)->addSeconds(2);

    //             // Check if the payment is still valid
    //             if (Carbon::now()->gte($paymentValidUntil)) {
    //                 // Update the user's payment_status to 'inactive'
    //                 $user->payment_status = 'inactive';
    //                 $user->save();

    //                 // Redirect the user to a payment page or return an error message
    //                 return redirect()->route('accessDenied');
    //             }
    //         } else {
    //             // If the user has no payment record, redirect them to the payment page
    //             // return redirect()->route('payment.index')->with('error', 'You have no active payment. Please update your payment status to continue using our services.');
    //         }
    //     }

    //     return $next($request);
    // }

}
