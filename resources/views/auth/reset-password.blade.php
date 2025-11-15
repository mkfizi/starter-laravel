<x-auth-layout>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="space-y-1">
            <x-text-title class="text-center">{{ __('Reset password') }}</x-text-title>
            <x-text class="text-center">{{ __('Please enter your new password below') }}</x-text>
        </div>
        <div class="space-y-4 mt-8">
            <div class="space-y-1">
                <x-label for="email">{{ __('Email') }}</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter email') }}" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="password">{{ __('Password') }}</x-label>
                <x-input type="password" id="password" name="password" value="" placeholder="{{ __('Enter password') }}" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="password">{{ __('Password Confirmation') }}</x-label>
                <x-input type="password" id="password" name="password_confirmation" value="" placeholder="{{ __('Confirm password') }}" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>
        <div class="space-y-2 mt-8">
            <x-button type="submit" class="w-full">
                <span>{{ __('Reset Password') }}</span>
            </x-button>
            <x-link href="{{ route('login') }}" class="block mx-auto w-fit underline">{{ __('Back to login') }}</x-link>
        </div>
    </form>
</x-auth-layout>