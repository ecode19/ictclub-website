<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources Repository | MICs</title>
    @include('links')
</head>

<body>
    @include('admin.adminNav')
    <main>
        @include('admin.message')
        <div class="container">
            <form action="{{route('storeResource')}}" method="post" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="form-group">
                    <label for="title">Resource Name:</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="resource_name" name="title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message  }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category">
                        <option value="presentation">Presentation</option>
                        <option value="document">Document</option>
                        <option value="tutorial">Tutorial</option>
                        <!-- Add more categories here -->
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="file">Upload File:</label>
                    <input type="file" class="form-control-file @error('file_path') is-invalid @enderror" id="file_path" name="file_path">

                    @error('file_path')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Upload Resource</button>
            </form>
             @if($resources->count() > 0)
                 <div class="row">
                     @foreach($resources as $resource)
                         <div class="col-12 col-ld-6 col-md-6">
                             <div class="card">
                                 <div class="card-header">{{$resource->title}}</div>
                                 <div class="card-body">
                                     <div class="card-text">{{$resource->description}}</div>
                                     <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank">Download Resource</a>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
            @else
                 <p class="alert alert-warning fw-bold shadow mt-3">CURRENTLY NO RESOURCE AVAILABLE</p>
             @endif
        </div>
    </main>
</body>

</html>
