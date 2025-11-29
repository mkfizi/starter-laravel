@props([
    'id',
    'width' => 'sm',
])

@php
    $widthClass = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
    ];
@endphp

<div id="{{ $id }}" class="top-0 left-0 z-10 fixed bg-black/80 w-dvw h-dvh"
    x-data="{ isModalOpen: false }"
    x-init="$watch('isModalOpen', isModalOpen => $dispatch('{{ $id }}-expanded', { id: '{{ $id }}', isModalOpen: isModalOpen }))"
    x-show="isModalOpen"
    x-cloak
    x-trap.noautofocus.noscroll="isModalOpen"
    x-on:click.self="isModalOpen = false"
    x-on:keydown.escape.window="isModalOpen = false"
    x-on:open-modal.window="$event.detail.id === '{{ $id }}' ? isModalOpen = true : null"
    x-on:close-modal.window="$event.detail.id === '{{ $id }}' ? isModalOpen = false : null"
    :inert="!isModalOpen"
>
    <div class="top-1/2 left-1/2 fixed bg-white dark:bg-neutral-950 p-8 border border-neutral-200 dark:border-neutral-800 rounded w-80 sm:w-full {{ $widthClass[$width] }} -translate-x-1/2 -translate-y-1/2 transform">
    <x-button-ghost type="button" class="top-2 right-2 absolute p-2!" aria-controls="{{ $id }}" aria-label="{{ __('Close modal.') }}"
            x-on:click="$dispatch('close-modal', { id: '{{ $id }}' })"
            ::aria-expanded="isModalOpen"
            aria-controls="{{ $id }}"
        >
            <x-icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
            </x-icon>
        </x-button-ghost>
        {{ $slot }}
    </div>  
</div>