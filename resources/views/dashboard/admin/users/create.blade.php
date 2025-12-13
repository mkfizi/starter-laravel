<x-layouts.dashboard title="{{ __('Users') }}">
    <div class="space-y-4">
        <div class="flex justify-between gap-2">
            <x-button-link-outline href="{{ route('dashboard.admin.users.index') }}">{{ __('Back' )}}</x-button-link-outline>
        </div>
        <x-card>
            <form action="{{ route('dashboard.admin.users.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="space-y-4 max-w-screen-sm">
                    <x-title>{{ __('Create New User') }}</x-title>
                    <div class="space-y-1">
                        <x-label for="name">{{ __('Name') }}</x-label>
                        <x-input id="name" name="name" type="text" class="w-full" required placeholder="{{ __('Enter name') }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="email">{{ __('Email') }}</x-label>
                        <x-input id="email" name="email" type="email" class="w-full" required placeholder="{{ __('Enter email') }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="password">{{ __('Password') }}</x-label>
                        <x-input-password id="password" name="password" type="password" class="w-full" required placeholder="{{ __('Enter password') }}" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="password_confirmation">{{ __('Confirm Password') }}</x-label>
                        <x-input-password id="password_confirmation" name="password_confirmation" type="password" class="w-full" required placeholder="{{ __('Confirm password') }}" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="must_change_password" class="flex items-center gap-1">
                            <x-input-checkbox id="must_change_password" name="must_change_password" checked />
                            <span>{{ __('Force password change') }}</span>
                        </x-label>
                    </div>
                    <div class="space-y-1">
                        <x-label>{{ __('Roles') }}</x-label>
                        <div class="space-y-2">
                            @foreach ($roles as $index =>$role)
                                <x-label for="role_{{ $index }}" class="flex items-center gap-1">
                                    <x-input-checkbox id="role_{{ $index }}" name="roles[]" value="{{ $role->id }}" />
                                    <span>{{ $role->name }}</span>
                                </x-label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                    </div>
                </div>
                <div class="mt-8 flexgap-2">
                    <x-button type="submit">{{ __('Create' )}}</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-layouts.dashboard>
