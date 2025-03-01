<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<x-admin-layout>
    <x-slot name="title">Vegetable Advice</x-slot>

    <div class="bg-dark py-3">
        <h1 class="text-white text-center">Vegetable Advice Details</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('vegetable_advice.index') }}" class="btn btn-dark">Back</a>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg my-4">
                        <div class="card-header bg-dark">
                            <h3 class="text-white">Show Vegetable Advice</h3>
                        </div>

                        <div class="card-body">
                            <!-- Description -->
                            <div class="mb-3">
                                <label for="advices">Description</label>
                                <p>{!! $vegetableAdvice->description !!}</p>
                            </div>

                            <!-- Associated Vegetables -->
                            <div class="mb-3">
                                <label for="vegetables">Associated Vegetables</label>
                                <ul class="list-group">
                                    @forelse ($vegetableAdvice->vegetables as $vegetable)
                                        <li class="list-group-item">
                                            {{ $vegetable->name }}
                                        </li>
                                    @empty
                                        <li class="list-group-item">
                                            No vegetables associated with this advice.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
