<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- Custom Styles -->
<style>
    .vegetable-image {
        text-align: center;
        vertical-align: middle;
    }

    .vegetable-image img {
        display: block;
        margin: 0 auto;
    }

    .fruit-image {
        text-align: center;
        vertical-align: middle;
    }

    .fruit-image img {
        display: block;
        margin: 0 auto;
    }
</style>

<x-market-layout>

    <x-slot name="title">Economic Center Dashboard</x-slot>

    <div class="d-flex">

        {{-- Vegetable --}}
        <div class="container">
            <div class="row justify-content-center mt-2">
                <div class="col-md-10 d-flex justify-content-end"></div>
                <div class="row d-flex justify-content-center">
                    @if (Session::has('success'))
                        <div class="col-md-10 mt-4">
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="col-md-20">
                        <div class="card border-0 shadow-lg my-4">
                            <div class="card-header bg-dark">
                                <h3 class="text-white">Vegetables</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered md-10">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Wholesale Price</th>
                                                <th>Retail Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($vegetables->isNotEmpty())
                                                @foreach ($vegetables as $vegetable)
                                                    <tr>
                                                        <td>{{ $vegetable->id }}</td>
                                                        <td class="vegetable-image">
                                                            @if ($vegetable->image)
                                                                <img src="{{ asset('storage/' . $vegetable->image) }}"
                                                                    alt="Vegetable Photo" class="rounded-circle"
                                                                    width="50" height="50">
                                                            @else
                                                                <img src="{{ asset('images/default-vegetable/vegetables.jpg') }}"
                                                                    alt="Default Photo" class="rounded-circle"
                                                                    width="50" height="50">
                                                            @endif
                                                        </td>
                                                        <td>{{ $vegetable->name }}</td>
                                                        <td>{{ $vegetable->description }}</td>
                                                        <td>
                                                            <input type="text"
                                                                value="{{ $vegetable->Wholesale_Price }}"
                                                                class="form-control wholesale-price"
                                                                data-id="{{ $vegetable->id }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{ $vegetable->Retail_Price }}"
                                                                class="form-control retail-price"
                                                                data-id="{{ $vegetable->id }}">
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-dark save-btn"
                                                                data-id="{{ $vegetable->id }}"
                                                                data-type="vegetable">Save</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center">No products found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Fruit --}}
        <div class="container">
            <div class="row justify-content-center mt-2">
                <div class="col-md-10 d-flex justify-content-end"></div>
                <div class="row d-flex justify-content-center">
                    @if (Session::has('success'))
                        <div class="col-md-10 mt-4">
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="col-md-20">
                        <div class="card border-0 shadow-lg my-4">
                            <div class="card-header bg-dark">
                                <h3 class="text-white">Fruit</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered md-10">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Wholesale Price</th>
                                                <th>Retail Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($fruits->isNotEmpty())
                                                @foreach ($fruits as $fruit)
                                                    <tr>
                                                        <td>{{ $fruit->id }}</td>
                                                        <td class="fruit-image">
                                                            @if ($fruit->image)
                                                                <img src="{{ asset('storage/' . $fruit->image) }}"
                                                                    alt="Fruit Photo" class="rounded-circle"
                                                                    width="50" height="50">
                                                            @else
                                                                <img src="{{ asset('images/default-fruit/fruits.jpg') }}"
                                                                    alt="Default Photo" class="rounded-circle"
                                                                    width="50" height="50">
                                                            @endif
                                                        </td>
                                                        <td>{{ $fruit->name }}</td>
                                                        <td>{{ $fruit->description }}</td>
                                                        <td>
                                                            <input type="text" value="{{ $fruit->Wholesale_Price }}"
                                                                class="form-control wholesale-price"
                                                                data-id="{{ $fruit->id }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{ $fruit->Retail_Price }}"
                                                                class="form-control retail-price"
                                                                data-id="{{ $fruit->id }}">
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-dark save-btn"
                                                                data-id="{{ $fruit->id }}"
                                                                data-type="fruit">Save</button>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center">No products found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-market-layout>

<script>
    document.querySelectorAll('.save-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const wholesalePrice = document.querySelector(`.wholesale-price[data-id="${id}"]`).value;
            const retailPrice = document.querySelector(`.retail-price[data-id="${id}"]`).value;

            // Determine which endpoint to use
            let endpoint;
            // You can use any condition to decide which endpoint to use
            // For example, if you have a data attribute on the button or some other logic
            if (this.getAttribute('data-type') === 'vegetable') {
                endpoint = `/vegetable/${id}`;
            } else if (this.getAttribute('data-type') === 'fruit') {
                endpoint = `/fruit/${id}`;
            }

            // Make an AJAX request to update the prices
            fetch(endpoint, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure CSRF token is included
                    },
                    body: JSON.stringify({
                        Wholesale_Price: wholesalePrice,
                        Retail_Price: retailPrice
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Prices updated successfully!');
                        // Optionally, you can refresh the page or update the UI accordingly
                    } else {
                        alert('Error updating prices: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating prices.');
                });
        });
    });
</script>
