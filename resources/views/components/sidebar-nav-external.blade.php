@props([
    'icon' => null,
    'title',
    'href',
])

<x-button-link-ghost href="{{ $href }}">
    <span class="flex items-center gap-2">
        @isset ($icon)
            <span class="stroke-black dark:stroke-white [&_svg]:w-5 [&_svg]:h-5">{!! $icon !!}</span>
        @endisset
        <span>{{ $title }}</span>
    </span>
</x-button-link-ghost>