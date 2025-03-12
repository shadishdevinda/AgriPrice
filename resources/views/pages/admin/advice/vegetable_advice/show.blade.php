{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- FontAwesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

{{-- Custom styles --}}
<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
    }

    .card-body {
        padding: 2rem;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-radius: 8px;
    }
</style>

<x-admin-layout>
    <x-slot name="title">Vegetable Advice</x-slot>

    <!-- Main Content -->
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header bg-dark">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-seedling"></i> Show Vegetable Advice
                        </h3>
                        <a href="{{ route('vegetable_advice.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">

                        <!-- Associated Vegetables -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Associated Vegetables</label>
                            <div class="p-3 bg-light rounded">
                                @if ($vegetableAdvice->vegetables->count() > 0)
                                    <ul class="list-group list-group-flush">
                                        @foreach ($vegetableAdvice->vegetables as $vegetable)
                                            <li class="list-group-item bg-transparent border-0">
                                                <i class="fas fa-leaf me-2 text-success"></i> {{ $vegetable->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="mb-0 text-muted">No vegetables associated with this advice.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Description</label>
                            <div class="p-3 bg-light rounded">
                                <p class="mb-0">{!! $vegetableAdvice->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
