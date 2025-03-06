{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- FontAwesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Custom styles --}}
<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
    }

    .btn-custom {
        background-color: #065744;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
    }

    .btn-custom:hover {
        background-color: #065744;
        color: white;
    }
</style>

<x-admin-layout>

    <x-slot name="title">Economic Center User Management</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">

                    <!-- Card Header -->
                    <div class="card-header bg-dark">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-user-shield"></i> Give Economic Center User Permissions
                        </h3>
                        <a href="{{ route('economic-center-user.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body">
                        <form action="{{ route('economic.center.users.give-permissions', $user->id) }}" method="POST"
                            id="givePermission">
                            @csrf
                            @method('PUT')

                            {{-- User Name and Role --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="role">User Name</label>
                                    <x-input type="text" class="form-control" name="name" id="name"
                                        value="{{ $user->name }}" readonly />
                                </div>
                                <div class="col-md-6">
                                    <label for="role">User Role</label>
                                    <x-input type="text" class="form-control" name="role" id="role"
                                        value="{{ $user->getRoleNames()->implode(', ') }}" readonly />
                                </div>
                            </div>

                            {{-- Permission list --}}
                            <div class="form-group">
                                <label for="permission">Permissions</label>
                                @foreach ($permissions as $permission)
                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                                {{ in_array($permission->id, $user->permissions->pluck('id')->toArray()) ? 'checked' : '' }} />
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save"></i> Update User with Permission/s
                                    </button>
                                </div>
                            </div>
                        </form>
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

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Initial form submission handler (unchanged)
    document.getElementById('givePermission').addEventListener('submit', function(e) {
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
                console.error('Error Response:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'An unexpected error occurred.',
                });
            });
    });
</script>
