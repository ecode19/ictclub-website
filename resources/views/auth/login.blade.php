{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
{{--    <div class="container"> --}}
{{--        <div class="row justify-content-center"> --}}
{{--            <div class="col-md-8"> --}}
{{--                <div class="card"> --}}
{{--                    <div class="card-header">{{ __('Login') }}</div> --}}

{{--                    <div class="card-body"> --}}
{{--                        <form method="POST" action="{{ route('login') }}"> --}}
{{--                            @csrf --}}

{{--                            <div class="row mb-3"> --}}
{{--                                <label for="registration_number" --}}
{{--                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

{{--                                <div class="col-md-6"> --}}
{{--                                    <input id="registration_number" type="registration_number" --}}
{{--                                        class="form-control @error('registration_number') is-invalid @enderror" --}}
{{--                                        name="registration_number" value="{{ old('registration_number') }}" required --}}
{{--                                        autocomplete="registration_number" autofocus> --}}

{{--                                    @error('registration_number') --}}
{{--                                        <span class="invalid-feedback" role="alert"> --}}
{{--                                            <strong>{{ $message }}</strong> --}}
{{--                                        </span> --}}
{{--                                    @enderror --}}
{{--                                </div> --}}
{{--                            </div> --}}

{{--                            <div class="row mb-3"> --}}
{{--                                <label for="password" --}}
{{--                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}

{{--                                <div class="col-md-6"> --}}
{{--                                    <input id="password" type="password" --}}
{{--                                        class="form-control @error('password') is-invalid @enderror" name="password" --}}
{{--                                        required autocomplete="current-password"> --}}

{{--                                    @error('password') --}}
{{--                                        <span class="invalid-feedback" role="alert"> --}}
{{--                                            <strong>{{ $message }}</strong> --}}
{{--                                        </span> --}}
{{--                                    @enderror --}}
{{--                                </div> --}}
{{--                            </div> --}}

{{--                            <div class="row mb-3"> --}}
{{--                                <div class="col-md-6 offset-md-4"> --}}
{{--                                    <div class="form-check"> --}}
{{--                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" --}}
{{--                                            {{ old('remember') ? 'checked' : '' }}> --}}

{{--                                        <label class="form-check-label" for="remember"> --}}
{{--                                            {{ __('Remember Me') }} --}}
{{--                                        </label> --}}
{{--                                    </div> --}}
{{--                                </div> --}}
{{--                            </div> --}}

{{--                            <div class="row mb-0"> --}}
{{--                                <div class="col-md-8 offset-md-4"> --}}
{{--                                    <button type="submit" class="btn btn-primary"> --}}
{{--                                        {{ __('Login') }} --}}
{{--                                    </button> --}}

{{--                                    @if (Route::has('password.request')) --}}
{{--                                        <a class="btn btn-link" href="{{ route('password.request') }}"> --}}
{{--                                            {{ __('Forgot Your Password?') }} --}}
{{--                                        </a> --}}
{{--                                    @endif --}}
{{--                                </div> --}}
{{--                            </div> --}}
{{--                        </form> --}}
{{--                    </div> --}}
{{--                </div> --}}
{{--            </div> --}}
{{--        </div> --}}
{{--    </div> --}}
{{-- @endsection --}}

<!--End Navbar-->
@extends('layouts.web')
@section('content')
{{-- @include('links') --}}
<section class="" style="background: linear-gradient(to right, #012499, #011033);">
    @include('sweetalert::alert')
    <div class="container">
        <div class="row g-0">
            <div class="col-md py-5 p-5 text-center" data-aos="fade-right" data-aos-duration="2000">
                <img src="../img/logo.png" class="img-fluid image-border rounded-circle w-50 mt-5" alt="club">
            </div>
            <div class="col-md py-lg-5 py-sm-0">
                <form action="{{ route('login') }}" method="post" autocomplete="off">
                    @csrf
                    @method('post')
                    <p class="lead fs-4 mb-3 mx-5 text-lg-start text-white fw-bold">Sign in</p>

                    @if (session()->has('fail'))
                        <div class="alert alert-danger p-1 col-lg-9" role="alert">
                            {{ session('fail') }}
                        </div>
                    @endif

                    <!--input for Registration Number-->
                    <div class="form-outline mt-4 col-lg-9">
                        <label class="form-label text-light" for="registration number">REGISTRATION
                            NUMBER</label>
                        <input type="text" name="registration_number" placeholder="Enter valid Registration number"
                            class="form-control @error('registration_number') is-invalid @enderror">

                        <div>
                            <span class="text-danger">
                                @error('registration_number')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!--input for password-->
                    <div class="form-outline mt-4 col-lg-9">
                        <label class="form-label text-light" for="Email">PASSWORD</label>
                        <input type="password" name="password" placeholder="Type your password"
                            class="form-control @error('password') is-invalid @enderror">
                        <div>
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <!--checkbox-->
                    <div class="form-check py-2">
                        <label class="form-check-label text-light" for="checkbox">Remember me</label>
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <!--Login button-->
                    <div class="pt-4">
                        <button type="submit" name="login" class="btn btn-primary btn-lg"
                            target="_blank">Login</button>
                        <p class="small text-light fw-bold mt-2 pt-1 mb-0">Don't have an account <a
                                href="{{ route('register') }}"
                                class="text-danger mx-2 text-decoration-none">Register</a></p>
                    </div>
                    <!--Sign in with-->
                    <div class="col-md py-3" data-aos="fade-up" data-aos-duration="2000">
                        <p class="text-white">Or Sign in with</p>
                        <a href="https://www.facebook.com/YourFacebookURLHere" target="_blank" class="btn btn-primary">
                            <i class="fab fa-facebook-f btn-floating mx-1"></i>
                        </a>
                        <a href="https://www.google.com" target="_blank" class="btn btn-primary">
                            <i class="fab fa-google btn-floating mx-1"></i>
                        </a>
                        <a href="https://www.instagram.com/YourInstagramURLHere" target="_blank"
                            class="btn btn-primary">
                            <i class="fab fa-instagram btn-floating mx-1"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <footer class="text-dark">
        <div class="container-fluid">
            <p class="text-center text-light"> Copyright <i class="far fa-copyright text-warning"></i> 2023 Ecode
                Technologies</p>
        </div> --}}
    </footer>
</section>
@endsection
