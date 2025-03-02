<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<x-admin-layout>
    <x-slot name="title">Vegetable</x-slot>

    <div class="bg-dark py-3">
        <h1 class="text-white text-center">Product List</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-12"> <!-- Use col-12 to take full width -->
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit Product
                            <a href="{{ route('vegetable.index') }}" class="btn btn-dark float-end border border-white">Back</a>
                        </h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('vegetable.update', $vegetable->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="card-body p-4"> <!-- Added padding -->
                            <div class="mb-3"> 
                                <label for="" class="form-label h5">Name</label>
                                <input value="{{ old('name', $vegetable->name) }}" type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="name">
                                @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Description</label>
                                <textarea class="form-control" name="description" cols="30" rows="5">{{ old('description', $vegetable->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Wholesale Price</label>
                                <input value="{{ old('Wholesale_Price', $vegetable->Wholesale_Price) }}" type="text" class="@error('Wholesale_Price') is-invalid @enderror form-control form-control-lg" placeholder="Wholesale Price" name="Wholesale_Price">
                                @error('Wholesale_Price')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Retail Price</label>
                                <input value="{{ old('Retail_Price', $vegetable->Retail_Price) }}" type="text" class="@error('Retail_Price') is-invalid @enderror form-control form-control-lg" placeholder="Retail Price" name="Retail_Price">
                                @error('Retail_Price')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Image</label>
                                <input type="file" class="form-control form-control-lg" placeholder="Image" name="image">
                                @if ($vegetable->image)
                                <img class="w-50 h-auto my-4" src="{{ asset('uploads/vegetable/' . $vegetable->image) }}" alt="Vegetable Image">
                                @endif
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>