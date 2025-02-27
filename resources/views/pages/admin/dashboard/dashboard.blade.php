{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



<x-admin-layout>
    
    <x-slot name="title">Dashboard</x-slot>
    <div class="row">
        <div class="card">
            <a href="{{ route('admin.dashboard.vegetableShow') }}">
                <div class="card-body">
                    <h1>Vegetables</h1>
                    <p>{{ $vegetableCount }}</p>  <!-- Displays vegetable count -->
                </div>
            </a>
        </div>

        <div class="card">
            <a href="{{ route('admin.dashboard.fruitShow') }}">
                <div class="card-body">
                    <h1>Fruit</h1>
                    <p>{{ $fruitCount }}</p>  <!-- Displays fruit count -->
                </div>
            </a>
        </div>

        <div class="card">
            <a href="{{ route('admin.dashboard.economicCentersShow') }}">
                <div class="card-body">
                    <h1>Economic Center</h1>
                    <p>{{ $economicCenter }}</p>  <!-- Displays vegetable count again -->
                </div>
            </a>
        </div>
    </div>


    <x-slot name="title">System User Management</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">System User Management</h5>
                    </div>
                    <table class="table table-bordered table-striped mt-3" id="usersTable">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Name</th>
                                <th width="30%">Email</th>
                                <th>Roles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr style="text-align: center;">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $role)
                                                <span class="badge bg-success">{{ $role }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

    
    



<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f4f4f4;
    padding: 20px;
}

/* Dashboard row layout */
.row {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
    gap: 20px;
    padding-top: 50px;
    padding-left:200px;
    padding-right:200px;
}

/* Card Styling */
.card {
    background: #007b5a59;
    border-radius: 20px;
    border: 2px solid white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

/* Hover effect for cards */
.card:hover {
    box-shadow: 0 6px 12px rgba(255, 255, 255, 0.508);
}

/* Card Body */
.card-body h1 {
    font-size: 22px;
    color: #040404;
    margin-bottom: 10px;
}

.card-body p {
    font-size: 16px;
    color: #000000b8;
}

/* Link Styling */
.card a {
    text-decoration: none;
    display: block;
    color: inherit;
}

</style>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
