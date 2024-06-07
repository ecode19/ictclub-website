@extends('layouts.programming')
@section('content')
    <div class="container">
        <div class="text-white">
            <div class="" aria-labelledby="dropdownMenuButton">
                <h6 class="">User Details</h6>
                Registration Number: {{ $user->registration_number }} <br>
                Full Name: {{ $user->fullname }} <br>
                Course: {{ $user->course }} <br>
                Category: {{ $user->category }} <br>
                Email: {{ $user->email }} <br>
                Created At: {{ $user->created_at }}
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-success ">Message</button>
            <button class="btn btn-warning ">Update</button>
            <button class="btn btn-danger ">Delete</button>
        </div>

        <h1 class="text-warning mt-4">Total found: <strong>{{ $totalResults }}</strong></h1>
    </div>
@endsection
