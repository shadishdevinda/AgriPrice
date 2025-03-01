{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<x-admin-layout>

    <x-slot name="title">Fruit Advice</x-slot>

    <div class="bg-dark py-3">
        <h1 class="text-white text-center">Fruit Advice List</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('fruit_advice.index') }}" class="btn btn-dark">Back</a>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg my-4">
                        <div class="card-header bg-dark">
                            <h3 class="text-white">Create Fruit Advice</h3>
                        </div>
                        <form enctype="multipart/form-data" action="{{ route('fruit_advice.store') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                {{-- Fruit selection --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="fruits" class="form-label">Fruits</label>
                                        <select name="fruits[]" class="form-select select2" id="fruits" multiple
                                            aria-describedby="fruitsHelp" required>
                                            @foreach ($fruits as $fruit)
                                                <option value="{{ $fruit }}">{{ $fruit }}</option>
                                            @endforeach
                                        </select>
                                        <small id="fruitsHelp" class="form-text text-muted">Select the fruits for
                                            advice.</small>
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="mb-3">
                                    <label for="" class="form-label h5">Description</label>
                                    <textarea class="form-control" name="description" cols="30" rows="5">{{ old('description') }}</textarea>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-lg btn-primary">submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-admin-layout>


{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Initialize select2 on the fruits select input
    $(document).ready(function() {
        $('#fruits').select2({
            placeholder: "Select fruits",
            allowClear: true
        });
    });
</script>
