<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphics Designing | ICT Club</title>
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
        <div class="container-fluid" id="graphics">
            <div class="row text-center">
                <div class="departments">
                    <center>
                        <h4 class="text-light display-4 mt-5 font-family-monospace">GRAPHICS DESIGNING</h4>
                    </center>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="">
                        <p align="justify" class="lh-lg fs-6">
                            <span class="text-primary fs-4">Graphics designing class.</span> Is a learning program that
                            focuses on teaching students how to create visual designs using various digital tools and
                            techniques. The class is designed to introduce students to the principles of graphic design,
                            including color theory, typography, layout, and composition.

                            Throughout the course, students will learn how to use graphic design software such as Adobe
                            Photoshop, Illustrator, or InDesign to create digital designs for various purposes, such as
                            advertising, branding, or social media content. They will also learn how to use digital
                            tools and techniques to...
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
