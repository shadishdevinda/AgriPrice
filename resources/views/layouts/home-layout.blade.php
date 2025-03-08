<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- Custom CSS -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
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


    /*       TABLE SECTION       */
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
        background: #5a6268
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

        .table tbody, .table tr, .table td {
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
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        {{-- Navigation menu --}}
        @include('pages.home.navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    {{-- Bootstrap CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
