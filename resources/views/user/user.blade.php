<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Dashboard</title>
    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="img/mwecau.png" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .color {
            background-color: #2C3592;
        }

        .favcolor {
            color: #2C3592;
        }

        .userbtn {
            background-color: #2C3592;
        }

        .col-12.col-md-10 .img-fluid {
            border: 3px solid #19c357;
        }

        .col-12.col-md-10.col-lg-6 .card {
            border: 2px solid #2C3592;
            border-radius: 4px;
        }

        .col-12.col-md-12.col-lg-6 h5 {
            border-bottom: 2px solid #1b0922;
        }
    </style>
</head>

<body>
    @if ($user->payment_status == 1)
        @include('users/usernav')
        <div class="container mt-5">
            <div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div>
                @if (session()->has('fail'))
                    <span class="alert alert-danger p-3 mt-5">
                        {{ session('fail') }}
                    </span>
                @endif
            </div>
        </div>
        <section class="mt-4 p-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-6">
                        <div class="card shadow-lg">
                            <div class="details text-light color">
                                <h6 class="mx-3 mt-3 fs-6 fw-bold">Club Member</h6>
                            </div>
                            <div class="card-tittle text-center">
                                <h6 class="mx-3 text-decoration-underline fs-6 fw-bold">Informations</h6>
                            </div>
                            <div class="card-body d-flex">
                                <img src="../img/logo.jpg" class="img-fluid rounded-circle mt-auto"
                                    alt="Profile Picture" style="width: 130px; height:130px">
                                <div class="mx-auto">
                                    <p><strong>RegNo:</strong> {{ $user->registration_number }}</p>
                                    <p><strong>Full Name: </strong> {{ $user->fullname }}</p>
                                    <p><strong>Course:</strong> {{ $user->course }}</p>
                                    <p><strong>Category: </strong> {{ $user->category }}</p>
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn color fs-5"><a
                                    href="{{ url('event', $user->id) }}" class="text-white text-decoration-none">Update
                                    Profile</a></button>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 mt-5">
                        <h4 class="text-dark fw-bold">Welcome, <span class="colorIcon fw-bold text-uppercase">
                                {{ $user->fullname }}</span>
                            <small class="favcolor"></small> to your
                            ICT Club Member Dashboard
                        </h4>

                        <p>Here you can access various features and functionalities related to your membership.</p>
                        <p>Feel free to explore and engage with the club activities!
                            @if ($user->payment_status == 1)
                                <div> <strong>Payment Status: </strong> <span class="colorIcon fw-bold fs-4">
                                        paid
                                    </span>
                                </div>
                            @endif
                        </p>
                        <!-- Display posts to users -->
                        <div class="posts">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <h5 class="colorIcon">Fellow <span class="fw-bold"> {{ $user->category }}</span> Member's
                </h5>
                <table class="table table-dark table-hover table-responsive table-bordered table-striped">
                    <thead>
                        <tr class=" fw-bold">
                            <td>S/N</td>
                            <td>REGISTRATION NUMBER</td>
                            <td>COURSE</td>
                        </tr>
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->registration_number }}</td>
                            <td class="text-uppercase">{{ $user->fullname }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
    @else
        @include('users.accessDenied');
    @endif
    <div class="container">
        <footer>
            <p>&copy; <?php echo date('Y'); ?> ICT Club. All rights reserved.</p>
        </footer>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
