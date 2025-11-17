@props([
    'type' => 'none',
])

@php
    $typeClasses = match($type) {
        'disc' => 'list-disc',
        'decimal' => 'list-decimal',
        default => '',
    };
@endphp

<ul {{ $attributes->merge(['class' => 'space-y-2 ml-4 dark:marker:text-neutral-200 marker:text-neutral-800 leading-0 ' . $typeClasses]) }}>
    {{  $slot }}
</ul>