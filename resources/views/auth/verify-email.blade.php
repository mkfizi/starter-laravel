<x-auth-layout>
    <x-text class="my-4">{{ __('Please verify your email address by clicking on the link we just emailed to you.') }}</x-text>
    @php
        $statusMessage = session('status') === 'verification-link-sent'
            ? __('A new verification link has been sent to the email address you provided during registration.')
            : session('status');
    @endphp
    <x-text-status :status="$statusMessage" />
    <div class="space-y-2 mt-8">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-button class="w-full">{{ __('Resend Verification Email') }}</x-button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-button-outline class="w-full">{{ __('Log Out') }}</x-button-outline>
        </form>
    </div>
</x-auth-layout>