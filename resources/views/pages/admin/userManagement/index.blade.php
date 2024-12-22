{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<x-admin-layout>

    <x-slot name="title">User Management</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">User Management
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createUserModal">
                                Add User
                            </button>
                        </h5>
                    </div>
                    <table class="table table-bordered table-striped mt-3">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Name</th>
                                <th width="30%">Email</th>
                                <th>Role</th>
                                <th width="30%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr style="text-align: center;">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-warning"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#editUserModal"
                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}" data-user_type="{{ $user->user_type }}"
                                            data-profile_photo="{{ asset('storage/profile-photos/' . $user->profile_photo) }}">
                                            Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-danger"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                            data-role="{{ $user->role }}">
                                            Delete
                                        </button>

                                        <!-- Assign Role Buttons -->
                                        <button type="button" class="btn btn-success"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#givePermissionModal"
                                            data-id="{{ $user->id }}">
                                            Assign Role
                                        </button>

                                        <!-- Assign Permission Buttons -->
                                        <button type="button" class="btn btn-info"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#givePermissionModal"
                                            data-id="{{ $user->id }}" data-name="{{ $user->role }}">
                                            Assign Permission
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    @include('pages.admin.userManagement.create')

    <!-- Edit User Modal -->
    @include('pages.admin.userManagement.edit')

    <!-- Delete User Modal -->
    @include('pages.admin.userManagement.delete')

    <!-- Give Role Modal -->
    @include('pages.admin.userManagement.assign-role')

    <!-- Assign Permission Modal -->
    @include('pages.admin.userManagement.assign-permission')
</x-admin-layout>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    // JavaScript to dynamically populate the modal with user data
    var editUserModal = document.getElementById('editUserModal');
    editUserModal.addEventListener('show.bs.modal', function(event) {
        // Get the button that triggered the modal
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-id');
        var userName = button.getAttribute('data-name');
        var userEmail = button.getAttribute('data-email');
        var userType = button.getAttribute('data-user_type');
        var profilePhoto = button.getAttribute('data-profile_photo');

        // Find the form and input fields inside the modal
        var form = editUserModal.querySelector('form');
        var inputName = form.querySelector('#name');
        var inputEmail = form.querySelector('#email');
        var inputUserType = form.querySelector('#user_type');
        var inputPassword = form.querySelector('#password'); // Password remains empty for the user to fill
        var profilePhotoPreview = form.querySelector('#profile_photo_preview');

        // Populate the modal fields
        inputName.value = userName;
        inputEmail.value = userEmail;
        inputUserType.value = userType;
        inputPassword.value = ''; // Clear password field

        // Display the existing profile photo (if available)
        if (profilePhoto) {
            profilePhotoPreview.src = profilePhoto;
            profilePhotoPreview.style.display = 'block';
        } else {
            profilePhotoPreview.style.display = 'none';
        }
    });

    // JavaScript to dynamically populate the modal with user data
    // JavaScript to dynamically populate the modal with user data
    var deleteUserModal = document.getElementById('deleteUserModal');
    deleteUserModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var id = button.getAttribute('data-id'); // Get the user ID
        var name = button.getAttribute('data-name'); // Get the user name
        var role = button.getAttribute('data-role'); // Get the user role
        var form = document.getElementById('deleteUserForm'); // The form inside the modal

        // Set the user name and role in the modal
        document.getElementById('userName').textContent = name;
        document.getElementById('userRole').textContent = role;

        // Update the modal's delete button action with user ID
        document.getElementById('confirmDeleteButton').setAttribute('data-id', id);
    });


    // JavaScript to dynamically populate the modal with role and permissions data
    document.getElementById('givePermissionModal').addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var roleId = button.getAttribute('data-id');
        var roleName = button.getAttribute('data-name');

        // Set role name in the modal
        document.getElementById('role_name').value = roleName;

        // Set the form action to the give-permissions route for the specific role
        var form = document.getElementById('givePermissionForm');
        form.action = "{{ route('roles.give-permissions', ':id') }}".replace(':id', roleId);
    });
</script>
