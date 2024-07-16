@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <h2 class="colorIcon">Event Management</h2>
        <hr>
        {{-- <div class="text-end">
            <a href="{{ route('events') }}" class="text-primary text-decoration-none"> <button class="btn btn-primary">views
                    posted events</button> </a>
        </div> --}}
        <!-- Event creation form -->
        <form action="{{ route('eventUpload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="mt-3 mb-3" for="event_name">Event Name:</label>
                <input type="text" class="form-control @error('event_name') is-invalid @enderror"
                    value="{{ old('event_name') }}" id="eventName" name="event_name">

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
                <textarea class="form-control @error('event_description') is-invalid @enderror" id="eventDesc" name="event_description" rows="10">{{ old('event_description') }}</textarea>

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
            <button type="submit" class="btn btn-success color mt-3 mb-3" id="postEvent"> <i class="fa fa-save" aria-hidden="true"></i> Create Event</button>
        </form>
    </div>
           {{-- Notifications link --}}
           <script src="{{ route('adminPostEvent') }}"></script>
@endsection
