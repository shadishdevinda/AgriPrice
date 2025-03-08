<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Advice Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .container {
            padding: 20px;
        }

        /* Search Bar Styling */
        .search-container {
            position: relative;
            max-width: 600px;
            margin: 0 auto 30px auto;
            width: 100%;
        }

        #searchBar {
            border-radius: 25px;
            padding: 12px 20px;
            font-size: 16px;
            border: 2px solid #28a745;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        #searchBar:focus {
            border-color: #218838;
            box-shadow: 0 0 8px rgba(40, 167, 69, 0.5);
            outline: none;
        }

        /* Search Dropdown Styling */
        .search-dropdown {
            position: absolute;
            width: 100%;
            background: white;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 10px 10px;
            display: none;
            z-index: 1000;
            max-height: 250px;
            overflow-y: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-dropdown a {
            display: block;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .search-dropdown a:hover {
            background: #f1f1f1;
            color: #28a745;
        }

        /* Fruit Cards Styling */
        .fruit-item {
            margin-bottom: 20px;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 0;
        }

        /* Responsive Grid */
        @media (max-width: 768px) {
            .col-lg-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 576px) {
            .col-lg-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    
    <div class="container">
        <br>

        <!-- Search Bar (Centered) -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="search-container">
                    <input type="text" id="searchBar" class="form-control" placeholder="Search for Fruits...">
                    <div id="searchResults" class="search-dropdown"></div>
                </div>
            </div>
        </div>

       <!-- Fruit Cards -->
       <div class="row justify-content-start gx-3" id="fruitList">
          @foreach($fruits as $fruit)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4 d-flex align-items-stretch fruit-item" data-name="{{ strtolower($fruit->name) }}">
                <a href="{{ route('advice.fruit.show', $fruit->id) }}" class="text-decoration-none text-dark w-100">
                    <div class="card w-100">
                        <img src="{{ asset('storage/' . $fruit->image) }}" class="card-img-top" alt="{{ $fruit->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $fruit->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
          @endforeach
       </div>

    </div>

    <!-- jQuery (Required for Search) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for Search Function -->
    <script>
        $(document).ready(function(){
            var fruitList = [];
            $(".fruit-item").each(function() {
                var name = $(this).data("name");
                var link = $(this).find("a").attr("href");
                fruitList.push({ name: name, link: link });
            });

            $("#searchBar").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                var results = $("#searchResults");
                results.empty();

                if (value.length > 0) {
                    var filtered = fruitList.filter(item => item.name.includes(value));
                    if (filtered.length > 0) {
                        results.show();
                        filtered.forEach(item => {
                            results.append(`<a href="${item.link}">${item.name}</a>`);
                        });
                    } else {
                        results.hide();
                    }
                } else {
                    results.hide();
                }
            });

            // Hide dropdown when clicking outside
            $(document).click(function(event) {
                if (!$(event.target).closest("#searchBar, #searchResults").length) {
                    $("#searchResults").hide();
                }
            });
        });
    </script>
</body>
</html>