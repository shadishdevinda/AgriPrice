<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createUserModalLabel">Create User</h1>
                <button type="button" id="closeButton" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createUserForm" action="{{ route('users.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Row 1: User Type and Name -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="user_type" class="form-label">User Type</label>
                            <select name="user_type" class="form-select" id="user_type"
                                aria-describedby="user_typeHelp">
                                <option value="default">Select User Type</option>
                                <option value="system-user">System User</option>
                                <option value="market-user">Market User</option>
                            </select>
                            <small id="user_typeHelp" class="form-text text-muted">Select the user type.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">Name</label>
                            <x-input type="text" name="username" class="form-control" id="username"
                                aria-describedby="usernameHelp" />
                            <small id="usernameHelp" class="form-text text-muted">Enter the name of the user.</small>
                        </div>
                    </div>

                    <!-- Row 2: Email and Password -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <x-input type="email" name="email" class="form-control" id="email"
                                aria-describedby="emailHelp" />
                            <small id="emailHelp" class="form-text text-muted">Enter the email of the user.</small>
                        </div>
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
                    </div>

                    <!-- Row 3: Re-Password and Profile Photo -->
                    <div class="row mb-3">
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
                        <div class="col-md-6">
                            <label for="profile_photo" class="form-label">Profile Photo</label>
                            <x-input type="file" name="profile_photo" class="form-control" id="profile_photo"
                                aria-describedby="profile_photoHelp" />
                            <small id="profile_photoHelp" class="form-text text-muted">Upload the profile photo of the
                                user.</small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeButton">Close</button>
                <button type="submit" form="createUserForm" class="btn btn-primary"
                    id="createButton">Create</button>
                <button type="button" id="nextButton" class="btn btn-primary" hidden>Next</button>
            </div>
        </div>
    </div>
</div>

{{-- Market Details Add Form --}}
@include('pages.admin.userManagement.marketInfo.create')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Handle dynamic footer change based on user type selection
    document.getElementById('user_type').addEventListener('change', function() {
        const userType = this.value;
        const createButton = document.getElementById('createButton');
        const nextButton = document.getElementById('nextButton');

        if (userType === 'market-user') {
            createButton.hidden = true;
            nextButton.hidden = false;

            document.getElementById('nextButton').addEventListener('click', function() {
                collectFormData();

                // Close the createUserModal and show createMarketModal
                $('#createUserModal').modal('hide'); // Hide the createUserModal
                $('#createMarketModal').modal('show'); // Show the createMarketModal
            });
        } else {
            createButton.hidden = false;
            nextButton.hidden = true;
        }
    });

    // Collect form data and populate createMarketForm
    function collectFormData() {
        const userType = document.getElementById('user_type').value;
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const profilePhoto = document.getElementById('profile_photo').files[0];

        // Populate fields in createMarketForm
        document.querySelector('#createMarketForm #user_type').value = userType;
        document.querySelector('#createMarketForm #username').value = username;
        document.querySelector('#createMarketForm #email').value = email;
        document.querySelector('#createMarketForm #password').value = password;

        // Handle file inputs (optional)
        const profilePhotoInput = document.querySelector('#createMarketForm #profile_photo');
        if (profilePhoto) {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(profilePhoto);
            profilePhotoInput.files = dataTransfer.files;
        }
    }

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
                console.error('Error Response:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'An unexpected error occurred.',
                });
            });
    });

    // Toggle the password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Toggle the password confirmation visibility
    document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
        const passwordConfirmationField = document.getElementById('password_confirmation');
        const icon = this.querySelector('i');
        if (passwordConfirmationField.type === 'password') {
            passwordConfirmationField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordConfirmationField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
