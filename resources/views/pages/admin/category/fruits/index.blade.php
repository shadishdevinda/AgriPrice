

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<x-admin-layout>
    <x-slot name="title">Fruit</x-slot>
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
            <div class="card border-0 shadow-lg my-4">
              <div class="card-header bg-dark">
                <h3 class="text-white">Fruits
                    <a href="{{ route('fruit.create') }}" class="btn btn-dark float-end border border-white  justify-content-end ">Create</a>
                </h3>
              </div>
              
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered md-10">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Wholesale_Price</th>
                        <th>Retail_Price</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if ($fruit->isNotEmpty()) <!-- Correct the check to use $products -->
                      @foreach ($fruit as $fruit) <!-- Fix the typo here -->
                      <tr>
                        <td>{{ $fruit->id }}</td>
                        <td>
                            @if ($fruit->image)
                                <img  src="{{ asset('uploads/fruit/' . $fruit->image) }}" alt="fruit Image" style="width: 50px; height: 50px;">
                            @else
                                No image
                            @endif
                        </td>
                        
                        </td>
                        <td>{{ $fruit->name }}</td>
                        <td>{{ $fruit->description }}</td>
                        <td>{{ $fruit->Wholesale_Price }}</td>
                        <td>{{ $fruit->Retail_Price }}</td>
                        <td>
                          <a href="{{ route('fruit.edit', $fruit->id) }}" class="btn btn-dark">Edit</a>
                          <a href="{{ route('fruit.show', $fruit->id) }}" class="btn btn-dark">Show</a>
                          <button type="button" class="btn btn-danger" onclick="deleteProduct({{ $fruit->id }})">Delete</button>
                      
                          <!-- Hidden delete form -->
                          <form id="delete-product-form{{ $fruit->id }}" action="{{ route('fruit.destroy', $fruit->id) }}" method="POST" style="display: none;">
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
                    </tbody>
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



