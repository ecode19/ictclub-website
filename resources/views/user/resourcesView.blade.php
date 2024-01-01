<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MICs | Resources</title>
    <!-- for title img -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>

<body>
        @include('user.usernav')
        <main>
            <div class="container mt-5">
                <h2 class="text-dark">Resources Panel</h2>
                <hr>

                @if($resources->count() > 0)
                            <div class="row">
                        @foreach($resources as $resource)
                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <div class="card bg-dark text-light">
                                    <div class="card-header fw-bold shadow-lg"><h3>{{$resource->title}}</h3></div>
                                <div class="card-body">
                                    {{$resource->description}} <br>

                                    <a class="text-decoration-none" href="{{ asset('storage/' . $resource->file_path) }}" target="_blank">
                                        <button class="btn btn-outline-primary"> Preview Resource</button>
                                       </a>
                                </div>
                                </div>
                            </div>
                        @endforeach
                            </div>
                        </div>

                @else
                    <p class="alert alert-warning shadow-lg"  role="alert">CURRENTLY NO RESOURCES POSTED</p>
                @endif
            </div>
        </main>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
