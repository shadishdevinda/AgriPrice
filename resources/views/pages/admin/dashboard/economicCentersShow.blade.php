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
                    <div class="card-header bg-dark">
                        <h5 class="card-title text-white">Economic Center Management

                            <a href="{{route('admin.dashboard')}}" class="btn btn-dark float-end border border-white  justify-content-end">Back</a>
                        </h5>
                    </div>
                    <table class="table table-bordered table-striped mt-3" id="economicCentersTable">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Center Name</th>
                                <th width="30%">Address</th>
                                <th>Contact Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($economicCenters as $economicCenter)
                                <tr style="text-align: center;">
                                    <td>{{ $economicCenter->id }}</td>
                                    <td>{{ $economicCenter->center_name }}</td>
                                    <td>{{ $economicCenter->center_location }}</td>
                                    <td>{{ $economicCenter->contact_number }}</td>
                                    
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

   
</x-admin-layout>

