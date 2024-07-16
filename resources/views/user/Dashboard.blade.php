@extends('layouts.user')
@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .color {
            background-color: #2C3592;
        }

        .favcolor {
            color: #2C3592;
        }

        .userbtn {
            background-color: #2C3592;
        }

        .col-12.col-md-10 .img-fluid {
            border: 3px solid #19c357;
        }

        .col-12.col-md-10.col-lg-6 .card {
            border: 2px solid #2C3592;
            border-radius: 4px;
        }

        .col-12.col-md-12.col-lg-6 h5 {
            border-bottom: 2px solid #1b0922;
        }
    </style>

    </head>


    <div class="container mt-5">
        <div>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div>
            @if (session()->has('fail'))
                <span class="alert alert-danger p-3 mt-5">
                    {{ session('fail') }}
                </span>
            @endif
        </div>
    </div>
    <section class="mt-4 p-4">
        <div class="container">
            <!-- Display the alert message -->
            @if (!Auth::user()->profile_picture)
                <div class="alert alert-warning text-center" role="alert">
                    Hi, <strong>{{ Auth::user()->fullname }}</strong> Click On Profile Update to Change Your Profile
                    Picture. </a>
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-md-10 col-lg-6">
                    <div class="card shadow-lg">
                        <div class="details text-light color">
                            <h6 class="mx-3 mt-3 fs-6 fw-bold">Club Member</h6>
                        </div>
                        <div class="card-tittle text-center">
                            <h6 class="mx-3 text-decoration-underline fs-6 fw-bold">Informations</h6>
                        </div>
                        <div class="card-body d-flex">
                            @if (Auth::User()->profile_picture)
                                <img src="{{ asset('images/profilePictures/' . Auth::User()->profile_picture) }}"
                                    class="img-fluid rounded-circle mt-auto" alt="Profile Picture"
                                    style="width: 130px; height:130px">
                            @else
                                <div class="">
                                    <img src="../img/logo.jpg" class="img-fluid rounded-circle mt-auto"
                                        alt="Profile Picture" style="width: 130px; height:130px">

                                </div>
                            @endif
                            <div class="mx-auto">
                                <p><strong>RegNo:</strong> {{ Auth::user()->registration_number }}</p>
                                <p><strong>Full Name: </strong> {{ Auth::user()->fullname }}</p>
                                <p><strong>Course:</strong> {{ Auth::user()->course }}</p>
                                <p><strong>Category: </strong> {{ Auth::user()->category }}</p>
                            </div>
                        </div>
                        <a class="btn color text-white fs-5"
                            href="{{ route('member.profile.update.form', [$authenticatedUser->id]) }}">
                            Update Profile</a>

                            <a class="btn color text-white fs-5 mt-2" href="{{ route('membership.card.print') }}">
                                Print Membership Card
                            </a>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 mt-5">
                    <h4 class="text-dark fw-bold">Welcome, <span class="colorIcon fw-bold text-uppercase">
                            {{ Auth::user()->fullname }}</span>
                        <small class="favcolor"></small> to your
                        ICT Club Member Dashboard
                    </h4>

                    <p>Here you can access various features and functionalities related to your membership.</p>
                    <p>Feel free to explore and engage with the club activities!</p>

                    <div> <strong>Payment Status: </strong> <span class="colorIcon fw-bold fs-4">
                            {{ Auth::user()->payment_status }}
                        </span>
                    </div>
                    <!-- Display posts to users -->
                    <div class="posts">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <h5 class="text-dark"> <span class="fw-bold"> Fellow {{ Auth::user()->category }}</span> Member's</h5>
            <table class="table table-primary table-hover table-responsive table-bordered table-striped">
                <thead>
                    <tr class="fw-bold">
                        <td>S/N</td>
                        <td>REGISTRATION NUMBER</td>
                        <td>CATEGORY</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($fellowMembers as $fellowMember)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $fellowMember->registration_number }}</td>
                            <td class="text-uppercase">{{ $fellowMember->category }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </section>
    <div class="container">
        <div class="alert alert-warning fs-5 fst-italic" role="alert">
            <p> <strong> NOTE: </strong> For Any Missing or incorrect information please Contact, <strong>Mr: Mahuyemba
                </strong></p>
        </div>
    </div>
@endsection
