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
    <div class="top-3 left-4 sm:left-8 absolute flex">
        <button type="button" class="hover:bg-neutral-100 focus:bg-neutral-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 disabled:opacity-60 p-2 rounded font-medium text-black dark:text-white text-sm cursor-pointer disabled:pointer-events-none" aria-controls="sidebar" aria-label="Open sidebar."
            x-data="{ isSidebarOpen: false }"
            @click="$dispatch('toggle-sidebar', { id: 'sidebar' })"
            @sidebar-expanded.window="$event.detail.id === 'sidebar' ? isSidebarOpen = $event.detail.isSidebarOpen : null"
            :aria-expanded="isSidebarOpen"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l16 0"/><path d="M4 12l16 0"/><path d="M4 18l16 0"/></svg>
        </button>
    </div>
    <div class="flex justify-between lg:justify-end items-center mx-auto px-4 sm:px-8 py-3">
        <div class="lg:hidden lg:invisible pl-13">
            <a href="{{ route('dashboard') }}" class="font-medium text-neutral-800 dark:text-neutral-200 text-lg">Title</a>
        </div>
        @include('layouts.dashboard.partials.navbar-dropdowns')
    </div>
</nav>