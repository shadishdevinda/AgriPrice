<x-admin-layout>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Permissions
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createPermissionModal">
                                Create Permission
                            </button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Permission</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editPermissionModal" data-id="{{ $permission->id }}"
                                                data-name="{{ $permission->name }}">
                                                Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deletePermissionModal" data-id="{{ $permission->id }}"
                                                data-name="{{ $permission->name }}">
                                                Delete
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

        <!-- Include the Create Permission Modal -->
        @include('pages.admin.roles-permissions.permissions.create')

        {{-- Include the Edit Permission Modal --}}
        @include('pages.admin.roles-permissions.permissions.edit')

        {{-- Include the Delete Permission Modal --}}
        @include('pages.admin.roles-permissions.permissions.delete')

</x-admin-layout>


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
</script>
