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
                            <i class="fas fa-user"></i> Economic Center Assign User
                        </h3>
                        <a href="{{ route('economic-centers.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('economic.center.add.user', $economicCenter->id) }}" method="POST"
                            enctype="multipart/form-data" id="assignUserForm">
                            @csrf
                            @method('PUT')

                            <!-- Center ID, Name -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="center_id" class="form-label">Center Registration ID :
                                    </label><span style="font-weight: 500"> {{ $economicCenter->id }}</span>
                                    <x-input type="hidden" name="center_id"
                                        value="{{ old('center_id', $economicCenter->id) }}" />
                                    <x-input type="text" class="form-control" id="center_name" name="center_name"
                                        value="{{ old('center_name', $economicCenter->center_name) }}" disabled />
                                    <small id="center_nameHelp" class="form-text text-muted">Economic center
                                        name.</small>
                                </div>
                            </div>

                            <!-- Row 1: User Type and Name  and Role -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="username" class="form-label">User Name</label>
                                    <x-input type="text" name="username" class="form-control" id="username"
                                        aria-describedby="usernameHelp" required />
                                    <small id="usernameHelp" class="form-text text-muted">Enter the name of the
                                        user.</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <x-input type="email" name="email" class="form-control" id="email"
                                        aria-describedby="emailHelp" required />
                                    <small id="emailHelp" class="form-text text-muted">Enter the email of the
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

                            <!-- Row 2: Password -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <x-input type="password" name="password" class="form-control" id="password"
                                            aria-describedby="passwordHelp" required />
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small id="passwordHelp" class="form-text text-muted">
                                        Password must meet the following requirements:
                                        <ul>
                                            <li>Minimum 8 characters</li>
                                            <li>At least one uppercase letter</li>
                                            <li>At least one lowercase letter</li>
                                            <li>At least one number</li>
                                            <li>At least one special character (e.g., !@#$%^&*)</li>
                                        </ul>
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Re-Password</label>
                                    <div class="input-group">
                                        <x-input type="password" name="password_confirmation" class="form-control"
                                            id="password_confirmation" aria-describedby="password_confirmationHelp"
                                            required />
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="togglePasswordConfirmation">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small id="password_confirmationHelp" class="form-text text-muted">
                                        Re-enter the password to confirm.
                                    </small>
                                </div>
                            </div>

                            <!-- Row 3: Profile Photo -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label for="profile_photo">Profile Photo</label>
                                        <input type="file" id="profile_photo" name="profile_photo"
                                            class="form-control" accept="image/*">

                                        <img id="photoPreview" src="#" alt="Profile Photo Preview"
                                            class="mt-2"
                                            style="display: none; width: 100px; height: 100px; object-fit: cover;">

                                        <button type="button" class="btn btn-secondary mt-2" id="removePhoto"
                                            style="display: none;">
                                            Remove Selected Photo
                                        </button>
                                    </div>
                                    <small id="profile_photoHelp" class="form-text text-muted">Upload the profile
                                        photo of the user.</small>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save"></i> Assign
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

    document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.getElementById('password');
        const passwordConfirmationField = document.getElementById('password_confirmation');
        const passwordHelp = document.getElementById('passwordHelp');
        const passwordConfirmationHelp = document.getElementById('password_confirmationHelp');

        // Function to validate password
        function validatePassword(password) {
            const minLength = 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasLowercase = /[a-z]/.test(password);
            const hasNumber = /\d/.test(password);
            const hasSpecialChar = /[!@#$%^&*]/.test(password);

            return {
                isValid: password.length >= minLength && hasUppercase && hasLowercase && hasNumber &&
                    hasSpecialChar,
                messages: [
                    password.length >= minLength ? '' : 'Password must be at least 8 characters.',
                    hasUppercase ? '' : 'Password must contain at least one uppercase letter.',
                    hasLowercase ? '' : 'Password must contain at least one lowercase letter.',
                    hasNumber ? '' : 'Password must contain at least one number.',
                    hasSpecialChar ? '' :
                    'Password must contain at least one special character (e.g., !@#$%^&*).',
                ].filter(message => message !== ''),
            };
        }

        // Function to validate password confirmation
        function validatePasswordConfirmation(password, confirmation) {
            return password === confirmation;
        }

        // Event listener for password field
        passwordField.addEventListener('input', function() {
            const password = passwordField.value;
            const validation = validatePassword(password);

            if (validation.isValid) {
                // Display success message in green
                passwordHelp.innerHTML = `
                <span style="color: green;">Password meets all requirements.</span>
            `;
            } else {
                // Display individual requirements in red
                passwordHelp.innerHTML = `
                <span style="color: red;">
                    Password must meet the following requirements:
                    <ul>
                        ${validation.messages.map(message => `<li>${message}</li>`).join('')}
                    </ul>
                </span>
            `;
            }
        });

        // Event listener for password confirmation field
        passwordConfirmationField.addEventListener('input', function() {
            const password = passwordField.value;
            const confirmation = passwordConfirmationField.value;

            if (validatePasswordConfirmation(password, confirmation)) {
                passwordConfirmationHelp.innerHTML = 'Passwords match.';
                passwordConfirmationHelp.style.color = 'green';
            } else {
                passwordConfirmationHelp.innerHTML = 'Passwords do not match.';
                passwordConfirmationHelp.style.color = 'red';
            }
        });

        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        // Toggle password confirmation visibility
        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmationField.getAttribute('type') === 'password' ? 'text' :
                'password';
            passwordConfirmationField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    });

    // Initial form submission handler (unchanged)
    document.getElementById('assignUserForm').addEventListener('submit', function(e) {
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

                        // Clear the Roles field (select2 initialization)
                        const rolesField = document.getElementById('roles');
                        if (rolesField) {
                            $(rolesField).val(null).trigger('change'); // Clear selected values
                        }

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

    // Initialize select2 on the roles select input
    $(document).ready(function() {
        $('#roles').select2({
            placeholder: "Select roles",
            allowClear: true
        });
    });
</script>
