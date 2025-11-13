<x-app-layout>
    @include('layouts.partials.navbar')
    <main class="mx-auto px-4 sm:px-8 py-16 w-full max-w-screen-xl">
        {{ $slot }}
    </main>
    @include('layouts.partials.footer')
</x-app-layout>