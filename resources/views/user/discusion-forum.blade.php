@extends('layouts.user')
@section('content')
    <div class="container mt-5 ">
        <h1 class="text text-primary"><strong class="text-warning">Welcome</strong>, {{ $userInfo->fullname }}</h1>
        <p>we're kindly request you to <a class="text-decoration-none fw-bold " href="">click here </a> to access the full club discussion forum</p>
    </div>
@endsection
