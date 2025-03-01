{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<x-admin-layout>
    <x-slot name="title">Vegetable Advice</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-12 ms-3 me-3">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0">Vegetable Advice</h3>
                        <a href="{{ route('vegetable_advice.create') }}" class="btn btn-light border border-white">
                            <i class="fas fa-plus"></i> Create
                        </a>
                    </div>

                    <!-- Filter Section -->
                    <div class="card-body bg-light">
                        <form action="{{ route('vegetable_advice.index') }}" method="GET">
                            <div class="input-group">
                                <select name="vegetable_id" id="vegetables" class="form-select select2" onchange="this.form.submit()">
                                    <option value="">Select a vegetable to filter</option>
                                    @foreach ($vegetables as $id => $name)
                                        <option value="{{ $id }}" {{ request('vegetable_id') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($vegetable_advice->isNotEmpty())
                                    @foreach ($vegetable_advice as $vegetableAdvice)
                                        <tr>
                                            <td>{{ $vegetableAdvice->id }}</td>
                                            <td class="description-column">
                                                {{ Str::limit($vegetableAdvice->description, 50, '...') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('vegetable_advice.edit', $vegetableAdvice->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('vegetable_advice.show', $vegetableAdvice->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> Show
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteProduct({{ $vegetableAdvice->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>

                                                <!-- Hidden delete form -->
                                                <form id="delete-product-form{{ $vegetableAdvice->id }}" action="{{ route('vegetable_advice.destroy', $vegetableAdvice->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">No vegetable advice found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
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

<!-- JavaScript for Delete Confirmation and select2 Initialization -->
<script>
    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete this vegetable advice?")) {
            document.getElementById('delete-product-form' + id).submit();
        }
    }

    // Initialize select2 on the vegetables select input
    $(document).ready(function() {
        $('#vegetables').select2({
            placeholder: "Select a vegetable to filter",
            allowClear: true
        });
    });
</script>
