@props([
    'routes' => [
        [
            'title' => 'Account',
            'route' => 'dashboard.settings.account',
        ],
        [
            'title' => 'Password',
            'route' => 'dashboard.settings.password',
        ],
        [
            'title' => '2FA',
            'route' => 'dashboard.settings.two-factor',
        ]
    ]
])

<x-layouts.dashboard title="{{ __('Settings') }}">
    <div class="flex lg:flex-row flex-col gap-4 lg:gap-8">
        <div class="flex flex-col gap-1 w-full lg:w-48 lg:shrink-0">
            @foreach($routes as $route)
                @if(request()->routeIs($route['route']))
                    <x-button-link-secondary href="{{ route($route['route']) }}">{{ __($route['title']) }}</x-button-link-secondary>
                @else
                    <x-button-link-ghost href="{{ route($route['route']) }}">{{ __($route['title']) }}</x-button-link-ghost>
                @endif
            @endforeach
        </div>
        <div class="max-w-screen-sm grow">
            @yield('content')
        </div>
    </div>
</x-layouts.dashboard>