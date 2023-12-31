<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event panel</title>
    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="../img/mwecau.png" />
    <link rel="stylesheet" href="{{ asset('../css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('../bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../fontawesome/css/all.min.css') }}">
</head>

<body>
    @include('user.usernav')

    <div class="container mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card text-light" style="background-color: darkcyan">
                        <div class="card-body text-center">
                            <h1 style="font-family: 'Arial Rounded MT Bold'">{{ $showEventDetails->event_name }}</h1>
                            <img src="{{ asset('images/events/' . $showEventDetails->image) }}"
                                alt="{{ $showEventDetails->event_name }}" class="img-fluid shadow-lg"
                                style="width:100%; height: 350px; border-radius: 4px; border: 2px solid #19c357">
                            <p class="card-text mt-3">
                                <strong>Description:</strong> {{ $showEventDetails->event_description }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-5 mt-3">

                    <div class="card">
                        <div class="card-header fw-bold">Similar Announcement</div>
                        @php
                            $counter = 1;
                        @endphp
                        @if ($similarEvents->count() > 0)
                            @foreach ($similarEvents as $similarEvent)
                                <div class="card-body"> {{ $counter++ }} . <strong class="">
                                        <a class="text-decoration-none"
                                            href="{{ route('EventDetails', ['id' => $innerEvent->id]) }}">
                                            {{ $similarEvent->event_name }}
                                        </a></strong><br>
                                    {{ $similarEvent->event_description }} <br>
                                    <strong>Date:</strong> {{ $similarEvent->event_date }}
                                </div>
                            @endforeach

                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
