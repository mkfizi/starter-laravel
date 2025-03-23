<!-- Metadata -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#ffffff">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- END Metadata -->
<!-- SEO -->
<meta name="title" content="{{ config('app.name', 'Starter Laravel') }}">
<meta name="description" content="{{ config('app.description') }}">
<meta name="robots" content="index, follow">
<!-- END SEO -->
<!-- Facebook Open Graph -->
<meta property="og:url" content="{{ config('app.url') }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ config('app.name', 'Starter Laravel') }}">
<meta property="og:image" content="path/to/img/meta-og.jpg">
<meta property="og:description" content="{{ config('app.description') }}">
<meta property="og:site_name" content="{{ config('app.name', 'Starter Laravel') }}">
<!-- END Facebook Open Graph -->
<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@mkfizi">
<meta name="twitter:creator" content="@mkfizi">
<meta name="twitter:url" content="{{ config('app.url') }}">
<meta name="twitter:title" content="{{ config('app.name', 'Starter Laravel') }}">
<meta name="twitter:description" content="{{ config('app.description') }}">
<meta name="twitter:image" content="path/to/img/meta-card.jpg">
<!-- END Twitter Card -->
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
<link rel="icon" type="image/png" sizes="32x32" href=" {{ asset('favicon-32x32.png') }}" />
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}" />
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
<!-- END Favicon -->
<!-- Style -->
@vite('resources/css/index.css')
<!-- END Style -->
<!-- Script -->
<link rel="preload" href="{{ Vite::asset('resources/js/index.js') }}" as="script">
@vite('resources/js/index.js')
<!-- END Script -->
<title>
    @isset($title)
        {!! "$title | " !!}
    @endisset {{ config('app.name', 'Starter Laravel') }}
</title>