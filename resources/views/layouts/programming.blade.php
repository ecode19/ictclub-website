<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Programming Division</title>

    <!-- for title img -->
    <link rel="shortcut icon" type="../image/icon" href="../../../img/logo.jpg" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <script src="{{ asset('jquery/js/jquery-3.5.1.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery/css/dataTables.bootstrap5.min.css') }}">
    <script src="{{ asset('jquery/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('jquery/js/jquery.dataTables.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('/css/aos/dist/aos.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">

    <script src="{{ asset('js/sweetalert/dist/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert/dist/sweetalert2.min.css') }}">
    {{-- <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js "></script>
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css " rel="stylesheet"> --}}
    <style>
        :root {
            --offcanvas-width: 230px;
            --topNavbarHeight: 68px;
        }

        .sidebar-nav {
            width: var(--offcanvas-width);
            transition: 0.9s ease;
        }

        @media (min-width: 992px) {
            .body {
                overflow: auto !important;
            }

            .offcanvas-backdrop {
                display: none;
                transition: 0.9s ease;
                overflow-x: auto;
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
                transition: 0.9s ease;
            }
        }

        body {
            background: #0b1810;
            color: white;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div id="id">

        {{-- admin navigation bar --}}

        <nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top"
            style="background: linear-gradient(to left, #265538, #162c1e);">
            <div class="container">
                <a href="{{ route('programming.dashboard') }}"
                    class="navbar-brand fw-bolder text-light fs-3 fst-italic ">Programming Division</a>
                <ul class="ms-auto text-light list-unstyled">
                    {{-- <li>{{ Auth::user()->fullname }}</li> --}}
                </ul>

                <div class="btn-group d-none d-sm-block ">
                    <button type="button" class="btn btn-secondary "> {{ Auth::user()->fullname }}</button>
                    <button type="button" class="btn btn-secondary  dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">coding</span>
                    </button>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="">
                            {{ __('Profile') }}
                        </a>

                        <a class="dropdown-item" href="">
                            {{ __('Setting') }}
                        </a>
                        <hr>
                        {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form> --}}
                    </ul>
                </div>

                <button class="btn d-lg-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <!--offcanvas-->
        <section>
            <div class="offcanvas offcanvas-start text-light sidebar-nav" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel" style="background: linear-gradient(to top, #265538, #0b1810);">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-muted" id="offcanvasExampleLabel"> <i class="fas fa-dashboard"></i>
                        Dashboard</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                {{-- <div class="dropdown-divider"></div> --}}
                <div class="offcanvas-body text-light">
                    <a href="{{ route('programming.members') }}">
                        <button class="w-100 mt-3 mb-2 departmentBtn">
                            <i class="fas fa-users"></i>
                            <small>Manage Members</small></button>
                    </a>

                    {{-- <a href="">
                        <button class="w-100 departmentBtn mt-3 mb-2">
                            <i class="fas fa-users"></i>
                            <small>Announcement</small></button>
                    </a> --}}

                    <a href="{{ route('programming.create.event') }}">
                        <button class="w-100 departmentBtn mt-3 mb-2 ">
                            <i class="fa fa-microphone" aria-hidden="true"></i>
                            <small>Announcement</small></button>
                    </a>
                    <a href="{{ route('programming.post-resources') }}">
                        <button class="w-100 departmentBtn mt-3 mb-2 ">
                            <i class="fas fa-file-pdf"></i>
                            <small>Resource Repository</small>
                        </button>
                    </a>
                    <a href="{{ route('programming.financial.panel') }}">
                        <button class="w-100 departmentBtn mt-3 mb-2 ">
                            <i class="fas fa-dollar"></i>
                            <small>Financial Tracking</small>
                        </button>
                    </a>
                    <a href="{{ route('programming.messages') }}">
                        <button class="w-100 departmentBtn mt-3 mb-2 ">
                            <i class="fa fa-fax"></i>
                            <small>Feedback & Support</small>
                        </button>
                    </a>
                    <a href="{{ route('programming.resource.view') }}">
                        <button class="w-100 departmentBtn mt-3 mb-2">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <small>show resources</small>
                        </button>
                    </a> <br>

                    <a href="https://mwecauictclubforum.onrender.com?username={{ Auth::user()->registration_number }}&room={{ Auth::user()->category }}"
                        target="_blank">
                        <button class="w-100 departmentBtn mt-3 text-start">
                            <i class="fa fa-message" aria-hidden="true"></i>
                            <small>Chat Forum</small>
                        </button>
                    </a><br>

                    {{--    laravel default login script --}}
                    <a href="{{ route('logout') }}" class="text-decoration-none fw-bold text-warning "
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <small><button class="btn btn-brand btn-primary btn-sm mt-2"> <i class="fa fa-sign-out"
                                    aria-hidden="true"></i> Logout</button></small>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </div>
        </section>

        <main>
            @yield('content')
        </main>
        {{-- footer --}}
        <section class=" ">
            <div class="text-center py-5 mt-5 mb-0 sticky-lg-bottom">
                <a class="text-white text-decoration-none" href="https://mwecauictclub.ac.tz/">
                    <p class="text-center text-white"><i class="far fa-copyright text-white"></i> <?php echo date('Y'); ?>
                        Mwecauictclub
                    </p>
                </a>
                <a href="" class="text-decoration-none">
                    <p class="text-center text-white">
                        Designed and Developed By : E & S
                    </p>
                </a>
            </div>
        </section>
        <!-- footer end -->
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

    <script>
        const activeMembersBtn = document.querySelector('.activeMembersBtn')
        const inactiveMembersBtn = document.querySelector('.inactiveMembersBtn')

        const activeMembersTable = document.querySelector('.activeMembersTable')
        const inactiveMembersTable = document.querySelector('.inactiveMembersTable')

        // activeMembersTable.style.display = 'none'
        inactiveMembersTable.style.display = 'none'

        activeMembersBtn.addEventListener('click', () => {
            activeMembersTable.style.display = 'block'
            inactiveMembersTable.style.display = 'none'
        });

        inactiveMembersBtn.addEventListener('click', () => {
            activeMembersTable.style.display = 'none'
            inactiveMembersTable.style.display = 'block'
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('jquery/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('jquery/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('jquery/js/jquery.dataTables.min.js') }}"></script>
</body>

</html>
