@php
    $permissionTypes = [
        'read' => __('Read'),
        'create' => __('Create'),
        'update' => __('Update'),
        'delete' => __('Delete'),
    ];
@endphp

<x-layouts.dashboard title="{{ __('Role Management') }}">
    <div class="space-y-4">
        <div class="flex justify-between gap-2">
            <x-button-link-outline href="{{ route('dashboard.admin.roles.index') }}">{{ __('Back' )}}</x-button-link-outline>
        </div>
        <x-card>
            <form action="{{ route('dashboard.admin.roles.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="space-y-4 max-w-screen-sm">
                    <x-title>{{ __('Create New Role') }}</x-title>
                    <div class="space-y-1">
                        <x-label for="name">{{ __('Name') }}</x-label>
                        <x-input id="name" name="name" type="text" class="w-full" required />
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
                                                @endphp
                                                @if($perm)
                                                    <x-input-checkbox 
                                                        value="{{ $perm['name'] }}" 
                                                        name="permissions[]" 
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
                    <x-button type="submit">{{ __('Create' )}}</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-layouts.dashboard>