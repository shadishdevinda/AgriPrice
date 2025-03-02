<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    .btn-custom {
        background-color: #065744cc;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
    }

    .btn-custom:hover {
        background-color: #054735cc;
    }

    .photo-preview {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-top: 1rem;
        display: none;
    }

    .btn-remove {
        margin-top: 1rem;
        display: none;
    }
</style>

<x-admin-layout>
    <x-slot name="title">Edit Vegetable</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header bg-dark">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-edit"></i> Edit Vegetable
                        </h3>
                        <a href="{{ route('vegetable.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <form id="updateVegetableForm" enctype="multipart/form-data"
                            action="{{ route('vegetable.update', $vegetable->id) }}" method="POST">
                            @method('put')
                            @csrf

                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label h5">
                                    <i class="fas fa-tag"></i> Name
                                </label>
                                <x-input value="{{ old('name', $vegetable->name) }}" type="text"
                                    class="form-control form-control-lg" placeholder="Enter vegetable name"
                                    name="name" />
                            </div>

                            <!-- Description Field -->
                            <div class="mb-4">
                                <label for="description" class="form-label h5">
                                    <i class="fas fa-info-circle"></i> Description
                                </label>
                                <textarea class="form-control" name="description" cols="30" rows="5"
                                    placeholder="Enter vegetable description">{{ old('description', $vegetable->description) }}</textarea>
                            </div>

                            {{-- ! Modify this part price change the center has vegetable table --}}
                            <!-- Wholesale Price Field & Retail Price Field -->
                            <div class="row mb-4">
                                <!-- Wholesale Price Field (Left Column) -->
                                <div class="col-md-6">
                                    <label for="Wholesale_Price" class="form-label h5">
                                        <i class="fas fa-dollar-sign"></i> Wholesale Price
                                    </label>
                                    <x-input value="{{ old('Wholesale_Price', $vegetable->Wholesale_Price) }}"
                                        type="text" class="form-control form-control-lg"
                                        placeholder="Enter wholesale price" name="Wholesale_Price" />
                                </div>

                                <!-- Retail Price Field (Right Column) -->
                                <div class="col-md-6">
                                    <label for="Retail_Price" class="form-label h5">
                                        <i class="fas fa-dollar-sign"></i> Retail Price
                                    </label>
                                    <x-input value="{{ old('Retail_Price', $vegetable->Retail_Price) }}" type="text"
                                        class="form-control form-control-lg" placeholder="Enter retail price"
                                        name="Retail_Price" />
                                </div>
                            </div>

                            <!-- Image Field -->
                            <div class="mb-4">
                                <label for="image" class="form-label h5">
                                    <i class="fas fa-image"></i> Image
                                </label>

                                <!-- Current Image -->
                                <div class="mb-3">
                                    @if ($vegetable->image)
                                        <img src="{{ asset('storage/' . $vegetable->image) }}" alt="Vegetable Photo"
                                            class="rounded-circle" width="100" height="100">
                                    @else
                                        <img src="{{ asset('images/default-vegetable/vegetables.jpg') }}"
                                            alt="Default Photo" class="rounded-circle" width="100" height="100">
                                    @endif
                                </div>

                                <!-- File Input -->
                                <input type="file" id="image" name="image" class="form-control form-control-lg"
                                    accept="image/*">
                                <small class="form-text text-muted">Upload an image of the vegetable.</small>

                                <!-- Image Preview -->
                                <div class="mt-3">
                                    <img id="photoPreview" src="#" alt="Vegetable Image Preview"
                                        class="rounded-circle" width="100" height="100" style="display: none;">
                                    <button type="button" class="btn btn-secondary btn-remove mt-2" id="removePhoto"
                                        style="display: none;">
                                        <i class="fas fa-trash"></i> Remove Selected Photo
                                    </button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save"></i> Create Vegetable
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript for Image Preview and Removal -->
<script>
    // Preview image
    document.getElementById('image').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
            document.getElementById('photoPreview').style.display = 'block';
            document.getElementById('removePhoto').style.display = 'inline-block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    // Remove image
    document.getElementById('removePhoto').addEventListener('click', function() {
        document.getElementById('image').value = '';
        document.getElementById('photoPreview').style.display = 'none';
        this.style.display = 'none';
    });

    // Form submission with Sweet Alerts
    document.getElementById('updateVegetableForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent form from submitting normally

        // Show loading spinner
        Swal.fire({
            title: 'Updating...',
            text: 'Please wait while we update the product.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Submit the form via AJAX
        const form = this;
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                    }).then(() => {
                        // No further action after the user clicks "Okay"
                    });
                } else {
                    // Handle validation errors
                    let errorMessages = [];
                    if (data.errors) {
                        // Convert the errors object into an array of error messages
                        errorMessages = Object.values(data.errors).flat();
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: `
                <ul>
                    ${errorMessages.map(error => `<li>${error}</li>`).join('')}
                </ul>
                `,
                    });
                }
            })
            .catch(error => {
                console.error('Error Response:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'An unexpected error occurred.',
                });
            });
    });
</script>
