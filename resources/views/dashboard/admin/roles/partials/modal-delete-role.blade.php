<x-modal id="modal-delete-role">
    <div 
        x-data="{
            roleId: null,
            roleName: null,
        }"
        x-on:set-role.window="
            roleId = $event.detail.id
            roleName = $event.detail.name
        "
    >
    <form method="POST" :action="`{{ route('dashboard.admin.roles.destroy', 0) }}`.replace('/0', `/${roleId}`)">
        @csrf
        @method('DELETE')
        <div class="space-y-4">
            <x-title>{{ __('Delete Role') }}</x-title>
            <x-text>{{ __('Are you sure you want to delete this role?') }}</x-text>
        </div>
        <div class="space-y-1 mt-4">
            <x-label for="name">{{ __('Role Name') }}</x-label>
            <x-input for="name" type="text" ::value="roleName" disabled/>
        </div>
        <div class="flex justify-end gap-2 mt-8">
            <x-button-secondary type="button" 
                x-on:click="$dispatch('close-modal', { id: 'modal-delete-role' })"
                ::aria-expanded="isModalOpen"
                aria-controls="modal-delete-role"
            >{{ __('Cancel') }}</x-button-secondary>
            <x-button-danger type="submit">{{ __('Delete') }}</x-button-danger>
        </div>
    </form>
</x-modal>