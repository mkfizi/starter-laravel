<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.metadata')
    </head>
    <body class="relative min-h-dvh antialiased">
        <!-- Content -->
        {{ $slot }}
        <!-- END Content -->
    </body>
</html>