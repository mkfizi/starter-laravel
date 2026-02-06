<div class="flex gap-2">
    <x-dark-mode-menu position="!-right-22 mt-2" />
    <x-language-menu position="!-right-11 mt-2" />
    <x-dropdown 
        id="settings-menu"
        position="right-0 mt-2"
    >
        <x-slot name="trigger">
            <x-button-ghost type="button" class="p-2!" aria-controls="settings-menu" aria-label="{{ __('Toggle settings menu.') }}">
                <x-icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"/><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/></svg>
                </x-icon>
            </x-button-ghost>
        </x-slot>
        <x-dropdown-link href="{{ route('dashboard.profile') }}">{{ __('Profile') }}</x-dropdown-link>
        <x-dropdown-link href="{{ route('dashboard.settings.account') }}">{{ __('Settings') }}</x-dropdown-link>
        <x-dropdown-divider />
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-button>{{ __('Logout') }}</x-dropdown-button>
        </form>
    </x-dropdown>   
</div>