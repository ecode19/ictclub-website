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

    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Check the user's latest payment status from the payments table
            $latestPayment = $user->payments()->latest()->first();
            if ($latestPayment) {
                // Calculate the payment validity period (5 minutes)
                $paymentValidUntil = Carbon::parse($latestPayment->date_paid)->addMonth(2);

                // Check if the payment is still valid
                if (Carbon::now()->gte($paymentValidUntil)) {
                    // Update the user's payment_status to 'inactive'
                    $user->payment_status = 'inactive';
                    $user->save();

                    // Redirect the user to a payment page or return an error message
                    return redirect()->route('accessDenied');
                }
            } else {
                // If the user has no payment record, redirect them to the payment page
                // return redirect()->route('payment.index')->with('error', 'You have no active payment. Please update your payment status to continue using our services.');
            }
        }

        return $next($request);
    }

}
