<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<x-admin-layout>
    <x-slot name="title">Vegetable Advice</x-slot>
    
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('vegetable_advice.create') }}" class="btn btn-dark border border-white">Create</a>
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
                        <h3 class="text-white">Vegetable Advice</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th> <!-- Fixed width for description -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($vegetable_advice->isNotEmpty())
                                    @foreach ($vegetable_advice as $vegetableAdvice)
                                        <tr>
                                            <td>{{ $vegetableAdvice->id }}</td>
                                            
                                            <!-- Apply the class for wrapping or truncating -->
                                            <td class="description-column">
                                                {{ Str::limit($vegetableAdvice->description, 50, '...') }}
                                            </td>

                                            <td>
                                                <a href="{{ route('vegetable_advice.edit', $vegetableAdvice->id) }}" class="btn btn-dark">Edit</a>
                                                <a href="{{ route('vegetable_advice.show', $vegetableAdvice->id) }}" class="btn btn-dark">Show</a>
                                                <button type="button" class="btn btn-danger" onclick="deleteProduct({{ $vegetableAdvice->id }})">Delete</button>

                                                <!-- Hidden delete form -->
                                                <form id="delete-product-form{{ $vegetableAdvice->id }}" action="{{ route('vegetable_advice.destroy', $vegetableAdvice->id) }}" method="POST" style="display: none;">
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
        if (confirm("Are you sure you want to delete this vegetable advice?")) {
            document.getElementById('delete-product-form' + id).submit();
        }
    }
</script>

<!-- CSS for Fixing the Description Column -->

