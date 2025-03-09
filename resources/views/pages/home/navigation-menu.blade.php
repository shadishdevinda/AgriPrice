<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Navigation Bar Styles */
    nav {
        background-color: #065744; /* Dark green background */
        padding: 10px 0;
        border-bottom: 2px solid #3a7d5f; /* Slightly lighter green border */
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .nav-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 60px;
    }

    /* Logo Styles */
    .logo {
        display: flex;
        align-items: center;
    }

    .logo a {
        display: flex;
        align-items: center;
    }

    .logo img {
        height: 40px; /* Adjust logo size */
        transition: transform 0.3s ease;
    }

    .logo img:hover {
        transform: scale(1.1); /* Slight zoom effect on hover */
    }

    /* Navigation Links */
    .nav-links {
        display: flex;
        gap: 30px;
        align-items: center;
    }

    .nav-link {
        color: white;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #ffd700; /* Gold color on hover */
    }

    /* Dropdown Menu */
    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .dropdown-toggle:hover {
        color: #ffd700; /* Gold color on hover */
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        border-radius: 5px;
        min-width: 160px;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        display: block;
        padding: 10px 15px;
        color: #065744; /* Dark green text */
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f0f0f0; /* Light gray background on hover */
    }

    /* Authentication Links */
    .auth-links {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .auth-link {
        color: white;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .auth-link:hover {
        color: #ffd700; /* Gold color on hover */
    }

    /* User Dropdown */
    .user-dropdown {
        position: relative;
    }

    .user-toggle {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .user-toggle:hover {
        color: #ffd700; /* Gold color on hover */
    }

    .user-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        border-radius: 5px;
        min-width: 160px;
    }

    .user-dropdown:hover .user-menu {
        display: block;
    }

    .user-item {
        display: block;
        padding: 10px 15px;
        color: #065744; /* Dark green text */
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .user-item:hover {
        background-color: #f0f0f0; /* Light gray background on hover */
    }

    /* Responsive Navigation Menu */
    .mobile-nav {
        display: none;
        background-color: #065744; /* Dark green background */
        padding: 10px 0;
    }

    .mobile-link {
        display: block;
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .mobile-link:hover {
        background-color: #3a7d5f; /* Slightly lighter green on hover */
    }

    /* Hamburger Menu Icon */
    .hamburger {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
    }

    .hamburger span {
        width: 25px;
        height: 3px;
        background-color: white;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    /* Media Queries for Responsive Design */
    @media (max-width: 768px) {
        .nav-links, .auth-links {
            display: none;
        }

        .hamburger {
            display: flex;
        }

        .mobile-nav {
            display: none;
            flex-direction: column;
            gap: 10px;
        }

        .mobile-nav.active {
            display: flex;
        }

        .nav-wrapper {
            flex-direction: row;
            align-items: center;
        }

        .logo {
            margin-bottom: 0;
        }
    }
</style>

<nav>
    <!-- Primary Navigation Menu -->
    <div class="container">
        <div class="nav-wrapper">
            <!-- Logo -->
            <div class="logo shrink-0 flex items-center">
                <a href="{{ route('market.dashboard') }}">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
            </div>

            <!-- Hamburger Menu Icon (Mobile Only) -->
            <div class="hamburger" onclick="toggleMobileNav()">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- Navigation Links -->
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link">{{ __('Home') }}</a>
                <a href="{{ route('vegetables.index') }}" class="nav-link">{{ __('Vegetables Prices') }}</a>
                <a href="{{ route('fruits.index') }}" class="nav-link">{{ __('Fruits Prices') }}</a>

                <!-- Advices Navigation Links -->
                <div class="dropdown">
                    <button class="dropdown-toggle">{{ __('Crops Advices') }}</button>
                    <div class="dropdown-menu">
                        <a href="{{ route('advices.vegetables.index') }}" class="dropdown-item">{{ __('Vegetable Advices') }}</a>
                        <a href="{{ route('advices.fruits.index') }}" class="dropdown-item">{{ __('Fruit Advices') }}</a>
                    </div>
                </div>
            </div>

            <!-- Authentication Links -->
            <div class="auth-links">
                @if (Route::has('login'))
                    @auth
                        <div class="user-dropdown">
                            <button class="user-toggle">Welcome, {{ Auth::user()->name }}</button>
                            <div class="user-menu">
                                <a href="{{ url('/dashboard') }}" class="user-item">{{ __('Dashboard') }}</a>
                                <a href="{{ route('logout') }}" class="user-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="auth-link">{{ __('Log in') }}</a>
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="mobile-nav" id="mobileNav">
        <a href="{{ route('home') }}" class="mobile-link">{{ __('Home') }}</a>
        <a href="{{ route('vegetables.index') }}" class="mobile-link">{{ __('Vegetables Prices') }}</a>
        <a href="{{ route('fruits.index') }}" class="mobile-link">{{ __('Fruits Prices') }}</a>
        <a href="{{ route('advices.fruits.index') }}" class="mobile-link">{{ __('Fruit Advices') }}</a>
        <a href="{{ route('advices.vegetables.index') }}" class="mobile-link">{{ __('Vegetable Advices') }}</a>
    </div>
</nav>

<script>
    // Toggle mobile navigation
    function toggleMobileNav() {
        const mobileNav = document.getElementById('mobileNav');
        mobileNav.classList.toggle('active');
    }
</script>
