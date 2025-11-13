<nav class="top-0 z-1 sticky w-full"
    x-data="{
        breakpoint: 1024,
        isScrolled: window.scrollY > 0,
    }"
    @scroll.window="isScrolled = window.scrollY > 0;"
    :class="{
        'bg-white dark:bg-neutral-950 border-b border-neutral-200 dark:border-neutral-800': isScrolled,
        'bg-transparent dark:bg-transparent border-transparent': !isScrolled
    }"
>
    <div class="flex justify-between lg:justify-end items-center mx-auto px-4 sm:px-8 py-2">
        <div class="lg:hidden lg:invisible flex items-center gap-4">
            {{-- Sidebar Open --}}
            <x-button-ghost type="button" class="!p-2" aria-controls="sidebar" aria-label="Open sidebar."
                x-data="{ isSidebarOpen: false }"
                @click="$dispatch('open-sidebar');"
                @set-sidebar-expanded.window="isSidebarOpen = $event.detail"
                ::aria-expanded="isSidebarOpen"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l16 0"/><path d="M4 12l16 0"/><path d="M4 18l16 0"/></svg>
            </x-button-ghost>
            {{-- END Sidebar Open --}}
            <a href="{{ route('dashboard') }}" class="font-medium text-neutral-800 dark:text-neutral-200 text-base">Title</a>
        </div>
        <div class="flex gap-2">
            {{-- Notification Menu Component --}}
            <x-dropdown 
                id="notification-menu"
                width="lg"
                position="-right-22"
            >
                <x-slot name="custom">
                    <x-button-ghost type="button" class="relative !p-2" aria-controls="dark-mode-menu" aria-label="Toggle dark mode menu."
                        x-ref="button"
                        @click="isDropdownOpen = !isDropdownOpen"
                        ::aria-expanded="isDropdownOpen"
                    >   
                        <div class="top-1 right-1 z-10 absolute bg-red-500 rounded-full w-2 h-2"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                    </x-button-ghost>
                </x-slot>
                <x-dropdown-link href="#">
                    <span class="block font-normal">This is a example text paragraph for notification.</span>
                    <span class="block font-normal text-end">
                        <small>1 hour ago</small>
                    </span>
                </x-dropdown-link>
                <x-dropdown-divider />
                <x-dropdown-link href="#">
                    <span class="block font-normal">This is a example text paragraph for notification.</span>
                    <span class="block font-normal text-end">
                        <small>8 hours ago</small>
                    </span>
                </x-dropdown-link>
                <x-dropdown-divider />
                <x-dropdown-link href="#">
                    <span class="block font-normal">This is a example text paragraph for notification.</span>
                    <span class="block font-normal text-end">
                        <small>1 day ago</small>
                    </span>
                </x-dropdown-link>
                <x-dropdown-divider />
                <x-dropdown-link href="#" class="!text-center">{{ __('View All Notifications') }}</x-dropdown-link>
            </x-dropdown>
            {{-- END Notification Menu --}} 
            {{-- Dark Mode Menu --}}
            <x-dark-mode-menu position="-right-11" />
            {{-- END Dark Mode Menu --}}
            {{-- Settings Menu --}}
            <x-dropdown 
                id="settings-menu"
                position="right"
            >
                <x-slot name="custom">
                    <x-button-ghost type="button" class="!p-2" aria-controls="dark-mode-menu" aria-label="Toggle dark mode menu."
                        x-ref="button"
                        @click="isDropdownOpen = !isDropdownOpen"
                        ::aria-expanded="isDropdownOpen"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"/><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/></svg>
                    </x-button-ghost>
                </x-slot>
                <x-dropdown-link href="#">{{ __('Profile') }}</x-dropdown-link>
                <x-dropdown-link href="#">{{ __('Settings') }}</x-dropdown-link>
                <x-dropdown-divider />
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <x-dropdown-button>{{ __('Logout') }}</x-dropdown-button>
                </form>
            </x-dropdown>
            {{-- END Settings Menu --}}     
        </div>
    </div>
</nav>