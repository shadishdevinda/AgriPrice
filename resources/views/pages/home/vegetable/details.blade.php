<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vegetable->name }} Details</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom CSS -->
    <style>
        body {
            padding: 20px;
        }
        .vegetable-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .header-section {
            display: flex;
            align-items:center;
            gap: 15px;
        }
        .crop-advice {
            font-weight: bold;
            font-size: 20px;
            position: relative;
            display: inline-block;
            margin-top: 10px;
        }
        .crop-advice::after {
            content: "";
            display: block;
            width: 100%;
            height: 3px;
            background: red;
            position: absolute;
            bottom: -3px;
        }
        .chart-container {
            width: 80%;
            height: 400px;
            margin: auto;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @include('pages.home.navbar')

    <!-- Header Section -->
    <div class="header-section">
        <img src="{{ asset('storage/' . $vegetable->image) }}" class="vegetable-image" alt="{{ $vegetable->name }}">
        <div>
            <h3><i>{{ $vegetable->name }}</i></h3>
            <p class="crop-advice">Crop advice</p>
        </div>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="date" class="form-label">Select Date:</label>
                <input type="date" name="date" id="date" class="form-control"
                       value="{{ request('center_id') ? '' : (request('date') ?? $latestDate) }}">
            </div>

            <div class="col-md-4">
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

            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- Chart Section -->
    <div class="chart-container">
        <canvas id="priceChart"></canvas>
    </div>

    <!-- Table Section -->
    <div class="table-container">
        <h5 class="text-center">Available Prices</h5>
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
                @foreach($centerhasvegetable as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                        <td>{{ $item->center->center_name }}</td>
                        <td>RS {{ $item->vegetable_wholesale_price }}</td>
                        <td>RS {{ $item->vegetable_retail_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- jQuery (Optional) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('priceChart').getContext('2d');

            var labels = [];
            var wholesalePrices = [];
            var retailPrices = [];

            @if ($isCenterFiltered)
                // If center filter is applied, use dates as labels
                @foreach($centerhasvegetable as $item)
                    labels.push("{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}");
                    wholesalePrices.push({{ $item->vegetable_wholesale_price }});
                    retailPrices.push({{ $item->vegetable_retail_price }});
                @endforeach
            @else
                // Otherwise, use economic centers as labels
                @foreach($centerhasvegetable as $item)
                    labels.push("{{ $item->center->center_name }}");
                    wholesalePrices.push({{ $item->vegetable_wholesale_price }});
                    retailPrices.push({{ $item->vegetable_retail_price }});
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

</body>
</html>
