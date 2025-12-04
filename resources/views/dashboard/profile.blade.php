<x-layouts.dashboard title="{{ __('Profile') }}">
    <x-card>
        <div class="max-w-screen-sm">
            <div class="space-y-4">
                <x-title>{{ __('Profile Information') }}</x-title>
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
        </div>
    </x-card>
</x-layouts.dashboard>