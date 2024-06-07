@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberSecurity | ICT Club</title>
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
        <div class="container-fluid" id="cyber">
            <div class="row text-center">
                <div class="departments">
                    <center>
                        <h4 class="text-warning display-4 mt-5 font-family-monospace">CYBERSECURITY</h4>
                    </center>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="">
                        <p align="justify" class="lh-lg fs-6">
                            <span class="text-primary fs-4">Cybersecurity.</span> is the practice of protecting digital
                            systems, networks, and devices from unauthorized access, theft, and damage. With the
                            increasing use of digital devices and online transactions, cybersecurity has become a
                            critical aspect of protecting personal and business information. In the ICT Club
                            Cybersecurity program, members will learn how to protect digital systems from cyber threats
                            and how to implement security measures to prevent cyber attacks.
                        </p>
                    </div>
                </div>
            </div>
            <div class="container">
                <center><button class="btn btn-brand btn-lg"><a class="text-warning nav-item nav-link"
                            href="#">Scroll Down <i class="fas fa-arrow-down fs-2 stricky-top"></i></a></button>
                </center>
            </div>
        </div>
    </section>
    @include('partials.footer')
    <!--Bootstrap CDN link-->
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>
