@include('links')

<div class="container">
            <h4 class="favcolor mt-5 fw-bold">MWECAU ICT CLUB SYSTEM (MICS)</h4>
            <div class="alert alert-warning">
                Hi, <strong>{{ Auth::user()->fullname }}</strong>, <strong
                    class="text-primary">{{ Auth::user()->registration_number }}</strong>
                <p class="text-danger fs-5 fw-bold">Your access is restricted due to unpaid status. Please contact the
                    admin.</p>
                <p class="">We're Kindly request you to pay your membership Fee.
                    Make payment and send payment receipt to the following E-mail Address
                    <strong>erickmanyasi5@gmail.com.</strong> and your account will be activated within a minute.Or
                    Contact Admin <strong> +255 624 861 910 </strong> <br> THANK YOU.<br>
                </p>
{{--                <p class="text-lg-center"><a href="{{ route('login') }}" class="">Go to Login--}}
{{--                        Page</a>--}}
{{--                </p>--}}

                {{--    laravel default login script--}}
                <a  href="{{ route('logout') }}" class="text-decoration-none fw-bold text-warning " onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <button class="btn btn-primary text-white"> Go to Home
                        Page</button>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </div>
