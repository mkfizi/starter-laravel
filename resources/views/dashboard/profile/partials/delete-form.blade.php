<x-card class="max-w-screen-sm">
    <div class="space-y-4">
        <x-text-title>{{ __('Delete Account') }}</x-text-title>
        <x-text>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</x-text>
    </div>
    <div class="flex gap-2 mt-8">
        <x-button-danger
            x-data="{ isModalOpen: false }"
            @click="$dispatch('open-modal')"
            @set-modal-expanded.window="isModalOpen = $event.detail"
            ::aria-expanded="isModalOpen"
        >{{ __('Delete Account' )}}</x-button-danger>
    </div>
</x-card>

<x-modal 
    title="{{ __('Delete Account') }}" 
    confirmStyle="danger"
    formRoute="{{ route('dashboard.profile.destroy', $user) }}"
    method="DELETE"
>
    <x-text>{{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. To proceed, please enter your password.') }}</x-text>
    <x-input id="password" name="password" type="password" class="mt-2" placeholder="{{ __('Enter your password') }}" required />
</x-modal>