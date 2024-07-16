@extends('layouts.user')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="justify-content-center align-items-center min-vh-100">
                <form action="{{ route('member.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <p>Hi, <strong class="colorIcon fs-4">{{ $userInfo->fullname }}</strong></p>

                    <div class="col-md-8 mt-3 mb-3">
                        <label class="mb-2" for="registration_number">Registration Number</label>
                        <input type="text" class="form-control" name="registration_number" id="registration_number"
                            value="{{ $userInfo->registration_number }}" disabled>
                    </div>


                    <div class="col-md-8 mt-3 mb-3">
                        <label class="mb-2" for="fullname">Fullname</label>
                        <input type="text" class="form-control" name="fullname" id="fullname"
                            value="{{ $userInfo->fullname }}" disabled>
                    </div>

                    <div class="col-md-8 mt-3 mb-3">
                        <label class="mb-2" for="course">Course</label>
                        <select class="form-select @error('course') is-invalid @enderror" name="course" id="course">
                            <option value="{{ $userInfo->course }}">{{ $userInfo->course }}</option>
                            <option value="BScCS">BScCS</option>
                            <option value="BAGEN">BAGEN</option>
                            <option value="Biology ICT">Biology ICT</option>
                            <option value="Chemistry ICT">Chemistry ICT</option>
                            <option value="Statistics ICT">Statistics ICT</option>
                        </select>
                    </div>

                    <div class="col-md-8 mt-3 mb-3">
                        <label class="mb-2" for="category">Category</label>
                        <input type="text" class="form-control" name="category" id="category"
                            value="{{ $userInfo->category }}" disabled>
                    </div>

                    <div class="col-md-8 mt-3 mb-3">
                        <label class="mb-2" for="image">Select Image File</label>
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
        <div>
            <p class="alert alert-warning fs-4 fst-italic" role="alert">
                Please contact admin to update other details send you're request to admin via <strong>info@mwecauictclub.ac.tz</strong>
            </p>
        </div>
    </div>
@endsection
