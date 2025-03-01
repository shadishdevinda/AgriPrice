<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<style>
    .vegetable-image {
        text-align: center;
        vertical-align: middle;
    }
    .vegetable-image img {
        display: block;
        margin: 0 auto;
    }
</style>

<x-admin-layout>
    <x-slot name="title">Vegetable</x-slot>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="row d-flex justify-content-center">
                @if (Session::has('success'))
                    <div class="col-md-10 mt-4">
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    </div>
                @endif
                <div class="col-md-10">
                </div>
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg my-4">
                        <div class="card-header bg-dark">
                            <h3 class="text-white">Vegetables
                                <a href="{{ route('vegetable.create') }}"
                                    class="btn btn-dark float-end border border-white  justify-content-end ">Create</a>
                        </div>
                        </h3>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Wholesale_Price</th>
                                <th>Retail_Price</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            @if ($vegetables->isNotEmpty())
                                <!-- Correct the check to use $products -->
                                @foreach ($vegetables as $vegetable)
                                    <!-- Fix the typo here -->
                                    <tr>
                                        <td>{{ $vegetable->id }}</td>
                                        <td>{{ $vegetable->name }}</td>
                                        <td>{{ $vegetable->description }}</td>
                                        <td>{{ $vegetable->Wholesale_Price }}</td>
                                        <td>{{ $vegetable->Retail_Price }}</td>
                                        <td class="vegetable-image">
                                            @if ($vegetable->image)
                                                <img src="{{ asset('storage/' . $vegetable->image) }}"
                                                    alt="Vegetable Photo" class="rounded-circle" width="50"
                                                    height="50">
                                            @else
                                                <img src="{{ asset('images/default-vegetable/vegetables.jpg') }}"
                                                    alt="Default Photo" class="rounded-circle" width="50"
                                                    height="50">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('vegetable.edit', $vegetable->id) }}"
                                                class="btn btn-dark">Edit</a>
                                            <a href="{{ route('vegetable.show', $vegetable->id) }}"
                                                class="btn btn-dark">Show</a>
                                            <button type="button" class="btn btn-danger"
                                                onclick="deleteProduct({{ $vegetable->id }})">Delete</button>

                                            <!-- Hidden delete form -->
                                            <form id="delete-product-form{{ $vegetable->id }}"
                                                action="{{ route('vegetable.destroy', $vegetable->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No products found</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete this product?")) {
            document.getElementById('delete-product-form' + id).submit();
        }
    }
</script>
