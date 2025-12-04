<x-layouts.auth>
    <form method="POST" action="{{ route('two-factor.login.store') }}"
        x-data="{ showOtp: true }"
    >
        @csrf
        <div class="space-y-1"
            :class="{ 'hidden invisible': !showOtp }"
        >
            <x-title class="text-center">{{ __('Authentication Code') }}</x-title>
            <x-text class="text-center">{{ __('Enter the authentication code provided by your authenticator application.') }}</x-text>
        </div>
        <div class="hidden invisible space-y-1"
            :class="{ 'hidden invisible': showOtp }"
        >
            <x-title class="text-center">{{ __('Recovery Code') }}</x-title>
            <x-text class="text-center">{{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}</x-text>
        </div>
        <div class="space-y-4 mt-8">
            <div class="space-y-1"
                :class="{ 'hidden invisible': !showOtp }"
            >
                <x-label for="code">{{ __('Authentication Code') }}</x-label>
                <x-input type="text" id="code" name="code" placeholder="{{ __('Enter authentication code') }}" autofocus />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                <div class="flex justify-end items-center mt-2">
                    <button type="button" class="font-medium text-neutral-500 hover:text-black focus:text-black visited:text-neutral-700 dark:hover:text-white dark:focus:text-white dark:text-neutral-400 dark:visited:text-neutral-200 text-sm cursor-pointer"
                        x-on:click="showOtp = false"
                    >
                    {{ __('Login using a recovery code') }}
                    </button>
                </div>
            </div>
            <div class="hidden space-y-1"
                :class="{ 'hidden invisible': showOtp }"
            >
                <x-label for="recovery_code">{{ __('Recovery Code') }}</x-label>
                <x-input type="text" id="recovery_code" name="recovery_code" class="w-full" placeholder="{{ __('Enter recovery code') }}" />
                <x-input-error :messages="$errors->get('recovery_code')" class="mt-2" />
                <div class="flex justify-end items-center mt-2">
                    <button type="button" class="font-medium text-neutral-500 hover:text-black focus:text-black visited:text-neutral-700 dark:hover:text-white dark:focus:text-white dark:text-neutral-400 dark:visited:text-neutral-200 text-sm cursor-pointer"
                        x-on:click="showOtp = true"
                    >
                    {{ __('Login using a authentication code') }}
                    </button>
                </div>
            </div>
        <div class="space-y-2 mt-8">
            <x-button type="submit" class="w-full">
                <span>{{ __('Continue') }}</span>
            </x-button>
            <x-link href="{{ route('login') }}" class="block mx-auto w-fit underline">{{ __('Back to Login') }}</x-link>
        </div>
    </form>
</x-layouts.auth>