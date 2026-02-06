<nav class="top-0 z-10 sticky w-full"
    x-data="{
        breakpoint: 1024,
        isNavbarMenuOpen: false,
        isScrolled: window.scrollY > 0
    }"
    x-on:resize.window="
        if (window.innerWidth >= breakpoint) {
            isNavbarMenuOpen = false;
        }
    "
    x-on:scroll.window="isScrolled = window.scrollY > 0;"
    :class="isScrolled
        ? 'bg-white dark:bg-neutral-950 border-b border-neutral-200 dark:border-neutral-800'
        : 'bg-transparent dark:bg-transparent border-transparent'"
>
    <div class="flex justify-between items-center mx-auto px-4 sm:px-8 py-3 max-w-screen-xl">
        <div class="flex items-center gap-4">
            <button type="button" class="lg:hidden lg:invisible hover:bg-neutral-100 focus:bg-neutral-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 disabled:opacity-60 p-2 rounded font-medium text-black dark:text-white text-sm cursor-pointer disabled:pointer-events-none" aria-controls="navbar-menu" aria-label="Open navbar menu."
                x-on:click="isNavbarMenuOpen = true"
                :aria-expanded="isNavbarMenuOpen"
            >
                <span class="stroke-black dark:stroke-white [&>svg]:w-5 [&>svg]:h-5 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l16 0"/><path d="M4 12l16 0"/><path d="M4 18l16 0"/></svg>
                </span>
            </button>
            <x-nav-title route="dashboard"/>
        </div>
        <div class="flex items-center gap-4">
            <div id="navbar-menu" class="hidden invisible lg:visible lg:block top-0 lg:top-auto left-0 lg:left-auto !z-20 z-10 lg:z-auto fixed lg:relative bg-black/80 lg:bg-transparent lg:ml-8 w-dvw lg:w-auto h-dvh lg:h-auto"
                x-trap.noautofocus.noscroll="isNavbarMenuOpen && window.innerWidth < breakpoint"
                x-on:click.self="isNavbarMenuOpen = false"
                x-on:keydown.escape.window="isNavbarMenuOpen = false"
                :class="{ 'hidden invisible' : !isNavbarMenuOpen || window.innerWidth >= breakpoint }"
                :inert="!isNavbarMenuOpen && window.innerWidth < breakpoint"
            >
                <div class="top-0 left-0 fixed lg:relative bg-white lg:bg-transparent dark:bg-neutral-950 px-4 sm:px-8 lg:px-0 py-4 lg:py-0 border-neutral-200 lg:border-0 dark:border-neutral-800 border-r w-full sm:w-64 lg:w-auto h-full lg:h-auto overflow-y-auto lg:overflow-y-visible">
                    <button type="button" class="lg:hidden lg:invisible top-2 right-2 absolute hover:bg-neutral-100 focus:bg-neutral-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 disabled:opacity-60 p-2 rounded font-medium text-black dark:text-white text-sm cursor-pointer disabled:pointer-events-none" aria-controls="navbar-menu" aria-label="Close navbar menu."
                        x-on:click="isNavbarMenuOpen = false"
                        :aria-expanded="isNavbarMenuOpen"
                    >
                        <span class="stroke-black dark:stroke-white [&>svg]:w-5 [&>svg]:h-5 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
                        </span>
                    </button>
                    <ul class="lg:flex lg:items-center lg:gap-2 space-y-1 lg:space-y-0 mt-8 lg:mt-0 leading-0">
                        @foreach (config('routes.dashboard') as $link)
                            @if (isset($link['permission']) && !auth()->user()->can($link['permission']))
                                @continue
                            @endif
                            @if (isset($link['route']) && !isset($link['links']))
                                <li>
                                    @if (request()->routeIs($link['route']))
                                        <x-button-link-secondary href="{{ route($link['route']) }}" class="inline-block w-full">{{ __($link['title']) }}</x-button-link-secondary>
                                    @else
                                        <x-button-link-ghost href="{{ route($link['route']) }}" class="inline-block w-full">{{ __($link['title']) }}</x-button-link-ghost>
                                    @endif
                                </li>  
                            @elseif(isset($link['href']))
                                <li>
                                    <x-button-link-ghost href="{{ $link['href'] }}" class="inline-block w-full" target="_blank" rel="noopener noreferrer">{{ __($link['title']) }}</x-button-link-ghost>
                                </li>    
                            {{-- Dashboard stack menu is intended for application with less menu items, 
                                therefore we are hiding menu routes with sub-links. If you still want
                                to show them, uncomment the following block. --}}      
                            @elseif(isset($link['links']))
                                <li class="hidden invisible lg:visible lg:block">
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            @php
                                                isset($route) ? $isActive = request()->routeIs($route.'*') : $isActive = false;
                                                $component = $isActive ? 'button-secondary' : 'button-ghost';
                                            @endphp
                                            <x-dynamic-component :component="$component" type="button" class="flex items-center gap-2" aria-controls="dark-mode-menu" aria-label="Toggle collapse menu.">
                                                <span>{{ __($link['title']) }}</span>
                                                <span class="stroke-black dark:stroke-white [&>svg]:w-5 [&>svg]:h-5 shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6"/></svg>
                                                </span>
                                            </x-dynamic-component>
                                        </x-slot>
                                        @foreach ($link['links'] as $sublink)
                                            <x-dropdown-link href="{{ isset($sublink['route']) ? route($sublink['route']) : '#' }}">{{ isset($sublink['title']) ? $sublink['title'] : '' }}</x-dropdown-link>
                                        @endforeach
                                    </x-dropdown>
                                </li>
                                <li class="lg:hidden lg:invisible">
                                    <x-sidebar-nav-collapse
                                        :icon="isset($link['icon']) ? $link['icon'] : null"
                                        :links="isset($link['links']) ? $link['links'] : []"
                                        :title="isset($link['title']) ? $link['title'] : null"
                                        :route="isset($link['route']) ? $link['route'] : null"
                                    />
                                </li> 
                           
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>  
            @include('layouts.dashboard.partials.navbar-buttons')
        </div>
    </div>
</nav>