<aside id="sidebar" class="hidden invisible lg:visible lg:block top-0 left-0 z-10 fixed lg:sticky bg-black/80 lg:bg-transparent w-dvw lg:w-64 h-dvh"
    x-data="{
        breakpoint: 1024,
        isSidebarOpen: false,
        isDesktopSidebarOpen: $persist(true).as('is-sidebar-open'),
    }"
    x-init="
        isSidebarOpen = window.innerWidth >= breakpoint ? isDesktopSidebarOpen : false;
        $watch('isSidebarOpen', value => {
            if (window.innerWidth >= breakpoint) {
                isDesktopSidebarOpen = value;
            }
            $dispatch('sidebar-expanded', { id: 'sidebar', isSidebarOpen: isSidebarOpen })
        });
    "
    x-trap.noautofocus.noscroll="isSidebarOpen && window.innerWidth < breakpoint"
    x-on:resize.window="
        const isDesktop = window.innerWidth >= breakpoint;
        if (isDesktop) {
            isSidebarOpen = isDesktopSidebarOpen;
        } else if (isSidebarOpen) {
            isSidebarOpen = false;
        }
    "
    x-on:click.self="window.innerWidth < breakpoint && (isSidebarOpen = false)"
    x-on:keydown.escape.window="window.innerWidth < breakpoint && (isSidebarOpen = false)"
    x-on:toggle-sidebar.window="$event.detail.id === 'sidebar' ? isSidebarOpen = !isSidebarOpen : null"
    x-on:open-sidebar.window="$event.detail.id === 'sidebar' ? isSidebarOpen = true : null"
    x-on:close-sidebar.window="$event.detail.id === 'sidebar' ? isSidebarOpen = false : null"
    :class="{ 
        'hidden invisible' : !isSidebarOpen,
        'lg:block lg:visible' : isDesktopSidebarOpen
    }"
    :inert="!isSidebarOpen && window.innerWidth < breakpoint"
>
    {{-- Sidebar Drawer --}}
    <div class="top-0 left-0 flex flex-col bg-white dark:bg-neutral-950 border-neutral-200 dark:border-neutral-800 border-r w-full sm:w-64 h-full">
        {{-- Sidebar Close --}}
        <x-button-ghost type="button" class="lg:hidden lg:invisible top-2 right-2 absolute !p-2" aria-controls="sidebar" aria-label="Close sidebar."
            x-on:click="$dispatch('close-sidebar', { id: 'sidebar' })"
            ::aria-expanded="isSidebarOpen"
            aria-controls="sidebar"
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
                    <li>
                        @if (request()->routeIs($link['route']))
                            <x-button-link-secondary href="{{ route($link['route']) }}" class="w-full {{ isset($link['icon']) ? 'flex items-center gap-2' : 'inline-block' }}">
                                @isset($link['icon'])
                                    <span class="stroke-black dark:stroke-white">{!! $link['icon'] !!}</span>
                                    <span>{{ $link['title'] }}</span>
                                @else
                                    {{ $link['title'] }}
                                @endisset
                            </x-button-link-secondary>
                        @else
                            <x-button-link-ghost href="{{ route($link['route']) }}" class="w-full {{ isset($link['icon']) ? 'flex items-center gap-2' : 'inline-block' }}">
                                @isset($link['icon'])
                                    <span class="stroke-black dark:stroke-white">{!! $link['icon'] !!}</span>
                                    <span>{{ $link['title'] }}</span>
                                @else
                                    {{ $link['title'] }}
                                @endisset
                            </x-button-link-ghost>
                        @endif
                    </li>
                @elseif(isset($link['href']))
                    <li>
                        <x-button-link-ghost href="{{ $link['href'] }}" class="w-full @isset($link['icon']) flex items-center gap-2 @else inline-block @endisset">
                            @isset($link['icon'])
                                <span class="stroke-black dark:stroke-white" >{!! $link['icon'] !!}</span>
                                <span>{{ $link['title'] }}</span>
                            @else
                                {{ $link['title'] }}
                            @endisset
                        </x-button-link-ghost>
                    </li>
                @elseif(isset($link['links']))
                    <li>
                        <div class="space-y-1"
                            x-data="{ isCollapseOpen: {{ request()->routeIs($link['route'].'*') ? 'true' : 'false' }} }"
                        >
                            @if (request()->routeIs($link['route'].'*'))
                                <x-button-secondary type="button" class="flex justify-between items-center w-full" aria-label="Toggle module menu."
                                    x-on:click="isCollapseOpen = !isCollapseOpen" 
                                    ::aria-expanded="isCollapseOpen"
                                >
                                    @isset($link['icon'])
                                        <span class="flex items-center gap-2">
                                            <span class="stroke-black dark:stroke-white">{!! $link['icon'] !!}</span>
                                            <span>{{ $link['title'] }}</span>
                                        </span>
                                    @else
                                        {{ $link['title'] }}
                                    @endisset
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-black dark:stroke-white w-5 h-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9l4 -4l4 4"/><path d="M16 15l-4 4l-4 -4"/></svg>
                                </x-button-secondary>
                            @else
                                <x-button-ghost type="button" class="flex justify-between items-center w-full" aria-label="Toggle module menu."
                                    x-on:click="isCollapseOpen = !isCollapseOpen" 
                                    ::aria-expanded="isCollapseOpen"
                                >
                                    @isset($link['icon'])
                                        <span class="flex items-center gap-2">
                                            <span class="stroke-black dark:stroke-white">{!! $link['icon'] !!}</span>
                                            <span>{{ $link['title'] }}</span>
                                        </span>
                                    @else
                                        {{ $link['title'] }}
                                    @endisset
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-black dark:stroke-white w-5 h-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9l4 -4l4 4"/><path d="M16 15l-4 4l-4 -4"/></svg>
                                </x-button-ghost>
                            @endif
                            <div class="overflow-hidden"
                                x-show="isCollapseOpen"
                                x-cloak
                                :inert="!isCollapseOpen"
                            >
                                <ul class="space-y-1 leading-0">
                                    @foreach ($link['links'] as $sublink)
                                        <li>
                                            @if (request()->routeIs($sublink['route']))
                                                <x-button-link-secondary href="{{ route($sublink['route']) }}" class="inline-block w-full">{{ $sublink['title'] }}</x-button-link-secondary>
                                            @else
                                                <x-button-link-ghost href="{{ route($sublink['route']) }}" class="inline-block w-full">{{ $sublink['title'] }}</x-button-link-ghost>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @else
                    <li>
                        <p class="mt-4 py-2 font-semibold text-black dark:text-white text-xs uppercase tracking-wide">
                            @isset($link['icon'])
                                <span class="flex items-center gap-2">
                                    <span class="stroke-black dark:stroke-white">{!! $link['icon'] !!}</span>
                                    <span>{{ $link['title'] }}</span>
                                </span>
                            @else
                                {{ $link['title'] }}
                            @endisset
                        </p>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    {{-- END Sidebar Drawer --}}
</aside>
{{-- Prevent FOUC when sidebar is closed on desktop --}}
<script>
    const isClosed = localStorage.getItem('is-sidebar-open') === 'false';
    if (window.innerWidth >= 1024 && isClosed) {
        document.querySelector('aside[x-data]')?.classList.remove('lg:block', 'lg:visible');
    }
</script>
{{-- END Prevent FOUC --}}