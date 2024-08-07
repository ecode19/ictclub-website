@extends('layouts.web')
@include('links')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf


                            <div class="row mb-3">
                                <label for="registration_number"
                                    class="col-md-4 col-form-label text-md-end ">{{ __('Registration Number') }}</label>

                                <div class="col-md-6">
                                    <input id="registration_number" type="text"
                                        class="form-control @error('registration_number') is-invalid @enderror"
                                        name="registration_number" value="{{ old('registration_number') }}" required
                                        autocomplete="registration_number" autofocus>

                                    @error('registration_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="fullname"
                                    class="col-md-4 col-form-label text-md-end ">{{ __('Fullname') }}</label>

                                <div class="col-md-6">
                                    <input id="fullname" type="text"
                                        class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                                        value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>

                                    @error('fullname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end ">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="course"
                                    class="col-md-4 col-form-label text-md-end ">{{ __('Course') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select @error('course') is-invalid @enderror" name="course"
                                        id="course">
                                        <option value="BScCS">BScCS</option>
                                        <option value="BAGEN">BAGEN</option>
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
                            </div>

                            <div class="row mb-3">
                                <label for="category"
                                    class="col-md-4 col-form-label text-md-end ">{{ __('Category') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select form-select-lg mb-3 @error('category') is-invalid @enderror"
                                       name="category" aria-label=".form-select-lg example">
                                        <option value="programming">programming</option>
                                        <option value="graphics designing">graphics designing</option>
                                        <option value="cyber security">cyber security</option>
                                    </select>

                                    {{-- <input id="category" type="category"
                                        class="form-control @error('category') is-invalid @enderror" name="category"
                                        value="{{ old('category') }}" required autocomplete="category"> --}}

                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end ">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end ">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
