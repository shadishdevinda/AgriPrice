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


<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
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
    }

    .btn-custom {
        background-color: #065744;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
    }

    .btn-custom:hover {
        background-color: #065744;
        color: white;
    }

    /* Quill Editor Container */
    #editor {
        height: 300px;
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
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
                           <i class="fas fa-plus-circle"></i> Create Fruit Advice
                        </h3>
                        <a href="{{ route('fruit_advice.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body">
                        <form id="adviceForm" enctype="multipart/form-data"
                            action="{{ route('fruit_advice.store') }}" method="POST">
                            @csrf

                            {{-- Fruit Selection --}}
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="fruits" class="form-label fw-bold">Select Fruits</label>
                                    <select name="fruits[]" class="form-select select2" id="fruits" multiple
                                        aria-describedby="fruitsHelp" required>
                                        @foreach ($fruits as $fruit)
                                            <option value="{{ $fruit }}">{{ $fruit }}</option>
                                        @endforeach
                                    </select>
                                    <small id="fruitsHelp" class="form-text text-muted">
                                        Choose the fruits for which you want to provide advice.
                                    </small>
                                </div>
                            </div>

                            {{-- Quill Editor --}}
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="editor" class="form-label fw-bold">Advice Description</label>
                                    <!-- Quill Editor -->
                                    <div id="editor"></div>
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

                            {{-- Submit Button --}}
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save"></i> Submit Advice
                                    </button>
                                </div>
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

{{-- Quill Initialization --}}
<script>
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
</script>

{{-- Custom js script --}}
<script>
    $(document).ready(function() {
        // Initialize select2 on the fruits select input
        $('#fruits').select2({
            placeholder: "Select fruits",
            allowClear: true
        });

        // Handle form submission
        $('#adviceForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Update the hidden textarea with the latest editor content
            const htmlContent = quill.root.innerHTML;
            document.getElementById('description').value = htmlContent;

            // Show loading alert
            Swal.fire({
                title: 'Processing...',
                text: 'Please wait while we submit your advice.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading(); // Show loading spinner
                }
            });

            // Get the form data
            let formData = new FormData(this);

            // Submit the form via AJAX
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Close the loading alert
                        Swal.close();

                        // Show SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonText: 'Okay'
                        }).then(() => {
                            // Optionally, reset the form after success
                            $('#adviceForm')[0].reset();
                            $('#fruits').val(null).trigger(
                            'change'); // Reset Select2
                            quill.root.innerHTML = ''; // Clear Quill editor
                        });
                    }
                },
                error: function(xhr) {
                    // Close the loading alert
                    Swal.close();

                    // Handle errors (e.g., validation errors)
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';

                    // Loop through errors and display them
                    for (let field in errors) {
                        errorMessage += errors[field][0] + '\n';
                    }

                    // Show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>
