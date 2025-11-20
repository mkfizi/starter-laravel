@props([
    'icon' => null,
    'links' => [],
    'title',
    'route'
])

@php
    $isActive = request()->routeIs($route.'*');
    $component = $isActive ? 'button-secondary' : 'button-ghost';
@endphp

<div class="space-y-1"
    x-data="{ isCollapseOpen: {{ $isActive ? 'true' : 'false' }} }"
>
    <x-dynamic-component 
        :component="$component" 
        type="button" 
        class="flex justify-between items-center w-full" 
        aria-label="Toggle module menu."
        x-on:click="isCollapseOpen = !isCollapseOpen" 
        aria-expanded="isCollapseOpen"
    >
        <span class="flex items-center gap-2">
            @isset ($icon)
                <span class="stroke-black dark:stroke-white w-5 [&>svg]:w-full h-5 [&>svg]:h-full shrink-0">{!! $icon !!}</span>
            @endisset
            <span>{{ $title }}</span>
        </span>
        <x-icon>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9l4 -4l4 4"/><path d="M16 15l-4 4l-4 -4"/></svg>
        </x-icon>
    </x-dynamic-component>
    
    <div class="overflow-hidden"
        x-show="isCollapseOpen"
        x-cloak
        :inert="!isCollapseOpen"
    >
        <ul class="space-y-1 leading-0">
            @foreach ($links as $sublink)
                <x-sidebar-nav-link
                    :route="route($sublink['route'])"
                    :active="request()->routeIs($sublink['route'])"
                    :title="$sublink['title']"
                />
            @endforeach
        </ul>
    </div>
</div>