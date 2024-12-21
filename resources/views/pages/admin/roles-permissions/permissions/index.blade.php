{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<x-admin-layout>
    <x-slot name="title">Permission Management</x-slot>
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
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-primary"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                data-bs-toggle="modal" data-bs-target="#editPermissionModal"
                                                data-id="{{ $permission->id }}" data-name="{{ $permission->name }}">
                                                Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-danger"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                data-bs-toggle="modal" data-bs-target="#deletePermissionModal"
                                                data-id="{{ $permission->id }}" data-name="{{ $permission->name }}">
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

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

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
