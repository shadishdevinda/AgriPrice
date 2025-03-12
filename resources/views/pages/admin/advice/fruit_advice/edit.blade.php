{{-- Bootstrap CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- FontAwesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
{{-- Select2 CDN --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Quill Editor CDN --}}
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

{{-- Custom styles --}}
<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
    }

    .card-header h3 {
        margin: 0;
    }

    .card-body {
        padding: 2rem;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        border-color: #065744;
        box-shadow: 0 0 5px rgba(6, 87, 68, 0.5);
    }

    .btn-custom {
        background-color: #065744;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        color: white;
        background-color: #054735;
    }

    .select2-container--default .select2-selection--multiple {
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .select2-container--default .select2-selection--multiple:focus {
        border-color: #065744;
        box-shadow: 0 0 5px rgba(6, 87, 68, 0.5);
    }

    /* Hide the original textarea */
    #description {
        display: none;
    }
</style>

<x-admin-layout>
    <x-slot name="title">Fruit Advice</x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header bg-dark">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-seedling"></i> Edit Fruit Advice
                        </h3>
                        <a href="{{ route('fruit_advice.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form id="updateForm" enctype="multipart/form-data"
                            action="{{ route('fruit_advice.update', $fruitAdvice->id) }}" method="POST">
                            @method('put')
                            @csrf
                            <!-- Fruit Selection -->
                            <div class="mb-4">
                                <label for="fruits" class="form-label fw-bold">Associated Fruits</label>
                                <select name="fruits[]" class="form-select select2" id="fruits" multiple>
                                    @foreach ($fruits as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, $associatedFruits) ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                             {{-- Quill Editor --}}
                             <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="editor" class="form-label fw-bold">Advice Description</label>
                                    <!-- Quill Editor -->
                                    <div id="editor">
                                        {!! old('description', $fruitAdvice->description) !!}
                                    </div>
                                </div>
                            </div>

                            {{-- Hidden Textarea for Description --}}
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <!-- Hidden textarea to store the HTML content -->
                                    <textarea class="form-control" name="description" id="description" rows="6" required
                                        placeholder="Enter detailed advice for the selected fruits...">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-custom" style="margin-top: 30px;">
                                    <i class="fas fa-save"></i> Update Advice
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

{{-- Bootstrap CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

{{-- Select2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


{{-- Custom js script --}}
<script>
    $(document).ready(function() {
        // Initialize Quill Editor
        const quill = new Quill('#editor', {
            theme: 'snow', // Use the Snow theme
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'], // Text formatting
                    [{
                        'header': 1
                    }, {
                        'header': 2
                    }], // Headers
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }], // Lists
                    ['link', 'image'], // Links and images
                    ['clean'] // Remove formatting
                ]
            },
            placeholder: 'Write your advice here...',
        });

        // Sync Quill content to the hidden textarea
        quill.on('text-change', function() {
            const htmlContent = quill.root.innerHTML; // Get HTML content
            document.getElementById('description').value = htmlContent; // Update textarea
        });

        // Initialize Select2
        $('.select2').select2({
            placeholder: 'Select fruits',
            allowClear: true
        });

        // Handle form submission
        $('#updateForm').on('submit', function(e) {
            e.preventDefault();

            // Show loading alert
            Swal.fire({
                title: 'Updating...',
                text: 'Please wait while we update the advice.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form via AJAX
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    // Close loading alert
                    Swal.close();

                    // Show success alert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Fruit advice updated successfully.',
                        confirmButtonText: 'Okay'
                    }).then(() => {
                        // No further action after the user clicks "Okay"
                    });
                },
                error: function(xhr) {
                    // Close loading alert
                    Swal.close();

                    // Handle validation errors
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = Object.values(errors).join('\n');

                    // Show error alert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                        confirmButtonText: 'Okay'
                    });
                }
            });
        });
    });
</script>
