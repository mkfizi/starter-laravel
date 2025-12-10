<x-layouts.dashboard title="{{ __('Users') }}">
    <div class="space-y-4">
        <div class="flex justify-between gap-2">
            <x-button-link-outline href="{{ route('dashboard.admin.users.index') }}">{{ __('Back' )}}</x-button-link-outline>
        </div>
        <x-card>
            <div class="space-y-4 max-w-screen-sm">
                <x-title>{{ __('User Information') }}</x-title>
                <div class="space-y-1">
                    <x-label for="name">{{ __('Name') }}</x-label>
                    <x-input id="name" name="name" type="text" class="w-full" value="{{ $user->name }}" disabled />
                </div>
                <div class="space-y-1">
                    <x-label for="email">{{ __('Email') }}</x-label>
                    <x-input id="email" name="email" type="email" class="w-full" value="{{ $user->email }}" disabled />
                </div>
                <div class="space-y-1">
                    <x-label for="roles">{{ __('Roles') }}</x-label>
                    <x-input id="roles" name="roles" type="text" class="w-full" value="{{ $user->roles->pluck('name')->join(', ') }}" disabled />
                </div>
            </div>
        </x-card>
    </div>
</x-layouts.dashboard>
