<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AgriPrice</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Covered+By+Your+Grace&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/welcome.css') }}">
    <style>
        html {
            scroll-behavior: smooth;
        }

    </style>

</head>
<body class="font-sans antialiased">

    @php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
    @endphp

    {{-- Navigation menu --}}
        @include('pages.home.navigation-menu')
    {{-- Hero section --}}
    <div id="header-section">
        @include('pages.home.header.hero')
    </div>
    {{-- Services-menu --}}
    <div id="services-section">
        @include('pages.home.services_category.services')
    </div>
    {{-- Calculations --}}
        @include('pages.home.homeBody.calculations')
    {{-- About section --}}
    <div id="about-section">
        @include('pages.home.about.aboutSection')
    </div>

    <hr style="margin: 0;">
    {{-- footerSection section --}}
    <div id="footer-section">
        @include('pages.home.footer.footerSection')
    </div>
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee"></circle>
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00"></circle>
        </svg>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&amp;sensor=false">
    </script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

    <script src="{{ asset('js/nav-link.js') }}"></script>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

<!-- Get count of vegetables, fruits, economic centers, crop advices -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let numbers = document.querySelectorAll(".number");
        numbers.forEach(num => {
            let target = +num.getAttribute("data-number");
            let count = 0;
            let speed = target / 5;
            let interval = setInterval(() => {
                count += Math.ceil(speed);
                if (count >= target) {
                    count = target;
                    clearInterval(interval);
                }
                num.innerText = count;
            }, 1);
        });
    });
    </script>

    <script defer=""
        src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        data-cf-beacon="{"
        rayid":"8efc9380fe84671b","servertiming":{"name":{"cfextpri":true,"cfl4":true,"cfspeedbrain":true,"cfcachestatus":true}},"version":"2024.10.5","token":"cd0b4b3a733644fc843ef0b185f98241"}"=""
        crossorigin="anonymous"></script>

</body>

</html>
