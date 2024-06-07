@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="mb-3"> <h1>Event List</h1></div>
        <hr>
        @if ($events->count() > 0)
            <div class="card">
                @foreach ($events as $event)
                    <div class="card-header bg-primary text-white">
                        <strong>Event Name: </strong>{{ $event->event_name }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('images/events/' . $event->image) }}" alt="{{ $event->event_name }}"
                                    class="img-fluid shadow-lg" style="width: 500px; height: 200px; border-radius: 5px; border: 1px solid #19c357">
                            </div>
                            <div class="col-md-8">
                                <p class="card-text">
                                    <strong>{{ $event->event_name }}</strong> - {{ $event->event_date }}
                                    <br>
                                    <strong>Description:</strong> {{ $event->event_description }}
                                </p>
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

    {{-- @if ($events->count() > 0) --}}
    {{--    <ul> --}}
    {{--        @foreach ($events as $event) --}}
    {{--            <li> --}}
    {{--                <strong>{{ $event->event_name }}</strong> - {{ $event->event_date }} --}}
    {{--                <br> --}}
    {{--                Description: {{ $event->event_description }} --}}
    {{--                <br> --}}
    {{--                Image: <img src="{{ asset('images/events/' . $event->image) }}" alt="{{ $event->event_name }}" width="100"> --}}
    {{--            </li> --}}
    {{--        @endforeach --}}
    {{--    </ul> --}}
@endsection
