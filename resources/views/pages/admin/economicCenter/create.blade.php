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
                        <form action="{{ route('economic-centers.store') }}" method="POST"
                            enctype="multipart/form-data" id="createCenterForm">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="center_id" class="form-label">Center Registration ID</label>
                                    <x-input type="text" class="form-control" id="center_id" name="center_id" />
                                    <small id="center_idHelp" class="form-text text-muted">Enter economic center
                                        Registration Id.</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="center_name" class="form-label">Center Name</label>
                                    <x-input type="text" class="form-control" id="center_name" name="center_name" />
                                    <small id="center_nameHelp" class="form-text text-muted">Enter economic center
                                        name.</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="contact_number" class="form-label">Center Contact Number</label>
                                    <x-input type="text" class="form-control" id="contact_number"
                                        name="contact_number" />
                                    <small id="contact_numberHelp" class="form-text text-muted">Enter economic contact
                                        number.</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="center_location" class="form-label">Center Location</label>
                                    <x-input type="text" class="form-control" id="center_location"
                                        name="center_location" />
                                    <small id="center_nameHelp" class="form-text text-muted">Enter economic
                                        Address.</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="center_photo">Center Photo</label>
                                <input type="file" id="center_photo" name="center_photo" class="form-control"
                                    accept="image/*">

                                <img id="photoPreview" src="#" alt="Center Photo Preview" class="mt-2"
                                    style="display: none; width: 100px; height: 100px; object-fit: cover;">

                                <button type="button" class="btn btn-secondary mt-2" id="removePhoto"
                                    style="display: none;">
                                    Remove Selected Photo
                                </button>
                            </div>

                            <button type="submit" class="btn btn-primary float-end">Add</button>
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

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Preview center photo
    document.getElementById('center_photo').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
            document.getElementById('photoPreview').style.display = 'block';
            document.getElementById('removePhoto').style.display = 'inline-block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    // Remove center photo
    document.getElementById('removePhoto').addEventListener('click', function() {
        document.getElementById('center_photo').value = '';
        document.getElementById('photoPreview').style.display = 'none';
        this.style.display = 'none';
    });

    // Initial form submission handler (unchanged)
    document.getElementById('createCenterForm').addEventListener('submit', function(e) {
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
                    }).then(() => {
                        // Reset the form
                        form.reset();
                        document.getElementById('photoPreview').style.display = 'none';
                        document.getElementById('removePhoto').style.display = 'none';
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
