<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<x-admin-layout>
    <x-slot name="title">Fruit Advice</x-slot>
    
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('fruit_advice.create') }}" class="btn btn-dark border border-white">Create</a>
            </div>
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
                        <h3 class="text-white">Fruit Advice</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($fruit_advice->isNotEmpty())
                                    @foreach ($fruit_advice as $fruitAdvice)
                                        <tr>
                                            <td>{{ $fruitAdvice->id }}</td>
                                            
                                            <!-- Apply the class for wrapping or truncating -->
                                            <td class="description-column">
                                                {{ Str::limit($fruitAdvice->description, 50, '...') }}
                                            </td>

                                            <td>
                                                <a href="{{ route('fruit_advice.edit', $fruitAdvice->id) }}" class="btn btn-dark">Edit</a>
                                                <a href="{{ route('fruit_advice.show', $fruitAdvice->id) }}" class="btn btn-dark">Show</a>
                                                <button type="button" class="btn btn-danger" onclick="deleteProduct({{ $fruitAdvice->id }})">Delete</button>

                                                <!-- Hidden delete form -->
                                                <form id="delete-product-form{{ $fruitAdvice->id }}" action="{{ route('fruit_advice.destroy', $fruitAdvice->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">No vegetable advice found</td>
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

<!-- JavaScript for Delete Confirmation -->
<script>
    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete this fruit advice?")) {
            document.getElementById('delete-product-form' + id).submit();
        }
    }
</script>

<!-- CSS for Fixing the Description Column -->

