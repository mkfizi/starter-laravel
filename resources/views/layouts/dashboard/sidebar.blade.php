@props([
    'title' =>  __('Dashboard'),
    'subtitle' =>  null,
])

<x-layouts.app>
    <div class="flex">
        @include('layouts.dashboard.partials.sidebar')
        <div class="relative flex-1 w-full">
            @include('layouts.dashboard.partials.navbar')
            <main class="space-y-8 mx-auto px-4 sm:px-8 pt-16 pb-32 w-full max-w-screen-xl overflow-hidden"> 
                <x-display2>{{ $title }}</x-display2>
                @include('layouts.dashboard.partials.alert-status')
                <div class="space-y-8">
                    {{ $slot }}
                </div>
            </main>
            @include('layouts.dashboard.partials.footer')
        </div>
    </div>
</x-layouts.app>