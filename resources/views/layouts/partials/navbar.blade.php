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
    <div class="flex justify-between items-center mx-auto px-4 sm:px-8 py-2 max-w-screen-xl">
        <x-link href="{{ route('web.home') }}" class="!text-base">{{ config('app.name') }}</x-link>
        <div class="flex items-center gap-2 lg:gap-6">
            {{-- Navbar Menu --}}
            <div id="navbar-menu" class="hidden invisible lg:visible lg:block top-0 lg:top-auto left-0 lg:left-auto z-10 lg:z-auto fixed lg:relative bg-black/80 lg:bg-transparent w-dvw lg:w-auto h-dvh lg:h-auto"
                x-trap.noautofocus.noscroll="isNavbarMenuOpen && window.innerWidth < breakpoint"
                @click.self="isNavbarMenuOpen = false"
                @keydown.escape.window="isNavbarMenuOpen = false"
                :class="{ 'hidden invisible' : !isNavbarMenuOpen || window.innerWidth >= breakpoint }"
                :inert="!isNavbarMenuOpen && window.innerWidth < breakpoint"
            >
                {{-- Navbar Menu Drawer --}}
                <div class="top-0 right-0 fixed lg:relative bg-white lg:bg-transparent dark:bg-neutral-950 px-4 sm:px-8 lg:px-0 py-4 lg:py-0 border-neutral-200 lg:border-0 dark:border-neutral-800 border-r w-full sm:w-64 lg:w-auto h-full lg:h-auto overflow-y-auto lg:overflow-y-visible">
                    {{-- Navbar Menu Close --}}
                    <x-button-ghost type="button" class="lg:hidden lg:invisible top-2 right-4 sm:right-8 absolute !p-2" aria-controls="navbar-menu" aria-label="Close navbar menu."
                        @click="isNavbarMenuOpen = false"
                        ::aria-expanded="isNavbarMenuOpen"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
                    </x-button-ghost>
                    {{-- END Navbar Menu Close --}}
                    {{-- Navbar Menu Links --}}
                    <ul class="lg:flex lg:items-center lg:gap-8 space-y-1 lg:space-y-0 mt-8 lg:mt-0 leading-0">
                        @foreach(config('route.web') as $link)
                            <li>
                                @if (request()->is(ltrim($link['href'], '/')))
                                    <x-nav-link-active href="{{ $link['href'] }}">{{ $link['name'] }}</x-nav-link-active>
                                @else
                                    <x-nav-link href="{{ $link['href'] }}">{{ $link['name'] }}</x-nav-link>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    {{-- END Navbar Menu Links --}}
                </div>
                {{-- END Navbar Menu Drawer --}}
            </div>  
            {{-- END Navbar Menu --}}
            {{-- Dark Mode Menu --}}
            <x-dropdown id="dark-mode-menu" position="right"
                extra-data="{
                    theme: localStorage.theme || 'system',
                    toggleTheme(newTheme) {
                        this.theme = newTheme;
                        newTheme === 'system' 
                            ? localStorage.removeItem('theme') 
                            : localStorage.theme = newTheme;
                        document.documentElement.classList.toggle('dark', 
                            newTheme === 'dark' || (newTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)
                        );
                        this.isDropdownOpen = false;
                    },
                }"
            >
                <x-slot name="custom">
                    <x-button-ghost type="button" class="!p-2" aria-controls="dark-mode-menu" aria-label="Toggle dark mode menu."
                        x-ref="button"
                        @click="isDropdownOpen = !isDropdownOpen"
                        ::aria-expanded="isDropdownOpen"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="dark:hidden stroke-black w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.828 14.828a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z"/><path d="M6.343 17.657l-1.414 1.414"/><path d="M6.343 6.343l-1.414 -1.414"/><path d="M17.657 6.343l1.414 -1.414"/><path d="M17.657 17.657l1.414 1.414"/><path d="M4 12h-2"/><path d="M12 4v-2"/><path d="M20 12h2"/><path d="M12 20v2"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="hidden dark:block stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"/></svg>
                    </x-button-ghost>
                </x-slot>
                <x-dropdown-button type="button" class="flex items-center gap-2" aria-label="Set light theme."
                    @click="toggleTheme('light')"
                    ::class="{'bg-neutral-100 dark:bg-neutral-800': theme === 'light'}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"/></svg>
                    <span>{{ __('Light') }}</span>
                </x-dropdown-button>
                <x-dropdown-button type="button" class="flex items-center gap-2" aria-label="Set dark theme."
                    @click="toggleTheme('dark')"
                    ::class="{'bg-neutral-100 dark:bg-neutral-800': theme === 'dark'}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.828 14.828a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z"/><path d="M6.343 17.657l-1.414 1.414"/><path d="M6.343 6.343l-1.414 -1.414"/><path d="M17.657 6.343l1.414 -1.414"/><path d="M17.657 17.657l1.414 1.414"/><path d="M4 12h-2"/><path d="M12 4v-2"/><path d="M20 12h2"/><path d="M12 20v2"/></svg>
                    <span>{{ __('Dark') }}</span>
                </x-dropdown-button>
                <x-dropdown-button type="button" class="flex items-center gap-2" aria-label="Set system theme."
                    @click="toggleTheme('system')"
                    ::class="{'bg-neutral-100 dark:bg-neutral-800': theme === 'system'}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10z"/><path d="M7 20h10"/><path d="M9 16v4"/><path d="M15 16v4"/></svg>
                    <span>{{ __('System') }}</span>
                </x-dropdown-button>
            </x-dropdown>
            {{-- END Dark Mode Menu --}}  
            {{-- Navbar Menu Open --}}
            <x-button-ghost type="button" class="lg:hidden lg:invisible !p-2" aria-controls="navbar-menu" aria-label="Open navbar menu."
                @click="isNavbarMenuOpen = true"
                ::aria-expanded="isNavbarMenuOpen"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l16 0"/><path d="M4 12l16 0"/><path d="M4 18l16 0"/></svg>
            </x-button-ghost>
            {{-- END Navbar Menu Open --}}
        </div>
    </div>
</nav>