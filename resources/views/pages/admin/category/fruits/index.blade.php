<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- Custom Styles -->
<style>
    .fruit-image {
        text-align: center;
        vertical-align: middle;
    }

    .fruit-image img {
        display: block;
        margin: 0 auto;
    }
</style>

<x-admin-layout>
    <x-slot name="title">Fruit</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <!-- Success Message -->
            @if (Session::has('success'))
                <div class="col-md-10 mt-4">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif

            <!-- Card for Fruit Table -->
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <!-- Card Header -->
                    <div class="card-header bg-dark">
                        <h3 class="text-white d-flex justify-content-between align-items-center">
                            Fruits
                            <a href="{{ route('fruit.create') }}" class="btn btn-dark border border-white">
                                Create
                            </a>
                        </h3>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Fruit Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Wholesale Price</th>
                                    <th>Retail Price</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($fruits->isNotEmpty())
                                    @foreach ($fruits as $fruit)
                                        <tr>
                                            <td>{{ $fruit->id }}</td>
                                            <td>{{ $fruit->name }}</td>
                                            <td>{{ $fruit->description }}</td>
                                            <td>{{ $fruit->Wholesale_Price }}</td>
                                            <td>{{ $fruit->Retail_Price }}</td>
                                            <td class="fruit-image">
                                                @if ($fruit->image)
                                                    <img src="{{ asset('storage/' . $fruit->image) }}" alt="Fruit Photo" class="rounded-circle" width="50" height="50">
                                                @else
                                                    <img src="{{ asset('images/default-fruit/fruits.jpg') }}" alt="Default Photo" class="rounded-circle" width="50" height="50">
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-warning btn-sm"
                                                        onclick="window.location.href='{{ route('fruit.edit', $fruit->id) }}'">
                                                    Edit
                                                </button>

                                                <!-- Show Button -->
                                                <button type="button" class="btn btn-dark btn-sm"
                                                        onclick="window.location.href='{{ route('fruit.show', $fruit->id) }}'">
                                                    Show
                                                </button>

                                                <!-- Delete Button -->
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="deleteProduct({{ $fruit->id }})">
                                                    Delete
                                                </button>

                                                <!-- Hidden Delete Form -->
                                                <form id="delete-product-form{{ $fruit->id }}"
                                                      action="{{ route('fruit.destroy', $fruit->id) }}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No fruits found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<!-- Delete Product Script -->
<script>
    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete this product?")) {
            document.getElementById('delete-product-form' + id).submit();
        }
    }
</script>
