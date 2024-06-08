@extends('layouts.programming')
@section('content')
    <div class="container mt-3 mb-3">
        <h2>Event Management</h2>
        <!-- Event creation form -->
        <div class="text-end mt-3">
            <a href="" class="text-primary text-decoration-none"> <button class="btn btn-primary btn-sm"> <i
                        class="fa fa-eye" aria-hidden="true"></i> views posted
                    events</button> </a>
        </div>

        <form action="{{ route('programming.postEvent') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label class="mt-3 mb-3" for="event_name">Event Name:</label>
                <input type="text" class="form-control @error('event_name') is-invalid @enderror"
                    value="{{ old('event_name') }}" id="event_name" name="event_name">

                @error('event_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="mt-3 mb-3" for="event_date">Event Date:</label>
                <input type="date" class="form-control @error('event_date') is-invalid @enderror"
                    value="{{ old('event_date') }}" id="event_date" name="event_date">

                @error('event_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label class="mt-3 mb-3" for="event_description">Event Description</label>
                <textarea class="form-control @error('event_description') is-invalid @enderror" name="event_description" rows="10">{{ old('event_description') }}</textarea>

                @error('event_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mt-3">
                <label class="mt-3 mb-3" for="Image">Select Image File</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image" accept="image/*">

                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success btn-sm color mt-3 mb-3"> <i class="fa fa-cloud-upload"
                    aria-hidden="true"></i> Create Event</button>
        </form>
        <hr>
    </div>

    <div class="container">
        <h4 class="">Active events</h4>
        <table class="table table-dark table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Event title</th>
                    <th>Action</th>
                </tr>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @if ($events->count() > 0)
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $event->event_name }}</td>
                            <td>
                                <a but href="{{ route('programming.event.details', [$event->id]) }}"><button
                                        class="btn btn-warning btn-sm mx-2"> <i class="fa fa-eye"
                                            aria-hidden="true"></i></button></a>

                                <form method="POST"
                                    action="{{ route('programming.destroy.event', [$event->id]) }}"
                                    enctype="multipart/form-data" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button"><i
                                            class="fa fa-trash-alt" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
            </thead>
        </table>
    </div>
@endsection
