
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<x-admin-layout>
    <x-slot name="title">Vegetable Advice</x-slot>

    <div class="bg-dark py-3">
      <h1 class="text-white text-center">Vegetable Advice List</h1>
    </div>
    <div class="container">
      <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
          <a href="{{route('vegetable_advice.index')}}" class="btn btn-dark">Back</a>
        </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card border-0 shadow-lg my-4">
            <div class="card-header bg-dark">
              <h3 class="text-white">Edit Vegetable Advice</h3>
            </div>
            <form enctype="multipart/form-data" action="{{route('vegetable_advice.update',$vegetableAdvice->id)}}" method="POST">
              @method('put')
                @csrf
            <div class="card-body">
                  <div class="mb-3">
                    <label for="" class="form-label h5">Description</label>
                    <textarea class="form-control" name="description" cols="30" rows="5">{{old('description',$vegetableAdvice->description)}}</textarea>
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
