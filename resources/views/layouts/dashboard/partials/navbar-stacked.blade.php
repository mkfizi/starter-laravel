<nav class="top-0 z-10 sticky w-full"
    x-data="{
        breakpoint: 1024,
        isNavbarMenuOpen: false,
        isScrolled: window.scrollY > 0
    }"
    @resize.window="
        if (window.innerWidth >= breakpoint) {
            isNavbarMenuOpen = false;
        }
    "
    @scroll.window="isScrolled = window.scrollY > 0;"
    :class="isScrolled
        ? 'bg-white dark:bg-neutral-950 border-b border-neutral-200 dark:border-neutral-800'
        : 'bg-transparent dark:bg-transparent border-transparent'"
>
    <div class="flex justify-between items-center mx-auto px-4 sm:px-8 py-3 max-w-screen-xl">
        <div class="flex items-center gap-4">
            {{-- Navbar Menu Open --}}
            <button type="button" class="lg:hidden lg:invisible hover:bg-neutral-100 focus:bg-neutral-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 disabled:opacity-60 p-2 rounded font-medium text-black dark:text-white text-sm cursor-pointer disabled:pointer-events-none" aria-controls="navbar-menu" aria-label="Open navbar menu."
                @click="isNavbarMenuOpen = true"
                :aria-expanded="isNavbarMenuOpen"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l16 0"/><path d="M4 12l16 0"/><path d="M4 18l16 0"/></svg>
            </button>
            {{-- END Navbar Menu Open --}}
            <a href="{{ route('dashboard') }}" class="font-medium text-neutral-800 dark:text-neutral-200 text-lg">{{ config('app.name') }}</a>
            {{-- Navbar Menu --}}
            <div id="navbar-menu" class="hidden invisible lg:visible lg:block top-0 lg:top-auto left-0 lg:left-auto !z-20 z-10 lg:z-auto fixed lg:relative bg-black/80 lg:bg-transparent lg:ml-8 w-dvw lg:w-auto h-dvh lg:h-auto"
                x-trap.noautofocus.noscroll="isNavbarMenuOpen && window.innerWidth < breakpoint"
                @click.self="isNavbarMenuOpen = false"
                @keydown.escape.window="isNavbarMenuOpen = false"
                :class="{ 'hidden invisible' : !isNavbarMenuOpen || window.innerWidth >= breakpoint }"
                :inert="!isNavbarMenuOpen && window.innerWidth < breakpoint"
            >
                {{-- Navbar Menu Drawer --}}
                <div class="top-0 left-0 fixed lg:relative bg-white lg:bg-transparent dark:bg-neutral-950 px-4 sm:px-8 lg:px-0 py-4 lg:py-0 border-neutral-200 lg:border-0 dark:border-neutral-800 border-r w-full sm:w-64 lg:w-auto h-full lg:h-auto overflow-y-auto lg:overflow-y-visible">
                    {{-- Navbar Menu Close --}}
                    <button type="button" class="lg:hidden lg:invisible top-2 right-2 absolute hover:bg-neutral-100 focus:bg-neutral-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 disabled:opacity-60 p-2 rounded font-medium text-black dark:text-white text-sm cursor-pointer disabled:pointer-events-none" aria-controls="navbar-menu" aria-label="Close navbar menu."
                        @click="isNavbarMenuOpen = false"
                        :aria-expanded="isNavbarMenuOpen"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
                    </button>
                    {{-- END Navbar Menu Close --}}
                    {{-- Navbar Menu Links --}}
                    <ul class="lg:flex lg:items-center lg:gap-2 space-y-1 lg:space-y-0 mt-8 lg:mt-0 leading-0">
                        @foreach(config('routes.dashboard') as $link)
                            @if(isset($link['route']) && !isset($link['links']))
                                <li>
                                    @if (request()->routeIs($link['route']))
                                        <x-button-link-secondary href="{{ route($link['route']) }}" class="inline-block w-full">{{ $link['title'] }}</x-button-link-secondary>
                                    @else
                                        <x-button-link-ghost href="{{ route($link['route']) }}" class="inline-block w-full">{{ $link['title'] }}</x-button-link-ghost>
                                    @endif
                                </li>                
                            @elseif(isset($link['links']))
                                <li class="hidden invisible lg:visible lg:block">
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            @if (request()->routeIs($link['route'].'*'))
                                                <x-button-secondary type="button" class="flex items-center gap-2" aria-controls="dark-mode-menu" aria-label="Toggle dark mode menu.">
                                                    <span>{{ $link['title'] }}</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6"/></svg>
                                                </x-button-secondary>
                                            @else
                                                <x-button-ghost type="button" class="flex items-center gap-2" aria-controls="dark-mode-menu" aria-label="Toggle dark mode menu.">
                                                    <span>{{ $link['title'] }}</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6"/></svg>
                                                </x-button-ghost>
                                            @endif
                                        </x-slot>
                                        @foreach($link['links'] as $sublink)
                                            <x-dropdown-link href="{{ route($sublink['route']) }}">{{ $sublink['title'] }}</x-dropdown-link>
                                        @endforeach
                                    </x-dropdown>
                                </li>
                                <li class="lg:hidden lg:invisible">
                                    <div class="space-y-1"
                                        x-data="{ isCollapseOpen: {{ request()->routeIs($link['route'].'*') ? 'true' : 'false' }} }"
                                    >
                                        @if (request()->routeIs($link['route'].'*'))
                                            <x-button-secondary type="button" class="flex justify-between items-center w-full" aria-label="Toggle module menu."
                                                @click="isCollapseOpen = !isCollapseOpen" 
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
                                                @click="isCollapseOpen = !isCollapseOpen" 
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
                                    <p class="lg:hidden lg:invisible mt-4 py-2 font-semibold text-black dark:text-white text-xs uppercase tracking-wide">{{ $link['title'] }}</p>
                                    <div class="hidden invisible lg:visible lg:block bg-neutral-300 dark:bg-neutral-700 w-px h-6"></div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    {{-- END Navbar Menu Links --}}
                </div>
                {{-- END Navbar Menu Drawer --}}
            </div>  
            {{-- END Navbar Menu --}}
        </div>
        @include('layouts.dashboard.partials.navbar-dropdowns')
    </div>
</nav>