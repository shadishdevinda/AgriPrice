<x-home-layout>

<!-- Header & Filter Container -->
<div class="header-filter-container">

    <!-- Header Section -->
    <div class="header-section">
        <img src="{{ asset('storage/' . $fruit->image) }}" class="fruit-image" alt="{{ $fruit->name }}">
        <div class="header-text">
            <h3><i>{{ $fruit->name }}</i></h3>
            <p class="crop-advice">Crop advice</p>
        </div>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="" class="filter-form">
        <div class="d-flex">
            <div class="filter-item">
                <label for="date" class="form-label">Select Date:</label>
                <input type="date" name="date" id="date" class="form-control"
                       value="{{ request('center_id') ? '' : (request('date') ?? $latestDate) }}">
            </div>

            <div class="filter-item">
                <label for="center_id" class="form-label">Select Economic Center:</label>
                <select name="center_id" id="center_id" class="form-control">
                    <option value="">All Centers</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->center->id }}" {{ request('center_id') == $center->center->id ? 'selected' : '' }}>
                            {{ $center->center->center_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-buttons">
                <button type="submit" class="btn btn-primary filter-btn">Filter</button>
                <a href="{{ url()->current() }}" class="btn btn-secondary reset-btn">Reset</a>
            </div>
        </div>
    </form>
</div>

<!-- Chart Section -->
<div class="chart-container">
    <canvas id="priceChart"></canvas>
</div>

<!-- Table Section -->
<div class="table-container">
    <h5 class="text-center table-title">Available Prices</h5>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Economic Center</th>
                <th>Wholesale Price</th>
                <th>Retail Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($centerhasfruit as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                    <td>{{ $item->center->center_name }}</td>
                    <td>RS {{ $item->fruit_wholesale_price }}</td>
                    <td>RS {{ $item->fruit_retail_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-home-layout>

<!-- Chart.js Script -->
<script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('priceChart').getContext('2d');

            var labels = [];
            var wholesalePrices = [];
            var retailPrices = [];

            @if ($isCenterFiltered)
                @foreach($centerhasfruit as $item)
                    labels.push("{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}");
                    wholesalePrices.push({{ $item->fruit_wholesale_price }});
                    retailPrices.push({{ $item->fruit_retail_price }});
                @endforeach
            @else
                @foreach($centerhasfruit as $item)
                    labels.push("{{ $item->center->center_name }}");
                    wholesalePrices.push({{ $item->fruit_wholesale_price }});
                    retailPrices.push({{ $item->fruit_retail_price }});
                @endforeach
            @endif

            var priceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Wholesale Price (RS)',
                            data: wholesalePrices,
                            backgroundColor: '#007bff',
                            borderColor: '#0056b3',
                            borderWidth: 1,
                            barThickness: 40
                        },
                        {
                            label: 'Retail Price (RS)',
                            data: retailPrices,
                            backgroundColor: '#28a745',
                            borderColor: '#1e7e34',
                            borderWidth: 1,
                            barThickness: 40
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: "{{ $isCenterFiltered ? 'Date' : 'Economic Centers' }}"
                            },
                            ticks: {
                                autoSkip: false,
                                maxRotation: 45,
                                minRotation: 0
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Price (RS)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        });
</script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
