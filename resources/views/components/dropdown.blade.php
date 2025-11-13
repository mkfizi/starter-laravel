@props([
    'id' => 'dropdown-' . \Illuminate\Support\Str::random(8),  
    'width' => 'sm', 
    'position' => 'left',
    'trigger' => null,
    'custom' => null,
    'extraData' => '{}'
])

@php
    $widthClasses = [
        'sm' => 'w-48',
        'md' => 'w-64',
        'lg' => 'w-80',
    ];

    $widthClass = $widthClasses[$width] ?? $widthClasses['sm'];

    $positionClasses = match ($position) {
        'left' => 'left-0',
        'right' => 'right-0',
        default => $position,
    };
@endphp

<div class="relative"
    x-data="{ isDropdownOpen: false, ...{{ $extraData }} }"
    @click.outside="isDropdownOpen = false"
    @keydown.escape.window="isDropdownOpen = false"
>
    @if($trigger && empty($custom))
        <x-button-outline type="button" aria-controls="{{ $id }}" aria-label="Toggle dropdown."
            x-ref="button"
            @click="isDropdownOpen = !isDropdownOpen"
            :aria-expanded="isDropdownOpen"
        >
            {{ $trigger }}
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-white dark:stroke-black w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6"/></svg>
        </x-button-outline>
    @endif
    @if($custom && empty($trigger))
        {{ $custom }}
    @endif
    <div id="{{ $id }}" class="{{ $positionClasses }} z-10 absolute bg-white dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded {{ $widthClass }}"
        x-show="isDropdownOpen"
        x-cloak
        x-anchor.no-style.offset.8="$refs.button"
        :inert="!isDropdownOpen"
        :style="{ top: $anchor.y+'px' }"
    >
        <ul class="space-y-1 p-1 leading-0">
            {{ $slot }}
        </ul>
    </div>
</div>