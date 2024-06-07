$(document).ready(function() {
        $('#memberTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", function () {
        AOS.init();
    });

    $(document).ready(function(){
        $('.team-slider').slick({
            slidesToShow: 3, // Number of cards to show at once
            slidesToScroll: 1, // Number of cards to scroll at a time
            autoplay: true, // Autoplay the slider
            autoplaySpeed: 4000, // Autoplay speed in milliseconds
            speed: 2000,
            responsive: [
                {
                    breakpoint: 768, // Breakpoint for smaller screens
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576, // Breakpoint for even smaller screens
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

    $(document).ready(function(){
        $('.team-slider3').slick({
            slidesToShow: 1, // Number of cards to show at once
            slidesToScroll: 1, // Number of cards to scroll at a time
            autoplay: true, // Autoplay the slider
            autoplaySpeed: 4000, // Autoplay speed in milliseconds
            speed: 5000,
            responsive: [
                {
                    breakpoint: 768, // Breakpoint for smaller screens
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576, // Breakpoint for even smaller screens
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

    $(document).ready(function(){
        $('.team-slider2').slick({
            slidesToShow: 3, // Number of cards to show at once
            slidesToScroll: 3, // Number of cards to scroll at a time
            autoplay: true, // Autoplay the slider
            autoplaySpeed: 5000, // Autoplay speed in milliseconds
            speed:3000, // Transition speed in milliseconds
            responsive: [
                {
                    breakpoint: 768, // Breakpoint for smaller screens
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576, // Breakpoint for even smaller screens
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

    $(document).ready(function(){
        $('.team-sliderAbout').slick({
            slidesToShow: 4, // Number of cards to show at once
            slidesToScroll: 3, // Number of cards to scroll at a time
            autoplay: true, // Autoplay the slider
            autoplaySpeed: 5000, // Autoplay speed in milliseconds
            speed:3000, // Transition speed in milliseconds
            responsive: [
                {
                    breakpoint: 768, // Breakpoint for smaller screens
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576, // Breakpoint for even smaller screens
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

