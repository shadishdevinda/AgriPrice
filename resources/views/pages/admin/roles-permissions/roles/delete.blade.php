<!-- Delete Role Modal -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleModalLabel">Delete Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the role ?
                    <br>
                    <br>
                    <strong id="roleName"></strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form id="deleteRoleForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // Handle form submission for deleting role
    document.getElementById('deleteRoleForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Show loading spinner
        Swal.fire({
            title: 'Deleting...',
            text: 'Please wait while we process your request.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

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
                    localStorage.setItem('roleDeleted', 'true');

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
    window.addEventListener('load', function() {
        if (localStorage.getItem('roleDeleted') === 'true') {
            // Remove the flag
            localStorage.removeItem('roleDeleted');

            // Show success alert
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Role deleted successfully.',
                confirmButtonText: 'Okay',
            });
        }
    });
</script>
