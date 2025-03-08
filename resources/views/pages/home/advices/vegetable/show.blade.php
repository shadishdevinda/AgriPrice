<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Advice Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #28a745;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.2rem;
            text-transform: capitalize;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            height: 350px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .card-img-top:hover {
            transform: scale(1.05);
        }
        .card-body {
            padding: 25px;
        }
        .card-title {
            color: #28a745;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .card-text {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.7;
        }
        h3 {
            color: #28a745;
            margin-top: 40px;
            margin-bottom: 25px;
            font-size: 1.8rem;
            font-weight: bold;
        }
        .list-group {
            border-radius: 10px;
            overflow: hidden;
        }
        .list-group-item {
            border: none;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
            padding: 15px 20px;
            font-size: 1.1rem;
            color: #444;
        }
        .list-group-item:hover {
            background-color: #f1f1f1;
            transform: translateX(10px);
        }
        .btn-primary {
            background-color: #28a745;
            border: none;
            padding: 12px 25px;
            font-size: 1.1rem;
            border-radius: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: inline-block;
            margin-top: 30px;
        }
        .btn-primary:hover {
            background-color: #218838;
            transform: translateY(-3px);
        }
        .btn-primary:focus {
            box-shadow: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="mb-4">{{ $vegetable->name }} - Advice</h2>

        <div class="card mb-4">
            <img src="{{ asset('storage/' . $vegetable->image) }}" class="card-img-top" alt="{{ $vegetable->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $vegetable->name }}</h5>
                <p class="card-text">{{ $vegetable->description }}</p>
            </div>
        </div>

        <h3>Advice</h3>
        <ul class="list-group">
            @forelse($vegetable->advice as $advice)
                <li class="list-group-item">{{ $advice->description }}</li>
            @empty
                <li class="list-group-item">No advice available for this vegetable.</li>
            @endforelse
        </ul>

        <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">Back</a>
    </div>

</body>
</html>