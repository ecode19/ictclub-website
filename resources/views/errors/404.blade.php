<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 - page not found</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    @include('links')
</head>

<body class="bg-dark align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="col-12 p-5 text-center">
            <div class="card p-5 rounded-5">
                <h1 class="display-1 fw-bold">404</h1>
                <h4 class="display0-6">Page not found</h4>
                <hr>
                <p class="lead fw-normal">
                    Hey, the page you're trying to find is not available.
                </p>
                <div class="rounded-2">
                    <a href="{{ url('/') }}" class="btn btn-primary">Got to homepage</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
