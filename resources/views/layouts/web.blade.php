<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'Mwecau ICT Club') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=alegreya:600" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">


    <!-- for title img -->
    <link rel="shortcut icon" type="../image/icon" href="../img/logo.png" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <script src="{{ asset('jquery/js/jquery-3.5.1.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery/css/dataTables.bootstrap5.min.css') }}">
    <script src="{{ asset('jquery/js/dataTables.bootstrap5.min.js') }}"></script>
    <sript src="{{ asset('jquery/js/jquery.dataTables.min.js') }}">
        </script>

        <link rel="stylesheet" href="{{ asset('/css/aos/dist/aos.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">



        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    @include('sweetalert::alert')
    <div class="id">
        {{-- navigation bar --}}
        <section>
            <!--navbar-->
            <nav class="navbar navbar-expand-lg sticky-top shadow-lg"
                style="background: linear-gradient(to right, #033392, #4a649b); border-bottom: 1px solid white;">
                <div class="container">
                    <a class="navbar-brand text-decoration-none fw-bold" href="{{ url('/') }}"
                        style="color: #fff;">
                        <img class="img-fluid rounded-circle d-none d-md-block d-sm-block" src="../../img/logo.png"
                            style="width: 100px; border:none;">
                    </a>
                    <div class="d-md-block d-lg-none d-sm-block">
                        <a href="{{ url('/') }}" class="navbar-brand text-white">
                            <h2 class="fw-bold">Mwecau-ICT Club </h2> <span
                                class="fs-6 mb-4 text-white fst-italic">"Inspire, Innovate, Integrate"</span>
                        </a>
                    </div>

                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
                        <span class="navbar-toggler-icon"> <i class="fa fa-bars text-light fs-3" aria-hidden="true"></i>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="{{ route('about.page') }}" class="nav-link">About Us</a></li>
                            <li class="nav-item"><a href="{{ route('department.page') }}"
                                    class="nav-link">Our Divisions</a></li>
                            <li class="nav-item"><a href="{{ route('contact.page') }}" class="nav-link">Contact Us</a>
                            </li>
                        </ul>
                        @guest
                            @if (Route::has('login'))
                                <button class="btn btn-brand"><a class="text-light nav-item nav-link"
                                        href="{{ route('login') }}" target="_blank">login</a></button>
                            @endif
                            @if (Route::has('register'))
                                <button class="btn btn-brand"><a class="text-light nav-item nav-link"
                                        href="{{ route('register') }}">register</a></button>
                            @endif
                        @else
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary "> {{ Auth::user()->fullname }}</button>
                                <button type="button" class="btn btn-secondary  dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">coding</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <span class="dropdown-item">{{ Auth::user()->registration_number }}</span>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>

                            </div>
                        @endguest
                    </div>
                </div>
            </nav>

            <!--End Navbar-->

        </section>
        {{-- navigation bar end --}}

        {{-- body section --}}
        <main class="py-0">
            @yield('content')
        </main>
        {{-- body section end  --}}

        {{-- chat icon --}}
        <section id="chat">
            <div id="chatIcon">
                <i class="fas fa-comments"></i>
            </div>
        </section>

        {{-- footer --}}
        <section class="footer-container text-white ">
            <!-- Copyright -->
            <div class="text-center p-3 sticky-lg-bottom" style="background-color: rgba(0, 0, 0, 0.2)">

                <a class="text-white" href="https://mwecauictclub.ac.tz/">
                    <p class="text-center text-white"><i class="far fa-copyright text-white"></i> <?php echo date('Y'); ?>
                        Mwecauictclub
                    </p>
                </a>
                <a href="">
                    <p class="text-center text-white">
                        Designed and Developed By : E & S
                    </p>
                </a>

            </div>
            <!-- Copyright -->
        </section>
        <!-- footer end -->

        {{-- chat icon --}}
        <section id="chat">
            <div class="shadow-lg" id="chatIcon">
                <i class="fas fa-comments"></i>
            </div>
        </section>
    </div>

    {{-- js links --}}
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="{{ asset('css/aos/dist/aos.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
