@extends('dashboard.settings.index')

@section('content')
    <x-card>
        <div class="max-w-screen-sm">
            <form action="{{ route('dashboard.settings.update-password', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <x-title>{{ __('Update Password') }}</x-title>
                    <div class="space-y-1">
                        <x-label for="current_password">{{ __('Current Password') }}</x-label>
                        <x-input-password id="current_password" name="current_password" class="w-full" required />
                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="password">{{ __('New Password') }}</x-label>
                        <x-input-password id="password" name="password" class="w-full" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="password_confirmation">{{ __('Confirm New Password') }}</x-label>
                        <x-input-password id="password_confirmation" name="password_confirmation" class="w-full" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
                <div class="space-y-2 mt-8">
                    <x-button type="submit">{{ __('Save' )}}</x-button>
                </div>
            </form>
        </div>
    </x-card>
@endsection