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
    {{-- Sidebar Drawer --}}
    <div class="top-0 left-0 flex flex-col bg-white dark:bg-neutral-950 border-neutral-200 dark:border-neutral-800 border-r w-full sm:w-64 h-full">
        {{-- Sidebar Close --}}
        <x-button-ghost type="button" class="lg:hidden lg:invisible top-2 right-2 absolute !p-2" aria-controls="sidebar" aria-label="Close sidebar."
            x-on:click="$dispatch('close-sidebar', { id: 'sidebar' })"
            ::aria-expanded="isSidebarOpen"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
        </x-button-ghost>
        {{-- END Sidebar Close --}}
        <div class="px-4 sm:px-8 py-4">
            <x-nav-title />
        </div>
        <ul class="space-y-1 px-4 sm:px-8 pb-4 overflow-y-auto">
            @foreach(config('routes.dashboard') as $link)
                @if(isset($link['route']) && !isset($link['links']))
                    <x-sidebar-nav-link
                        :active="request()->routeIs($link['route'])"
                        :icon="isset($link['icon']) ? $link['icon'] : null"
                        :title="$link['title']"
                        :route="$link['route']"
                    />
                @elseif(isset($link['href']))
                    <x-sidebar-nav-external
                        :href="$link['href']"
                        :icon="isset($link['icon']) ? $link['icon'] : null"
                        :title="$link['title']"
                    />
                @elseif(isset($link['links']))
                    <x-sidebar-nav-collapse
                        :icon="isset($link['icon']) ? $link['icon'] : null"
                        :links="$link['links']"
                        :title="$link['title']"
                        :route="$link['route']"
                    />
                @else
                    <x-sidebar-nav-title :title="$link['title']" />
                @endif
            @endforeach
        </ul>
    </div>
    {{-- END Sidebar Drawer --}}
</aside>