<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

{{-- Select2 styles --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .detail {
        font-family: Arial, sans-serif;
        color: #ffffff;
        margin: 10px 100px 0px 100px;
        margin-top: 3%
    }

    .contact {
        text-align: center;
        background-color: #02554d;
        padding-top: 50px;
    }

    .contact-title {
        font-size: 2.6em;
        margin-bottom: 3%;
    }

    h3 {
        font-size: 1.3em;
    }

    .contact-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .contact-item {
        padding: 20px;
        width: 300px;
        margin: 10px;
    }

    .contact-item h2 {
        font-size: 1.8em;
        font-weight: 600;
        margin: 10px 0;
    }

    .contact-item p {
        padding-bottom: 3px;
    }

    .contact-item h3 {
        font-size: 1.2em;
    }

    .icon {
        font-size: 2em;
        margin-bottom: 10px;
    }
</style>

<x-market-layout>

    {{-- Page title --}}
    <x-slot name="title">Admin Contact</x-slot>



    {{-- page header part --}}
    <x-slot name="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Logo or Brand Name -->
                <div class="brand">
                    <h3 class="mb-0">Market Dashboard</h3>
                </div>

                <!-- User and Economic Center Info -->
                <div class="user-info text-end">
                    @if ($user)
                        <p class="mb-0">Welcome, <strong>{{ $user->name }}</strong></p>
                        @if ($economicCenter)
                            <p class="mb-0">Economic Center: <strong>{{ $economicCenter->center_name }}</strong></p>
                        @else
                            <p class="mb-0 text-warning">No economic center assigned.</p>
                        @endif
                    @else
                        <p class="mb-0 text-danger">User not authenticated.</p>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <div class="detail">
        <section class="contact">
            <h1 class="contact-title">Contact Us</h1>
            <div class="contact-container">
                <div class="contact-item address">
                    <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                    <h2>ADDRESS</h2>
                    <h3>Colombo Division Office</h3>
                    <p>16 Keerthi Ln Off Maliban Street,<br>11 Colombo</p>
                </div>
                <div class="contact-item phone">
                    <div class="icon"><i class="fas fa-phone"></i></div>
                    <h2>PHONE</h2>
                    <h3>Service Department</h3>
                    <p>011 559 8599<br>(Then press 2 for emergency calls)</p>
                    <h3>Colombo Division Office</h3>
                    <p>011 459 8452<br>011 459 8463</p>
                    <h3>Request for Proposal</h3>
                    <p>011 559 659</p>
                </div>
                <div class="contact-item phone">
                    <div class="icon"><i class="fab fa-whatsapp"></i></div>
                    <h2>Whatsapp</h2>
                    <h3>Service Department</h3>
                    <p>075 555 1222<br>(Then press 2 for emergency calls)</p>
                    <h3>Colombo Division Office</h3>
                    <p>075 455 2233<br>075 455 2244</p>
                    <h3>Request for Proposal</h3>
                    <p>075 444 2255</p>
                </div>
                <div class="contact-item email">
                    <div class="icon"><i class="fas fa-envelope"></i></div>
                    <h2>EMAIL</h2>
                    <p>
                    <h3>Request for Proposal</h3> infoagriprice@agriprice.com</p>
                    <p>
                    <h3>Request for Service</h3> serviceagriprice@agriprice.com</p>
                    <p>
                    <h3>Request for Opportunities</h3> careersagriprice@.com</p>
                </div>
            </div>
        </section>

    </div>


</x-market-layout>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
