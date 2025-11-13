<x-auth-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="space-y-4">
            <x-text-title class="text-center">{{ __('Login') }}</x-text-title>
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
                    <x-label for="input-checkbox" class="flex items-center gap-1">
                        <x-checkbox id="input-checkbox" name="checkbox" value="" />
                        <span>{{ __('Remember me') }}</span>
                    </x-label>
                    <x-link href="{{ route('password.request') }}">{{ __('Forgot password?') }}</x-link>
                </div>
            </div>
            @if (session('status'))
                <x-text-status :status="session('status')" />
            @endif
        </div>
        <div class="space-y-2 mt-8 mb-4">
            <x-button type="submit" class="w-full">
                <span>{{ __('Login') }}</span>
            </x-button>
            <x-link href="{{ route('register') }}" class="block mx-auto w-fit underline">{{ __('Register as New User') }}</x-link>
        </div>
    </form>
</x-auth-layout>