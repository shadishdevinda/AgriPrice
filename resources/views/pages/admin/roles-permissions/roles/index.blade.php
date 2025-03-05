{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<x-admin-layout>
    <x-slot name="title">Role Management</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-12 ms-3 me-3">

                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0"><i class="fas fa-user-shield" style="margin-right: 10px;"></i>Roles
                            Management</h3>
                        <button type="button"
                            class="btn btn-dark float-end border border-white d-flex align-items-center gap-2 justify-content-end"
                            data-bs-toggle="modal" data-bs-target="#createRoleModal">
                            <i class="fas fa-plus"></i> <span>Add New Role</span>
                        </button>
                    </div>

                    <!-- Filter Section -->
                    <div class="card-body bg-light">
                        <form action="{{ route('roles.index') }}" method="GET">
                            <div class="input-group">
                                <select name="role_id" id="roles" class="form-select select2"
                                    onchange="this.form.submit()">
                                    <option value="">Search a role to filter</option>
                                    @foreach ($roles as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ request('role_id') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped mt-3">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Id</th>
                                    <th style="width: 30%">Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($roleList->isNotEmpty())
                                    @foreach ($roleList as $role)
                                        <tr style="text-align: center;">
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td style="display: flex; justify-content: center; gap: 5%;">
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-warning"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-bs-toggle="modal" data-bs-target="#editRoleModal"
                                                    data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                                                    <i class="fas fa-edit"></i> <span>Edit</span>
                                                </button>

                                                <!-- Add / Edit Permission Button -->
                                                <button type="button" class="btn btn-success"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-bs-toggle="modal" data-bs-target="#givePermissionModal"
                                                    data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                                                    <i class="fas fa-plus"></i> <span>Add / Edit Permission</span>
                                                </button>

                                                <!-- Delete Button -->
                                                <button type="button" class="btn btn-danger"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-bs-toggle="modal" data-bs-target="#deleteRoleModal"
                                                    data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                                                    <i class="fas fa-trash"></i> <span>Delete</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No roles found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="d-flex justify-content-end mt-3">
                            {{ $roleList->links() }}
                        </div>
                    </div>
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

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

    // Initialize select2 on the permissions select input
    $(document).ready(function() {
        $('#roles').select2({
            placeholder: "Search a role to filter",
            allowClear: true
        });
    });
</script>
