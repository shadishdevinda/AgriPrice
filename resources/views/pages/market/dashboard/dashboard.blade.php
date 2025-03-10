<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

{{-- Select2 styles --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom Styles -->
<style>
    .vegetable-image {
        text-align: center;
        vertical-align: middle;
    }

    .vegetable-image img {
        display: block;
        margin: 0 auto;
    }

    .fruit-image {
        text-align: center;
        vertical-align: middle;
    }

    .fruit-image img {
        display: block;
        margin: 0 auto;
    }
</style>

<x-market-layout>

    <x-slot name="title">Economic Center Dashboard</x-slot>

    {{-- Dashboard page header part --}}
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

    <div class="d-flex">

        {{-- Vegetable --}}
        <div class="container">
            <div class="row justify-content-center mt-2">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-20">
                        <div class="card my-4">

                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h3 class="text-white">
                                        <i class="fas fa-carrot me-2"></i>
                                        Vegetables
                                    </h3>
                                </div>

                                <!-- Filter Section -->
                                <div class="card-body bg-light">
                                    <form id="filterForm" action="{{ route('market.dashboard') }}" method="GET">
                                        <div class="input-group">
                                            <select name="vegetable_id" id="vegetables" class="form-select select2">
                                                <option value="">Select a vegetable to filter</option>
                                                @foreach ($vegetables as $id => $name)
                                                    <option value="{{ $id }}"
                                                        {{ request('vegetable_id') == $id ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>

                                <!-- Table Section -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered md-10" id="vegetableTable">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Wholesale Price(1kg-Rs.)</th>
                                                    <th>Retail Price(1kg-Rs.)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                @include('pages.market.dashboard.vegetable-table', [
                                                    'vegetablesList' => $vegetablesList,
                                                    'vegetablePrices' => $vegetablePrices,
                                                ])
                                            </tbody>
                                        </table>

                                        <!-- Vegetable Table Pagination -->
                                        <div id="vegetablePagination">
                                            {{ $vegetablesList->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Fruit --}}
        <div class="container">
            <div class="row justify-content-center mt-2">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-20">
                        <div class="card my-4">

                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h3 class="text-white">
                                        <i class="fas fa-apple-alt me-2"></i>
                                        Fruits
                                    </h3>
                                </div>

                                <!-- Filter Section -->
                                <div class="card-body bg-light">
                                    <form id="filterForm" action="{{ route('market.dashboard') }}" method="GET">
                                        <div class="input-group">
                                            <select name="fruit_id" id="fruits" class="form-select select2">
                                                <option value="">Select a fruit to filter</option>
                                                @foreach ($fruits as $id => $name)
                                                    <option value="{{ $id }}"
                                                        {{ request('fruit_id') == $id ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered md-10" id="fruitTable">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Wholesale Price(1kg-Rs.)</th>
                                                    <th>Retail Price(1kg-Rs.)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                @include('pages.market.dashboard.fruit-table', [
                                                    'fruitList' => $fruitList,
                                                    'fruitPrices' => $fruitPrices,
                                                ])
                                            </tbody>
                                        </table>

                                        <!-- Fruit Table Pagination -->
                                        <div id="fruitPagination">
                                            {{ $fruitList->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

</x-market-layout>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- Custom JS --}}
<script>
    // Initialize select2 on the vegetables and fruits select inputs
    $(document).ready(function() {
        $('#vegetables').select2({
            placeholder: "Select a vegetable to filter",
            allowClear: true
        });

        $('#fruits').select2({
            placeholder: "Select a fruit to filter",
            allowClear: true
        });
    });

    // AJAX request to filter the data
    $(document).ready(function() {
        // Function to show loading SweetAlert
        function showLoadingAlert() {
            Swal.fire({
                title: 'Filtering...',
                text: 'Please wait while we filter the data.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        // Function to hide loading SweetAlert
        function hideLoadingAlert() {
            Swal.close();
        }

        // Handle filter change for vegetables
        $('#vegetables').on('change', function() {
            const vegetableId = $(this).val(); // Get the selected vegetable ID
            const fruitId = $('#fruits').val(); // Get the selected fruit ID

            // Show loading alert
            showLoadingAlert();

            // Send AJAX request
            $.ajax({
                url: "{{ route('market.dashboard') }}",
                method: 'GET',
                data: {
                    vegetable_id: vegetableId,
                    fruit_id: fruitId
                },
                success: function(response) {
                    // Hide loading alert
                    hideLoadingAlert();

                    // Update the vegetable table
                    $('#vegetableTable tbody').html(response.vegetablesList);

                    // Update the fruit table
                    $('#fruitTable tbody').html(response.fruitList);

                    // Update pagination links
                    $('#vegetablePagination').html(response.pagination.vegetables);
                    $('#fruitPagination').html(response.pagination.fruits);
                },
                error: function(xhr) {
                    // Hide loading alert
                    hideLoadingAlert();

                    console.error('Error:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while filtering the data.',
                    });
                }
            });
        });

        // Handle filter change for fruits
        $('#fruits').on('change', function() {
            const vegetableId = $('#vegetables').val(); // Get the selected vegetable ID
            const fruitId = $(this).val(); // Get the selected fruit ID

            // Show loading alert
            showLoadingAlert();

            // Send AJAX request
            $.ajax({
                url: "{{ route('market.dashboard') }}",
                method: 'GET',
                data: {
                    vegetable_id: vegetableId,
                    fruit_id: fruitId
                },
                success: function(response) {
                    // Hide loading alert
                    hideLoadingAlert();

                    // Update the vegetable table
                    $('#vegetableTable tbody').html(response.vegetablesList);

                    // Update the fruit table
                    $('#fruitTable tbody').html(response.fruitList);

                    // Update pagination links
                    $('#vegetablePagination').html(response.pagination.vegetables);
                    $('#fruitPagination').html(response.pagination.fruits);
                },
                error: function(xhr) {
                    // Hide loading alert
                    hideLoadingAlert();

                    console.error('Error:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while filtering the data.',
                    });
                }
            });
        });
    });

    // AJAX request to update the vegetable prices
    $(document).ready(function() {
        // Handle save button click
        $('.vegetable-save-btn').on('click', function() {
            const itemId = $(this).data('id'); // Get the item ID
            const itemType = $(this).data('type'); // Get the item type (vegetable or fruit)
            const wholesalePrice = $(this).closest('tr').find('.wholesale-price')
        .val(); // Get wholesale price
            const retailPrice = $(this).closest('tr').find('.retail-price').val(); // Get retail price

            // Show loading alert
            Swal.fire({
                title: 'Updating...',
                text: 'Please wait while we update the prices.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Determine the route based on the item type
            const route = itemType === 'vegetable' ? 'market.vegetable.update' : 'market.fruit.update';

            // Send AJAX request
            $.ajax({
                url: "{{ route('market.vegetable.update', ['id' => '__ID__']) }}".replace(
                    '__ID__', itemId),
                method: 'PUT',
                data: {
                    Wholesale_Price: wholesalePrice,
                    Retail_Price: retailPrice,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Hide loading alert
                    Swal.close();

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Prices updated successfully.',
                        confirmButtonText: 'Okay'
                    });
                },
                error: function(xhr) {
                    // Hide loading alert
                    Swal.close();

                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while updating the prices.',
                        confirmButtonText: 'Okay'
                    });
                }
            });
        });
    });

    // AJAX request to update the fruit prices
    $(document).ready(function() {
        // Handle save button click
        $('.fruit-save-btn').on('click', function() {
            const itemId = $(this).data('id'); // Get the item ID
            const itemType = $(this).data('type'); // Get the item type (vegetable or fruit)
            const wholesalePrice = $(this).closest('tr').find('.wholesale-price')
        .val(); // Get wholesale price
            const retailPrice = $(this).closest('tr').find('.retail-price').val(); // Get retail price

            // Show loading alert
            Swal.fire({
                title: 'Updating...',
                text: 'Please wait while we update the prices.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Determine the route based on the item type
            const route = itemType === 'vegetable' ? 'market.vegetable.update' : 'market.fruit.update';

            // Send AJAX request
            $.ajax({
                url: "{{ route('market.fruit.update', ['id' => '__ID__']) }}".replace('__ID__', itemId),
                method: 'PUT',
                data: {
                    Wholesale_Price: wholesalePrice,
                    Retail_Price: retailPrice,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Hide loading alert
                    Swal.close();

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Prices updated successfully.',
                        confirmButtonText: 'Okay'
                    });
                },
                error: function(xhr) {
                    // Hide loading alert
                    Swal.close();

                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while updating the prices.',
                        confirmButtonText: 'Okay'
                    });
                }
            });
        });
    });
</script>

