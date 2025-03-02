@if ($fruitList->isNotEmpty())
    @foreach ($fruitList as $fruit)
        <tr>
            <td>
                @if ($fruit->image)
                    <img src="{{ asset('storage/' . $fruit->image) }}" alt="fruit Photo" class="rounded-circle"
                        width="50" height="50">
                @else
                    <img src="{{ asset('images/default-fruit/fruits.jpg') }}" alt="Default Photo"
                        class="rounded-circle" width="50" height="50">
                @endif
            </td>
            <td>{{ $fruit->name }}</td>
            <td>
                <x-input type="text" value="{{ $fruitPrices[$fruit->id]['fruit_wholesale_price'] ?? 'N/A' }}" class="form-control wholesale-price"
                    data-id="{{ $fruit->id }}" placeholder="100.00"/>
            </td>
            <td>
                <x-input type="text" value="{{ $fruitPrices[$fruit->id]['fruit_retail_price'] ?? 'N/A' }}" class="form-control retail-price"
                    data-id="{{ $fruit->id }}" placeholder="100.00"/>
            </td>
            <td>
                <button class="btn btn-primary fruit-save-btn d-flex align-items-center gap-1" data-id="{{ $fruit->id }}"
                    data-type="fruit"
                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Save</button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="text-center">No products found</td>
    </tr>
@endif
