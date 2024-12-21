{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<x-admin-layout>
    <x-slot name="title">Role Management</x-slot>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Roles
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createRoleModal">
                                Create Role
                            </button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-warning"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                data-bs-toggle="modal" data-bs-target="#editRoleModal"
                                                data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                                                Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-danger"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                data-bs-toggle="modal" data-bs-target="#deleteRoleModal"
                                                data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                                                Delete
                                            </button>

                                            <!-- Add / Edit Permission Button -->
                                            <button type="button" class="btn btn-success"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                data-bs-toggle="modal" data-bs-target="#givePermissionModal"
                                                data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                                                Add / Edit Permission
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

        <!-- Include the Create Role Modal -->
        @include('pages.admin.roles-permissions.roles.create')

        {{-- Include the Edit Role Modal --}}
        @include('pages.admin.roles-permissions.roles.edit')

        {{-- Include the Delete Role Modal --}}
        @include('pages.admin.roles-permissions.roles.delete')

        {{-- Include the Give permissions to Role --}}
        @include('pages.admin.roles-permissions.roles.give-permissions')

</x-admin-layout>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    // JavaScript to dynamically populate the modal with role data
    var editRoleModal = document.getElementById('editRoleModal')
    editRoleModal.addEventListener('show.bs.modal', function(event) {
        // Get the button that triggered the modal
        var button = event.relatedTarget
        var roleId = button.getAttribute('data-id')
        var roleName = button.getAttribute('data-name')

        // Find the form and input fields inside the modal
        var form = editRoleModal.querySelector('form')
        var input = form.querySelector('#name')

        // Set the form action URL (to update the specific role)
        form.action = "{{ route('roles.update', ':id') }}".replace(':id', roleId)

        // Set the input value to the current role name
        input.value = roleName
    })

    // JavaScript to dynamically populate the modal with role data
    var deleteRoleModal = document.getElementById('deleteRoleModal');
    deleteRoleModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var form = document.getElementById('deleteRoleForm');

        // Set the role name in the modal
        document.getElementById('roleName').textContent = name;

        // Set the form action to the delete route for the specific role
        form.action = "{{ route('roles.destroy', ':id') }}".replace(':id', id);
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
