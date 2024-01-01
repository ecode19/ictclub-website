<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--links-->

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap5.min.css">
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
                margin-left: var(--offcanvas-width);
            }

            .sidebar-nav {
                transform: none;
                visibility: visible !important;
                top: var(--topNavbarHeight);
                height: 100%;
            }
        }

        button.f:hover {
            background-color: black;
            color: white;
        }

        .btn {
            color: white;
        }

        .color {
            background-color: #19c357;
        }

        .image-border {
            border: 2px solid #19c357;
        }

        .color2 {
            color: #19c357;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top" style="background-color:#19c357;">
        <div class="container">
            <a href="{{ route('AdminDashboard') }}" class="navbar-brand fw-bolder text-light fs-3">MWECAU ICT CLUB
                SYSTEM
                (MICs)</a>
            <ul class="ms-auto text-light list-unstyled">
                <li>{{ Auth::user()->fullname }}, ({{ Auth::user()->usertype }})</li>
            </ul>
            <button class="btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <span class="">Menu</span>
            </button>
        </div>
    </nav>
    <!--offcanvas-->
    <section>
        <div class="offcanvas offcanvas-start text-light shadow-lg sidebar-nav" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel" style="background-color:#19c357;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-muted" id="offcanvasExampleLabel"> <i class="fas fa-dashboard"></i>
                    Dashboard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="dropdown-divider"></div>
            <div class="offcanvas-body text-light">
                <div class="dropdown">
                    {{-- <a href="{{ route('member_list') }}"><button class="f btn btn-dark mt-3"> Manage Member</button></a> --}}
                    <button class="f btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-graduate"></i> Manage Member
                    </button>
                    <ul class="dropdown-menu" style="background-color: lightorange">
                        <li><a class="dropdown-item" href="{{ route('add_Member') }}">New Member</a></li>
                        <li><a class="dropdown-item" href="{{ route('member_list') }}">Member List</a></li>
                        <li><a class="dropdown-item" href=""></a></li>
                    </ul>
                </div>

                <a href="{{ route('post_event') }}"><button class="f btn btn-dark mt-3"> Event
                        Management</button></a>
                <a href="{{ route('resource_repository') }}"><button class="f btn btn-dark mt-3"><i
                            class="fas fa-file-pdf"></i>
                        Resource
                        Repository</button></a>
                <a href="{{ route('departments') }}"><button class="f btn btn-dark mt-3"><i class="fas fa-users"></i>
                        Departments</button></a>
                <a href=""><button class="f btn btn-dark mt-3"><i class="fas fa-paper-plane"></i>
                        Communication</button></a>
                <a href=""><button class="f btn btn-dark mt-3"><i class="fas fa-dollar"></i> Financial
                        Tracking</button></a>
                <a href=""><button class="f btn btn-dark mt-3"><i class="fas fa-feedback"></i> Feedback
                        & Support</button></a>
                <a href=""><button class="f btn btn-dark mt-3"> show resources</button></a> <br>

                {{--    laravel default login script --}}
                <a href="{{ route('logout') }}" class="text-decoration-none fw-bold text-warning "
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
    {{--    <section class="table"> --}}

    {{--    </section> --}}
    <!--bootstrap javascrip-->
    <!--bootstrap javascrip-->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
