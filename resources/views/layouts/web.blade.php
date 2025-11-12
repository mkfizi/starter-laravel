@extends('app')

@section('content')
@include('layouts.partials.navbar')
<main class="mx-auto px-4 sm:px-8 py-16 w-full max-w-screen-xl">
    @yield('main')
</main>
@include('layouts.partials.footer')
@endsection