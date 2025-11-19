<x-layouts.auth>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="space-y-1">
            <x-title class="text-center">{{ __('Log in to your account') }}</x-text-title>
            <x-text class="text-center">{{ __('Enter your email and password below to log in') }}</x-text>
        </div>
        <div class="space-y-4 mt-8">
            <div class="space-y-1">
                <x-label for="email">{{ __('Email') }}</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter email') }}" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="password">{{ __('Password') }}</x-label>
                <x-input type="password" id="password" name="password" value="" placeholder="{{ __('Enter password') }}" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <div class="flex justify-between items-center mt-2">
                    <x-label for="remember_me" class="flex items-center gap-1">
                        <x-input-checkbox id="remember_me" name="remember" value="1" />
                        <span>{{ __('Remember me') }}</span>
                    </x-label>
                    <x-link href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</x-link>
                </div>
            </div>
            @if (session('status'))
                <x-text-status :status="session('status')" />
            @endif
        </div>
        <div class="space-y-2 mt-8">
            <x-button type="submit" class="w-full">
                <span>{{ __('Login') }}</span>
            </x-button>
            <div class="flex justify-center gap-1">
                <x-text>{{ __('Don\'t have an account?') }}</x-text>
                <x-link href="{{ route('register') }}" class="underline">{{ __('Sign up') }}</x-link>
            </div>
        </div>
    </form>
</x-layouts.auth>