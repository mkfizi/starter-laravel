@props([
    'id' => 'dropdown-' . \Illuminate\Support\Str::random(8),  
    'width' => 'sm', 
    'position' => 'left',
    'extraData' => '{}'
])

@php
    $widthClasses = [
        'sm' => 'w-48',
        'md' => 'w-64',
        'lg' => 'w-80',
    ];
    
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
    <div 
        x-ref="button"
        @click="isDropdownOpen = !isDropdownOpen" 
        :aria-expanded="isDropdownOpen"
    >
        {{ $trigger }}
    </div>
    <div id="{{ $id }}" class="{{ $positionClasses }} z-10 absolute bg-white dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded {{ $widthClasses[$width] }}"
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