{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<x-admin-layout>
    <x-slot name="title">Permission Management</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-12 ms-3 me-3">

                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0"><i class="fas fa-user-shield" style="margin-right: 10px;"></i>
                            Permissions Management</h3>
                        <button type="button"
                            class="btn btn-dark float-end border border-white d-flex align-items-center gap-2 justify-content-end"
                            data-bs-toggle="modal" data-bs-target="#createPermissionModal">
                            <i class="fas fa-plus"></i> <span>Add New Permission</span>
                        </button>
                    </div>

                    <!-- Filter Section -->
                    <div class="card-body bg-light">
                        <form action="{{ route('permissions.index') }}" method="GET">
                            <div class="row">
                                <div class="col-12 col-md-8 mx-auto">
                                    <div class="input-group">
                                        <select name="permission_id" id="permissions" class="form-select select2"
                                            onchange="this.form.submit()">
                                            <option value="">Search a permission to filter</option>
                                            @foreach ($permissions as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ request('permission_id') == $id ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped mt-3">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Id</th>
                                    <th>Permission</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($permissionsList->isNotEmpty())
                                    @foreach ($permissionsList as $permission)
                                        <tr style="text-align: center;">
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td style="display: flex; justify-content: center; gap: 10%;">
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-warning"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-bs-toggle="modal" data-bs-target="#editPermissionModal"
                                                    data-id="{{ $permission->id }}" data-name="{{ $permission->name }}">
                                                    <i class="fas fa-edit"></i> <span>Edit</span>
                                                </button>

                                                <!-- Delete Button -->
                                                <button type="button" class="btn btn-danger"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-bs-toggle="modal" data-bs-target="#deletePermissionModal"
                                                    data-id="{{ $permission->id }}" data-name="{{ $permission->name }}">
                                                    <i class="fas fa-trash"></i> <span>Delete</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No permissions found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="d-flex justify-content-end mt-3">
                            {{ $permissionsList->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include the Create Permission Modal -->
        @include('pages.admin.roles-permissions.permissions.create')

        {{-- Include the Edit Permission Modal --}}
        @include('pages.admin.roles-permissions.permissions.edit')

        {{-- Include the Delete Permission Modal --}}
        @include('pages.admin.roles-permissions.permissions.delete')

</x-admin-layout>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // JavaScript to dynamically populate the modal with permission data
    var editPermissionModal = document.getElementById('editPermissionModal')
    editPermissionModal.addEventListener('show.bs.modal', function(event) {
        // Get the button that triggered the modal
        var button = event.relatedTarget
        var permissionId = button.getAttribute('data-id')
        var permissionName = button.getAttribute('data-name')

        // Find the form and input fields inside the modal
        var form = editPermissionModal.querySelector('form')
        var input = form.querySelector('#name')

        // Set the form action URL (to update the specific permission)
        form.action = "{{ route('permissions.update', ':id') }}".replace(':id', permissionId)

        // Set the input value to the current permission name
        input.value = permissionName
    })

    // JavaScript to dynamically populate the modal with permission data
    var deletePermissionModal = document.getElementById('deletePermissionModal');
    deletePermissionModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var form = document.getElementById('deletePermissionForm');

        // Set the permission name in the modal
        document.getElementById('permissionName').textContent = name;

        // Set the form action to the delete route for the specific permission
        form.action = "{{ route('permissions.destroy', ':id') }}".replace(':id', id);
    });

    // Initialize select2 on the permissions select input
    $(document).ready(function() {
        $('#permissions').select2({
            placeholder: "Search a permission to filter",
            allowClear: true
        });
    });
</script>
