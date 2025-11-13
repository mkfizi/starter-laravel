{{-- Prevent FOUC --}}
<script>
    // Toggle theme.
    // localStorage.theme = 'dark';
    document.documentElement.classList.toggle('dark', localStorage.theme === 'dark' || (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches) || (localStorage.theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches));
</script>
{{-- END Prevent FOUC --}}

{{-- Metadata --}}
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#ffffff">
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- END Metadata --}}
{{-- SEO --}}
<meta name="title" content="{{ config('app.name') }}">
<meta name="description" content="{{ config('app.metadata.description') }}">
<meta name="robots" content="index, follow">
{{-- END SEO --}}
{{-- Facebook Open Graph --}}
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ config('app.name') }}">
<meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
<meta property="og:description" content="{{ config('app.metadata.description') }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
{{-- END Facebook Open Graph --}}
{{-- Twitter Card --}}
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="{{ config('app.name') }}">
<meta name="twitter:creator" content="@mkfizi">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="{{ config('app.name') }}">
<meta name="twitter:description" content="{{ config('app.metadata.description') }}">
<meta name="twitter:image" content="{{ asset('images/twitter-image.jpg') }}">
{{-- END Twitter Card --}}
{{-- Favicon --}}
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="manifest" href="{{ asset('manifest.json') }}">
{{-- END Favicon --}}

<title>{{ config('app.name') }}</title>