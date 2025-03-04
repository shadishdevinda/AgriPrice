{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .center-image {
        text-align: center;
        vertical-align: middle;
    }

    .center-image img {
        display: block;
        margin: 0 auto;
    }
</style>

<x-admin-layout>

    <x-slot name="title">Economic Center User Management</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Economic Center User Management
                            <a href="{{ route('economic-center-user.create') }}" class="btn btn-primary float-end me-2">
                                Add User
                            </a>
                        </h5>
                    </div>
                    <table class="table table-bordered table-striped mt-3" id="usersTable">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Name</th>
                                <th width="30%">Email</th>
                                <td><b>Photo</b></th>
                                <th>Roles</th>
                                <th width="30%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr style="text-align: center;">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="center-image">
                                        @if ($user->profile_photo_path)
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                alt="Profile Photo" class="rounded-circle" width="50"
                                                height="50">
                                        @else
                                            <img src="{{ asset('images/default-user/user.png') }}" alt="Default Photo"
                                                class="rounded-circle" width="50" height="50">
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $role)
                                                <span class="badge bg-success">{{ $role }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('economic-center-user.edit', $user->id) }}"
                                                class="btn btn-warning"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                <i class="fas fa-edit">Edit
                                            </a>

                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-danger"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                                data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                data-role="{{ $user->getRoleNames()->implode(', ') }}">
                                                <i class="fas fa-trash">Delete
                                            </button>

                                            <!-- Assign Permission Buttons -->
                                            <a href="{{ route('economic.center.users.permissions', $user->id) }}"
                                                class="btn btn-info"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                Assign Permission
                                            </a>
                                        </div>

                                        <!-- Hidden delete form -->
                                        <form id="delete-system-user-delete-form{{ $user->id }}"
                                            action="{{ route('users.destroy', $user->id) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
    @include('pages.admin.userManagement.economic_center_user.delete')
</x-admin-layout>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // JavaScript to dynamically populate the modal with user data
    var deleteUserModal = document.getElementById('deleteUserModal');
    deleteUserModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var id = button.getAttribute('data-id'); // Get the user ID
        var name = button.getAttribute('data-name'); // Get the user name
        var role = button.getAttribute('data-role'); // Get the user role(s)

        // Set the user name and role(s) in the modal
        document.getElementById('userName').textContent = name;
        document.getElementById('userRole').textContent = role;

        // Update the modal's delete button action with user ID
        document.getElementById('confirmDeleteButton').setAttribute('data-id', id);

        // Update the form's hidden fields
        var form = document.getElementById('deleteUserForm');
        form.querySelector('input[name="user_id"]').value = id;
        form.querySelector('input[name="user_roles"]').value = role;
    });

    // Function to handle user deletion
    function deleteUser() {
        var userId = document.getElementById('confirmDeleteButton').getAttribute('data-id');
        var form = document.getElementById('deleteUserForm');

        // Show loading spinner
        Swal.fire({
            title: 'Deleting...',
            text: 'Please wait while we process your request.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(form.action, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                    }).then(() => {
                        $('#deleteUserModal').modal('hide'); // Close the modal
                        location.reload(); // Reload the page
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred. Please try again.',
                });
            });
    }
</script>
