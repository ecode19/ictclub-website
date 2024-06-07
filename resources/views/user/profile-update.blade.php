@extends('layouts.user')
@section('content')
<form action="{{ route('member.profile.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<p>{{$userInfo->fullname}}</p>
    <div class="container">
        <div class="mt-3 mb-3 col-6">
            <label for="image">Select Image File</label>
            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture" id="profile_picture" accept="image/*">


            @error('image')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Update</button>
    </div>
</form>
@endsection
