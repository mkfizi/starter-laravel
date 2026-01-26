<x-offcanvas id="offcanvas-filter-user" position="right" width="sm">
    <form method="GET" action="{{ route('dashboard.admin.users.index') }}" class="space-y-8">
        @csrf
        <div class="space-y-2">
            <x-text class="font-semibold">{{ __('Role') }}</x-text>
            @foreach($roles as $index => $role)
                <x-label for="role-{{ $index }}" class="flex items-center gap-1">
                    <x-input-checkbox 
                        id="role-{{ $index }}" 
                        name="roles[]" 
                        value="{{ $role->name }}" 
                        :checked="is_array(request('roles')) && in_array($role->name, request('roles', []))"
                    />
                    <span class="text-sm">{{ ucfirst($role->name) }}</span>
                </x-label>
            @endforeach
        </div>
        <hr class="border-neutral-200 dark:border-neutral-800"/>
        <div class="flex flex-col gap-2">
            <button type="button" class="flex-auto bg-neutral-100 hover:bg-neutral-200 focus:bg-neutral-200 dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:focus:bg-neutral-600 disabled:opacity-60 px-3 py-2 rounded font-medium text-black dark:text-white text-sm cursor-pointer disabled:pointer-events-none" aria-controls="modal"
                x-on:click="$dispatch('close-offcanvas', { id: 'filter-menu' });"
                :aria-expanded="isOffcanvasOpen"
            >
                <span>Clear</span>
            </button>
            <button type="submit" class="flex-auto bg-black hover:bg-neutral-800 focus:bg-neutral-800 dark:bg-neutral-100 dark:hover:bg-white dark:focus:bg-white disabled:opacity-60 px-3 py-2 rounded font-medium text-white dark:text-black text-sm cursor-pointer disabled:pointer-events-none">
                <span>Apply</span>
            </button>
        </div>
    </form>
</x-offcanvas>