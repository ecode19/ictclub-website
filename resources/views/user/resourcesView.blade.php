<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MICs | Resources</title>
    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="img/mwecau.png" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="preloader.css">
</head>

<body>
    @if ($user->payment_status == 1)
        @include('users.usernav')
        <main>
            <div class="container mt-5">
                <h1 class="text-dark">RESOURCES PANEL</h1>
            </div>
        </main>
    @else
        @include('users.accessDenied');
    @endif

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
