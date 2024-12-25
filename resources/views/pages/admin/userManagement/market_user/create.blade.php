<div class="modal fade" id="createMarketModal" tabindex="-1" aria-labelledby="createMarketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createMarketModalLabel">Create Economic Center</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createMarketForm" action="{{ route('users.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <x-input type="text" name="username" class="form-control" id="username" readonly hidden/>
                    <x-input type="text" name="user_type" class="form-control" id="user_type" readonly hidden/>
                    <x-input type="email" name="email" class="form-control" id="email" readonly hidden/>
                    <x-input type="password" name="password" class="form-control" id="password" readonly hidden/>
                    <x-input type="file" name="profile_photo" class="form-control" id="profile_photo" readonly hidden/>

                    <!-- Row 1: Economic center Name and Registration ID -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="center_name" class="form-label">Economic Center Name</label>
                            <x-input type="text" name="center_name" class="form-control" id="center_name"
                                aria-describedby="center_nameHelp" />
                            <small id="center_nameHelp" class="form-text text-muted">Enter the name of the economic
                                center.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="center_reg_id" class="form-label">Registration ID</label>
                            <x-input type="text" name="center_reg_id" class="form-control" id="center_reg_id"
                                aria-describedby="center_reg_idHelp" />
                            <small id="center_reg_idHelp" class="form-text text-muted">Enter the registration ID of the
                                economic center.</small>
                        </div>
                    </div>

                    <!-- Row 2: Economic center location -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="center_location" class="form-label">Location</label>
                            <x-input type="text" name="center_location" class="form-control" id="center_location"
                                aria-describedby="center_locationHelp" />
                            <small id="center_locationHelp" class="form-text text-muted">Enter the location of the
                                economic center.</small>
                        </div>
                    </div>

                    <!-- Row 3: Economic Center Photo -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="center_photo" class="form-label">Economic Center Photo</label>
                            <x-input type="file" name="center_photo" class="form-control" id="center_photo"
                                aria-describedby="center_photoHelp" />
                            <small id="center_photoHelp" class="form-text text-muted">Upload the photo of the economic
                                center.</small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="back-btn">Back</button>
                <button type="submit" form="createMarketForm" class="btn btn-primary" id="submit-btn">Create</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Back button click event
    document.getElementById('back-btn').addEventListener('click', function() {
        $('#createMarketModal').modal('hide'); // Hide the create market modal
        $('#createUserModal').modal('show'); // Show the create user modal
    });

    document.getElementById('submit-btn').addEventListener('click', function() {
        // Show loading spinner
        Swal.fire({
            title: 'Submitting...',
            text: 'Please wait while we process your request.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Create FormData object from the form
        const createUserForm = document.getElementById('createUserForm');
        const formData = new FormData(createUserForm);

        // Submit data via AJAX
        fetch(createUserForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
        })
            .then(response => response.json())
            .then(data => {
                Swal.close(); // Close the loading spinner
                if (data.success) {
                    // Success SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message, // Display success message from JSON
                    }).then(() => {
                        window.location.reload(); // Reload the page to reflect changes
                    });
                } else {
                    // Validation error SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please check the errors and try again.',
                    });
                }
            })
            .catch(error => {
                Swal.close(); // Close the loading spinner
                // Unexpected error SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred. Please try again.',
                });
            });
    });
</script>
