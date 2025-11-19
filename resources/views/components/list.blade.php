@props([
    'type' => 'none',
])

@php
    $typeClasses = match($type) {
        'disc' => 'list-disc ml-4',
        'decimal' => 'list-decimal ml-4',
        default => '',
    };
@endphp

<ul {{ $attributes->merge(['class' => 'space-y-1 leading-0 ' . $typeClasses]) }}>
    {{  $slot }}
</ul>