{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<x-admin-layout>

    <x-slot name="title">Economic Center Management</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Economic Center Management
                            <a href="{{ route('economic-centers.index') }}" class="btn btn-primary float-end me-2">
                                Back
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('economic-centers.update', $economicCenter->id) }}" method="POST"
                            enctype="multipart/form-data" id="editEconomicCenterForm">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="center_id" class="form-label">Center Registration ID</label>
                                    <x-input type="text" class="form-control" id="center_id" name="center_id"
                                        value="{{ old('center_id', $economicCenter->id) }}" readonly />
                                    <small id="center_idHelp" class="form-text text-muted">Cannot change Registration
                                        Id.</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="center_name" class="form-label">Center Name</label>
                                    <x-input type="text" class="form-control" id="center_name" name="center_name"
                                        value="{{ old('center_name', $economicCenter->center_name) }}" />
                                    <small id="center_nameHelp" class="form-text text-muted">Update economic center
                                        name.</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="contact_number" class="form-label">Center Contact Number</label>
                                    <x-input type="text" class="form-control" id="contact_number"
                                        name="contact_number"
                                        value="{{ old('contact_number', $economicCenter->contact_number) }}" />
                                    <small id="contact_numberHelp" class="form-text text-muted">Update economic contact
                                        number.</small>
                                </div>

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

                            <button type="submit" class="btn btn-primary float-end">Update</button>
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
