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
            color: #1b0922;
        }

        .col-12.col-md-10 .img-fluid {
            border: 3px solid #19c357;
        }

        .col-12.col-md-10.col-lg-6 .card {
            border: 2px solid #19c357;
            border-radius: 4px;
        }

        .col-12.col-md-12.col-lg-6 h5 {
            border-bottom: 2px solid #1b0922;
        }
    </style>
</head>

<body>
    @if ($user->payment_status == 1)
        @include('users.usernav');
        <section class="mt-4 p-4 p-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-6">
                        <div class="card shadow-lg">
                            <div class="details bg-info">
                                <h6 class="mx-3 mt-3 fw-bold text-center"
                                    style="font-family: 'Times New Roman', Times, serif;">Mwecau ICT Club</h6>
                            </div>
                            <div class="card-tittle text-center">
                                <h6 class="mx-3 fs-6 fw-bold" style="font-family: 'Times New Roman', Times, serif;">Club
                                    Memmbership Card</h6>
                            </div>
                            <div class="card-body d-flex">
                                <div class="">
                                    <p><strong>RegNo:</strong>{{ $user->registration_number }} </p>
                                    <p><strong>Full Name: </strong>{{ $user->fullname }}</p>
                                    <p><strong>Course:</strong> {{ $user->course }}</p>
                                    <p><strong>Category:</strong>{{ $user->category }}</p>
                                </div>
                                <div class="mx-auto">
                                    <img src="../img/logo.jpg" class="img-fluid rounded-circle mt-auto"
                                        alt="Profile Picture" style="width: 130px; height:130px">
                                </div>
                            </div>
                            <div class="bg-info w-100"><strong>Date Issued:</strong> <?php echo date('m:d:Y'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        @include('users.accessDenied');
    @endif



    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
