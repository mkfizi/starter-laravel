<x-modal id="modal-delete-user">
    <div
        x-data="{
            userId: null,
            userName: null,
        }"
        x-on:set-user.window="
            userId = $event.detail.id
            userName = $event.detail.name
        "
    >
        <form method="POST" :action="`{{ route('dashboard.admin.users.destroy', 0) }}`.replace('/0', `/${userId}`)">
            @csrf
            @method('DELETE')
            <div class="space-y-4">
                <x-title>{{ __('Delete User') }}</x-title>
                <x-text>{{ __('Are you sure you want to delete this user?') }}</x-text>
                <div>
                    <x-label for="name">{{ __('User Name') }}</x-label>
                    <x-input id="name" name="name" type="text" class="w-full" x-model="userName" disabled />
                </div>
                <div class="flex justify-end gap-2">
                     <x-button-secondary type="button" 
                        x-on:click="$dispatch('close-modal', { id: 'modal-delete-user' })"
                        ::aria-expanded="isModalOpen"
                        aria-controls="modal-delete-user"
                    >{{ __('Cancel') }}</x-button-secondary>
                    <x-button-danger type="submit">{{ __('Delete') }}</x-button-danger>
                </div>
            </div>
        </form>
    </div>
</x-modal>
