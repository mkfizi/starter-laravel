<x-offcanvas id="offcanvas-filter-user" position="right" width="sm">
    <form method="GET" action="{{ route('dashboard.admin.users.index') }}" class="space-y-8">
        @csrf
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif
        @if(request('per_page'))
            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
        @endif
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
            <x-button-secondary type="button" class="flex-auto"
                x-on:click="window.location.href='{{ route('dashboard.admin.users.index', request()->only(['search', 'per_page'])) }}'"
            >
                <span>Clear</span>
            </x-button-secondary>
            <x-button type="submit" class="flex-auto">
                <span>Apply</span>
            </x-button>
        </div>
    </form>
</x-offcanvas>