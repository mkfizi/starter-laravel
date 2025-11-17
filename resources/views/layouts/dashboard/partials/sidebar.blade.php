<aside id="sidebar" class="hidden invisible lg:visible lg:block top-0 left-0 z-10 fixed lg:sticky bg-black/80 lg:bg-transparent w-dvw lg:w-64 h-dvh"
    x-data="{
        breakpoint: 1024,
        isSidebarOpen: false,
    }"
    x-init="$watch('isSidebarOpen', isSidebarOpen => $dispatch('sidebar-expanded', { id: 'sidebar', isSidebarOpen: isSidebarOpen }))"
    x-trap.noautofocus.noscroll="isSidebarOpen && window.innerWidth < breakpoint"
    x-on:resize.window="
        if (window.innerWidth >= breakpoint && isSidebarOpen) {
            isSidebarOpen = false;
        }
    "
    x-on:click.self="window.innerWidth < breakpoint && (isSidebarOpen = false)"
    x-on:keydown.escape.window="window.innerWidth < breakpoint && (isSidebarOpen = false)"
    x-on:open-sidebar.window="$event.detail.id === 'sidebar' ? isSidebarOpen = true : null"
    x-on:close-sidebar.window="$event.detail.id === 'sidebar' ? isSidebarOpen = false : null"
    :class="{ 'hidden invisible' : !isSidebarOpen }"
    :inert="!isSidebarOpen && window.innerWidth < breakpoint"
>
    @include('layouts.dashboard.partials.sidebar-drawer')
</aside>