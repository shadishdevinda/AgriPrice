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

    <x-slot name="title">System User Management</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-12 ms-3 me-3">

                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0"><i class="fas fa-user-shield" style="margin-right: 10px;"></i>System User Management</h3>
                        <a href="{{ route('users.create') }}"
                            class="btn btn-dark float-end border border-white d-flex align-items-center gap-2 justify-content-end">
                            <i class="fas fa-plus"></i> <span>Add System User</span>
                        </a>
                    </div>

                    <!-- Filter Section -->
                    <div class="card-body bg-light">
                        <form action="{{ route('users.index') }}" method="GET">
                            <div class="input-group">
                                <select name="user_id" id="users" class="form-select select2"
                                    onchange="this.form.submit()">
                                    <option value="">Select a user's ID/Name/Email to filter</option>
                                    @foreach ($userOptions as $id => $details)
                                        <option value="{{ $id }}"
                                            {{ request('user_id') == $id ? 'selected' : '' }}>
                                            {{ $details }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead style="text-align: center;">
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th width="30%">Email</th>
                                    <td><b>Photo</b></th>
                                    <th>Roles</th>
                                    <th width="30%">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                @if ($users->isNotEmpty())
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
                                                    <img src="{{ asset('images/default-user/user.png') }}"
                                                        alt="Default Photo" class="rounded-circle" width="50"
                                                        height="50">
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
                                                    <button type="button"
                                                        class="btn btn-warning d-flex align-items-center gap-1"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        onclick="window.location.href='{{ route('users.edit', $user->id) }}'">
                                                        <i class="fas fa-edit"></i> <span>Edit</span>
                                                    </button>

                                                    <!-- Assign Permission Buttons -->
                                                    <a href="{{ route('system.users.permissions', $user->id) }}"
                                                        class="btn btn-info"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                        <i class="fas fa-user"></i> <span>Assign Permission</span>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm d-flex align-items-center gap-1"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}', '{{ $user->getRoleNames()->implode(', ') }}')">
                                                        <i class="fas fa-trash"></i> <span>Delete</span>
                                                    </button>
                                                </div>

                                                <!-- Hidden delete form -->
                                                <form id="delete-system-user-form" action="" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">No users found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end mt-3">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-admin-layout>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Initialize select2 on the users select input
    $(document).ready(function() {
        $('#users').select2({
            placeholder: "Select a user's ID/Name/Email",
            allowClear: true
        });
    });

    function confirmDelete(userId, userName, userRole) {
        Swal.fire({
            title: 'Are you sure?',
            html: `You are about to delete the user: <br>User Name: <strong>${userName}</strong><br>Role: <strong>${userRole}</strong><br>This action cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteUser(userId);
            }
        });
    }

    function deleteUser(userId) {
        const url = `/system/users/${userId}`; // Use the correct route structure

        // Show loading spinner
        Swal.fire({
            title: 'Deleting...',
            text: 'Please wait while we delete the system user.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    _method: 'DELETE' // Simulate DELETE request
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Store success message in localStorage
                    localStorage.setItem('deleteSuccess', 'The user has been deleted successfully.');

                    // Reload the page
                    window.location.reload();
                } else {
                    Swal.fire('Error!', data.message || 'An error occurred while deleting the user.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'An unexpected error occurred while deleting the user.', 'error');
            });
    }

    // Show success message after page reload
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = localStorage.getItem('deleteSuccess');
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: successMessage,
                confirmButtonText: 'Okay'
            });

            // Remove the success message from localStorage after showing it
            localStorage.removeItem('deleteSuccess');
        }
    });
</script>
