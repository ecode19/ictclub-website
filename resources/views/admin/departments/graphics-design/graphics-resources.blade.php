@extends('layouts.graphics-designing')
@section('content')
    <div class="container">
        <h4 class="mt-5 mb-3">Graphics Resources</h4>
        <hr>
        @if ($graphicsResources->count() > 0)
            <div class="row">
                @foreach ($graphicsResources as $resource)
                    <div class="col-12 col-md-4 col-md-6 col-lg-4 mt-3">
                        <div class="card">
                            <div class="card-header text-primary">{{ $resource->file_name }}</div>
                            <div class="card-body">
                                <img src="{{ asset('images/resourcesThumbnails/' . $resource->thumbnail) }}"
                                    class="img-fluid w-100 mt-auto" alt="Profile Picture"
                                    style="height:130px; border-radius: 5px;">
                                <div class="card-text text-dark">{{ $resource->description }}</div>
                                <p class="mt-3 fw-bold text-dark">Posted By: {{ $resource->user->fullname }}</p>
                                <div class="mt-3 d-flex">

                                    <a href="{{ route('graphics.resource.preview', $resource->file_name) }}" target="_blank">
                                        <button class="btn btn-primary btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i>
                                            Preview</button> </a>

                                    <a href="{{ route('graphics.resource.update.view', [$resource->id]) }}"><button
                                            class="btn btn-warning btn-sm mx-1"> <i class="fa fa-pencil"
                                                aria-hidden="true"></i>Edit</button></a>


                                    <form method="POST" action="{{ route('resource.destroy', $resource->id) }}"
                                        enctype="multipart/form-data" class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button">Delete</button>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="alert alert-warning fw-bold shadow mt-3">CURRENTLY NO RESOURCE AVAILABLE</p>
        @endif
    </div>
@endsection
