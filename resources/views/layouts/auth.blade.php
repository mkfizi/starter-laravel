<x-app-layout>
    <nav class="w-full">
        <div class="flex justify-between items-center mx-auto px-4 sm:px-8 py-2 lg:py-4 max-w-screen-xl">
            <x-link href="{{ route('web.index') }}" class="!text-base">{{ config('app.name') }}</x-link>
            <x-dark-mode-menu />
        </div>
    </nav>
    <main class="mx-auto px-4 sm:px-8 py-16 w-full max-w-screen-xl">
        <div class="mx-auto pt-32 max-w-sm">
            <div class="p-4 border border-neutral-200 dark:border-neutral-800 rounded overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </main>
    @include('layouts.partials.footer')
</x-app-layout>