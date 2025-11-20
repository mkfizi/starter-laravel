@props([
    'position' => 'right',
])

<x-dropdown 
    id="dark-mode-menu"
    position="{{ $position }}"
>
    <x-slot name="trigger">
    <x-button-ghost type="button" class="p-2!" aria-controls="dark-mode-menu" aria-label="Toggle dark mode menu.">
            <x-icon class="dark:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.828 14.828a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z"/><path d="M6.343 17.657l-1.414 1.414"/><path d="M6.343 6.343l-1.414 -1.414"/><path d="M17.657 6.343l1.414 -1.414"/><path d="M17.657 17.657l1.414 1.414"/><path d="M4 12h-2"/><path d="M12 4v-2"/><path d="M20 12h2"/><path d="M12 20v2"/></svg>
            </x-icon>
            <x-icon class="hidden dark:block">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"/></svg>
            </x-icon>
        </x-button-ghost>
    </x-slot>
    <div class="space-y-1"
        x-data="{
            theme: localStorage.theme || 'system',
            toggleTheme(newTheme) {
                this.theme = newTheme;
                newTheme === 'system' 
                    ? localStorage.removeItem('theme') 
                    : localStorage.theme = newTheme;
                document.documentElement.classList.toggle('dark', 
                    newTheme === 'dark' || (newTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)
                );
                this.$root.isDropdownOpen = false;
            }
        }"
    >
        <x-dropdown-button type="button" class="flex items-center gap-2" aria-label="Set light theme."
            x-on:click="toggleTheme('light')"
            ::class="{'bg-neutral-100 dark:bg-neutral-800': theme === 'light'}"
        >
            <x-icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"/></svg>
            </x-icon>
            <span>{{ __('Light') }}</span>
        </x-dropdown-button>
        <x-dropdown-button type="button" class="flex items-center gap-2" aria-label="Set dark theme."
            x-on:click="toggleTheme('dark')"
            ::class="{'bg-neutral-100 dark:bg-neutral-800': theme === 'dark'}"
        >
            <x-icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.828 14.828a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z"/><path d="M6.343 17.657l-1.414 1.414"/><path d="M6.343 6.343l-1.414 -1.414"/><path d="M17.657 6.343l1.414 -1.414"/><path d="M17.657 17.657l1.414 1.414"/><path d="M4 12h-2"/><path d="M12 4v-2"/><path d="M20 12h2"/><path d="M12 20v2"/></svg>
            </x-icon>
            <span>{{ __('Dark') }}</span>
        </x-dropdown-button>
        <x-dropdown-button type="button" class="flex items-center gap-2" aria-label="Set system theme."
            x-on:click="toggleTheme('system')"
            ::class="{'bg-neutral-100 dark:bg-neutral-800': theme === 'system'}"
        >
            <x-icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10z"/><path d="M7 20h10"/><path d="M9 16v4"/><path d="M15 16v4"/></svg>
            </x-icon>
            <span>{{ __('System') }}</span>
        </x-dropdown-button>
    </div>
</x-dropdown>