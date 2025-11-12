<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.partials.head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
	<body class="relative bg-white dark:bg-neutral-950 min-h-dvh antialiased">
        @yield('content')
    </body>
</html>