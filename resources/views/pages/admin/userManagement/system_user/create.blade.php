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

    <x-slot name="title">System User Management</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header bg-dark">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-plus-circle"></i> Create System User
                        </h3>
                        <a href="{{ route('users.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form id="createUserForm" action="{{ route('users.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Row 1: User Type and Name and Role-->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="user_type" class="form-label">User Type</label>
                                    <select name="user_type" class="form-select" id="user_type"
                                        aria-describedby="user_typeHelp" required>
                                        <option value="" selected disabled>Select User Type</option>
                                        <option value="system-user">System User</option>
                                    </select>
                                    <small id="user_typeHelp" class="form-text text-muted">Select the user
                                        type.</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Name</label>
                                    <x-input type="text" name="username" class="form-control" id="username"
                                        aria-describedby="usernameHelp" required />
                                    <small id="usernameHelp" class="form-text text-muted">Enter the name of the
                                        user.</small>
                                </div>

                                {{-- Roles --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="roles" class="form-label">Roles</label>
                                        <select name="roles[]" class="form-select select2" id="roles" multiple
                                            aria-describedby="rolesHelp" required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}">{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        <small id="rolesHelp" class="form-text text-muted">Select the roles of the
                                            user.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Row 2: Email and Password -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <x-input type="email" name="email" class="form-control" id="email"
                                        aria-describedby="emailHelp" required />
                                    <small id="emailHelp" class="form-text text-muted">Enter the email of the
                                        user.</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <x-input type="password" name="password" class="form-control" id="password"
                                            aria-describedby="passwordHelp" required />
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small id="passwordHelp" class="form-text text-muted">Enter the password of the
                                        user.</small>
                                </div>
                            </div>

                            <!-- Row 3: Re-Password and Profile Photo -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Re-Password</label>
                                    <div class="input-group">
                                        <x-input type="password" name="password_confirmation" class="form-control"
                                            id="password_confirmation" aria-describedby="passwordHelp" required />
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="togglePasswordConfirmation">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small id="password_confirmationHelp" class="form-text text-muted">Re-enter the
                                        password of the user.</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="profile_photo">Profile Photo</label>
                                    <input type="file" id="profile_photo" name="profile_photo"
                                        class="form-control" accept="image/*">

                                    <img id="photoPreview" src="#" alt="Profile Photo Preview" class="mt-2"
                                        style="display: none; width: 100px; height: 100px; object-fit: cover;">

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
                                        <i class="fas fa-save"></i> Create User
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

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Preview profile photo
    document.getElementById('profile_photo').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
            document.getElementById('photoPreview').style.display = 'block';
            document.getElementById('removePhoto').style.display = 'inline-block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    // Remove profile photo
    document.getElementById('removePhoto').addEventListener('click', function() {
        document.getElementById('profile_photo').value = '';
        document.getElementById('photoPreview').style.display = 'none';
        this.style.display = 'none';
    });

    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');
        passwordField.type = (passwordField.type === 'password') ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });

    // Toggle password confirmation visibility
    document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
        const passwordConfirmationField = document.getElementById('password_confirmation');
        const icon = this.querySelector('i');
        passwordConfirmationField.type = (passwordConfirmationField.type === 'password') ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });

    // Initial form submission handler (unchanged)
    document.getElementById('createUserForm').addEventListener('submit', function(e) {
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
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        confirmButtonText: 'Okay',
                    }).then(() => {
                        // Reset the form
                        form.reset();

                        document.getElementById('photoPreview').style.display = 'none';
                        document.getElementById('removePhoto').style.display = 'none';

                        // Clear the Roles field (select2 initialization)
                        const rolesField = document.getElementById('roles');
                        if (rolesField) {
                            $(rolesField).val(null).trigger('change'); // Clear selected values
                        }
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

    // Initialize select2 on the roles select input
    $(document).ready(function() {
        $('#roles').select2({
            placeholder: "Select roles",
            allowClear: true
        });
    });
</script>
