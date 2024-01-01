<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MICs | Announcements</title>
    <!-- for title img -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <style>
        .event-card:hover img {
            opacity: 0.8;
            background-color: darkorange;
        }

        .event-card {
            transition: opacity 0.3s ease-in-out;
        }
    </style>

</head>

<body>
        <main>
            @include('user.usernav')
            <div class="container mt-3">
                <h2 class="text-dark">Announcements</h2>
                <hr>
            </div>

            <div class="container mt-5">
                @if ($events->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($events as $event)
                                    <div class="col-12 col-md-6 col-lg-4 col-md-4 mb-4 event-card">
                                        <div class="card">
{{--                                            <div class="card-header bg-secondary text-white">--}}
{{--                                                <strong>Event Name: </strong>{{ $event->event_name }}--}}
{{--                                            </div>--}}
                                            <div class="card-body">
                                                <a class="text-decoration-none" href="{{ route('EventDetails', ['id' => $event->id]) }}">
                                                    <img src="{{ asset('images/events/' . $event->image) }}" alt="{{ $event->event_name }}"
                                                         class="img-fluid shadow-lg" style="width: 100%; height: 200px; border-radius: 5px; border: 1px solid #19c357">
                                                </a>
                                                <strong>{{ $event->event_name }}</strong>
{{--                                                <p class="text-center text-decoration-underline fst-italic fw-bold">Summary</p>--}}
                                                <p class="card-text mt-3">
                                                    <strong>Description:</strong> {{ $event->event_description }}
                                                </p>
                                                <a class="btn btn-outline-primary" href="{{ route('EventDetails', ['id' => $event->id]) }}">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        <p>No events found.</p>
                    </div>
                @endif
            </div>


        </main>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
