@extends('layouts.web')

@section('content')
    {{-- curvy landing page --}}
    <section class="">
        <div class="text-center wrapper align-content-center"
            style="position: relative; background: linear-gradient(to top, #033392, #4a649b); min-height: 100vh;">
            <section>
                <div class="academis1 text-center" data-aos="fade-right" data-aos-duration="2000">
                    <div class="academicsText1 justify-items-around align-content-center">
                        <h2 class="fst-italic text-white fw-bold display-1">An outstanding tech Club in Tanzania
                            universities. </h2>
                        <p class="fs-5 d-none ">
                            Studying at Mwenge catholic University is a great way to enhance your career.
                            In today’s competitive environment, professionals need the skills to adapt
                            to an ever-changing world.
                        </p>

                        <div class="">
                            <a href="{{ route('register') }}"><button class="btn btn-warning" data-aos="fade-up"
                                    data-aos-duration="1000">Join Our Community
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </section>


            <div class="custom-shape-divider-bottom-1713515880">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none">
                    <path
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                        class="shape-fill"></path>
                </svg>
            </div>
        </div>
    </section>

    {{-- about section --}}
    <section>
        <div class="container">
            <div class="text-dark justify-content-center">
                <div class="col-12 col-lg-12 text-cener">
                    <h2 class="hover-text d-none  display-4">ABOUT</h2>
                    {{-- <hr class="bg-primary w-25 mx-auto"> --}}
                    <h2 class="text-dark">Welcome to the Mwenge Catholic University ICT Club!</h2>
                    <p class="" style="letter-spacing: 1px; font-size: 20; line-height: 30px;">
                        Welcome To Our ICT Club! We Are A Community Of Technology Enthusiasts Dedicated To Learning,
                        Innovating, And
                        Collaborating In The Field Of ICT. Our Goal Is To Provide Students With Opportunities To Explore And
                        Develop
                        Their Skills In Areas Such As Programming, Graphic Design, Web Development, Networking, Computer
                        Maintenance, And Cybersecurity. Join Us Today And Discover Your Passion For Technology!
                    </p>
                </div>
            </div>
        </div>
        <i class="far fa-circle text-primary mx-5 d-none my-2 fa-4x"></i>
    </section>

    <!--DEPARTMENTS-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-2 col-lg-2">
                    <h2 class="custom-border-left fw-bold colorIcon">OUR DEPARTMENTS</h2>
                </div>
                <div class="col-12 col-md-12 col-lg-8 mx-auto">
                    <div class="row g-0">
                        <div class="col-12 col-md-6 col-lg-6 code card-with-border shadow-lg">
                            <div class="image-container">
                                <img class="w-100" src="./img/mar.jpg" alt="">
                                <div class="overlay">
                                    <div class="text-center text-warning fw-bold colorIcon">
                                        <h1 class="text-warning">PROGRAMMING</h1>
                                        <small class="fs-6 mt-4">
                                            The ICT club can develop scalable software systems and enhance collaboration
                                            among members.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="image-container">
                                <img class="w-100" src="./img/marv.jpg" alt="">
                                <div class="overlay">
                                    <div class="text-center text-warning fw-bold colorIcon">
                                        <h1 class="text-warning">CYBER & NETWORKING</h1>
                                        <small class="fs-6 mt-4 text-white ">
                                            Cyber and Networking: Explore the interconnected world of information security
                                            and network
                                            infrastructure.
                                        </small>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="image-container">
                                <img class="w-100" src="./img/graph.png" alt="">
                                <div class="overlay">
                                    <div class="text-center text-warning fw-bold colorIcon">
                                        <h1 class="text-warning">MAINTENANCE</h1>
                                        <small class="fs-6 mt-4 text-white">
                                            Explore the vital discipline of Maintenance, where skilled professionals keep
                                            technology running
                                            smoothly and efficiently
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md col-lg-6 card-with-border">
                            <div class="image-container">
                                <img class="w-100" src="./img/graph.png" alt="">
                                <div class="overlay">
                                    <div class="text-center text-warning fw-bold colorIcon">
                                        <h1 class="text-info">GRAPHICS DESIGNING</h1>
                                        <small class="fs-6 mt-4 text-white">
                                            Graphics Designing: Unleash your creativity in the world of visual
                                            communication, crafting
                                            captivating designs and bringing ideas to life.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="d-none">
        <div class="container">
            <div class="row">
                <h3 class="hover-text custom-border-left display-4 text-lg-start text-center text-dark">OUR DEPARTMENTS</h3>
                <div class="col-md">
                    <h3 class="text-dark text-center fs-4">Programming</h3>
                    <p align="justify" class="text-justify lh-lg">The ICT club programming class is a learning program that
                        focuses on teaching students how to write code and develop computer programs
                        using various programming languages and tools. The class may also cover topics
                        such as web development, game development, or data analysis, depending on the
                        focus of the curriculum. </p>
                </div>
                <div class="col-md">
                    <h3 class="text-dark text-center fs-4">Networking & Security</h3>
                    <p align="justify" class="text-justify lh-lg">It is an essential aspect of the modern digital world and
                        has
                        become a crucial component in both personal and business settings. The ICT Club
                        Networking program provides members with the knowledge and skills necessary to
                        design, implement and manage computer networks.</p>
                </div>
                <div class="col-md">
                    <h3 class="text-dark text-center fs-4">Graphic Designing</h3>
                    <p align="justify" class="text-justify lh-lg">The ICT club graphics designing class is a learning
                        program
                        that focuses on teaching students how to create and manipulate visual content
                        using various software tools. designing involves creating visual content using
                        software tools such as Adobe Photoshop, Illustrator, and CorelDRAW. </p>
                </div>
                <div class="col-md">
                    <h3 class="text-dark text-center fs-4">Computer Maintenance</h3>
                    <p align="justify" class="text-justify lh-lg">
                        The ICT club graphics designing class is a learning program
                        that focuses on teaching students how to create and manipulate visual content
                        using various software tools. designing involves creating visual content using
                        software tools such as Adobe Photoshop, Illustrator, and CorelDRAW. </p>
                </div>
            </div>
        </div>
    </section>

    <!--Projects starts-->
    <section class="">
        <div id="Services" class="container">
            <div class="row text-center g-1 mt-5">
                <h2 class="hove-text custom-border-left text-lg-start display-4 colorIcon">Ongoing projects</h2>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-bottom-border text-dark">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi b-laptop "><img class="w-100 rounded shadow-lg" src="img/pro.jpg"
                                        style="height: 150px"></i>
                            </div>
                            <h4 class="card-title mb-3 colorIcon">Web Development Project</h4>
                            <span class="d-none">(Educational Website)</span>
                            <p align="justify" style="line-height:1.7;">Web development projects: Members of the club
                                could work on
                                building websites for different purposes, such as e-commerce, personal blogs, or
                                informational sites.
                                <span class="text-primary"> Bootstrap Framework, HTML, JavaScript And PHP Laravel
                                    Framework</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-bottom-border text-dark">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi b-laptop "><img class="w-75 rounded" src="img/c.png" style="height:px"></i>
                            </div>
                            <h4 class="card-title mb-3 colorIcon">Robotics Project</h4>
                            <span class="d-none">(Programming)</span>
                            <p class="text-justify">Robotics projects: Members could work on building robots or creating
                                programs that
                                control robots</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-bottom-border text-dark">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi b-laptop "><img class="w-100 rounded" src="img/cybersec_640.jpg"></i>
                            </div>
                            <a href="./pages/form.html" class="text-decoration-none">
                                <h4 class="card-title mb-3 colorIcon">Home Appliance projects</h4>
                            </a>
                            <span class="text-danger d-none">Start in 1 week</span>
                            <p class="text-justify">Members could learn about cybersecurity and work on projects related to
                                protecting
                                computer systems from threats.</p>
                        </div>
                    </div>
                    <a class=" btn btn-sm mt-3 news-btn text-white " href="">More
                        Projects <i class="fas fa-angle-double-right fw-bold fs-5 fa-fw"></i></a>
                </div>
            </div>
        </div>
    </section> <br>
    <!--End Projects-->

    <!--membership-->
    <section class="d-flex justify-content-center align-items-center shadow-lg" id="membership">
        <div class="container">
            <div class="row">
                <div class="col-md text-light fs-1">
                    <div class="mb-4">
                        <h2 class="mb-3 d-none" data-aos="fade-up" data-aos-duration="1000">Membership categories</h2>
                        <ul class="list-unstyled d-none" data-aos="zoom-in-down" data-aos-duration="1000">
                            <li class="list-items"><i class="fas fa-angle-right text-primary"></i> Honorary membership
                            </li>
                            <i class="fas fa-angle-right text-warning fw-bold d-none"></i> <small class="d-none">held by
                                students who
                                are pursuing Computer science and ICT as a Program.</small>
                            <li class="list-items"><i class="fas fa-angle-right text-primary"></i> Associate members</li>
                            </i> <small class="d-none">held by person (s) or Institution (s)</small>
                            <li class="list-items"><i class="fas fa-angle-right text-primary"></i> Expert members</li>
                            <i class="fas fa-angle-right text-warning d-none"></i> <small class="d-none">held by a
                                graduate student of
                                computer science at Mwenge Catholic University</small>
                        </ul>
                        <p align="#">
                        <h2 class="text-warning fw-bold fst-italic text-wrap display-3 mx-5" style="width: 20rem;"
                            data-aos="zoom-in" data-aos-duration="2000">OUR MEMBERSHIP CATEGORIES </h2><br>
                        </p>
                    </div>
                </div>
                <div class="col-md text-light fs-1">
                    <div class="mb-5">
                        <ul class="list-unstyled" data-aos="fade-up" data-aos-duration="2000">
                            <li class="list-items"><i class="fas fa-angle-right colorIcon"></i> Honorary membership</li>
                            <i class="fas fa-angle-right fw-bold d-none  text-warning"></i> <small class="d-none">held by
                                students who
                                are pursuing Computer science and ICT as a Program.</small>
                            <li class="list-items"><i class="fas fa-angle-right colorIcon"></i> Associate members</li>
                            </i> <small class="d-none">held by person (s) or Institution (s)</small>
                            <li class="list-items"><i class="fas fa-angle-right colorIcon"></i> Expert members</li>
                            <i class="fas fa-angle-right text-warning d-none"></i> <small class="d-none">held by a
                                graduate student of
                                computer science at Mwenge Catholic University</small>
                        </ul>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('register') }}"><button class="btn btn-warning fs-5" data-aos="fade-left"
                            data-aos-duration="2000">Join Our Community
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!--news and map section-->
    <div class="container-fluid">
        <div class="row g-5">
            <div class="col-12 col-md-12 col-lg-8 py-5">
                <!-- Main Content -->
                <div class="video-container">
                    <iframe class="video-border" src="https://www.youtube.com/embed/Dm-5LJc03rM"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-md-12 col-lg-4  mt-0">
                <!-- News and Feeds Section -->
                <div class="card">
                    <h2 class="text-center fs-2 colorIcon">News and Feeds</h2>
                    {{-- <div class="card-header fw-bold  colorIcon fs-5">
                        News and Feeds
                    </div> --}}
                    <div id="card-container" class="card-body border-news"
                        style="max-height: 400px; overflow-y: scroll;">
                        @if ($news->count() > 0)
                            @foreach ($news as $news)
                                <div class="news-card card">
                                    <!-- Card content here -->
                                    <h5 class="card-title text-uppercase ">{{ $news->event_name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $news->event_date }}</h6>
                                    <p class="card-text">{{ $news->event_description }}</p>
                                    <div class="card-footer">
                                        <a href="{{ route('about.page'), $news->id }}" target="_blank"
                                            class="btn btn-warning">Read
                                            More</a>
                                    </div>
                                </div> <br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--team-->
    <section>
        <div class="container">
            <h2 class="text-center colorIcon">MEET THE TEAM</h2>
            <div class="row">
                <div class="team-slider">
                    <div class="col-md-4">
                        <div class="team-card text-center">
                            <div class="team-member-img mb-4 "><img src="./img/ecode.png"
                                    class=" shadow-lg img-fluid rounded-circle mx-auto" alt="Developer"></div>
                            <div class="fw-bold">Erick Manyasi</div>
                            <div class="text-info fst-italic  mb-3">UI/UX Designer</div>
                            <p class="">Passionate about creating intuitive user experiences that
                                inspire.</p>

                            <button class="btn btn-outline-warning mb-4">Contact</button>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-facebook fs-4"></i></a>
                                <a href="#"><i class="fab fa-twitter fs-4"></i></a>
                                <a href="#"><i class="fab fa-linkedin fs-4"></i></a>
                                <a href="#"><i class="fab fa-instagram fs-4"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="team-card text-center">
                            <div class="team-member-img"><img src="./img/suleiman.jpg"
                                    class=" shadow-lg img-fluid rounded-circle mx-auto" alt="Developer"></div>
                            <div class="fw-bold">Suleiman Ramadhan</div>
                            <div class="text-info fst-italic mb-3">HOD Programming</div>
                            <p class="">Passionate about crafting elegant solutions and pushing the boundaries of
                                technology to create seamless user experiences.</p>


                            <button class="btn btn-outline-warning mb-4">Contact</button>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-facebook fs-4"></i></a>
                                <a href="#"><i class="fab fa-twitter fs-4"></i></a>
                                <a href="#"><i class="fab fa-linkedin fs-4"></i></a>
                                <a href="#"><i class="fab fa-instagram fs-4"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="team-card text-center">
                            <div class="team-member-img"><img src="./img/mwecau.png"
                                    class=" shadow-lg img-fluid rounded-circle mx-auto" alt="Developer"></div>
                            <div class="fw-bold">Erick Manyasi</div>
                            <div class="text-info fst-italic mb-3">UI/UX Designer</div>
                            <p class="">Passionate about creating intuitive user experiences that
                                inspire.</p>

                            <button class="btn btn-outline-warning mb-4">Contact</button>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-facebook fs-4"></i></a>
                                <a href="#"><i class="fab fa-twitter fs-4"></i></a>
                                <a href="#"><i class="fab fa-linkedin fs-4"></i></a>
                                <a href="#"><i class="fab fa-instagram fs-4"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="team-card text-center">
                            <div class="team-member-img"><img src="./img/mwecau.png"
                                    class=" shadow-lg img-fluid rounded-circle mx-auto" alt="Developer"></div>
                            <div class="fw-bold">Erick Manyasi</div>
                            <div class="text-info fst-italic mb-3">UI/UX Designer</div>
                            <p class="">Passionate about creating intuitive user experiences that
                                inspire.</p>

                            <button class="btn btn-outline-warning mb-4">Contact</button>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-facebook fs-4"></i></a>
                                <a href="#"><i class="fab fa-twitter fs-4"></i></a>
                                <a href="#"><i class="fab fa-linkedin fs-4"></i></a>
                                <a href="#"><i class="fab fa-instagram fs-4"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <br>

    <!--Event Start-->
    <section class="mt-md-5 mt-lg-2 mb-4 align-items-center">
        <div class="container">
            <div class="row g-2">
                <h4 class="display-4 text-lg-start colorIcon">Our partners</h4>
                <div class="team-slider2">

                    <div class="col-lg-3 col-md-3 col-3 d-flex justify-content-center" data-aos="flip-up"
                        data-aos-duration="1000">
                        <img src="img/mwecau.png" alt="SVG image" class="svg img-fluid" style="width: 150px;">
                    </div>
                    <div class="col-lg-3 col-md-3 col-3 d-flex justify-content-center" data-aos="flip-up"
                        data-aos-duration="1000">
                        <img src="img/misitu2.png" alt="SVG image" class="img-fluid rounded-circle"
                            style="width: 150px;">
                    </div>
                    <div class="col-lg-3 col-md-3 col-3 d-flex justify-content-center" data-aos="flip-up"
                        data-aos-duration="1000">
                        <img src="img/univer.jpg" alt="SVG image" class="img-fluid rounded" style="width: 150px;">
                    </div>
                    <div class="col-lg-3 col-md-3 col-3 d-flex justify-content-center" data-aos="flip-up"
                        data-aos-duration="1000">
                        <img src="img/ternet.png" alt="SVG image" class="img-fluid" style="width: 150px;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Events-->

    <div class="container">
        <h2 class="text-center mb-4"></h2>
        <div class="row">

            <!-- Repeat the above card structure for other team members -->
        </div>
    </div>
@endsection
