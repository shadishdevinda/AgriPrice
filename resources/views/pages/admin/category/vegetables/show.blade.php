<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- Include FontAwesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    .square-image {
        border-radius: 8px; /* Slightly rounded corners for a modern look */
        object-fit: cover; /* Ensure the image covers the square area */
        width: 250px; /* Set width */
        height: 250px; /* Set height */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    }

    .center-image {
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        margin-bottom: 1.5rem; /* Add spacing below the image */
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem; /* Add padding for better spacing */
    }

    .card-body {
        padding: 2rem; /* Add more padding for better spacing */
    }

    .form-group label {
        font-weight: 600; /* Make labels bold */
        color: #333; /* Darker color for better readability */
        margin-bottom: 0.5rem; /* Add spacing below labels */
    }

    .form-group p {
        font-size: 1.1rem; /* Slightly larger font size for content */
        color: #555; /* Slightly lighter color for content */
        margin-bottom: 1.5rem; /* Add spacing below paragraphs */
    }

    .btn-dark {
        background-color: #343a40; /* Dark button color */
        border: none; /* Remove border */
        padding: 0.5rem 1rem; /* Add padding for better button size */
    }

    .btn-dark:hover {
        background-color: #23272b; /* Darker hover color */
    }
</style>

<x-admin-layout>
    <x-slot name="title">Vegetable:{{$vegetable->name}}</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">

                    <!-- Card Header -->
                    <div class="card-header bg-dark">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-seedling"></i> <!-- Add an icon -->
                            Product Description
                        </h3>
                        <a href="{{ route('vegetable.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Back <!-- Add an icon -->
                        </a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="form-group">
                            <!-- Image Section -->
                            <div class="center-image">
                                <img src="{{ asset('storage/' . $vegetable->image) }}" alt="Vegetable Photo"
                                    class="square-image">
                            </div>

                            <!-- Name Section -->
                            <div class="mb-4">
                                <label for="name">
                                    <i class="fas fa-tag"></i> Name <!-- Add an icon -->
                                </label>
                                <p>{{ $vegetable->name }}</p>
                            </div>

                            <!-- Description Section -->
                            <div class="mb-4">
                                <label for="advices">
                                    <i class="fas fa-info-circle"></i> Description <!-- Add an icon -->
                                </label>
                                <p>{!! $vegetable->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
