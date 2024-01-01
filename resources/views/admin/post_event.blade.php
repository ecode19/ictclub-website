<!DOCTYPE html>
<html lang="">

<head>
    <title>Event Management</title>
    @include('links')

</head>

<body>
    @include('admin.adminNav')
    <main>
        <div class="container mt-5">
            <h2 class="text-dark">Event Management</h2>
            <!-- Event creation form -->
            <form action="{{ route('eventUpload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                    <input type="text" class="form-control @error('event_name') is-invalid @enderror" value="{{old('event_name')}}" id="event_name" name="event_name">

                    @error('event_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="event_date">Event Date:</label>
                    <input type="date" class="form-control @error('event_date') is-invalid @enderror" value="{{old('event_date')}}" id="event_date" name="event_date">

                    @error('event_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>

                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="event_description">Event Description</label>
                    <textarea class="form-control @error('event_description') is-invalid @enderror" name="event_description" rows="10"> value="{{ old('message') }}"</textarea>
                    <div class="text-danger">
                        @error('event_description')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                 <div class="mt-3">
                     <label for="Image">Select Image File</label>
                     <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" accept="image/*" >

                     @error('image')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{$message }}</strong>
                     </span>
                     @enderror
                 </div>
                <button type="submit" class="btn color mt-3">Create Event</button>
            </form>
            <hr>

            <a href="{{ route('events') }}" class="text-primary text-decoration-none">View Messages</a>
            <!-- List of existing events -->
            <h3>Existing Events:</h3>
            <ul class="list-group">
                <li class="list-group-item">Event 1 - August 25, 2023</li>
                <li class="list-group-item">Event 2 - September 10, 2023</li>
                <!-- Add dynamically generated list items for each event -->
            </ul>
        </div>
    </main>

</body>

</html>
