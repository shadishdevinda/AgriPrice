<!-- Give Permission Modal -->
<div class="modal fade" id="givePermissionModal" tabindex="-1" aria-labelledby="givePermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="givePermissionModalLabel">Add / Edit Permissions for Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="givePermissionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="role_name">Role Name</label>
                        <x-input type="text" class="form-control" id="role_name" name="role_name" readonly />
                    </div>
                    <div class="form-group mb-3">
                        <label for="permissions">Permissions</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                                type="checkbox" name="permission[]"
                                                value="{{ $permission->name }}"
                                                id="permission{{ $permission->id }}"
                                               {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permission{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('givePermissionForm').addEventListener('submit', function (e) {
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
            // Handle unexpected errors
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred. Please try again.',
            });
        });
    });
</script>
