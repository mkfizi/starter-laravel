<x-offcanvas id="offcanvas-filter-activity-log" position="right" width="sm">
    <form method="GET" action="{{ route('dashboard.admin.activity-log.index') }}" class="space-y-8">
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif
        @if(request('per_page'))
            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
        @endif
        <div class="space-y-2">
            <x-text class="font-semibold">{{ __('Action') }}</x-text>
            @php
                $actions = ['created', 'updated', 'deleted', 'login', 'logout', 'failed login attempt'];
            @endphp
            @foreach($actions as $index => $action)
                <x-label for="action-{{ $index }}" class="flex items-center gap-1">
                    <x-input-checkbox 
                        id="action-{{ $index }}" 
                        name="actions[]" 
                        value="{{ $action }}" 
                        :checked="is_array(request('actions')) && in_array($action, request('actions', []))"
                    />
                    <span class="text-sm capitalize">{{ $action }}</span>
                </x-label>
            @endforeach
        </div>
        <hr class="border-neutral-200 dark:border-neutral-800"/>
        <div class="space-y-2">
            <x-text class="font-semibold">{{ __('Date Range') }}</x-text>
            <div class="space-y-1">
                <x-label for="date_from">{{ __('From') }}</x-label>
                <x-input 
                    id="date_from" 
                    name="date_from" 
                    type="date" 
                    class="w-full" 
                    :value="request('date_from')"
                />
            </div>
            <div class="space-y-1">
                <x-label for="date_to">{{ __('To') }}</x-label>
                <x-input 
                    id="date_to" 
                    name="date_to" 
                    type="date" 
                    class="w-full" 
                    :value="request('date_to')"
                />
            </div>
        </div>
        <hr class="border-neutral-200 dark:border-neutral-800"/>
        <div class="flex flex-col gap-2">
            <x-button-secondary type="button" class="flex-auto"
                x-on:click="window.location.href='{{ route('dashboard.admin.activity-log.index', request()->only(['search', 'per_page'])) }}'"
            >
                <span>{{ __('Clear') }}</span>
            </x-button-secondary>
            <x-button type="submit" class="flex-auto">
                <span>{{ __('Apply') }}</span>
            </x-button>
        </div>
    </form>
</x-offcanvas>
