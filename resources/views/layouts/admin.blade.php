<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'Mwecau ICT Club') }}</title>

    {{-- sweetalert offline links --}}
    <script src="{{ asset('js/sweetalert/dist/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert/dist/sweetalert2.min.css') }}">

    <!-- for title img -->
    <link rel="shortcut icon" type="../image/icon" href="../img/logo.jpg" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('jquery/css/dataTables.bootstrap5.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/aos/dist/aos.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">

    <style>
        :root {
            --offcanvas-width: 230px;
            --topNavbarHeight: 68px;
        }

        .sidebar-nav {
            width: var(--offcanvas-width);
        }

        @media (min-width: 992px) {
            .body {
                overflow: auto !important;
            }

            .offcanvas-backdrop {
                display: none;
            }

            main {
                margin-left: 250px;
                margin-right: 20px
            }

            .sidebar-nav {
                transform: none;
                visibility: visible !important;
                top: var(--topNavbarHeight);
                height: 100%;
            }
        }

        .DashboardCard {
            border-radius: 10px;
            height: 240px;
            color: white;
            background: linear-gradient(to top, #02102b, #1e57d3);
        }
    </style>
</head>

<body class="overflow-x-hidden">
    @include('sweetalert::alert')

    {{-- admin navigation bar --}}

    <nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top"
        style="background: linear-gradient(to right, #02102b, #1e57d3);">
        <div class="container">
            <a href="{{ route('AdminDashboard') }}" class="navbar-brand fw-bolder text-light fs-3">MICs</a>
            <ul class="ms-auto text-light list-unstyled">


            </ul>

            <div class="btn-group d-none d-sm-block ">
                <button type="button" class="btn btn-secondary "> {{ Auth::user()->fullname }}</button>
                <button type="button" class="btn btn-secondary  dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">coding</span>
                </button>
                <ul class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>

            <button class="btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!--offcanvas-->
    <section>
        <div class="offcanvas offcanvas-start text-light shadow-lg sidebar-nav" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel" style="background: linear-gradient(to top, #02102b, #1e57d3);">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-muted" id="offcanvasExampleLabel"> <i class="fas fa-dashboard"></i>
                    Dashboard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="dropdown-divider"></div>
            <div class="offcanvas-body text-light">
                <div class="dropdown">
                    {{-- <a href="{{ route('member_list') }}"><button class="f btn btn-dark mt-3"> Manage Member</button></a> --}}
                    <button class="w-100 btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-graduate"></i> Manage Member
                    </button>
                    <ul class="dropdown-menu" style="background-color: lightorange">
                        <li><a class="dropdown-item" href="{{ route('admin.register.member') }}">New Member</a></li>
                        <li><a class="dropdown-item" href="{{ route('member_list') }}">Member List</a></li>
                        <li><a class="dropdown-item" href="{{ route('showAssignForm') }}">Add department admin</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.register.number') }}">Verify Number</a></li>
                    </ul>
                </div>

                <a href="{{ route('post_event') }}">
                    <button class="w-100 btn btn-dark mt-3 text-start"> <i class="fa fa-users"></i>
                        <small>Event Management</small>
                    </button>
                </a>

                <a href="{{ route('resource_repository') }}">
                    <button class="w-100 btn btn-dark mt-3 text-start">
                        <i class="fas fa-file-pdf"></i>
                        <small> Resource Repository</small>
                    </button>
                </a>

                <a href="{{ route('departments') }}">
                    <button class="w-100 btn btn-dark mt-3 text-start">
                        <i class="fas fa-users"></i>
                        <small> Departments</small>
                    </button>
                </a>

                <a href="{{ route('admin.comments') }}"><button class="w-100 btn btn-dark mt-3 text-start">
                        <i class="fas fa-paper-plane"></i>
                        <small> Communication</small>
                    </button>
                </a>

                <a href="{{ route('admin.financial.panel') }}">
                    <button class="w-100 btn btn-dark mt-3 text-start">
                        <i class="fas fa-dollar"></i>
                        <small>Financial Tracking</small>
                    </button>
                </a>

                <a href="{{ route('resource_repository') }}">
                    <button class="w-100 btn btn-dark mt-3 text-start">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <small>show resources</small>
                    </button>
                </a>


                <div class="dropdown mt-3">
                    {{-- <a href="{{ route('member_list') }}"><button class="f btn btn-dark mt-3"> Manage Member</button></a> --}}
                    <button class="w-100 btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-folder"></i> Manage site
                    </button>
                    <ul class="dropdown-menu" style="background-color: lightorange">
                        <li><a class="dropdown-item" href="{{ route('manage.team.members') }}">Team Members</a></li>
                        </li>
                    </ul>
                </div>

                <a href="https://mwecauictclubforum.onrender.com?username={{ Auth::user()->registration_number }}&room={{ Auth::user()->category }}"
                    target="_blank">
                    <button class="w-100 btn btn-dark mt-3 text-start">
                        <i class="fa fa-message" aria-hidden="true"></i>
                        <small>Chat Forum</small>
                    </button>
                </a><br>

                <div class="dropdown mt-3">
                    {{-- <a href="{{ route('member_list') }}"><button class="f btn btn-dark mt-3"> Manage Member</button></a> --}}
                    <button class="w-100 btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-folder"></i> Print Documents
                    </button>
                    <ul class="dropdown-menu" style="background-color: lightorange">
                        <li><a class="dropdown-item" href="{{ route('all.registered.members') }}">Print All
                                registered members</a></li>
                        <li><a class="dropdown-item" href="{{ route('active-members') }}">Print active
                                members</a></li>
                        <li><a class="dropdown-item" href="{{ route('inactive-members') }}">Print inactive
                                members</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('club.departments') }}">Print Department List</a>
                        <li><a class="dropdown-item" href="{{ route('club.cyber.members') }}">Members Under cyber</a>
                        <li><a class="dropdown-item" href="{{ route('club.programming.members') }}">Members under
                                programming</a>
                        <li><a class="dropdown-item" href="{{ route('club.graphics.members') }}">Members Under
                                Graphics</a>
                        <li><a class="dropdown-item" href="{{ route('verified.numbers') }}">Verified Numbers</a>
                        </li>
                    </ul>
                </div>

                <a class="btn btn-secondary btn-sm mt-2 w-100 text-start" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <hr>

                {{--    laravel default login script --}}
                <a href="{{ route('logout') }}" class="text-decoration-none d-none fw-bold text-warning "
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <button class="btn btn-brand btn-primary btn-sm mt-2"> <i class="fa fa-sign-out"
                            aria-hidden="true"></i> Logout</button>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </div>
    </section>

    <div id="id">

        <main>
            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this action!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#dc3545",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit the form associated with this button
                            button.closest('.delete-form').submit();
                        }
                    });
                });
            });
        });
    </script>

    <script src="{{ asset('jquery/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('jquery/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('jquery/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}



</html>
