<div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createRoleModalLabel">Add New Role</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createRoleForm" action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Role</label>
                        <x-input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" />
                        <small id="nameHelp" class="form-text text-muted">Enter the name of the role.</small>
                    </div>
                    <button type="submit" class="btn btn-primary float-end mt-3"><span>Add Role</span></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('createRoleForm').addEventListener('submit', function (e) {
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
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json', // Ensure the response is JSON
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Set a flag in localStorage to indicate a successful submission
                localStorage.setItem('roleCreated', 'true');

                // Reload the page
                window.location.reload();
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

    // Check for the flag after the page reloads
    window.addEventListener('load', function () {
        if (localStorage.getItem('roleCreated') === 'true') {
            // Remove the flag
            localStorage.removeItem('roleCreated');

            // Show success alert
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Role created successfully.',
                confirmButtonText: 'Okay',
            });
        }
    });
</script>
