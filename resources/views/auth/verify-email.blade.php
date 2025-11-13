<x-auth-layout>
    <x-text class="mt-4">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</x-text>
    <x-text>test</x-text>
    <div class="space-y-1 mt-8 mb-4">
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