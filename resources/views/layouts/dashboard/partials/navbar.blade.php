<nav class="top-0 z-1 sticky w-full"
    x-data="{
        breakpoint: 1024,
        isScrolled: window.scrollY > 0,
    }"
    x-on:scroll.window="isScrolled = window.scrollY > 0;"
    :class="{
        'bg-white dark:bg-neutral-950 border-b border-neutral-200 dark:border-neutral-800': isScrolled,
        'bg-transparent dark:bg-transparent border-transparent': !isScrolled
    }"
>
    <div class="flex justify-between lg:justify-end items-center mx-auto px-4 sm:px-8 py-3">
        <div class="lg:hidden lg:invisible flex items-center gap-4">
            {{-- Sidebar Open --}}
            <x-button-ghost type="button" class="p-2!" aria-controls="sidebar" aria-label="{{ __('Open sidebar.') }}"
                x-data="{ isSidebarOpen: false }"
                x-on:click="$dispatch('open-sidebar', { id: 'sidebar' })"
                x-on:sidebar-expanded.window="$event.detail.id === 'sidebar' ? isSidebarOpen = $event.detail.isSidebarOpen : null"
                ::aria-expanded="isSidebarOpen"
            >
                <x-icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l16 0"/><path d="M4 12l16 0"/><path d="M4 18l16 0"/></svg>
                </x-icon>
            </x-button-ghost>
            {{-- END Sidebar Open --}}
            <x-nav-title />
        </div>
        @include('layouts.dashboard.partials.navbar-buttons')
    </div>
</nav>