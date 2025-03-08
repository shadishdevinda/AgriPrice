<nav x-data="{ open: false }" class="border-b border-gray-100" style="background-color: #065744; padding-bottom:10px;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>


                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link class="text-white hove:text:black" href="{{ route('home') }}"
                        :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link class="text-white hove:text:black" href="{{ route('vegetables.index') }}"
                        :active="request()->routeIs('vegetables.index')">
                        {{ __('Vegetables Prices') }}
                    </x-nav-link>
                    <x-nav-link class="text-white hove:text:black" href="{{ route('fruits.index') }}"
                        :active="request()->routeIs('fruits.index')">
                        {{ __('Fruits Prices') }}
                    </x-nav-link>
                    <x-nav-link class="text-white hove:text:black" href=""
                        :active="request()->routeIs('')">
                        {{ __('Crops Advices') }}
                    </x-nav-link>
                </div>

            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Authentication Links -->
                @if (Route::has('login'))
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Welcome, {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                            </li>
                        @endauth
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>


        </div>
    </div>
</nav>
