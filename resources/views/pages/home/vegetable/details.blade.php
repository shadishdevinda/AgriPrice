<x-home-layout>

    <x-slot name="title">{{ $vegetable->name ?? 'Vegetable' }} Price Details</x-slot>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        /* Navigation Links */
        .nav-links {
            gap: 60px;
        }

        /*        HEADER SECTION     */
        .header-filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            flex-wrap: nowrap;
        }

        .header-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .vegetable-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 15px;
        }

        .header-text h3 {
            font-size: 22px;
            margin: 0;
            color: #333;
        }

        .crop-advice {
            font-weight: bold;
            font-size: 20px;
            position: relative;
            display: inline-block;
            margin-top: 10px;
            color: #666;
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

        /*        FILTER FORM        */
        .filter-form {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .filter-form .d-flex {
            gap: 15px;
            flex-wrap: nowrap;
        }

        .filter-item {
            display: flex;
            flex-direction: column;
        }

        .filter-form .form-label {
            font-weight: bold;
            color: #333;
        }

        .filter-form .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }

        .filter-form .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        /*         BUTTONS           */
        .filter-buttons {
            display: flex;
            align-items: center;
            padding: 30px 0px 0px 0px;
            gap: 10px;
        }

        .filter-btn {
            background-color: #007bff;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            transition: background 0.3s ease-in-out;
        }

        .filter-btn:hover {
            background-color: #0056b3;
        }

        .reset-btn {
            background-color: #6c757d;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            transition: background 0.3s ease-in-out;
        }

        .reset-btn:hover {
            background-color: #5a6268;
        }

        /*       CHART SECTION       */
        .chart-container {
            width: 80%;
            height: 400px;
            margin: auto;
        }

        /* Table Section */
        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            padding: 12px;
            text-align: center;
            font-size: 16px;
            position: sticky;
            top: 0;
            background: #065744;
            /* Green color */
            color: white;
            /* White text for better contrast */
            z-index: 2;
        }

        .table tbody tr {
            transition: background 0.3s ease-in-out;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .table tbody td {
            padding: 10px;
            text-align: center;
            font-size: 15px;
            border-bottom: 1px solid #ddd;
        }

        /* Table Responsive */
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
            }

            .table tbody tr {
                margin-bottom: 10px;
                background: #f8f9fa;
                border-radius: 10px;
                padding: 10px;
            }

            .table tbody td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table tbody td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 50%;
                padding-right: 10px;
                text-align: left;
                font-weight: bold;
                color: #333;
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .header-filter-container {
                flex-wrap: wrap;
                gap: 15px;
            }

            .header-section {
                width: 100%;
                justify-content: center;
                text-align: center;
            }

            .filter-form {
                width: 100%;
                justify-content: center;
            }

            .filter-form .d-flex {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

    </style>

    <!-- Header & Filter Section (Same Row) -->
    <div class="header-filter-container">
        <!-- Header Section -->
        <div class="header-section">
            <img src="{{ asset('storage/' . $vegetable->image) }}" class="vegetable-image" alt="{{ $vegetable->name }}">
            <div class="header-text">
                <h3><i>{{ $vegetable->name }}</i></h3>
                <p class="crop-advice">Crop advice</p>
            </div>
        </div>

        <!-- Filter Form (Placed in Same Row) -->
        <form method="GET" action="" class="filter-form">
            <div class="d-flex align-items-center">
                <div class="filter-item">
                    <label for="date" class="form-label">Select Date:</label>
                    <input type="date" name="date" id="date" class="form-control"
                        value="{{ request('center_id') ? '' : request('date') ?? $latestDate }}">
                </div>

                <div class="filter-item">
                    <label for="center_id" class="form-label">Select Economic Center:</label>
                    <select name="center_id" id="center_id" class="form-control">
                        <option value="">All Centers</option>
                        @foreach ($centers as $center)
                            <option value="{{ $center->center->id }}"
                                {{ request('center_id') == $center->center->id ? 'selected' : '' }}>
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
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Economic Center</th>
                    <th>Wholesale Price</th>
                    <th>Retail Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($centerhasvegetable as $item)
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

</x-home-layout>

<!-- Chart.js Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('priceChart').getContext('2d');

        var labels = [];
        var wholesalePrices = [];
        var retailPrices = [];

        @if ($isCenterFiltered)
            // If center filter is applied, use dates as labels
            @foreach ($centerhasvegetable as $item)
                labels.push("{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}");
                wholesalePrices.push({{ $item->vegetable_wholesale_price }});
                retailPrices.push({{ $item->vegetable_retail_price }});
            @endforeach
        @else
            // Otherwise, use economic centers as labels
            @foreach ($centerhasvegetable as $item)
                labels.push("{{ $item->center->center_name }}");
                wholesalePrices.push({{ $item->vegetable_wholesale_price }});
                retailPrices.push({{ $item->vegetable_retail_price }});
            @endforeach
        @endif

        var priceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
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
