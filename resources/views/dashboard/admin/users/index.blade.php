<x-layouts.dashboard title="{{ __('Users') }}">
    <div class="space-y-4">
        <div class="flex sm:flex-row flex-col justify-between gap-4">
            <div class="flex gap-2">
                <x-input-search route="{{ route('dashboard.admin.users.index') }}" />
            </div>
            <x-button-link href="{{ route('dashboard.admin.users.create') }}" class="text-center">{{ __('Create New') }}</x-button-link>
        </div>
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
                                <x-link href="{{ route('dashboard.admin.users.show', $user->id) }}" aria-label="{{ __('View user.') }}">
                                    <x-icon>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/></svg>
                                    </x-icon>
                                </x-link>
                                @php
                                    $superAdminEmail = config('app.super_admin');
                                    $isUserSuperAdmin = $user->email === $superAdminEmail;
                                @endphp
                                @if(!$isUserSuperAdmin) 
                                    <x-link href="{{ route('dashboard.admin.users.edit', $user->id) }}" aria-label="{{ __('Edit user.') }}">
                                        <x-icon>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/><path d="M16 5l3 3"/></svg>
                                        </x-icon>
                                    </x-link>
                                    <x-link href="#" aria-label="{{ __('Delete user.') }}"
                                        x-data="{ isModalOpen: false }"
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
                                @endif
                            </div>
                        </x-table-td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <x-table-td ::colspan="5" class="text-center">
                        <x-text>{{ __('No data available.') }}</x-text>
                    </x-table-td>
                </tr>
            @endif
        </x-table>
        <x-pagination :data="$users" :route="route('dashboard.admin.users.index')" />
    </div>
    @include('dashboard.admin.users.partials.modal-delete-user')
</x-layouts.dashboard>
