{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<x-admin-layout>

    <x-slot name="title">Economic Center Management</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Economic Center Management

                            <a href="{{ route('economic-centers.create') }}" class="btn btn-primary float-end me-2">
                                Add Economic Center
                            </a>
                        </h5>
                    </div>
                    <table class="table table-bordered table-striped mt-3" id="economicCentersTable">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Center Name</th>
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
                                    <td>{{ $economicCenter->center_location }}</td>
                                    <td>{{ $economicCenter->contact_number }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('economic-centers.edit', $economicCenter->id) }}"
                                            class="btn btn-warning"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-danger"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#deleteEconomicCenterModal"
                                            data-id="{{ $economicCenter->id }}"
                                            data-name="{{ $economicCenter->center_name }}">
                                            Delete
                                        </button>

                                        <!-- Assign Users Buttons -->
                                        <a href="{{ route('economic.center.assign.user', $economicCenter->id) }}" class="btn btn-info"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-id="{{ $economicCenter->id }}"
                                            data-name="{{ $economicCenter->center_name }}">
                                            Assign Users
                                        </a>
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

    <!-- Delete User Modal -->
    @include('pages.admin.economicCenter.delete')
</x-admin-layout>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // JavaScript to dynamically populate the modal with economic center data
    var deleteEconomicCenterModal = document.getElementById('deleteEconomicCenterModal');
    deleteEconomicCenterModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var id = button.getAttribute('data-id'); // Get the economic center ID
        var name = button.getAttribute('data-name'); // Get the economic center name

        // Set the economic center name in the modal
        document.getElementById('centerName').textContent = name;

        // Update the modal's delete button with the economic center ID
        document.getElementById('confirmDeleteButton').setAttribute('data-id', id);
    });
</script>
