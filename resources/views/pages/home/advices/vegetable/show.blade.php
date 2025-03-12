<x-home-layout>

    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        /* Navigation Links */
        .nav-links {
            gap: 60px;
        }

        /* Card Styles */
        .vegetable-card {
            background-color: #f9f9f9;
            border-radius: 12px;
            overflow: hidden;
        }

        /* Back Button */
        .back-btn {
            position: absolute;
            /* Position the button absolutely within the card */
            top: 15px;
            /* Distance from the top */
            right: 15px;
            /* Distance from the right */
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
            z-index: 1;
            /* Ensure the button stays above other elements */
        }

        .back-btn:hover {
            background-color: #45a049;
        }

        .back-btn i {
            margin-right: 5px;
        }

        /* Vegetable Image Container */
        .vegetable-image-container {
            background-color: #f9f9f9;
            display: flex;
            /* Use Flexbox */
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Set a fixed height or adjust as needed */
            margin-top: 10px;
            margin-bottom: 10px;
        }

        /* Vegetable Image */
        .vegetable-image {
            max-width: 32%;
            /* Adjust as needed */
            max-height: auto;
            /* Adjust as needed */
            border-radius: 8px;
            object-fit: contain;
            /* Ensures the image maintains its aspect ratio */
        }

        /* Card Body */
        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .vegetable-description {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin-bottom: 20px;
        }

        /* Advice Section */
        .advice-section {
            margin-top: 20px;
        }

        .advice-heading {
            font-size: 22px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .advice-list {
            list-style: none;
            padding: 0;
        }

        .advice-item {
            background-color: #f9f9f9;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
            transition: background-color 0.3s ease;
        }

        .no-advice {
            color: #888;
            font-style: italic;
        }
    </style>

    <x-slot name="title">{{ $vegetable->name ?? 'Vegetable' }}'s Details</x-slot>

    <div class="container" style="max-width: auto; margin: 0 auto; margin-top: 30px;">
        <!-- vegetable Card -->
        <div class="card vegetable-card">
            <!-- Back Button -->
            <a href="{{ url()->previous() }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>

            <h2 class="card-title" style="text-align: center">{{ $vegetable->name }}'s Advices</h2>

            <!-- Centered Image -->
            <div class="vegetable-image-container">
                <img src="{{ asset('storage/' . $vegetable->image) }}" class="vegetable-image"
                    alt="{{ $vegetable->name }}">
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <!-- vegetable Description -->
                <p class="card-text vegetable-description">{{ $vegetable->description }}</p>

                <!-- Advice Section -->
                <div class="advice-section">
                    <h3 class="advice-heading">Advice</h3>
                    <ul class="advice-list">
                        @forelse($vegetable->advice as $advice)
                            <li class="advice-item">{!! $advice->description !!}</li>
                        @empty
                            <li class="advice-item no-advice">No advice available for this vegetable.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-home-layout>
