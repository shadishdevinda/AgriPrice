<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.535),
    rgba(60, 22, 7, 0.324)),url('/images/image_1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;
    min-height: 100vh;">
    <div>
        <div class="logo shrink-0 flex items-center" >
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <span class="flaticon flaticon-agriculture" style="color: rgba(255, 255, 255, 0.863);"></span>
            <span class="ml-2" style="color: rgba(255, 255, 255, 0.976);">AgriPrice <small style="color: rgba(255, 255, 255, 0.685);">Agriculture Farming</small></span>
        </a>
        </div>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg ">
        {{ $slot }}
    </div>
</div>
