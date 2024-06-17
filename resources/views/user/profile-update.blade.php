@extends('layouts.user')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center ">
            <form action="{{ route('member.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <p>Hi, <strong class="colorIcon fs-4">{{ $userInfo->fullname }}</strong></p>
                <div class="col-md-8 mt-3 mb-3">
                    <label for="image">Select Image File</label>
                    <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                        name="profile_picture" id="profile_picture" accept="image/*">


                    @error('profile_picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
@endsection
