@extends('dashboard.settings.index')

@section('content')
    <div class="space-y-8">
        <x-card>
            <form action="{{ route('dashboard.settings.update-profile', $user) }}" method="POST">
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
        <x-card>
            <div class="space-y-4">
                <x-text-title>{{ __('Delete Account') }}</x-text-title>
                <x-text>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</x-text>
            </div>
            <div class="flex gap-2 mt-8">
                <x-button-danger
                    x-data="{ isModalOpen: false }"
                    @click="$dispatch('open-modal-delete-account')"
                    @set-modal-delete-account.window="isModalOpen = $event.detail"
                    ::aria-expanded="isModalOpen"
                    aria-controls="modal-delete-account"
                >{{ __('Delete Account' )}}</x-button-danger>
            </div>
        </x-card>
    </div>
    <x-modal-form
        id="modal-delete-account"
        title="{{ __('Delete Account') }}" 
        route="{{ route('dashboard.settings.destroy', $user) }}"
        method="DELETE"
    >
        <x-text>{{ __('Please enter your password to proceed with account deletion.') }}</x-text>
        <x-input id="password" name="password" type="password" placeholder="{{ __('Enter your password') }}" required />
        <x-slot name="submit">
            <x-button-danger type="submit">{{ __('Confirm') }}</x-button-danger>
        </x-slot>
    </x-modal-form>
@endsection