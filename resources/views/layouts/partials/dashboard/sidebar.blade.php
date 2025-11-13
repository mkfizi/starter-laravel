<aside id="sidebar" class="hidden invisible lg:visible lg:block top-0 left-0 z-10 fixed lg:sticky bg-black/80 lg:bg-transparent w-dvw lg:w-64 h-dvh"
    x-data="{
        breakpoint: 1024,
        isSidebarOpen: false,
    }"
    x-init="$watch('isSidebarOpen', isSidebarOpen => $dispatch('set-sidebar-expanded', isSidebarOpen))"
    x-show="isSidebarOpen || window.innerWidth >= breakpoint"
    x-trap.noautofocus.noscroll="isSidebarOpen && window.innerWidth < breakpoint"
    @resize.window="
        if (window.innerWidth >= breakpoint && isSidebarOpen) {
            isSidebarOpen = false;
        }
    "
    @click.self="window.innerWidth < breakpoint && (isSidebarOpen = false)"
    @keydown.escape.window="window.innerWidth < breakpoint && (isSidebarOpen = false)"
    @open-sidebar.window="isSidebarOpen = true"
    :class="{ 'hidden invisible' : !isSidebarOpen }"
    :inert="!isSidebarOpen && window.innerWidth < breakpoint"
>
    {{-- Sidebar Drawer --}}
    <div class="top-0 left-0 flex flex-col bg-white dark:bg-neutral-950 border-neutral-200 dark:border-neutral-800 border-r w-full sm:w-64 h-full">
        {{-- Sidebar Close --}}
        <x-button-ghost type="button" class="lg:hidden lg:invisible top-2 right-2 absolute !p-2" aria-controls="sidebar" aria-label="Close sidebar."
            @click="isSidebarOpen = false"
            ::aria-expanded="isSidebarOpen"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
        </x-button-ghost>
        {{-- END Sidebar Close --}}
        <a href="{{ route('dashboard') }}" class="py-4 pr-4 sm:pr-8 pl-6.5 sm:pl-10.5 font-medium text-neutral-800 dark:text-neutral-200 text-base">{{ config('app.name') }}</a>
        <ul class="space-y-1 px-4 sm:px-8 pb-4 overflow-y-auto">
            @foreach(config('route.dashboard') as $link)
                @if(isset($link['href']))
                    <li>
                        @if (request()->is(ltrim($link['href'], '/')) || request()->is(ltrim($link['href'], '/') . '/*'))
                            <a href="{{ $link['href'] }}" class="inline-block bg-neutral-100 dark:bg-neutral-800 px-3 py-2 rounded w-full font-medium text-black dark:text-white text-sm text-left cursor-pointer">{{ $link['name'] }}</a>
                        @else
                            <a href="{{ $link['href'] }}" class="inline-block hover:bg-neutral-100 dark:hover:bg-neutral-800 px-3 py-2 rounded w-full font-medium text-black dark:text-white text-sm text-left cursor-pointer">{{ $link['name'] }}</a>
                        @endif
                    </li>
                @elseif(isset($link['links']))
                    <li>
                        <div class="space-y-1 mt-2"
                            x-data="{ isModuleMenuOpen: false }"
                        >
                            <button type="button" class="flex justify-between items-center hover:bg-neutral-100 dark:hover:bg-neutral-800 px-3 py-2 rounded w-full font-semibold text-black dark:text-white text-sm text-left uppercase cursor-pointer" aria-label="Toggle module menu."
                                @click="isModuleMenuOpen = !isModuleMenuOpen" 
                                :aria-expanded="isModuleMenuOpen"
                            >
                                <span>{{ $link['name'] }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-black dark:stroke-white w-5 h-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9l4 -4l4 4"/><path d="M16 15l-4 4l-4 -4"/></svg>
                            </button>
                            <div class="overflow-hidden"
                                x-show="isModuleMenuOpen"
                                x-cloak
                                :inert="!isModuleMenuOpen"
                            >
                                <ul class="space-y-1 leading-0">
                                    @foreach ($link['links'] as $sublink)
                                        <li>
                                            @if (request()->is(ltrim($sublink['href'], '/')) || request()->is(ltrim($sublink['href'], '/') . '/*'))
                                                <a href="{{ $sublink['href'] }}" class="inline-block bg-neutral-100 dark:bg-neutral-800 px-3 py-2 rounded w-full font-medium text-black dark:text-white text-sm text-left cursor-pointer">{{ $link['name'] }}</a>
                                            @else
                                                <a href="{{ $sublink['href'] }}" class="inline-block hover:bg-neutral-100 dark:hover:bg-neutral-800 px-3 py-2 rounded w-full font-medium text-black dark:text-white text-sm text-left cursor-pointer">{{ $sublink['name'] }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @else
                    <li>
                        <p class="mt-2 py-2 pl-2.5 font-semibold text-neutral-800 dark:text-neutral-200 text-sm uppercase">{{ $link['name'] }}</p>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    {{-- END Sidebar Drawer --}}
</aside>