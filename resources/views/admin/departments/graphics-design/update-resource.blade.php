@extends('layouts.graphics-designing')
@section('content')
    <div class="container mt-5">
        <h2 class="text-secondary">Resources Management Panel</h2>
        <hr>
        <form action="{{ route('graphics.update.resource', $resources->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label class="mt-2" for="title">Resource Name:</label>
                <input type="text" value="{{ $resources->title }}"
                    class="form-control @error('title') is-invalid @enderror" id="resource_name" name="title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="mt-2" for="description">Resource Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="3">{{ $resources->description }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="mt-2" for="category">Resource Category:</label>
                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category">
                    <option value="presentation" {{ $resources->category == 'presentation' ? 'selected' : '' }}>Presentation
                    </option>
                    <option value="document" {{ $resources->category == 'document' ? 'selected' : '' }}>Document</option>
                    <option value="tutorial" {{ $resources->category == 'tutorial' ? 'selected' : '' }}>Tutorial</option>
                </select>

                @error('category')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group mt-2">
                <label class="mt-2" for="file">Resource File:</label>
                <input type="file" value="{{ $resources->file_name }}"
                    class="form-control @error('file') is-invalid @enderror" id="file" name="file">

                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <div class="mt-4">
                    <h6>Resource thumbnail</h6>
                    <img src="{{ asset('images/resourcesThumbnails/' . $resources->thumbnail) }}"
                        class="img-fluid w-50 mt-1" alt="Profile Picture" style="height: 190px; border-radius: 5px;">
                </div>

                <hr>

                <label class="mt-2" for="thumbnail">Change thumbnail</label>
                <input type="file" value="{{ $resources->thumbnail }}"
                    class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail">

                @error('thumbnail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-sm mb-3 mt-3"> <i class="fa fa-save" aria-hidden="true"></i>
                Save</button>
        </form>
        {{-- @if ($resources->count() > 0)
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
                                <div class="mt-3 d-flex">

                                    <a href="{{ route('admin.document.preview', $resource->file_path) }}" target="_blank">
                                        <button class="btn btn-primary btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i>
                                            Preview</button> </a>

                                    <a href=""><button class="btn btn-warning btn-sm mx-1"> <i class="fa fa-pencil"
                                                aria-hidden="true"></i>Edit</button></a>
                                    <a href=""> <button class="btn btn-danger btn-sm"> <i class="fa fa-remove"
                                                aria-hidden="true"></i>
                                            Delete</button></a>

                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="text-end mt-3">
                    <button class="btn btn-primary btn-sm">view Available resources</button>
                </div>
            </div>
        @else
            <p class="alert alert-warning fw-bold shadow mt-3">CURRENTLY NO RESOURCE AVAILABLE</p>
        @endif --}}
    </div>
@endsection
