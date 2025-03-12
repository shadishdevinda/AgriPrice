{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<style>
    /* Card Styling */
    .card {
        background: #007b5a59;
        border-radius: 20px;
        border: 2px solid white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-body {
        display: flex;
        gap: 30px;
    }

    .card-img {
        color: white;
        width: 50px;
        /* Adjust size as needed */
        height: 50px;
        /* Adjust size as needed */
        justify-content: end;
    }

    /* Hover effect for cards */
    .card:hover {
        box-shadow: 0 6px 12px rgba(255, 255, 255, 0.508);
    }

    /* Card Body */
    .card-text {
        margin-right: 10px;
        width: 200px
    }

    .card-text h1 {
        font-size: 20px;
        font-weight: bold;
    }

    .card-text p {
        font-size: 20px;
        padding-left: 10px
    }

    /* Link Styling */
    .card a {
        text-decoration: none;
        display: block;
        color: inherit;
    }
</style>

<x-admin-layout>

    <x-slot name="title">Dashboard</x-slot>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h1>Vegetables</h1>
                            <p>{{ $vegetableCount }}</p> <!-- Displays vegetable count -->
                        </div>
                        <div class="card-img">
                            <img src="\images\ad1.png" alt="">
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h1>Fruit</h1>
                            <p>{{ $fruitCount }}</p> <!-- Displays fruit count -->
                        </div>
                        <div class="card-img">
                            <img src="\images\ad2.png" alt="">
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h1>Economic Center</h1>
                            <p>{{ $economicCenter }}</p> <!-- Displays vegetable count again -->
                        </div>
                        <div class="card-img">
                            <img src="\images\ad3.png" alt="">
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">
                        <h5 class="card-title text-white" >System User Management</h5>
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

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
