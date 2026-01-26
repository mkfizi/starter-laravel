@props([
    'id',
    'position' => 'right',
    'width' => 'sm',
])

@php
    $widthClass = [
        'sm' => 'sm:w-64',
        'md' => 'sm:w-80',
        'lg' => 'sm:w-96',
    ];

    $positionClass = [
        'left' => 'left-0',
        'right' => 'right-0',
    ];
@endphp

<div id="{{ $id }}" class="top-0 {{ $positionClass[$position] ?? 'right-0' }} z-10 fixed bg-black/80 w-dvw h-dvh"
    x-data="{ isOffcanvasOpen: false }"
    x-init="$watch('isOffcanvasOpen', isOffcanvasOpen => $dispatch('{{ $id }}-expanded', { id: '{{ $id }}', isOffcanvasOpen: isOffcanvasOpen }))"
    x-show="isOffcanvasOpen"
    x-cloak
    x-trap.noautofocus.noscroll="isOffcanvasOpen"
    x-on:click.self="isOffcanvasOpen = false"
    x-on:keydown.escape.window="isOffcanvasOpen = false"
    x-on:open-offcanvas.window="$event.detail.id === '{{ $id }}' ? isOffcanvasOpen = true : null"
    x-on:close-offcanvas.window="$event.detail.id === '{{ $id }}' ? isOffcanvasOpen = false : null"
    :inert="!isOffcanvasOpen"
>
    <div class="top-0 {{ $positionClass[$position] ?? 'right-0' }} fixed bg-white dark:bg-neutral-950 border-neutral-200 dark:border-neutral-800 border-r w-full {{ $widthClass[$width] ?? 'sm:w-64' }} h-full">
        <button type="button" class="top-2 right-2 absolute hover:bg-neutral-100 focus:bg-neutral-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 disabled:opacity-60 [&_svg]:stroke-black dark:[&_svg]:stroke-white p-2 rounded font-medium text-black dark:text-white text-sm cursor-pointer disabled:pointer-events-none" aria-label="{{ __('Close offcanvas.') }}"
            x-on:click="$dispatch('close-offcanvas', { id: '{{ $id }}' })"
            :aria-expanded="isOffcanvasOpen"
            aria-controls="{{ $id }}"
        >
            <span class="[&_svg]:w-5 [&_svg]:h-5 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
            </span>
        </button>
        <div class="mt-8 px-4 sm:px-8 py-4 overflow-y-auto">
            {{ $slot }}
        </div>
    </div>
</div>