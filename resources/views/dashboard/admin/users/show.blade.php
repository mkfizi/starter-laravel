<x-layouts.dashboard title="{{ __('Users') }}">
    <div class="space-y-4">
        <div class="flex justify-between gap-2">
            <x-button-link-outline href="{{ route('dashboard.admin.users.index') }}">{{ __('Back' )}}</x-button-link-outline>
        </div>
        <x-card>
            <div class="space-y-4 max-w-screen-sm">
                <x-title>{{ __('User Information') }}</x-title>
                <div class="space-y-1">
                    <x-label for="name">{{ __('Name') }}</x-label>
                    <x-input id="name" name="name" type="text" class="w-full" value="{{ $user->name }}" disabled />
                </div>
                <div class="space-y-1">
                    <x-label for="email">{{ __('Email') }}</x-label>
                    <x-input id="email" name="email" type="email" class="w-full" value="{{ $user->email }}" disabled />
                </div>
                <div class="space-y-1">
                    <x-label>{{ __('Roles') }}</x-label>
                    @if($user->roles->count() > 0)
                        <x-list type="disc">
                            @foreach($user->roles as $role)
                                <x-list-item>{{ $role->name }}</x-list-item>
                            @endforeach
                        </x-list>
                    @else
                        <x-text class="text-neutral-500">{{ __('No roles assigned') }}</x-text>
                    @endif
                </div>
            </div>
            <div class="flex gap-2 mt-8">
                @php
                    $superAdminEmail = config('app.super_admin');
                    $isUserSuperAdmin = $user->email === $superAdminEmail;
                @endphp
                @if(!$isUserSuperAdmin)
                    <x-button-link href="{{ route('dashboard.admin.users.edit', $user->id) }}">{{ __('Edit' )}}</x-button-link>
                    <x-button-danger type="button"
                        x-data="{ isModalOpen: false }"
                        x-on:click="
                            $dispatch('set-user', { id: '{{ $user->id }}', name: '{{ addslashes($user->name) }}' });
                            $dispatch('open-modal', { id: 'modal-delete-user' });
                        "
                        x-on:modal-delete-user-expanded.window="$event.detail.id === 'modal-delete-user' ? isModalOpen = $event.detail.isModalOpen : null"
                        ::aria-expanded="isModalOpen"
                        aria-controls="modal-delete-user"
                    >
                        {{ __('Delete' )}}
                    </x-button-danger>
                @endif
            </div>
        </x-card>
    </div>
    @include('dashboard.admin.users.partials.modal-delete-user')
</x-layouts.dashboard>
