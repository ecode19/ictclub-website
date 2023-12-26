<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programming | ICT Club</title>
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
        <div class="container-fluid" id="programming">
            <div class="row text-center">
                <div class="departments">
                    <center>
                        <h4 class="text-light display-4 mt-5 font-family-monospace">COMPUTER PROGRAMMING</h4>
                    </center>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="">
                        <p align="justify" class="lh-lg fs-6">
                            <span class="text-primary fs-4">Programming class.</span> Is a learning program that focuses
                            on teaching students how to write code and develop computer programs using various
                            programming languages and tools. The class is designed to introduce students to the basics
                            of programming, including programming concepts, data types, control structures, and
                            algorithms. Students will also learn how to use different programming environments and
                            tools, such as Integrated Development Environments (IDEs), compilers, and debuggers.
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
