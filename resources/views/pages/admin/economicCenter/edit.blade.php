{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- FontAwesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
{{-- Select2 CDN --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Custom styles --}}
<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
    }

    .btn-custom {
        background-color: #065744;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
    }

    .btn-custom:hover {
        background-color: #065744;
        color: white;
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

    <x-slot name="title">Economic Center Management</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">

                    <!-- Card Header -->
                    <div class="card-header bg-dark">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-pencil"></i> Update Economic Center
                        </h3>
                        <a href="{{ route('economic-centers.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body">
                        <form action="{{ route('economic-centers.update', $economicCenter->id) }}" method="POST"
                            enctype="multipart/form-data" id="editEconomicCenterForm">
                            @csrf
                            @method('PUT')

                            {{-- Economic Center Register ID & Center Name --}}
                            <div class="row mb-3">
                                {{-- Economic Center Register ID --}}
                                <div class="col-md-6">
                                    <label for="center_id" class="form-label">Center Registration ID</label>
                                    <x-input type="text" class="form-control" id="center_id" name="center_id"
                                        value="{{ old('center_id', $economicCenter->id) }}" readonly />
                                    <small id="center_idHelp" class="form-text text-muted">Cannot change Registration
                                        Id.</small>
                                </div>

                                {{-- Economic Center Name --}}
                                <div class="col-md-6">
                                    <label for="center_name" class="form-label">Center Name</label>
                                    <x-input type="text" class="form-control" id="center_name" name="center_name"
                                        value="{{ old('center_name', $economicCenter->center_name) }}" />
                                    <small id="center_nameHelp" class="form-text text-muted">Update economic center
                                        name.</small>
                                </div>
                            </div>

                            {{-- Economic Center Contact Number & Location --}}
                            <div class="row mb-3">
                                {{-- Economic Center Contact Number --}}
                                <div class="col-md-6">
                                    <label for="contact_number" class="form-label">Center Contact Number</label>
                                    <x-input type="text" class="form-control" id="contact_number"
                                        name="contact_number"
                                        value="{{ old('contact_number', $economicCenter->contact_number) }}" />
                                    <small id="contact_numberHelp" class="form-text text-muted">Update economic contact
                                        number.</small>
                                </div>

                                {{-- Economic Center Location --}}
                                <div class="col-md-6">
                                    <label for="center_location" class="form-label">Center Location</label>
                                    <x-input type="text" class="form-control" id="center_location"
                                        name="center_location"
                                        value="{{ old('center_location', $economicCenter->center_location) }}" />
                                    <small id="center_nameHelp" class="form-text text-muted">Update economic
                                        Address.</small>
                                </div>
                            </div>

                            {{-- Profile Photo --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="profile_photo">Economic Center Photo</label>

                                    {{-- Display existing profile photo if available --}}
                                    @if ($economicCenter->profile_photo_path)
                                        <img id="photoPreview"
                                            src="{{ asset('storage/' . $economicCenter->profile_photo_path) }}"
                                            alt="Profile Photo" class="mt-2"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <img id="photoPreview" src="#" alt="Profile Photo Preview"
                                            class="mt-2"
                                            style="display: none; width: 100px; height: 100px; object-fit: cover;">
                                    @endif

                                    {{-- Input for uploading a new profile photo --}}
                                    <input type="file" id="profile_photo" name="profile_photo"
                                        class="form-control" accept="image/*">

                                    {{-- Remove Photo button visibility based on whether there is a selected photo --}}
                                    <button type="button" class="btn btn-secondary mt-2" id="removePhoto"
                                        style="display: none;">
                                        Remove Selected Photo
                                    </button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save"></i> Update Economic Center
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

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Show preview of selected image when a user selects a file
    document.getElementById('profile_photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
            document.getElementById('photoPreview').style.display = 'block';
            document.getElementById('removePhoto').style.display = 'inline-block';
        };

        reader.readAsDataURL(file);
    });

    // Remove selected photo (reset the input and hide the preview)
    document.getElementById('removePhoto').addEventListener('click', function() {
        document.getElementById('profile_photo').value = '';
        document.getElementById('photoPreview').src = '';
        document.getElementById('photoPreview').style.display = 'none';
        document.getElementById('removePhoto').style.display = 'none';
    });

    // Initial form submission handler (unchanged)
    document.getElementById('editEconomicCenterForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent form from submitting normally

        // Show loading spinner
        Swal.fire({
            title: 'Submitting...',
            text: 'Please wait while we process your request.',
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
                    'X-Requested-With': 'XMLHttpRequest'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                    });
                } else {
                    // Handle validation errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: `
                        <ul>
                            ${data.errors.map(error => `<li>${error}</li>`).join('')}
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

