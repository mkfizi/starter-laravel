<x-layouts.dashboard title="{{ __('Profile') }}">
    <div class="max-w-screen-md">
        <x-card>
            <div class="space-y-4">
                <x-title>{{ __('Profile Information') }}</x-text-title>
                <div class="space-y-1">
                    <x-label for="name">{{ __('Name') }}</x-label>
                    <x-input id="name" name="name" type="text" class="w-full" :value="$user->name" disabled />
                </div>
                <div class="space-y-1">
                    <x-label for="email">{{ __('Email') }}</x-label>
                    <x-input id="email" name="email" type="email" class="w-full" :value="$user->email" disabled />
                </div>
            </div>
            <div class="flex gap-2 mt-8">
                <x-button-link href="{{ route('dashboard.settings.account') }}">{{ __('Edit Profile' )}}</x-button-link>
            </div>
        </x-card>
    </div>
</x-layouts.dashboard>