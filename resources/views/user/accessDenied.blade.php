<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .payment-status-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* height: 100vh; */
        }

        .payment-status-card {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .payment-status-card h2 {
            margin-bottom: 1rem;
        }

        .payment-status-card p {
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
    @include('links')
</head>

<body>
    <div class="payment-status-container container h-100 ">
        <h4 class="favcolor mt-5 fw-bold">MWECAU ICT CLUB SYSTEM (MICS)</h4>
        <h6>Payment Status</h6>
        <div class="alert alert-warning">
            <div class="header">
                Hi, <strong>{{ Auth::user()->fullname }}</strong>,
             </div>
            <div class="">
                <span>
                    <strong class="text-danger w-bold">Your account is currently inactive due to payment
                        issues. Please update your payment status to continue using our services.</strong> </span>
                <div class="mt-3 mb-3 ">
                    <span>
                        We're Kindly request you to pay your membership Fee.
                        Make payment and send payment receipt to the following E-mail Address
                        <strong>erickmanyasi5@gmail.com.</strong> and your account will be activated within a minute.Or
                        Contact Admin <strong> +255 624 861 910 </strong> <br> THANK YOU.
                    </span>
                </div>

            </div>
            {{--    laravel default login script --}}
            <a href="{{ route('logout') }}" class="text-decoration-none fw-bold text-warning "
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <button class="btn btn-primary text-white"> Go to Home
                    Page</button>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </div>
    </div>
</body>

</html>

@include('links')
