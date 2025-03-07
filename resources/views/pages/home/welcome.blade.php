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

</head>

<style>
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }
</style>

<body class="font-sans antialiased">

    {{-- Page 1st bar --}}
    @include('pages.home.header.firstBar')

    {{-- Page 2nd bar --}}
    @include('pages.home.header.secondBar')

    <!-- Navbar -->
    @include('pages.home.navbar')

    <!-- hero section -->
    @include('pages.home.header.hero')

    <!-- hero section -->
    @include('pages.home.homeBody.services')

    <!-- adout section -->
    @include('pages.home.about.dashboard')
    
    <!-- calculations section -->
    @include('pages.home.homeBody.calculations')

    <!-- Recent Work section -->
    @include('pages.home.homeBody.recentWork')

    <!-- Video Slide section -->
    @include('pages.home.homeBody.videoSlide')

    <!-- Testimonial section -->
    @include('pages.home.homeBody.testimonial')
   

    <hr style="margin: 0;">

   <!-- Contact section -->
   @include('pages.home.contact.dashboard')

   <!-- blogs section -->
   @include('pages.home.blogs.dashboard')

   <!-- newsletter section -->
   @include('pages.home.homeBody.newsletter')

   <!-- footerSection section -->
   @include('pages.home.footer.footerSection')



   

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

    <script defer=""
        src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        data-cf-beacon="{"
        rayid":"8efc9380fe84671b","servertiming":{"name":{"cfextpri":true,"cfl4":true,"cfspeedbrain":true,"cfcachestatus":true}},"version":"2024.10.5","token":"cd0b4b3a733644fc843ef0b185f98241"}"=""
        crossorigin="anonymous"></script>

</body>

</html>
