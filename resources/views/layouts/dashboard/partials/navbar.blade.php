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
    <div class="flex justify-between lg:justify-end items-center mx-auto px-4 sm:px-8 py-3">
        <div class="lg:hidden lg:invisible flex items-center gap-4">
            {{-- Sidebar Open --}}
            <x-button-ghost type="button" class="!p-2" aria-controls="sidebar" aria-label="Open sidebar."
                x-data="{ isSidebarOpen: false }"
                @click="$dispatch('open-sidebar')"
                @set-sidebar-expanded.window="isSidebarOpen = $event.detail"
                ::aria-expanded="isSidebarOpen"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l16 0"/><path d="M4 12l16 0"/><path d="M4 18l16 0"/></svg>
            </x-button-ghost>
            {{-- END Sidebar Open --}}
            <a href="{{ route('dashboard') }}" class="font-medium text-neutral-800 dark:text-neutral-200 text-lg">Title</a>
        </div>
        @include('layouts.dashboard.partials.navbar-buttons')
    </div>
</nav>