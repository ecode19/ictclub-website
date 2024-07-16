@extends('layouts.graphics-designing')
@section('content')
    <div class="container mt-5">
        <h2 class="">Resources Management Panel</h2>
        <hr>
        <form action="{{ route('graphics.upload.resource') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="form-group">
                <label class="mt-2" for="title">Resource Name:</label>
                <input type="text" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror"
                    id="resourceTitle" name="title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="mt-2" for="description">Resource Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="mt-2" for="category">Resource Category:</label>
                <select class="form-control @error('category') is-invalid @enderror" id="department" name="category">
                    <option value="cyber security">Cyber Security</option>
                    <option value="programming">Programming</option>
                    <option value="graphics designing">graphics designing</option>
                </select>

                @error('category')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label class="mt-2" for="file">Resource File:</label>
                <input type="file" value="{{ old('file') }}" class="form-control @error('file') is-invalid @enderror"
                    id="file" name="file">

                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label class="mt-2" for="thumbnail">Resource thumbnail</label>
                <input type="file" value="{{ old('thumbnail') }}"
                    class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail">

                @error('thumbnail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-sm mb-3 mt-3" id="submitBtn"> <i class="fa fa-upload" aria-hidden="true"></i>
                Upload Resource</button>
        </form>
        @if ($resources->count() > 0)
            <div class="row">
                @foreach ($resources as $resource)
                    <div class="col-12 col-ld-6 col-md-6 mt-3">
                        <div class="card">
                            <div class="card-header text-primary">{{ $resource->file_name }}</div>
                            <div class="card-body">
                                <img src="{{ asset('images/resourcesThumbnails/' . $resource->thumbnail) }}"
                                    class="img-fluid w-100 mt-auto" alt="Profile Picture"
                                    style="height:130px; border-radius: 5px;">
                                <div class="card-text text-dark">{{ $resource->description }}</div>
                                <p class="mt-3 fw-bold text-dark">Posted By: {{ $resource->user->fullname }}</p>
                                <div class="mt-3 d-flex">

                                    <a href="{{ route('admin.document.preview', $resource->file_path) }}" target="_blank">
                                        <button class="btn btn-primary btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i>
                                            Preview</button> </a>

                                    <a href="{{ route('programming.resource.update.view', [$resource->id]) }}"><button
                                            class="btn btn-warning btn-sm mx-1"> <i class="fa fa-pencil"
                                                aria-hidden="true"></i>Edit</button></a>

                                    <form method="POST" action="{{ route('resource.destroy', $resource->id) }}"
                                        enctype="multipart/form-data" id="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" id="delete-button">Delete</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="text-end mt-3">
                    <a href="{{ route('graphics.resource.view') }}">
                        <button class="btn btn-primary btn-sm">view Available resources</button>
                    </a>
                </div>
            </div>
        @else
            <p class="alert alert-warning shadow mt-3">Currently no resource is available under cyber security department.</p>
        @endif
    </div>

    <script>
        document.getElementById('delete-button').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this action!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#dc3545",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        });
    </script>

        {{-- Notifications link --}}
        <script src="{{ route('admin') }}"></script>
@endsection
