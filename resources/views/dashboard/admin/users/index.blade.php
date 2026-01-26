@php
    $activeFilters = collect(request('roles', []))->count();
    $hasFilters = $activeFilters > 0;
@endphp

<x-layouts.dashboard title="{{ __('Users') }}">
    <div class="space-y-4">
        <div class="flex sm:flex-row flex-col justify-between gap-4">
            <div class="flex gap-2">
                <x-input-search route="{{ route('dashboard.admin.users.index') }}" :searchText="__('Search user\'s name/email')" class="sm:w-72"/>
                <x-button class="p-2!" aria-label="{{ __('Filter users.') }}"
                    x-data="{ isOffcanvasOpen: false }"
                    x-on:click="$dispatch('open-offcanvas', { id: 'offcanvas-filter-user' })"
                    x-on:offcanvas-filter-user-expanded.window="$event.detail.id === 'offcanvas-filter-user' ? isOffcanvasOpen = $event.detail.isOffcanvasOpen : null"
                    ::aria-expanded="isOffcanvasOpen"
                    aria-controls="offcanvas-filter-user"
                >
                    <x-icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z"/></svg>
                    </x-icon>
                    @if($hasFilters)
                        <span class="top-0 right-0 absolute bg-neutral-300 dark:bg-neutral-600 -mt-1 -mr-1 px-1.5 rounded-full font-semibold text-neutral-800 dark:text-neutral-200 text-xs">
                            {{ $activeFilters }}
                        </span>
                    @endif
                </x-button>
            </div>
            <x-button-link href="{{ route('dashboard.admin.users.create') }}" class="text-center">{{ __('Create New') }}</x-button-link>
        </div>
        @if($hasFilters)
            <div class="flex flex-wrap items-center gap-2">
                <x-text>{{ __('Active filters:') }}</x-text>
                @foreach(request('roles', []) as $role)
                    <x-badge class="inline-flex items-center gap-1">
                        <span>{{ ucfirst($role) }}</span>
                        <x-link href="{{ route('dashboard.admin.users.index', array_merge(request()->except('roles'), ['roles' => array_diff(request('roles', []), [$role])])) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                        </x-link>
                    </x-badge>
                @endforeach
                <x-link href="{{ route('dashboard.admin.users.index', request()->only(['search', 'per_page'])) }}" class="text-xs hover:underline">
                    {{ __('Clear all') }}
                </x-link>
            </div>
        @endif
        <x-table>
            <x-slot name="header">
                <x-table-th><x-text>{{ __('No') }}</x-text></x-table-th>
                <x-table-th><x-text>{{ __('Name') }}</x-text></x-table-th>
                <x-table-th><x-text>{{ __('Email') }}</x-text></x-table-th>
                <x-table-th><x-text>{{ __('Role') }}</x-text></x-table-th>
                <x-table-th></x-table-th>
            </x-slot>
            @if (count($users) > 0)
                @foreach ($users as $index => $user)
                    <tr>
                        <x-table-td class="w-1/12">
                            <x-text>{{ $users->firstItem() + $index }}</x-text>
                        </x-table-td>
                        <x-table-td><x-text>{{ $user->name }}</x-text></x-table-td>
                        <x-table-td><x-text>{{ $user->email }}</x-text></x-table-td>
                        <x-table-td><x-text>{{ $user->roles->pluck('name')->join(', ') }}</x-text></x-table-td>
                        <x-table-td class="w-16">
                            <div class="flex gap-2">
                                <x-tooltip text="{{ __('View User') }}">
                                    <x-link href="{{ route('dashboard.admin.users.show', $user->id) }}" aria-label="{{ __('View user.') }}">
                                        <x-icon>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-note"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 20l7 -7" /><path d="M13 20v-6a1 1 0 0 1 1 -1h6v-7a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7" /></svg>
                                        </x-icon>
                                    </x-link>
                                </x-tooltip>
                                @php
                                    $superAdminEmail = config('app.super_admin');
                                    $isUserSuperAdmin = $user->email === $superAdminEmail;
                                @endphp
                                @if(!$isUserSuperAdmin) 
                                    <x-tooltip text="{{ __('Edit User') }}">
                                        <x-link href="{{ route('dashboard.admin.users.edit', $user->id) }}" aria-label="{{ __('Edit user.') }}">
                                            <x-icon>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/><path d="M16 5l3 3"/></svg>
                                            </x-icon>
                                        </x-link>
                                    </x-tooltip>
                                    <span x-data="{ isModalOpen: false }">
                                        <x-tooltip text="{{ __('Delete User') }}">
                                            <x-link href="#" aria-label="{{ __('Delete user.') }}"
                                                x-on:click.prevent="
                                                    $dispatch('set-user', {
                                                        id: '{{ addslashes($user->id) }}',
                                                        name: '{{ addslashes($user->name) }}'
                                                    });
                                                    $dispatch('open-modal', { id: 'modal-delete-user' });
                                                "
                                                x-on:modal-delete-user-expanded.window="$event.detail.id === 'modal-delete-user' ? isModalOpen = $event.detail.isModalOpen : null"
                                                ::aria-expanded="isModalOpen"
                                                aria-controls="modal-delete-user"
                                            >
                                                <x-icon>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"/><path d="M9 9l6 6m0 -6l-6 6"/></svg>
                                                </x-icon>
                                            </x-link>
                                        </x-tooltip>
                                    </span>
                                @endif
                            </div>
                        </x-table-td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <x-table-td :colspan="5" class="text-center">
                        <x-text>{{ __('No data available.') }}</x-text>
                    </x-table-td>
                </tr>
            @endif
        </x-table>
        <x-pagination :data="$users" :route="route('dashboard.admin.users.index')" />
    </div>
    @include('dashboard.admin.users.partials.modal-delete-user')
    @include('dashboard.admin.users.partials.offcanvas-filter-user')
</x-layouts.dashboard>
