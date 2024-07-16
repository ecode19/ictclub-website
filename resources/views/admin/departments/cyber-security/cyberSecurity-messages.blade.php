@extends('layouts.cyber-security')
@section('content')
    <div class="container">
        <div class="mt-5">
            <h4 class="">Cyber Security Messages from website Users.</h4>

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
                                    <button class="btn btn-primary btn-sm mx-2">Reply</button>
                                    <form method="POST"
                                        action="{{ route('cyber-security.message.destroy', [$comment->id]) }}"
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
                <p class="alert alert-warning mt-5" role="alert">Currently, There is no comments relating to Cyber Security Division.</p>
            @endif


        </div>
    @endsection
