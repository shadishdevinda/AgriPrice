<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
    style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.535),
    rgba(60, 22, 7, 0.324)),url('/images/login-background.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;
    min-height: 100vh;">
    <div>
        {{ $logo }}
    </div>

    <div class="mt-3 mb-3 text-2xl">
        {{ $heading }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
