@extends('layouts.programming')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="text-center">
                <h5 class="text-uppercase">{{ $eventDetails->event_name }}</h5>
                <img src="{{ asset('images/events/' . $eventDetails->image) }}" alt="{{ $eventDetails->event_name }}"
                    class="img-fluid shadow-lg" style="width: 870px; height: 360px; border-radius: 5px;">
            </div>
            <div class="mt-3">
                <P>{{ $eventDetails->event_description }}</P>
            </div>
        </div>
        <a href=""><button class="btn btn-warning btn-sm mt-3"> <i class="fa fa-pencil" aria-hidden="true"></i>
                Edit</button></a>
    </div>
@endsection
