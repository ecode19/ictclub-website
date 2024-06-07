@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <h4>Comments from website users</h4>
        <hr>
        <div class="mt-2">
            @php
                $counter = 1;
            @endphp
            @if ($comments->count() > 0)
                @foreach ($comments as $comment)
                    <div class="card mb-2 mt-3">
                        <div class="card-body">
                            <div class="card-text">
                                <h6 class="text-dark">{{ $comment->message }}</h6>
                                <p class="text-dark">From: <strong>{{ $comment->fullname }}</strong> </p>
                                <div class="d-flex">
                                    {{-- <button class="btn btn-primary btn-sm mx-2">Reply</button> --}}
                                    <form method="POST" action="{{ route('admin.destroy.comment', [$comment->id]) }}"
                                        enctype="multipart/form-data" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <p class="alert alert-warning shadow-lg" role="alert">Currently there is no comment from website user.</p>
            @endif
        </div>
    @endsection
