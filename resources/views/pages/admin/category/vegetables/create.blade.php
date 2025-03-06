 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

 <!-- FontAwesome for icons -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

 <!-- SweetAlert2 CSS -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 {{-- Custom styles --}}
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

     .btn-remove {
         margin-top: 1rem;
         display: none;
     }

     .photo-preview {
         width: 150px;
         height: 150px;
         object-fit: cover;
         border-radius: 8px;
         margin-top: 1rem;
         display: none;
     }
 </style>

 <x-admin-layout>
     {{-- Tab topic --}}
     <x-slot name="title">Create Vegetable</x-slot>

     {{-- Content area --}}
     <div class="container">
         <div class="row justify-content-center mt-4">
             <div class="col-md-12">
                 <div class="card">

                     <!-- Card Header -->
                     <div class="card-header bg-dark">
                         <h3 class="text-white mb-0">
                             <i class="fas fa-plus-circle"></i> Create Vegetable
                         </h3>
                         <a href="{{ route('vegetable.index') }}" class="btn btn-light">
                             <i class="fas fa-arrow-left"></i> Back
                         </a>
                     </div>

                     <!-- Card Body -->
                     <div class="card-body">
                         <form id="createVegetableForm" enctype="multipart/form-data"
                             action="{{ route('vegetable.store') }}" method="POST">
                             @csrf
                             <!-- Name Field -->
                             <div class="mb-4">
                                 <label for="name" class="form-label h5">
                                     <i class="fas fa-tag"></i> Name
                                 </label>
                                 <x-input value="{{ old('name') }}" type="text"
                                     class="form-control form-control-lg" placeholder="Enter vegetable name"
                                     name="name" required />
                             </div>

                             <!-- Description Field -->
                             <div class="mb-4">
                                 <label for="description" class="form-label h5">
                                     <i class="fas fa-info-circle"></i> Description
                                 </label>
                                 <textarea class="form-control" name="description" cols="30" rows="5"
                                     placeholder="Enter vegetable description" required>{{ old('description') }}</textarea>
                             </div>

                             <!-- Image Field -->
                             <div class="mb-4">
                                 <label for="image" class="form-label h5">
                                     <i class="fas fa-image"></i> Image
                                 </label>
                                 <input type="file" id="image" name="image"
                                     class="form-control form-control-lg" accept="image/*" required>
                                 <small class="form-text text-muted">Upload an image of the vegetable.</small>

                                 <!-- Image Preview -->
                                 <img id="photoPreview" src="#" alt="Vegetable Image Preview"
                                     class="photo-preview">
                                 <button type="button" class="btn btn-secondary btn-remove" id="removePhoto">
                                     <i class="fas fa-trash"></i> Remove Selected Photo
                                 </button>
                             </div>

                             <!-- Submit Button -->
                             <div class="row">
                                 <div class="col-md-12 d-flex justify-content-end">
                                     <button type="submit" class="btn btn-custom">
                                         <i class="fas fa-save"></i> Create Vegetable
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

 <!-- JavaScript for Image Preview, Removal, and Sweet Alerts -->
 <script>
     // Preview image
     document.getElementById('image').addEventListener('change', function(event) {
         const reader = new FileReader();
         reader.onload = function(e) {
             document.getElementById('photoPreview').src = e.target.result;
             document.getElementById('photoPreview').style.display = 'block';
             document.getElementById('removePhoto').style.display = 'inline-block';
         };
         reader.readAsDataURL(event.target.files[0]);
     });

     // Remove image
     document.getElementById('removePhoto').addEventListener('click', function() {
         document.getElementById('image').value = '';
         document.getElementById('photoPreview').style.display = 'none';
         this.style.display = 'none';
     });

     // Form submission with Sweet Alerts
     document.getElementById('createVegetableForm').addEventListener('submit', function(e) {
         e.preventDefault(); // Prevent form from submitting normally

         // Show loading spinner
         Swal.fire({
             title: 'Creating...',
             text: 'Please wait while we create the vegetable.',
             allowOutsideClick: false,
             didOpen: () => {
                 Swal.showLoading();
             }
         });

         // Submit the form via AJAX
         const form = this;
         const formData = new FormData(form);

         fetch(form.action, {
                 method: 'POST',
                 body: formData,
                 headers: {
                     'X-Requested-With': 'XMLHttpRequest',
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                         'content')
                 },
             })
             .then(response => response.json())
             .then(data => {
                 if (data.success) {
                     Swal.fire({
                         icon: 'success',
                         title: 'Success!',
                         text: data.message,
                         confirmButtonText: 'Okay',
                     }).then(() => {
                         // Reset the form
                         form.reset();

                         // Hide the image preview and remove button
                         document.getElementById('photoPreview').style.display = 'none';
                         document.getElementById('removePhoto').style.display = 'none';
                     });
                 } else {
                     // Handle validation errors
                     let errorMessage = 'An error occurred.';
                     if (data.errors && Array.isArray(data.errors)) {
                         errorMessage = data.errors.map(error => `<li>${error}</li>`).join('');
                     } else if (data.message) {
                         errorMessage = data.message;
                     }

                     Swal.fire({
                         icon: 'error',
                         title: 'Error',
                         html: `<ul>${errorMessage}</ul>`,
                     });
                 }
             })
             .catch(error => {
                 console.error('Error Response:', error);
                 Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: error.message || 'An unexpected error occurred.',
                 });
             });
     });
 </script>
