<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <!-- for title img -->
    <link rel="shortcut icon" type="../image/icon" href="../img/logo.jpg" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <script src="{{ asset('jquery/js/jquery-3.5.1.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery/css/dataTables.bootstrap5.min.css') }}">
    <script src="{{ asset('jquery/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('jquery/js/jquery.dataTables.min.js') }}"></script>

</head>

<body>
    @include('sweetalert::alert')
    <div id="id">
        {{-- user navigation bar --}}
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top"
            style="background: linear-gradient(to right, #031a47, #4a649b);">
            <div class="container">
                <a href="{{ route('member.dashboard') }}" class="navbar-brand text-warning"><img
                        class="img-fluid ms-auto rounded-circle d-none d-sm-block" src="../../img/logo.jpg"
                        style="width: 100px; heig"></a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
                    Menu<span class="navbar-toggler-ico"></span>
                </button>
                <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav fs-6 mx-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('member.dashboard') }}">Profile</a></li>
                        {{--                <li class="nav-item"><a class="nav-link" href="{{ route('event') }}">Events</a></li> --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('announcement') }}">Announcements</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('resources.page') }}">Resources</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('discusion-forum.page') }}">Discussion
                                Forum</a>
                        </li>
                    </ul>

                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary "> {{ Auth::user()->fullname }}</button>
                        <button type="button" class="btn btn-secondary  dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">coding</span>
                        </button>

                        <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="{{ url('/') }}">
                                    Go back to website</a></li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>

        {{-- main content goes here --}}
        <main>
            @yield('content')
        </main>
        {{-- footer --}}
        <div class="container mt-5 py-5">
            <footer>
                <p>&copy; <?php echo date('Y'); ?> ICT Club. All rights reserved.</p>
            </footer>
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>



</body>

</html>
