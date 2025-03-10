<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

{{-- Select2 styles --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


</x-market-layout>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

