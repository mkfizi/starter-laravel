<x-card class="max-w-screen-sm">
    <form action="{{ route('dashboard.profile.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <x-text-title>{{ __('Profile Information') }}</x-text-title>
            <div class="space-y-1">
                <x-label for="name">{{ __('Name') }}</x-label>
                <x-input id="name" name="name" type="text" class="w-full" :value="old('name', $user->name)" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>
            <div class="space-y-1">
                <x-label for="email">{{ __('Email') }}</x-label>
                <x-input id="email" name="email" type="email" class="w-full" :value="old('email', $user->email)" required />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
        </div>
        <div class="flex gap-2 mt-8">
            <x-button type="submit">{{ __('Save' )}}</x-button>
            <x-button-outline type="reset">{{ __('Reset' )}}</x-button-outline>
        </div>
    </form>
</x-card>