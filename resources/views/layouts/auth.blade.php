<x-layouts.app>
    <nav class="w-full">
        <div class="flex justify-between items-center mx-auto px-4 sm:px-8 py-2 lg:py-4 max-w-screen-xl">
            <x-nav-title />
            <x-dark-mode-menu />
        </div>
    </nav>
    <main class="mx-auto px-4 sm:px-8 py-16 w-full max-w-screen-xl">
        <div class="mx-auto pt-32 max-w-sm">
            <a href="{{ route('web.index') }}" class="block mx-auto w-fit text-center" aria-label="Navigate to Home."> 
                <span class="[&>svg]:w-12 [&>svg]:h-12 text-black dark:text-white shrink-0">
                    <svg height="24" width="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M 0.92 0.92 L 23 0.92 M 23 0.92 L 23 6.44 M 23 6.44 L 14.72 6.44 M 14.72 6.44 L 14.72 9.2 M 14.72 9.2 L 23 9.2 M 23 9.2 L 23 14.72 M 23 14.72 L 14.72 14.72 M 14.72 14.72 L 14.72 23 M 14.72 23 L 9.2 23 M 9.2 23 L 9.2 6.44 M 9.2 6.44 L 6.44 6.44 M 6.44 6.44 L 6.44 23 M 6.44 23 L 0.92 23 M 0.92 23 L 0.92 0.92">
                    </svg>
                </span>
            </a>
            <x-card class="mt-8">
                {{ $slot }}
            </x-card>
        </div>
    </main>
    @include('layouts.partials.footer')
</x-layouts.app>