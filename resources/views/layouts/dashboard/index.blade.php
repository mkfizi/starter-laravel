@props([
    'title' =>  __('Dashboard'),
])

<x-layouts.app>
    <div class="flex">
        @include('layouts.dashboard.partials.sidebar')
        <div class="relative flex-1 w-full">
            @include('layouts.dashboard.partials.navbar')
            <main class="space-y-8 mx-auto px-4 sm:px-8 pt-16 pb-32 w-full max-w-screen-xl overflow-hidden"> 
                <p class="font-bold text-black dark:text-white text-2xl sm:text-3xl lg:text-4xl">{{ $title }}</p>
                @include('layouts.dashboard.partials.alert-status')
                <div class="space-y-8">
                    {{ $slot }}
                </div>
            </main>
            @include('layouts.dashboard.partials.footer')
        </div>
    </div>
</x-layouts.app>