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
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th width="20%">Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach --}}
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
