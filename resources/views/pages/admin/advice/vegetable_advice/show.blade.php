
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<x-admin-layout>
    <x-slot name="title">Vegetable Advic</x-slot>
    
<div class="bg-dark py-3">
    <h1 class="text-white text-center">Vegetable Advic List</h1>
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
            <h3 class="text-white">Show Vegetable Advic</h3>
          </div>

        <div class="card-body">

                <div class="md-3">
                    <label for="advices">Description</label>
                    <p>{!! $vegetableAdvice->description !!}</p>
                </div>
                
            </div>
            
        </div>
        </div>
    </div>
    </div>
</div>

</x-admin-layout>