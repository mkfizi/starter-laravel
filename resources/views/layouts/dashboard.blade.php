@props([
    'title' =>  __('Dashboard'),
])

<x-app-layout>
    <div class="flex">
        @include('layouts.partials.dashboard.sidebar')
        <div class="relative flex-1 w-full">
            @include('layouts.partials.dashboard.navbar')
            <main class="space-y-8 mx-auto px-4 sm:px-8 pt-16 pb-32 w-full max-w-screen-xl overflow-hidden"> 
                <p class="font-bold text-black dark:text-white text-2xl sm:text-3xl lg:text-4xl">{{ $title }}</p>
                @if(session('status'))
                    <x-alert id="dashboard-alert">
                        {{ session('status') }}
                    </x-alert>
                @endsession
                <div class="space-y-8">
                    {{ $slot }}
                </div>
            </main>
            @include('layouts.partials.dashboard.footer')
        </div>
    </div>
</x-app-layout>