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
        <x-nav-title />
        <div class="flex items-center gap-2 lg:gap-6">
            {{-- Navbar Menu --}}
            <div id="navbar-menu" class="hidden invisible lg:visible lg:block top-0 lg:top-auto left-0 lg:left-auto z-10 lg:z-auto fixed lg:relative bg-black/80 lg:bg-transparent w-dvw lg:w-auto h-dvh lg:h-auto"
                x-trap.noautofocus.noscroll="isNavbarMenuOpen && window.innerWidth < breakpoint"
                x-on:click.self="isNavbarMenuOpen = false"
                x-on:keydown.escape.window="isNavbarMenuOpen = false"
                :class="{ 'hidden invisible' : !isNavbarMenuOpen || window.innerWidth >= breakpoint }"
                :inert="!isNavbarMenuOpen && window.innerWidth < breakpoint"
            >
                {{-- Navbar Menu Drawer --}}
                <div class="top-0 right-0 fixed lg:relative bg-white lg:bg-transparent dark:bg-neutral-950 px-4 sm:px-8 lg:px-0 py-4 lg:py-0 border-neutral-200 lg:border-0 dark:border-neutral-800 border-r w-full sm:w-64 lg:w-auto h-full lg:h-auto overflow-y-auto lg:overflow-y-visible">
                    {{-- Navbar Menu Close --}}
                    <x-button-ghost type="button" class="lg:hidden lg:invisible top-2 right-4 sm:right-8 absolute p-2!" aria-controls="navbar-menu" aria-label="{{ __('Close navbar menu.') }}"
                        x-on:click="isNavbarMenuOpen = false"
                        ::aria-expanded="isNavbarMenuOpen"
                    >
                        <x-icon>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
                        </x-icon>
                    </x-button-ghost>
                    {{-- END Navbar Menu Close --}}
                    {{-- Navbar Menu Links --}}
                    <ul class="lg:flex lg:items-center lg:gap-8 space-y-1 lg:space-y-0 mt-8 lg:mt-0 leading-0">
                        @foreach (config('routes.web') as $link)
                            <li>
                                @if (isset($link['route']))
                                    @if (request()->routeIs($link['route']))
                                        <a href="{{ route($link['route']) }}" class="inline-block font-medium text-black hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-neutral-200 dark:focus:text-neutral-200 dark:text-white text-sm cursor-pointer">{{ $link['title'] }}</a>
                                    @else
                                        <a href="{{ route($link['route']) }}" class="inline-block lg:hover:bg-transparent hover:bg-neutral-100 dark:lg:hover:bg-transparent dark:hover:bg-neutral-800 lg:p-0 px-3 py-2 rounded w-full font-medium text-black lg:hover:text-black lg:focus:text-black lg:text-neutral-500 lg:visited:text-neutral-700 dark:lg:hover:text-white dark:lg:focus:text-white dark:lg:text-neutral-400 dark:lg:visited:text-neutral-200 dark:text-white text-sm text-left cursor-pointer">{{ $link['title'] }}</a>
                                    @endif
                                @elseif (isset($link['href']))
                                    <a href="{{ $link['href'] }}" target="_blank" rel="noopener" class="inline-block lg:hover:bg-transparent hover:bg-neutral-100 dark:lg:hover:bg-transparent dark:hover:bg-neutral-800 lg:p-0 px-3 py-2 rounded w-full font-medium text-black lg:hover:text-black lg:focus:text-black lg:text-neutral-500 lg:visited:text-neutral-700 dark:lg:hover:text-white dark:lg:focus:text-white dark:lg:text-neutral-400 dark:lg:visited:text-neutral-200 dark:text-white text-sm text-left cursor-pointer">{{ $link['title'] }}</a>
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
            <x-dark-mode-menu />
            {{-- END Dark Mode Menu --}}
            {{-- Login Button --}}
            <x-button-link-ghost class="lg:hidden lg:invisible p-2!" href="{{ route('login') }}">
                <x-icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-login"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M21 12h-13l3 -3" /><path d="M11 15l-3 -3" /></svg>
                </x-icon>
            </x-button-link-ghost>
            <x-button-link class="!hidden invisible lg:visible lg:!block" href="{{ route('login') }}">{{ __('Login') }}</x-button-link>
            {{-- END Login Button --}}
            {{-- Navbar Menu Open --}}
            <x-button-ghost type="button" class="lg:hidden lg:invisible !p-2" aria-controls="navbar-menu" aria-label="{{ __('Open navbar menu.') }}"
                x-on:click="isNavbarMenuOpen = true"
                ::aria-expanded="isNavbarMenuOpen"
            >
                <x-icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l16 0"/><path d="M4 12l16 0"/><path d="M4 18l16 0"/></svg>
                </x-icon>
            </x-button-ghost>
            {{-- END Navbar Menu Open --}}
        </div>
    </div>
</nav>