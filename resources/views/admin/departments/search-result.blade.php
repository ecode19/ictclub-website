@extends('layouts.programming')
@section('content')
    <div class="container mt-5">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-lg" style="background: linear-gradient(to top, #1b1f15, #9ec73f) ">
                <div class="card-body">
                    @if ($user->profile_picture)
                        <div class="text-center mb-4"> <img
                                src="{{ asset('images/profilePictures/' . $user->profile_picture) }}"
                                class="img-fluid rounded-circle w-50 " alt=""
                                style="background-color: rgb(107, 107, 252)">
                        </div>
                    @else
                        <div class="text-center mb-4"> <img src="{{ asset('img/logo.png/') }}"
                                class="img-fluid rounded-circle w-50 " alt="">
                        </div>
                    @endif

                    <div class="text-right">
                        <span class="fs-4">Fullname: <strong>{{ $user->fullname }}</strong></span> <br>
                        <span class="fs-6">Registration Number: <strong>{{ $user->registration_number }}</strong></span>
                        <br>
                        <span class="fs-4">Course: <strong>{{ $user->course }}</strong></span> <br>
                        <span class="fs-5">Division: <strong>{{ $user->category }} </strong></span><br>
                        <span class="fs-6">Date Registered: <i class="fa fa-registered" aria-hidden="true"></i>
                            <strong>{{ $user->created_at }} </span><br>
                    </div></strong>
                </div>
            </div>
        </div>
    @endsection
