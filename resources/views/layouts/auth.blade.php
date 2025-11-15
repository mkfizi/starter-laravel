<x-app-layout>
    <nav class="w-full">
        <div class="flex justify-between items-center mx-auto px-4 sm:px-8 py-2 lg:py-4 max-w-screen-xl">
            <a href="{{ route('web.index') }}" class="font-medium text-neutral-800 dark:text-neutral-200 text-lg">{{ config('app.name') }}</a>
            <x-dark-mode-menu />
        </div>
    </nav>
    <main class="mx-auto px-4 sm:px-8 py-16 w-full max-w-screen-xl">
        <div class="mx-auto pt-32 max-w-sm">
            <a href="{{ route('web.index') }}" class="block relative bg-black dark:bg-white mx-auto w-16 h-16" aria-label="Navigate to Home."> 
                <span class="block top-8 left-4 absolute bg-white dark:bg-black w-4 h-8"></span>
                <span class="block top-12 left-8 absolute bg-white dark:bg-black w-4 h-4"></span>
            </a>
            <x-card class="mt-8">
                {{ $slot }}
            </x-card>
        </div>
    </main>
    @include('layouts.partials.footer')
</x-app-layout>