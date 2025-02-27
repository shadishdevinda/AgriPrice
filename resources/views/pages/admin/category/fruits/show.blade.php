
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
            <h3 class="text-white">Show Fruit</h3>
          </div>

        <div class="card-body">
            
            <div class="form-group">
                <div class="md-3">
                    <label for="name">Name</label>
                    <p>{{$fruit->name}}</p>
                </div>

                <div class="md-3">
                    <label for="advices">Description</label>
                    <p>{!! $fruit->description !!}</p>
                </div>
                
                <div class="md-3">
                    <label for="bprice">Wholesale_Price</label>
                    <p>{{$fruit->Wholesale_Price}}</p>
                </div>
                <div class="md-3">
                    <label for="sprice">Retail_Price</label>
                    <p>{{$fruit->Retail_Price}}</p>
                </div>
                
                <div class="md-3">
                    <label for="image">Image</label>
                    <img class="w-50 h-auto my-4" src="{{ asset('uploads/fruit/' . $fruit->image) }}" alt="Fruit Image" style="width: 50px; height: 50px;">
                    
                </div>
                
            </div>
            
        </div>
        </div>
    </div>
    </div>
</div>

</x-admin-layout>