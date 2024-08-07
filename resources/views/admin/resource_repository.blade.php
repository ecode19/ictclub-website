@extends('layouts.admin')
@section('content')
    @include('admin.message')
    <div class="container">
        <h2 class="colorIcon">Resources Management Panel</h2>
        <hr>
        <form action="{{ route('admin.upload.resources') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="form-group">
                <label class="mb-3 mt-3" for="title">Resource Name:</label>
                <input type="text" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror"
                    name="title" id="resourceTitle">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="mb-3 mt-3" for="description">Resource Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="mb-3 mt-3" for="category">Resource Category:</label>
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

            <div class="form-group mt-3">
                <label class="mb-3 mt-3" for="file">Resource File:</label>
                <input type="file" value="{{ old('file') }}" class="form-control @error('file') is-invalid @enderror"
                    id="file" name="file">

                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label class="mb-3 mt-3" for="thumbnail">Resource thumbnail</label>
                <input type="file" value="{{ old('thumbnail') }}"
                    class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail">

                @error('thumbnail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-3 mt-3" id="submitBtn"> <i class="fa fa-upload"
                    aria-hidden="true"></i> Upload
                Resource</button>
        </form>

        {{-- <div class="container">
            <div class="col-md-6 mt-2">
                <!-- Display PDF links -->
                @foreach ($resources as $resource)
                    <div>

                        <a class="text-decoration-none text-danger"
                            href="{{ route('admin.document.preview', $resource->file_name) }}"
                            target="_blank">{{ $resource->file_name }}</a>
                    </div>
                @endforeach
            </div>
        </div> --}}

        <div class="container mt-3">
            <h1 class="text-center">Latest available resources </h1>
            @php
                $counter = 1;
            @endphp
            <table class="table table-success table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Resource Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resources as $resource)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td class="fs-5"> <a class="text-decoration-none text-danger"
                                    href="{{ route('admin.document.preview', $resource->file_name) }}"
                                    target="_blank">{{ $resource->file_name }}</a>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('resource.destroy', $resource->id) }}"
                                    enctype="multipart/form-data" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                                <p class="mt3 fw-bold">Posted By: {{ $resource->user->fullname }}</p>
                                <div class="mt-3 d-flex">

                                    <a href="{{ route('admin.document.preview', $resource->file_name) }}" target="_blank">
                                        <button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                                            Preview</button>
                                    </a>

                                    <a href="{{ route('cyber-security.resource.update.view', [$resource->id]) }}"><button
                                            class="btn btn-warning btn-sm mx-1"> <i class="fa fa-pencil"
                                                aria-hidden="true"></i> Edit</button></a>

                                    <form method="POST" action="{{ route('resource.destroy', $resource->id) }}"
                                        enctype="multipart/form-data" class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button delete-btn"><i
                                                class="fa fa-trash-alt" aria-hidden="true"></i> Delete</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="text-end mt-3">
                    <a href="{{ route('cyber-security.resource.view') }}">
                        <button class="btn btn-primary btn-sm">view Available resources</button>
                    </a>
                </div>
            </div>
        @else
            <p class="alert alert-warning shadow mt-3 fw-bold">Currently no resource is available.
            </p>
        @endif
    </div>

    {{-- Notifications link --}}
    <script src="{{ route('admin') }}"></script>
@endsection
