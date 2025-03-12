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
                        <h3 class="text-white mb-0"><i class="fas fa-carrot" style="margin-right: 10px;"></i>Vegetable
                            Advice</h3>
                        <a href="{{ route('vegetable_advice.create') }}"
                            class="btn btn-dark float-end border border-white d-flex align-items-center gap-2 justify-content-end">
                            <i class="fas fa-seedling"></i> <span>Add Vegetable Advice</span>
                        </a>
                    </div>

                    <!-- Filter Section -->
                    <div class="card-body bg-light">
                        <form action="{{ route('vegetable_advice.index') }}" method="GET">
                            <div class="input-group">
                                <select name="vegetable_id" id="vegetables" class="form-select select2"
                                    onchange="this.form.submit()">
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

                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                @if ($vegetable_advice->isNotEmpty())
                                    @foreach ($vegetable_advice as $vegetableAdvice)
                                        <tr>
                                            <td>{{ $vegetableAdvice->id }}</td>
                                            <td class="description-column">
                                                {!! Str::limit(strip_tags($vegetableAdvice->description), 50, '...') !!}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end gap-2">
                                                    <!-- Show Button -->
                                                    <button type="button"
                                                        class="btn btn-primary d-flex align-items-center gap-1"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        onclick="window.location.href='{{ route('vegetable_advice.show', $vegetableAdvice->id) }}'">
                                                        <i class="fas fa-eye"></i> <span>Show</span>
                                                    </button>

                                                    <!-- Edit Button -->
                                                    <button type="button"
                                                        class="btn btn-warning d-flex align-items-center gap-1"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        onclick="window.location.href='{{ route('vegetable_advice.edit', $vegetableAdvice->id) }}'">
                                                        <i class="fas fa-edit"></i> <span>Edit</span>
                                                    </button>

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm d-flex align-items-center gap-1"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        onclick="deleteVegAdvice({{ $vegetableAdvice->id }})">
                                                        <i class="fas fa-trash"></i> <span>Delete</span>
                                                    </button>
                                                </div>

                                                <!-- Hidden delete form -->
                                                <form id="delete-vegetable-advice-form{{ $vegetableAdvice->id }}"
                                                    action="{{ route('vegetable_advice.destroy', $vegetableAdvice->id) }}"
                                                    method="POST" style="display: none;">
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

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $vegetable_advice->links() }}
                        </div>
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
    // Function to delete a vegetable advice
    function deleteVegAdvice(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete this vegetable advice. This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading spinner
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Please wait while we delete the vegetable advice.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit the delete form via AJAX
                const form = document.getElementById('delete-vegetable-advice-form' + id); // Correct form ID
                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Store success message in localStorage before reloading
                            localStorage.setItem('deleteSuccess', 'Vegetable advice deleted successfully!');

                            // Reload the page immediately after successful deletion
                            window.location.reload();
                        } else {
                            // Show error message if deletion fails
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message ||
                                    'An error occurred while deleting the vegetable advice.',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred.',
                        });
                    });
            }
        });
    }

    // Show the delete success message after page reload
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = localStorage.getItem('deleteSuccess');
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: successMessage,
                confirmButtonText: 'Okay',
            });

            // Remove the success message from localStorage after showing it
            localStorage.removeItem('deleteSuccess');
        }
    });

    // Initialize select2 on the vegetables select input
    $(document).ready(function() {
        $('#vegetables').select2({
            placeholder: "Select a vegetable to filter",
            allowClear: true
        });
    });
</script>
