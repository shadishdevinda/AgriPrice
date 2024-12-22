<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editRoleModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="POST" action="{{ route('users.update', $user->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Row 1: User Type and Name and Email-->
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="user_type" class="form-label">Choose</label>
                            <select name="user_type" class="form-select" id="user_type"
                                aria-describedby="user_typeHelp">
                                <option value="default">User Type</option>
                                <option value="system-user">System User</option>
                                <option value="market-user">Market User</option>
                            </select>
                            <small id="user_typeHelp" class="form-text text-muted">Select the user type.</small>
                        </div>
                        <div class="col-md-5">
                            <label for="name" class="form-label">Name</label>
                            <x-input type="text" name="name" class="form-control" id="name"
                                aria-describedby="nameHelp" />
                            <small id="nameHelp" class="form-text text-muted">Enter the name of the user.</small>
                        </div>
                        <div class="col-md-5">
                            <label for="email" class="form-label">Email</label>
                            <x-input type="email" name="email" class="form-control" id="email"
                                aria-describedby="emailHelp" />
                            <small id="emailHelp" class="form-text text-muted">Enter the email of the user.</small>
                        </div>
                    </div>

                    <!-- Row 2: Password and Re-Password-->
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
                                user.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Re-Password</label>
                            <div class="input-group">
                                <x-input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation" aria-describedby="passwordHelp" />
                                <button type="button" class="btn btn-outline-secondary"
                                    id="togglePasswordConfirmation">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small id="password_confirmationHelp" class="form-text text-muted">Re-enter the password of
                                the user.</small>
                        </div>
                    </div>

                    <!-- Profile Photo Preview -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="profile_photo" class="form-label">Profile Photo</label>
                            <x-input type="file" name="profile_photo" class="form-control" id="profile_photo"
                                aria-describedby="profile_photoHelp" />
                            <img id="profile_photo_preview" src="#" alt="Profile Photo"
                                class="img-thumbnail mt-2" style="display: none; max-width: 150px;">
                            <small id="profile_photoHelp" class="form-text text-muted">Upload the profile photo of the
                                user.</small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="updateButton" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // Handle Edit User Modal
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

        // Get the form data
        const form = this;
        const formData = new FormData(form);

        // Perform the AJAX request
        fetch(form.action, {
                method: 'POST', // Ensure it's a POST request or PUT if needed
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
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
                        window.location.reload(); // Reload the page to reflect changes
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
                // Handle unexpected errors
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred. Please try again.',
                });
            });
    });
</script>
