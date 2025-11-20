@props([
    'active' => false,
    'icon' => null,
    'title',
    'route'
])

@php
    $component = $active ? 'button-link-secondary' : 'button-link-ghost';
@endphp

<x-dynamic-component 
    :component="$component" 
    :href="$route" 
    class="inline-block w-full"
>
    <span class="flex items-center gap-2">
        @isset ($icon)
            <span class="stroke-black dark:stroke-white [&_svg]:w-5 [&_svg]:h-5 shrink-0">{!! $icon !!}</span>
        @endisset
        <span>{{ $title }}</span>
    </span>
</x-dynamic-component>