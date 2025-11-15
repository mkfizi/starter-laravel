<x-auth-layout>
    
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="space-y-4">
            <x-text>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</x-text>
            <div class="space-y-2">
                <x-input type="email" id="email" name="email" value="" placeholder="{{ __('Enter email') }}" required />
                {{-- Uncomment below to display error messages. --}}
                {{-- <x-input-error :messages="$errors->get('email')" /> --}}
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
</x-auth-layout>