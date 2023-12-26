<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Networking | ICT Club</title>
    <!-- for title img -->
    <link rel="shortcut icon" type="image/icon" href="../img/logo.jpg" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>

<body class="text-light text-capitalize">
    <!--navbar-->
    @include('partials.navbar')
    <section>
        <div class="container-fluid" id="networking">
            <div class="row text-center">
                <div class="departments">
                    <center>
                        <h4 class="text-warning display-4 mt-5 font-family-monospace">COMPUTER NETWORKING</h4>
                    </center>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="">
                        <p align="justify" class="lh-lg fs-6">
                            <span class="text-primary fs-4">Networking.</span> is the practice of connecting devices
                            together to form a communication network. It is an essential aspect of the modern digital
                            world and has become a crucial component in both personal and business settings. The ICT
                            Club Networking program provides members with the knowledge and skills necessary to design,
                            implement and manage computer networks.
                        </p>
                    </div>
                </div>
            </div>
            <div class="container col-lg-10 col-sm-12 col-md-12">
                <center><button class="btn btn-brand btn-lg"><a class="text-warning nav-item nav-link"
                            href="#">Scroll Down <i class="fas fa-arrow-down fs-2 stricky-top"></i></a></button>
                </center>
            </div>
        </div>
    </section>
    @include('partials.footer')
    <!--Bootstrap CDN link-->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
