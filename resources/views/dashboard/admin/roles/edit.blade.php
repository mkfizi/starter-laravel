@php
    $permissionTypes = [
        'read' => __('Read'),
        'create' => __('Create'),
        'update' => __('Update'),
        'delete' => __('Delete'),
    ];
@endphp

<x-layouts.dashboard title="{{ __('Role Management') }}">
    {{-- <div class="flex justify-between gap-2">
        <x-button-link-outline href="{{ route('dashboard.admin.roles.index') }}">{{ __('Back' )}}</x-button-link-outline>
        <x-button-link href="{{ route('dashboard.admin.roles.create') }}" class="text-center">{{ __('Create New' )}}</x-button-link>
    </div>
    <x-card>
        <div class="max-w-screen-sm">
            <form action="{{ route('dashboard.admin.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4 max-w-screen-sm">
                    <x-title>{{ __('Edit Role') }}</x-text-title>
                    <div class="space-y-1">
                        <x-label for="name">{{ __('Name') }}</x-label>
                        <x-input id="name" name="name" type="text" class="w-full" :value="old('name', $role->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <div class="gap-4 grid grid-cols-1 sm:grid-cols-3 mt-2">
                            @foreach(config('permission.role_permission.permissions') as $index => $permission)
                                <div>
                                    <x-text class="font-bold">{{ $permission['module'] }}</x-text>
                                    <div class="space-y-1 mt-2">
                                         @foreach($permission['permissions'] as $subindex => $permissionItem)
                                            <div class="flex justify-between items-center">
                                                <x-label for="permission-{{ $index }}-{{ $subindex }}" class="flex items-center gap-1">
                                                    <x-input-checkbox id="permission-{{ $index }}-{{ $subindex }}" name="permissions[]" value="{{ $permissionItem['name'] }}" 
                                                        :checked="$role->hasPermissionTo($permissionItem['name'])"
                                                    />
                                                    <span>{{ $permissionItem['description'] }}</span>
                                                </x-label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('permissions')" class="mt-2" bullet="true"/>
                        <x-input-error :messages="$errors->get('permissions.*')" class="mt-2" bullet="true"/>
                    </div>
                </div>
                <div class="mt-8 flexgap-2">
                    <x-button type="submit">{{ __('Update' )}}</x-button>
                    <x-button-outline type="reset">{{ __('Reset' )}}</x-button-outline>
                </div>
            </form>
        </div>
    </x-card> --}}
    <div class="space-y-4">
        <div class="flex justify-between gap-2">
            <x-button-link-outline href="{{ route('dashboard.admin.roles.index') }}">{{ __('Back' )}}</x-button-link-outline>
        </div>
        <x-card>
            <form action="{{ route('dashboard.admin.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4 max-w-screen-sm">
                    <x-title>{{ __('Update Role') }}</x-title>
                    <div class="space-y-1">
                        <x-label for="name">{{ __('Name') }}</x-label>
                        <x-input id="name" name="name" type="text" class="w-full" value="{{ $role->name }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" /> 
                    </div>
                    <div class="space-y-1">
                        <table>
                            <thead>
                                <tr>
                                    <th class="py-2 w-3/4 text-start">
                                        <x-text>{{ __('Permission') }}</x-text>
                                    </th>
                                    <th class="px-4 py-2">
                                        <x-text>{{ __('Read') }}</x-text>
                                    </th>
                                    <th class="px-4 py-2">
                                        <x-text>{{ __('Create') }}</x-text>
                                    </th>
                                    <th class="px-4 py-2">
                                        <x-text>{{ __('Update') }}</x-text>
                                    </th>
                                    <th class="px-4 py-2">
                                        <x-text>{{ __('Delete') }}</x-text>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
                                @foreach (config('permission.role_permission.permissions') as $permission)
                                    <tr>
                                        <td class="py-2 w-2/3">
                                            <x-text>{{ $permission['module'] }}</x-text>
                                        </td>
                                        @foreach ($permissionTypes as $type => $label)
                                            <td class="py-2 text-center">
                                                @php
                                                    $perm = collect($permission['permissions'])->firstWhere('type', $type);
                                                    $isEditable = !in_array($role->name, config('permission.role_permission.protected.edit'));
                                                @endphp
                                                @if($perm)
                                                    <x-input-checkbox 
                                                        value="{{ $isEditable ? $perm['name'] : '' }}" 
                                                        name="permissions[]" 
                                                        :checked="$role->hasPermissionTo($perm['name'])"
                                                    />
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-input-error :messages="$errors->get('permissions')" class="mt-2" bullet="true"/>
                        <x-input-error :messages="$errors->get('permissions.*')" class="mt-2" bullet="true"/>
                    </div>
                </div>
                <div class="mt-8 flexgap-2">
                    <x-button-outline type="reset">{{ __('Reset' )}}</x-button-outline>
                    <x-button type="submit">{{ __('Update' )}}</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-layouts.dashboard>