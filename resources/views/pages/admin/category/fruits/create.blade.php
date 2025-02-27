
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<x-admin-layout>

    <x-slot name="title">Fruit</x-slot>

    <div class="bg-dark py-3">
      <h1 class="text-white text-center">Fruit List</h1>
    </div>
    <div class="container">
      <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
          <a href="{{route('fruit.index')}}" class="btn btn-dark">Back</a>
        </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card border-0 shadow-lg my-4">
            <div class="card-header bg-dark">
              <h3 class="text-white">Create Fruit</h3>
            </div>
            <form enctype="multipart/form-data" action="{{route('fruit.store')}}" method="POST">
              @csrf
            <div class="card-body">
              <div class="mb-3 ps-1"> 
                <label for="" class="form-label h5">Name</label>
                <input value="{{old('name')}}" type="text" class=" @error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="name">
                @error('name')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
              </div>

              <div class="mb-3">
                <label for="" class="form-label h5">Description</label>
                <textarea class="form-control" name="description" cols="30" rows="5">{{old('description')}}</textarea>
              </div>

              <div class="mb-3">
                <label for="" class="form-label h5">Wholesale_Price</label>
                <input  value="{{old('Wholesale_Price')}}" type="text" class="@error('Wholesale_Price') is-invalid @enderror form-control form-control-lg" placeholder="Wholesale_Price" name="Wholesale_Price">
                @error('Wholesale_Price')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
              </div>

              <div class="mb-3">
                <label for="" class="form-label h5">Retail_Price</label>
                <input value="{{old('Retail_Price')}}" type="text" class="@error('Retail_Price') is-invalid @enderror form-control form-control-lg" placeholder="Retail_Price" name="Retail_Price">
                @error('Retail_Price')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
              </div>
              
              <div class="mb-3">
                <label for="" class="form-label h5">Image</label>
                <input type="file" class="form-control form-control-lg" placeholder="Image" name="image">
                
              </div>
              <div class="d-grid">
                <button class="btn btn-lg btn-primary">submit</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
</x-admin-layout>