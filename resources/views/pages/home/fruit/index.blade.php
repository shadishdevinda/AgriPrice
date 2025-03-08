<!-- Custom CSS -->
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 100%;
    }

    .card img {
        height: 180px;
        object-fit: cover;
    }

    /* Search bar styling */
    .search-container {
        position: relative;
        max-width: 600px;
        margin: auto;
        width: 100%;
    }

    /* Search dropdown styles */
    .search-dropdown {
        position: absolute;
        width: 100%;
        background: white;
        border: 1px solid #ccc;
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
        padding: 12px;
        color: #333;
        text-decoration: none;
        font-size: 16px;
        transition: background 0.3s ease-in-out;
    }

    .search-dropdown a:hover {
        background: #f8f9fa;
        color: #007bff;
    }
</style>

<x-home-layout>
    <x-slot name="title">Fruit Price</x-slot>

    <div class="container">
        <br>
        <!-- Search Bar (Centered) -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="search-container">
                    <x-input type="text" id="searchBar" class="form-control text-center" placeholder="Search for fruits..."/>
                    <div id="searchResults" class="search-dropdown"></div>
                </div>
            </div>
        </div>

        <!-- Fruit Cards -->
        <div class="row justify-content-start gx-3" id="fruitList">
            @foreach($fruits as $fruit)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4 d-flex align-items-stretch fruit-item" data-name="{{ strtolower($fruit->name) }}">
                    <a href="{{ route('fruits.details', $fruit->id) }}" class="text-decoration-none text-dark w-100">
                        <div class="card w-100">
                            <img src="{{ asset('storage/' . $fruit->image) }}" class="card-img-top" alt="{{ $fruit->name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title
                                    ">{{ $fruit->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-home-layout>

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
