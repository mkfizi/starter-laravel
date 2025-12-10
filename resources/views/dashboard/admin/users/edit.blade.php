<x-layouts.dashboard title="{{ __('Users') }}">
    <div class="space-y-4">
        <div class="flex justify-between gap-2">
            <x-button-link-outline href="{{ route('dashboard.admin.users.index') }}">{{ __('Back' )}}</x-button-link-outline>
        </div>
        <x-card>
            <form action="{{ route('dashboard.admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4 max-w-screen-sm">
                    <x-title>{{ __('Update User') }}</x-title>
                    <div class="space-y-1">
                        <x-label for="name">{{ __('Name') }}</x-label>
                        <x-input id="name" name="name" type="text" class="w-full" value="{{ $user->name }}" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="email">{{ __('Email') }}</x-label>
                        <x-input id="email" name="email" type="email" class="w-full" value="{{ $user->email }}" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="password">{{ __('Password') }}</x-label>
                        <x-input id="password" name="password" type="password" class="w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <x-text class="text-neutral-500 text-xs">{{ __('Leave blank to keep current password.') }}</x-text>
                    </div>
                    <div class="space-y-1">
                        <x-label for="roles">{{ __('Roles') }}</x-label>
                        <x-select id="roles" name="roles[]" class="w-full" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @if($user->roles->contains($role->id)) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('roles')" class="mt-2" />
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
