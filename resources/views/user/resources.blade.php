@extends('layouts.user')
@section('content')
    <div class="container mt-5">
        <h2 class="text-secondary post">Resources Panel</h2>
        <div>
            <p>Hi, <strong>{{ $authenticatedUser->fullname }}</strong> if you like to receive notifications about new
                resources under <strong>{{ $authenticatedUser->category }} </strong> you can click the button below.</p>
        </div>
        <button class="btn btn-sm" id="userIdBtn" data-id="{{ $authenticatedUser->id }}">
            </button>

        <hr>
        @if ($resources->count() > 0)
            <div class="row">
                @foreach ($resources as $resource)
                    <div class="col-lg-4  mt-3 mb-5">
                        <!-- Display PDF links -->
                        <div class="resourceCard card border-0">
                            <div class="text-center mt-3 fw-bold fs-5">{{ $resource->title }}</div>
                            <div class="card-body">
                                <div class="card-text text-center mb-3">
                                    <img src="{{ asset('images/resourcesThumbnails/' . $resource->thumbnail) }}"
                                        class="img-fluid w-100 mt-auto" alt="Profile Picture"
                                        style="height:130px; border-radius: 5px;">
                                    {{-- <img src="../img/logo.jpg" class="img-fluid rounded-circle mt-auto" alt="Profile Picture"
                                        style="width: 130px; height:130px"> --}}
                                </div>

                                <div class="mt-3">
                                    <small>Posted By: {{ $resource->user->fullname }}</small> <br>
                                    <small class="text-warning">Category: {{ $resource->category }}</small>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('resource.preview', $resource->file_name) }}">
                                        <button class="btn btn-warning">preview</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@else
    <p class="alert alert-warning shadow-lg" role="alert">Currently no resource under <strong
            class="text-uppercase">{{ $authenticatedUser->category }}</strong> has been posted.</p>
    @endif
    </div>

    {{-- Notifications link --}}
    <script src="{{ route('user') }}"></script>
    {{-- <script src="{{ route('serveWorker') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
