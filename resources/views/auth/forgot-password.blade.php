<x-layouts.auth>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="space-y-1">
            <x-title class="text-center">{{ __('Forgot password') }}</x-text-title>
            <x-text class="text-center">{{ __('Enter your email to receive a password reset link') }}</x-text>
        </div>
        <div class="space-y-4 mt-8">
            <div class="space-y-1">
                <x-label for="email">{{ __('Email') }}</x-label>
                <x-input type="email" id="email" name="email" value="" placeholder="{{ __('Enter email') }}" required />
                {{-- Uncomment below to display error messages. --}}
                {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
            </div>
            <x-text-status :status="session('status')" />
            {{-- This is a trick for when the email is not found but still shows the success message for security purposes. --}}
            @if ($errors->has('email'))
                @php
                    $statusMessage = __('We have emailed your password reset link.');
                @endphp
                <x-text-status :status="$statusMessage" />
            @endif
        </div>
        <div class="space-y-2 mt-8">
            <x-button type="submit" class="w-full">
                <span>{{ __('Email Password Reset Link') }}</span>
            </x-button>
            <x-link href="{{ route('login') }}" class="block mx-auto w-fit underline">{{ __('Back to Login') }}</x-link>
        </div>
    </form>
</x-layouts.auth>