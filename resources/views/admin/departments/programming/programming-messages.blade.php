@extends('layouts.programming')
@section('content')
    <div class="container">
        <div class="mt-5">
            <h4 class="">Programming Messages from website Users.</h4>
            <hr>
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
            @endif
            @if ($comments->isEmpty())
                <p class="alert alert-warning shadow-lg">Currently, there is no Message from website relating to
                    <strong>programming department.</strong>
                </p>
            @endif
        </div>
    @endsection
