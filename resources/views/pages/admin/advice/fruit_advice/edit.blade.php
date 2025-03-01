<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- Include Select2 CSS -->
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
                            <h3 class="text-white">Edit Fruit Advice</h3>
                        </div>
                        <form enctype="multipart/form-data" action="{{ route('fruit_advice.update', $fruitAdvice->id) }}"
                            method="POST">
                            @method('put')
                            @csrf
                            <div class="card-body">

                                {{-- Description --}}
                                <div class="mb-3">
                                    <label for="" class="form-label h5">Description</label>
                                    <textarea class="form-control" name="description" cols="30" rows="5">{{ old('description', $fruitAdvice->description) }}</textarea>
                                </div>

                                <!-- Fruit Selection -->
                                <div class="mb-3">
                                    <label for="fruits" class="form-label">Associated Fruits</label>
                                    <select name="fruits[]" class="form-select select2" id="fruits" multiple>
                                        @foreach ($fruits as $id => $name)
                                            <option value="{{ $id }}" {{ in_array($id, $associatedFruits) ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-lg btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-admin-layout>

<!-- Include jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: 'Select fruits',
            allowClear: true
        });
    });
</script>
