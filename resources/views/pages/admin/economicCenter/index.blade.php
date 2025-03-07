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

    <x-slot name="title">Economic Center Management</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-12 ms-3 me-3">

                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0"><i class="fas fa-building" style="margin-right: 10px;"></i>Economic Center Management</h3>
                        <a href="{{ route('economic-centers.create') }}"
                            class="btn btn-dark float-end border border-white d-flex align-items-center gap-2 justify-content-end">
                            <i class="fas fa-plus"></i> </i><span>Add Economic Center</span>
                        </a>
                    </div>

                    <!-- Filter Section -->
                    <div class="card-body bg-light">
                        <form action="{{ route('economic-centers.index') }}" method="GET">
                            <div class="input-group">
                                <select name="economicCenter_id" id="economic-centers" class="form-select select2"
                                    onchange="this.form.submit()">
                                    <option value="">Select a user's ID/Economic Center Name</option>
                                    @foreach ($userOptions as $id => $details)
                                        <option value="{{ $id }}"
                                            {{ request('economicCenter_id') == $id ? 'selected' : '' }}>
                                            {{ $details }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Card Body - Economic Center Table -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead style="text-align: center;">
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Center Name</th>
                                    <td><b>Photo</b></th>
                                    <th width="30%">Address</th>
                                    <th>Contact Number</th>
                                    <th width="30%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($economicCenters as $economicCenter)
                                    <tr style="text-align: center;">
                                        <td>{{ $economicCenter->id }}</td>
                                        <td>{{ $economicCenter->center_name }}</td>
                                        <td class="center-image">
                                            @if ($economicCenter->profile_photo_path)
                                                <img src="{{ asset('storage/' . $economicCenter->profile_photo_path) }}"
                                                    alt="Profile Photo" class="rounded-circle" width="50"
                                                    height="50">
                                            @else
                                                <img src="{{ asset('images/default-center/economic-center.jpg') }}"
                                                    alt="Default Photo" class="rounded-circle" width="50"
                                                    height="50">
                                            @endif
                                        </td>
                                        <td>{{ $economicCenter->center_location }}</td>
                                        <td>{{ $economicCenter->contact_number }}</td>
                                        <td>
                                            <div class="d-flex justify-content-end gap-2">
                                                <!-- Edit Button -->
                                                <button type="button"
                                                    class="btn btn-warning d-flex align-items-center gap-1"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    onclick="window.location.href='{{ route('economic-centers.edit', $economicCenter->id) }}'">
                                                    <i class="fas fa-edit"></i> <span>Edit</span>
                                                </button>

                                                <!-- Assign Users Buttons -->
                                                <a href="{{ route('economic.center.assign.user', $economicCenter->id) }}"
                                                    class="btn btn-info"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-id="{{ $economicCenter->id }}"
                                                    data-name="{{ $economicCenter->center_name }}">
                                                    <i class="fas fa-user"></i> <span>Assign Users</span>
                                                </a>

                                                <!-- Delete Button -->
                                                <button type="button" class="btn btn-danger"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    onclick="confirmDelete('{{ $economicCenter->id }}', '{{ $economicCenter->center_name }}')">
                                                    <i class="fas fa-trash"></i> <span>Delete</span>
                                                </button>
                                            </div>

                                            <!-- Hidden delete form -->
                                            <form id="delete-economic-center-form" action="" method="POST"
                                                style="display: none;">
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
                            {{ $economicCenters->links() }}
                        </div>
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
    function confirmDelete(economicCenterId, economicCenterName) {
        Swal.fire({
            title: 'Are you sure?',
            html: `You are about to delete the economic center <br>Economic Center Name: <strong>${economicCenterName}</strong><br>This action cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteEconomicCenter(economicCenterId);
            }
        });
    }

    function deleteEconomicCenter(economicCenterId) {
        const url = `/economic-centers/${economicCenterId}`;

        Swal.fire({
            title: 'Deleting...',
            text: 'Please wait while we delete the economic center.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    localStorage.setItem('deleteSuccess', 'The economic center has been deleted successfully.');
                    window.location.reload();
                } else {
                    Swal.fire('Error!', data.message || 'An error occurred while deleting the economic center.',
                        'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'An unexpected error occurred while deleting the economic center.', 'error');
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

            localStorage.removeItem('deleteSuccess');
        }
    });

    // Initialize select2 on the Economic Center select input
    $(document).ready(function() {
        $('#economic-centers').select2({
            placeholder: "Select a Economic Center's ID/Name",
            allowClear: true
        });
    });
</script>
