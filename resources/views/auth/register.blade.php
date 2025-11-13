<x-auth-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="space-y-4">
            <x-text-title class="text-center">{{ __('Sign Up') }}</x-text-title>
            <div class="space-y-1">
                <x-label for="name">{{ __('Name') }}</x-label>
                <x-input type="text" id="name" name="name" value="" placeholder="{{ __('Enter name') }}" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="email">{{ __('Email') }}</x-label>
                <x-input type="email" id="email" name="email" value="" placeholder="{{ __('Enter email') }}" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="password">{{ __('Password') }}</x-label>
                <x-input type="password" id="password" name="password" value="" placeholder="{{ __('Enter password') }}" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="password_confirmation">{{ __('Confirm Password') }}</x-label>
                <x-input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="{{ __('Confirm password') }}" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>
        <div class="space-y-1 mt-8 mb-4">
            <x-button type="submit" class="w-full">
                <span>{{ __('Sign Up') }}</span>
            </x-button>
            <x-link href="{{ route('login') }}" class="block mx-auto w-fit underline">{{ __('Already have an account? Log in') }}</x-link>
        </div>
    </form>
</x-auth-layout>