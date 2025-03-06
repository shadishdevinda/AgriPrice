@if ($vegetablesList->isNotEmpty())
    @foreach ($vegetablesList as $vegetable)
        <tr>
            <td>
                @if ($vegetable->image)
                    <img src="{{ asset('storage/' . $vegetable->image) }}" alt="Vegetable Photo" class="rounded-circle"
                        width="50" height="50">
                @else
                    <img src="{{ asset('images/default-vegetable/vegetables.jpg') }}" alt="Default Photo"
                        class="rounded-circle" width="50" height="50">
                @endif
            </td>
            <td>{{ $vegetable->name }}</td>
            <td>
                <x-input type="text" value="{{ $vegetablePrices[$vegetable->id]['vegetable_wholesale_price'] ?? 'N/A' }}" class="form-control wholesale-price"
                    data-id="{{ $vegetable->id }}" placeholder="100.00"/>
            </td>
            <td>
                <x-input type="text" value="{{ $vegetablePrices[$vegetable->id]['vegetable_retail_price'] ?? 'N/A' }}" class="form-control retail-price"
                    data-id="{{ $vegetable->id }}" placeholder="100.00"/>
            </td>
            <td>
                <button class="btn btn-primary vegetable-save-btn d-flex align-items-center gap-1" data-id="{{ $vegetable->id }}"
                    data-type="vegetable"
                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    Save
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="text-center">No products found</td>
    </tr>
@endif
