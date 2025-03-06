@if ($fruitList->isNotEmpty())
    @foreach ($fruitList as $fruit)
        <tr>
            <td>
                @if ($fruit->image)
                    <img src="{{ asset('storage/' . $fruit->image) }}" alt="fruit Photo" class="rounded-circle"
                        width="50" height="50">
                @else
                    <img src="{{ asset('images/default-fruit/fruits.jpg') }}" alt="Default Photo" class="rounded-circle"
                        width="50" height="50">
                @endif
            </td>
            <td>{{ $fruit->name }}</td>
            <td>
                <x-input type="text" value="{{ $fruitPrices[$fruit->id]['fruit_wholesale_price'] ?? 'N/A' }}"
                    class="form-control wholesale-price" data-id="{{ $fruit->id }}" placeholder="100.00" />
            </td>
            <td>
                <x-input type="text" value="{{ $fruitPrices[$fruit->id]['fruit_retail_price'] ?? 'N/A' }}"
                    class="form-control retail-price" data-id="{{ $fruit->id }}" placeholder="100.00" />
            </td>
            <td>
                <button class="btn btn-primary fruit-save-btn d-flex align-items-center gap-1"
                    data-id="{{ $fruit->id }}" data-type="fruit"
                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    Update
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="text-center">No products found</td>
    </tr>
@endif

<script>
    // AJAX request to update the fruit prices
    $(document).ready(function() {
        // Handle save button click
        $('.fruit-save-btn').on('click', function() {
            const itemId = $(this).data('id'); // Get the item ID
            const itemType = $(this).data('type'); // Get the item type (vegetable or fruit)
            const wholesalePrice = $(this).closest('tr').find('.wholesale-price')
                .val(); // Get wholesale price
            const retailPrice = $(this).closest('tr').find('.retail-price').val(); // Get retail price

            // Show loading alert
            Swal.fire({
                title: 'Updating...',
                text: 'Please wait while we update the prices.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Determine the route based on the item type
            const route = itemType === 'vegetable' ? 'market.vegetable.update' : 'market.fruit.update';

            // Send AJAX request
            $.ajax({
                url: "{{ route('market.fruit.update', ['id' => '__ID__']) }}".replace('__ID__',
                    itemId),
                method: 'PUT',
                data: {
                    Wholesale_Price: wholesalePrice,
                    Retail_Price: retailPrice,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Hide loading alert
                    Swal.close();

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Prices updated successfully.',
                        confirmButtonText: 'Okay'
                    });
                },
                error: function(xhr) {
                    // Hide loading alert
                    Swal.close();

                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while updating the prices.',
                        confirmButtonText: 'Okay'
                    });
                }
            });
        });
    });
</script>
