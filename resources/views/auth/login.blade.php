
<x-guest-layout>
    <x-slot name="title">System Login</x-slot>

    <style>
        .loginPart {
            max-width: 400px;
            margin: 0 auto;
            padding: 2rem;
            background-color: rgba(255, 255, 255, 0.258);
            border-radius: 0.5rem;
        }

        .loginPart h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .loginPart label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .loginPart input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ffffff21;
            border-radius: 0.375rem;
            background-color: #ffffff21;
            color: #ffffff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .loginPart input:focus {
            border-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .loginPart .block.mt-4 {
            margin-top: 1rem;
        }

        .loginPart .flex.items-center.justify-end.mt-4 {
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .loginPart .underline {
            color: #ffffff;
            text-decoration: none;
        }

        .loginPart .underline:hover {
            text-decoration: underline;
        }

        .loginPart .checkbox {
            width: 20px;
            height: 20px;
            color: black
        }

        .loginPart button {
            background-color: #000000d2;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .loginPart button:hover {
            background-color: #ffffff;
            color: black
        }

        .loginPart .text-sm {
            font-size: 0.875rem;
        }

        .loginPart .text-gray-600 {
            color: #ffffff;
        }

        .loginPart .text-green-600 {
            color: #ffffff;
        }

        .loginPart .mb-4 {
            margin-bottom: 1rem;
        }
    </style>
        
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <div class="loginPart">
                <h2>Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="d-flex items-center">
                            <x-checkbox id="remember_me" name="remember" class="checkbox" />
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-button class="ms-4">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </x-authentication-card>
</x-guest-layout>