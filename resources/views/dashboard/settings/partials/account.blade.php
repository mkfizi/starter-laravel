@extends('dashboard.settings.index')

@section('content')
    <div class="space-y-8">
        <x-card>
            <div class="max-w-screen-sm">
                <form action="{{ route('dashboard.settings.update-profile', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <x-title>{{ __('Profile Information') }}</x-text-title>
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
                        <x-button-outline type="reset">{{ __('Reset' )}}</x-button-outline>
                        <x-button type="submit">{{ __('Save' )}}</x-button>
                    </div>
                </form>
            </div>
        </x-card>
        <x-card>
            <div class="max-w-screen-sm">
                <div class="space-y-4">
                    <x-title>{{ __('Delete Account') }}</x-title>
                    <x-text>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</x-text>
                </div>
                <div class="flex gap-2 mt-8">
                    <x-button-danger
                        x-data="{ isModalOpen: false }"
                        x-on:click="$dispatch('open-modal', { id: 'modal-delete-account' })"
                        x-on:modal-delete-account-expanded.window="$event.detail.id === 'modal-delete-account' ? isModalOpen = $event.detail.isModalOpen : null"
                        ::aria-expanded="isModalOpen"
                        aria-controls="modal-delete-account"
                    >{{ __('Delete Account' )}}</x-button-danger>
                </div>
            </div>
        </x-card>
    </div>
    <x-modal id="modal-delete-account">
        <span x-init="isModalOpen = {{ json_encode($errors->has('password')) }};"></span>
        <form action="{{ route('dashboard.settings.destroy', $user) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="space-y-4">
                <x-title>{{ __('Delete Account') }}</x-title>
                <x-text>{{ __('Please confirm your account deletion by entering your password.') }}</x-text>
                <div class="space-y-1">
                    <x-input id="password" name="password" type="password" placeholder="{{ __('Enter your password') }}" required />
                    <x-input-error :messages="$errors->get('password')" />
                </div>
            </div>
            <div class="flex flex-wrap justify-end gap-2 mt-8">
                <x-button-secondary type="button"
                    x-on:click="$dispatch('close-modal', { id: 'modal-delete-account' })"
                    ::aria-expanded="isModalOpen"
                    aria-controls="modal-delete-account"
                >{{ __('Cancel') }}</x-button-secondary>
                <x-button-danger type="submit">{{ __('Confirm') }}</x-button-danger>
            </div>
        </form>
    </x-modal>
    
@endsection