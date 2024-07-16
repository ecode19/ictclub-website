@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="mt-5">
            <h2 class="colorIcon">Edit team Member</h2>
            <hr>
            <form class="mx-5 mt-5" action="{{ route('update.team.member', $member->id) }}" method="post" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mt-5">
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="mb-2" for="name">Member Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ $member->name }}" name="name" placeholder="Enter Member Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="mb-2" for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ $member->title }}" placeholder="Enter Title">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="mb-2" for="professionalism">Professionalism</label>
                        <input type="text" class="form-control @error('professionalism') is-invalid @enderror"
                            name="professionalism" value="{{ $member->professionalism }}"
                            placeholder="Enter professionalism">
                        @error('professionalism')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="mb-2" for="email">E-Mail</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $member->email }}" placeholder="Enter Valid E-Mail Address">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="mb-2" for="x">X Link</label>
                        <input type="url" class="form-control @error('x') is-invalid @enderror" name="x"
                            value="{{ $member->x }}" placeholder="X Social Media Link">
                        @error('x')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="mb-2" for="whatsApp">WhatsApp</label>
                        <input type="url" class="form-control @error('whatsApp') is-invalid @enderror" name="whatsApp"
                            value="{{ $member->whatsApp }}" placeholder="WhatsApp Social Media Link">
                        @error('whatsApp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <label class="mb-2" for="facebook">Facebook Profile</label>
                        <input type="url" class="form-control @error('facebook') is-invalid @enderror" name="facebook"
                            value="{{ $member->facebook }}" placeholder="Facebook Social Media Link">
                        @error('facebook')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        @if ($member->profile_image)
                            <div class="text-center mb-4"> <img
                                    src="{{ asset('images/profilePictures/' . $member->profile_image) }}"
                                    class="img-fluid rounded w-50 " alt=""
                                    style="background-color: rgb(107, 107, 252)">
                            </div>
                        @else
                        <div class="text-center mb-4"> <img
                            src="{{ asset('img/logo.jpg') }}"
                            class="img-fluid rounded w-50 " alt=""
                            style="background-color: rgb(107, 107, 252)">
                    </div>
                        @endif

                        <label class="mb-2" for="profile_image">Profile Image</label>
                        <input type="file" class="form-control @error('profile_image') is-invalid @enderror"
                            name="profile_image" value="{{ old('profile_image') }}" placeholder="Select profile image">
                        @error('profile_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3 mb-4"><i class="fa fa-save" aria-hidden="true"></i>
                    Save</button>
            </form>
        </div>
    </div>
@endsection
