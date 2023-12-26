<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MICs | Events</title>
    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="img/mwecau.png" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>

<body>
    @if ($user->payment_status == 1)
        <main>
            @include('users/usernav')
            <div class="container text-end mt-3">
                <h5 class="text-info fw-bold">{{ $user->fullname }}</h5>
            </div>
            <div class="container mt-3">
                <h2 class="text-dark">Club Events</h2>
                <hr>
            </div>
        </main>
    @else
        @include('users.accessDenied');
    @endif

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
