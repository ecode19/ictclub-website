@extends('layouts.programming')
@section('content')
    <div class="container">
        <form class="mx-5 mt-5" action="{{ route('new.programming.member') }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('POST')
            {{-- @include('admin.message') --}}
            <h4 class="">Register programming member</h4>
            <hr>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="registration_number">Registration Number</label>
                    <input type="text" class="form-control @error('registration_number') is-invalid @enderror"
                        value="{{ old('registration_number') }}" name="registration_number"
                        placeholder="Enter Member Registration Number">

                    @error('registration_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="Full name">Full Name</label>
                    <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                        value="{{ old('fullname') }}" placeholder="Enter Full Name">

                    @error('fullname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="email">E-Mail</label>
                    <input type="email" class="form-control @error('fullname') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" placeholder="Enter Valid E-Mail Address">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="GENDER">Course</label>
                    <select class="form-select" name="course">
                        <option value="BAGEN">BAGEN</option>
                        <option value="BScCS">BScCS</option>
                        <option value="Biology ICT">Biology ICT</option>
                        <option value="Chemistry ICT">Chemistry ICT</option>
                        <option value="Statistics ICT">Statistics ICT</option>
                    </select>

                    @error('course')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <label class="mb-2" for="category">Category</label>
                    <select class="form-select" name="category" aria-readonly="true">
                        <option value="programming">programming</option>
                    </select>
                </div>
                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        placeholder="Enter Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="confirmPassword">Confirm password</label>
                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="Re-type your password">

                    <span class="text-danger p-1"> </span>

                </div>

            </div>
            <button type="submit" class="btn btn-success"> <i class="fa fa-upload" aria-hidden="true"></i>
                Register</button>
        </form>


    </div>
@endsection
