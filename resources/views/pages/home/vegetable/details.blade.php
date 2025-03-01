<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vegetable->name }} Details</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card img {
            height: 300px;
            object-fit: cover;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center mb-4">{{ $vegetable->name }} Details</h2>
        <div class="card mx-auto" style="max-width: 500px;">
            <img src="{{ asset('storage/' . $vegetable->image) }}" class="card-img-top" alt="{{ $vegetable->name }}">
            <div class="card-body text-center">
                <h3 class="card-title">{{ $vegetable->name }}</h3>
                <p class="card-text">{{ $vegetable->description }}</p>
                <h4>Wholesale Price: ${{ $vegetable->Wholesale_Price }}</h4>
                <h4>Retail Price: ${{ $vegetable->Retail_Price }}</h4>
                <a href="{{ route('vegetables.index') }}" class="btn btn-primary mt-3">Back to Vegetables</a>
            </div>
        </div>
    </div>

    <!-- jQuery (Optional) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function(){
            console.log("{{ $vegetable->name }} details page loaded!");
        });
    </script>

</body>
</html>
