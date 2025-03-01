<!-- Delete EconomicCenter Modal -->
<div class="modal fade" id="deleteEconomicCenterModal" tabindex="-1" aria-labelledby="deleteEconomicCenterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEconomicCenterModalLabel">Delete System EconomicCenter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the Economic Center? <br><br>
                    <strong id="centerName"></strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="confirmDeleteButton" type="button" class="btn btn-danger"
                    onclick="deleteEconomicCenter()">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to handle EconomicCenter deletion
    function deleteEconomicCenter() {
        var EconomicCenterId = document.getElementById('confirmDeleteButton').getAttribute('data-id');

        // Show loading spinner
        Swal.fire({
            title: 'Deleting...',
            text: 'Please wait while we process your request.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(`/economic-centers/${EconomicCenterId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                    }).then(() => {
                        // Show the "Please wait" message with a spinner
                        Swal.fire({
                            title: 'Please wait...',
                            text: 'Reloading the page.',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading(); // Show the loading spinner
                            }
                        });

                        // Close the modal and reload the page after a slight delay
                        setTimeout(() => {
                            $('#deleteEconomicCenterModal').modal('hide'); // Close the modal
                            location.reload(); // Reload the page
                        }, 1000); // Adjust the delay as needed
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred. Please try again.',
                });
            });
    }
</script>
