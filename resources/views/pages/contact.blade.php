<!DOCTYPE html>
<html>

<head>
    <title>Contact Us | ICT Club</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <!--SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <style>
        .contact-form {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 30px;
            margin-top: 50px;
        }

        .contact-info {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 30px;
            margin-top: 50px;
            height: 80%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .contact-info h2 {
            margin-bottom: 30px;
        }

        .contact-info p {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .contact-info p i {
            margin-right: 10px;
        }

        #chatIcon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: darkcyan;
            color: #fff;
            text-align: center;
            cursor: pointer;
        }

        #chatIcon i {
            font-size: 24px;
            line-height: 50px;
        }

        #contactp {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 50px 0;
        }

        .footer h4 {
            margin-bottom: 30px;
        }

        .footer ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 30px;
        }

        .footer ul li a {
            color: #fff;
        }
    </style>
</head>

<body>
    <!--navbar-->
    @include('partials.navbar')
    <div class="container">
        <div class="row g-0" id="contact">
            <div class="col-md-6">
                <div class="contact-form bottom-border">

                    <h2 class="bottom-border
                    colorIcon">Contact Us</h2>
                    <form method="POST" action="{{ route('contactStore') }}" autocomplete="off">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your name"
                                value="{{ old('name') }}">
                            <div class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email"
                                value="{{ old('email') }}">
                            <div class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" name="message" rows="5">{{ old('message') }}</textarea>
                            <div class="text-danger">
                                @error('message')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-3 text-md-center">Submit</button>
                        <a href="{{ route('news') }}" class="text-primary text-decoration-none">View Messages</a>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-info bottom-border">
                    <h2 class="bottom-border colorIcon">M-ICT Club Address</h2>
                    <p><i class="fas fa-map-marker-alt colorIcon"></i>P.O. Box 1226, Moshi, Kilimanjaro</p>
                    <p><i class="fa fa-phone colorIcon"></i>Tel: +255-27-2974 110<span></p>
                    <p><i class="fa fa-envelope colorIcon"></i>example@mail.com</p>
                    <p><i class="fa fa-fax colorIcon"></i>Fax: +255-27-2974108</p>
                    <p><i class="fa fa-headset colorIcon"></i>Customer Support</p>
                </div>
            </div>
        </div>
    </div><br>

    <!--INCLUDING FOOTER FILE-->
    @include('partials.footer')

    <section id="chat">
        <!-- Chat Icon -->
        <div id="chatIcon">
            <i class="fas fa-comments"></i>
        </div>
    </section>
    <div id="chatIcon">
        <i class="fa fa-comments"></i>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('') }}"></script>


    <div class="card">
        @if (Session()->has('message'))
            <script>
                Swal.fire('Message', '{{ Session::get('message') }}', 'warning', {
                    button: "Ok",
                });
            </script>
        @endif
    </div>
</body>

</html>









<script>
    document.getElementById("chatIcon").addEventListener("click", function() {
        window.open("https://your-chat-page.com", "chatWindow", "width=400,height=600");
    });

    window.onload = function() {
        document.getElementById("contactPage").style.opacity = 1;
    };
    $('.navbar-toggler').click(function() {
        $('.navbar-collapse').toggleClass('collapsing');
    });
</script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
