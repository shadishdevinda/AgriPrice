{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<x-admin-layout>

    <x-slot name="title">User Management</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Edit System User
                            <a href="{{ route('users.index') }}" class="btn btn-primary float-end me-2">
                                Back
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" id="editUserForm">
                            @csrf
                            @method('PUT')

                            {{-- User Type, Name, and Email --}}
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="user_type" class="form-label">Choose</label>
                                    <select name="user_type" class="form-select" id="user_type"
                                        aria-describedby="user_typeHelp">
                                        <option value="default" disabled>Select User Type</option>
                                        <option value="system-user"
                                            {{ $user->user_type == 'system-user' ? 'selected' : '' }}>System User
                                        </option>
                                    </select>
                                    <small id="user_typeHelp" class="form-text text-muted">Select the user type.</small>
                                </div>
                                <div class="col-md-5">
                                    <label for="name" class="form-label">Name</label>
                                    <x-input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="form-control" id="name" aria-describedby="nameHelp" />
                                    <small id="nameHelp" class="form-text text-muted">Enter the name of the
                                        user.</small>
                                </div>
                                <div class="col-md-5">
                                    <label for="email" class="form-label">Email</label>
                                    <x-input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="form-control" id="email" aria-describedby="emailHelp" />
                                    <small id="emailHelp" class="form-text text-muted">Enter the email of the
                                        user.</small>
                                </div>
                            </div>

                            {{-- Roles --}}
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="roles" class="form-label">Roles</label>
                                    <select name="roles[]" class="form-select select2" id="roles" multiple
                                        aria-describedby="rolesHelp">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small id="rolesHelp" class="form-text text-muted">Select the roles of the
                                        user.</small>
                                </div>
                            </div>


                            {{-- Password and Confirm Password --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <x-input type="password" name="password" class="form-control" id="password"
                                            aria-describedby="passwordHelp" />
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small id="passwordHelp" class="form-text text-muted">Enter the password of the
                                        user. Leave empty to keep unchanged.</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Re-Password</label>
                                    <div class="input-group">
                                        <x-input type="password" name="password_confirmation" class="form-control"
                                            id="password_confirmation" aria-describedby="password_confirmationHelp" />
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="togglePasswordConfirmation">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small id="password_confirmationHelp" class="form-text text-muted">Re-enter the
                                        password of the user.</small>
                                </div>
                            </div>

                            {{-- Profile Photo --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="profile_photo">Profile Photo</label>

                                    {{-- Display existing profile photo if available --}}
                                    @if ($user->profile_photo_path)
                                        <img id="photoPreview"
                                            src="{{ asset('storage/' . $user->profile_photo_path) }}"
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

                            <button type="submit" class="btn btn-primary">Update</button>
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
    document.getElementById('editUserForm').addEventListener('submit', function(e) {
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

    // Initialize select2 on the roles select input
    $(document).ready(function() {
        $('#roles').select2({
            placeholder: "Select roles",
            allowClear: true
        });
    });
</script>
