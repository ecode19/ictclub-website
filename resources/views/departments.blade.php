@extends('layouts.web')
@section('content')
    <section id="serve">
        <div class="container-fluid">
            <div class="row">
                <div class="team-slider3">
                    <div class="departents">
                        <center>
                            <h4 class="display-1 fw-bold py-5 mt-5 fw-bold" data-aos="zoom-in" data-aos-duration="3000"
                                style="color: #50f18b;">
                                Get Benefited</h4>
                        </center>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <h2 class="text-center display-3 colorIcon">Club Departmets</h2>
            <h3 class="text-dark display-5 mx-5">Programming</h3>
            <div class="row g-0">
                <div class="col-lg-6 col-md-10 col-sm-12 p-4" data-aos="fade-down-left" data-aos-duration="1000">
                    <img src="../img/pro.jpg" class="rounded d-block shadow w-100">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 p-4 shadow-lg">
                    <p align="justify" class="lh-lg" style="letter-spacing: 1px;">
                        <span class="text-primary">The ICT club programming class</span> Is a learning program that
                        focuses on
                        teaching students how to write code and develop computer programs using various programming
                        languages and
                        tools. The class is designed to introduce students to the basics of programming, including
                        programming
                        concepts, data types, control structures, and algorithms. Students will also learn how to use
                        different
                        programming environments and tools, such as Integrated Development Environments (IDEs),
                        compilers, and
                        debuggers.
                        <a href="{{ route('programming') }}" class="text-decoration-none text-primary">More</a>
                    </p>
                </div>
                <h3 class="text-dark display-5 text-center mx-5">Graphics Designing</h3>

                <div class="col-lg-6 col-md-12 col-sm-12 p-4 shadow-lg">
                    <p align="justify" class="lh-lg mt-5" style="letter-spacing: 1px;">
                        <span class="text-primary">The ICT club graphics designing class</span> Is a learning program
                        that focuses
                        on teaching students how to create visual designs using various digital tools and techniques.
                        The class is
                        designed to introduce students to the principles of graphic design, including color theory,
                        typography,
                        layout, and composition.

                        Throughout the course, students will learn how to use graphic design software such as Adobe
                        Photoshop,
                        Illustrator, or InDesign to create digital designs for various purposes, such as advertising,
                        branding, or
                        social media content. They will also learn how to use digital tools and techniques to
                        <a href="{{ route('graphics.department') }}" class="text-decoration-none text-primary">More</a>
                    </p>
                </div>
                <div class="col-lg-6 col-md-10 col-sm-12 p-4" data-aos="zoom-in">
                    <img src="../img/zyro-image (1).png" class="img-fluid rounded mx-auto d-block shadow d-none d-sm-block">
                </div>
                <h3 class="text-dark display-5 align-items-right">Networking</h3>

                <div class="col-lg-6 col-md-10 col-sm-12 p-4" data-aos="zoom-in-right">
                    <img src="../img/net.jpg" class="img-fluid rounded mx-auto d-block shadow-lg">
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12 p-4 shadow-lg">
                    <p align="justify" class="lh-lg" style="letter-spacing: 1px;">
                        Networking is the practice of connecting devices together to form a communication network. It is
                        an
                        essential aspect of the modern digital world and has become a crucial component in both personal
                        and
                        business settings. The ICT Club Networking program provides members with the knowledge and
                        skills necessary
                        to design, implement and manage computer networks.
                        <a href="{{ route('networking.department') }}" class="text-decoration-none text-primary">More</a>
                    </p>
                </div>
                <h3 class="text-dark display-5 text-center d-block">Web Development</h3>
                <div class="col-lg-6 col-md-12 col-sm-12 p-4 shadow-lg">
                    <p align="justify" class="mt-5 lh-lg" style="letter-spacing: 1px;">
                        Web development is the process of creating websites using programming languages such as HTML,
                        CSS, and
                        JavaScript. It is an essential skill for creating dynamic and interactive websites that are both
                        user-friendly and visually appealing. In the ICT Club Web Development program, members will
                        learn how to
                        create and manage websites, including website design, development, and optimization.
                        <a href="" class="text-decoration-none text-primary">More</a>
                    </p>
                </div>
                <div class="col-lg-6 col-md-10 text-sm-center col-sm-12 p-4" data-aos="flip-up" data-aos-duration="1000">
                    <img src="../img/pro.jpg" class="img-fluid rounded mx-auto d-block shadow-lg">
                    <span class="text-primary mt-3 text-center d-block">HTML,CSS,Bootstrap and JavaScript</span>
                </div>
                <h3 class="text-dark display-5 mx-5">Computer Maintenance</h3>
                <div class="col-lg-6 col-md-10 col-sm-12 p-4" data-aos="zoom-out-left">
                    <img src="../img/maintenance.jpg" class="rounded d-block shadow-lg w-100 h-100">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 p-4 shadow-lg">
                    <p align="justify" style="letter-spacing: 1px; line-height: 30px;">
                        <span class="text-primary">Computer maintenance</span> involves the regular upkeep of computer
                        systems to
                        ensure they are running efficiently and effectively. It includes tasks such as updating
                        software, cleaning
                        hardware components, and performing regular backups of important data. In the ICT Club Computer
                        Maintenance
                        program, members will...
                        <!--learn how to diagnose and troubleshoot computer problems, perform hardware and software upgrades, and maintain the health and performance of computer systems. The program will also cover topics such as virus and malware protection, data recovery, and system optimization to ensure that members have the knowledge and skills necessary to keep their computers running smoothly.-->
                        <a href="" class="text-decoration-none text-primary">More</a>
                    </p>
                </div>
                <h3 class="text-dark display-5 text-center mx-5">Cyber Security</h3>
                <div class="col-lg-6 col-md-12 col-sm-12 p-4 shadow-lg">
                    <p align="justify" class="lh-lg" style="letter-spacing: 1px;">
                        Cybersecurity is the practice of protecting digital systems, networks, and devices from
                        unauthorized access,
                        theft, and damage. With the increasing use of digital devices and online transactions,
                        cybersecurity has
                        become a critical aspect of protecting personal and business information. In the ICT Club
                        Cybersecurity
                        program, members will learn how to...
                        <!--protect digital systems from cyber threats and how to implement security measures to prevent cyber attacks-->
                        <a href="" class="text-decoration-none text-primary">More</a>
                    </p>
                </div>
                <div class="col-lg-6 col-md-10 col-sm-12 p-4" data-aos="zoom-out-right">
                    <img src="../img/security.jpg" class="rounded mx-auto d-block w-100 h-100 shadow-lg">
                </div>
            </div>
        </div>
    @endsection
