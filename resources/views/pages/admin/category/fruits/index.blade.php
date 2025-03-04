<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Select2 styles --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Custom Styles -->
<style>
    .fruit-image {
        text-align: center;
        vertical-align: middle;
    }

    .fruit-image img {
        display: block;
        margin: 0 auto;
    }
</style>

<x-admin-layout>
    <x-slot name="title">Fruit</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">

            <!-- Card for Fruit Table -->
            <div class="col-md-12">
                <div class="card">
                    {{-- Card header --}}
                    <div class="card-header bg-dark">
                        <h3 class="text-white"><i class="fas fa-apple-alt" style="margin-right: 10px;"></i>Fruits
                            <a href="{{ route('fruit.create') }}"
                                class="btn btn-dark float-end border border-white d-flex align-items-center gap-2 justify-content-end">
                                <i class="fas fa-seedling"></i> <span>Create</span>
                            </a>
                        </h3>
                    </div>

                    <!-- Filter Section -->
                    <div class="card-body bg-light">
                        <form action="{{ route('fruit.index') }}" method="GET">
                            <div class="input-group">
                                <select name="fruit_id" id="fruits" class="form-select select2"
                                    onchange="this.form.submit()">
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

                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                @if ($fruitsList->isNotEmpty())
                                    @foreach ($fruitsList as $fruit)
                                        <tr>
                                            <td>{{ $fruit->id }}</td>
                                            <td>{{ $fruit->name }}</td>
                                            <td class="description-column">
                                                {{ Str::limit($fruit->description, 50, '...') }}
                                            </td>
                                            <td class="fruit-image">
                                                @if ($fruit->image)
                                                    <img src="{{ asset('storage/' . $fruit->image) }}" alt="Fruit Photo"
                                                        class="rounded-circle" width="50" height="50">
                                                @else
                                                    <img src="{{ asset('images/default-fruit/fruits.jpg') }}"
                                                        alt="Default Photo" class="rounded-circle" width="50"
                                                        height="50">
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end gap-2">
                                                    <!-- Show Button -->
                                                    <button type="button"
                                                        class="btn btn-primary d-flex align-items-center gap-1"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        onclick="window.location.href='{{ route('fruit.show', $fruit->id) }}'">
                                                        <i class="fas fa-eye"></i> <span>Show</span>
                                                    </button>

                                                    <!-- Edit Button -->
                                                    <button type="button"
                                                        class="btn btn-warning d-flex align-items-center gap-1"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        onclick="window.location.href='{{ route('fruit.edit', $fruit->id) }}'">
                                                        <i class="fas fa-edit"></i> <span>Edit</span>
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm d-flex align-items-center gap-1"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        onclick="deleteFruit({{ $fruit->id }})">
                                                        <i class="fas fa-trash-alt"></i> <span>Delete</span>
                                                    </button>

                                                    <!-- Hidden delete form -->
                                                    <form id="delete-fruit-form-{{ $fruit->id }}"
                                                        action="{{ route('fruit.destroy', $fruit->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No fruits found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $fruitsList->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- Custom js scripts --}}
<script>
    // Function to delete a fruit
    function deleteFruit(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
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
                    text: 'Please wait while we delete the fruit.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit the delete form via AJAX
                const form = document.getElementById('delete-fruit-form-' + id); // Use the correct form ID
                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Store success message in localStorage before reloading
                            localStorage.setItem('deleteSuccess', 'Fruit deleted successfully!');

                            // Reload the page immediately after successful deletion
                            window.location.reload();
                        } else {
                            // Show error message if deletion fails
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'An error occurred while deleting the fruit.',
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


    // Initialize select2 on the fruits select input
    $(document).ready(function() {
        $('#fruits').select2({
            placeholder: "Select a fruit to filter",
            allowClear: true
        });
    });
</script>
