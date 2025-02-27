
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<x-admin-layout>
    <x-slot name="title">Vegetable</x-slot>
      <div class="container">
        <div class="row justify-content-center mt-4">
          <div class="col-md-10 d-flex justify-content-end">
            
        </div>
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
                  <a href="{{route('admin.dashboard')}}" class="btn btn-dark float-end border border-white  justify-content-end">Back</a>
                </h3>     
          </div>
                
              </div>
              
              <div class="card-body">
                <table class="table">
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Wholesale_Price</th>
                    <th>Retail_Price</th>
                    
                  </tr>
                  @if ($vegetable->isNotEmpty()) <!-- Correct the check to use $products -->
                  @foreach ($vegetable as $vegetable) <!-- Fix the typo here -->
                  <tr>
                    <td>{{ $vegetable->id }}</td>
                    <td>
                        @if ($vegetable->image)
                            <img  src="{{ asset('uploads/vegetable/' . $vegetable->image) }}" alt="Vegetable Image" style="width: 50px; height: 50px;">
                        @else
                            No image
                        @endif
                    </td>
                    
                    </td>
                    <td>{{ $vegetable->name }}</td>
                    <td>{{ $vegetable->description }}</td>
                    <td>{{ $vegetable->Wholesale_Price }}</td>
                    <td>{{ $vegetable->Retail_Price }}</td>
                    
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
