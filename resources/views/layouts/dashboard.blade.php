@props([
    'title' =>  __('Dashboard'),
])

<x-app-layout>
    <div class="flex">
        @include('layouts.partials.dashboard.sidebar')
        <div class="relative flex-1 w-full">
            @include('layouts.partials.dashboard.navbar')
            <main class="mx-auto px-4 sm:px-8 py-16 w-full overflow-hidden"> 
                <p class="font-bold text-black dark:text-white text-2xl sm:text-3xl lg:text-4xl">{{ $title }}</p>
                <div class="space-y-8 mt-8">
                    {{ $slot }}
                </div>
            </main>
            @include('layouts.partials.dashboard.footer')
        </div>
    </div>
</x-app-layout>