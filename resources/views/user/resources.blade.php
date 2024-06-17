@extends('layouts.user')
@section('content')
    <div class="container mt-5">
        <h2 class="text-secondary">Resources Panel</h2>
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
                                    <small>Posted By: Suleiman Ramadhani</small> <br>
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
    <p class="alert alert-warning shadow-lg" role="alert">CURRENTLY NO RESOURCES POSTED</p>
    @endif
    </div>
@endsection
