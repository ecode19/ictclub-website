@extends('layouts.admin')
@section('content')
    @include('admin.message')
    <div class="container">
        <form class="mx-5 mt-5" action="{{ route('add.team.member') }}" method="post" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            @method('POST')
            <h1 class="colorIcon">Register Team Member</h1>
            <hr>
            <div class="row mt-5">
                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="name">Member Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" name="name" placeholder="Enter Member Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        value="{{ old('title') }}" placeholder="Enter Title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="professionalism">Professionalism</label>
                    <input type="text" class="form-control @error('professionalism') is-invalid @enderror"
                        name="professionalism" value="{{ old('professionalism') }}" placeholder="Enter professionalism">
                    @error('professionalism')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="email">E-Mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" placeholder="Enter Valid E-Mail Address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="x">X Link</label>
                    <input type="url" class="form-control @error('x') is-invalid @enderror" name="x"
                        value="{{ old('x') }}" placeholder="X Social Media Link">
                    @error('x')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="whatsApp">WhatsApp</label>
                    <input type="url" class="form-control @error('whatsApp') is-invalid @enderror" name="whatsApp"
                        value="{{ old('whatsApp') }}" placeholder="WhatsApp Social Media Link">
                    @error('whatsApp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-4">
                    <label class="mb-2" for="facebook">Facebook Profile</label>
                    <input type="url" class="form-control @error('facebook') is-invalid @enderror" name="facebook"
                        value="{{ old('facebook') }}" placeholder="Facebook Social Media Link">
                    @error('facebook')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-6 mb-4">
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
            <button type="submit" class="btn btn-success mt-3 mb-4">Register</button>
        </form>

        <table class="table table-success table-bordered table-striped table-responsive overflow-x-auto">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @if (count($teamMembers) > 0)
                    @foreach ($teamMembers as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->name }}</td>
                            <td class="text-center">
                                <img src="{{ asset('images/profilePictures/' . $member->profile_image) }}"
                                    class="img-fluid rounded-circle" alt=""
                                    style="width:50px; height: 50px;">
                            </td>
                            <td>
                                <a href="{{ route('edit.team.member', $member->id) }}" class="btn btn-warning btn-sm"> <i
                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="" class="btn btn-danger btn-sm"> <i class="fa fa-trash"
                                        aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p class="alert alert-warning" role="alert">Currently, No record found.</p>
                @endif
            </tbody>
        </table>
    </div>
@endsection
