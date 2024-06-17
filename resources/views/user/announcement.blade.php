@extends('layouts.user')
@section('content')
    <style>
        .event-card:hover img {
            opacity: 0.8;
            background-color: darkorange;
        }

        .event-card {
            transition: opacity 0.3s ease-in-out;
        }

     .DashboardCard {
    border-radius: 10px;
    height: 470px;
    color: white;
    background: linear-gradient(to top, #031a47, #031a47);
}
    </style>

    <div class="container mt-5">
        <h2 class="text-secondary">Announcements</h2>
<hr>
    </div>

    <div class="container ">
        @if ($events->count() > 0)
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-12 col-md-6 col-lg-4 col-md-4 mb-4 event-card">
                        <div class="DashboardCard card">
                            <div class="card-body">
                                <a class="text-decoration-none" href="{{ route('EventDetails', ['id' => $event->id]) }}">
                                    <img src="{{ asset('images/events/' . $event->image) }}" alt="{{ $event->event_name }}"
                                        class="img-fluid shadow-lg" style="width: 100%; height: 200px; border-radius: 5px;">
                                </a>
                                <strong>{{ $event->event_name }}</strong>
                                <p class="card-text mt-3">
                                    <strong>Description:</strong> {{ $event->event_description }}
                                </p>
                                <a class="btn btn-warning"
                                    href="{{ route('EventDetails', ['id' => $event->id]) }}">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                <p>No events found.</p>
            </div>
        @endif
    </div>
@endsection
