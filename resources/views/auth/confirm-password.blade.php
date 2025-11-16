<x-layouts.auth>
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="space-y-4">
            <x-text>{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</x-text>
            <div class="space-y-2">
                <x-input type="password" id="password" name="password" placeholder="{{ __('Enter your password') }}" required />
                <x-input-error :messages="$errors->get('password')" />
            </div>
        </div>
        <div class="space-y-2 mt-8">
            <x-button type="submit" class="w-full">
                <span>{{ __('Confirm Password') }}</span>
            </x-button>
            <x-link href="{{ url()->previous() }}" class="block mx-auto w-fit underline">{{ __('Back') }}</x-link>
        </div>
    </form>
</x-layouts.auth>