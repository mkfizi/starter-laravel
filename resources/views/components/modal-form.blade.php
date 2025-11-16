@props([
    'id' => 'modal-' . \Illuminate\Support\Str::random(8),
    'width' => 'sm',
    'title' => 'Modal Title',
    'action' => null,
    'method' => 'POST',
])

@php
    $widthClass = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'full' => 'max-w-full',
    ];
@endphp

<div id="{{ $id }}" class="top-0 left-0 z-10 fixed bg-black/80 w-dvw h-dvh"
    x-data="{ isModalOpen: false }"
    x-init="$watch('isModalOpen', isModalOpen => $dispatch('set-modal-expanded', isModalOpen))"
    x-show="isModalOpen"
    x-cloak
    x-trap.noautofocus.noscroll="isModalOpen"
    @click.self="isModalOpen = false"
    @keydown.escape.window="isModalOpen = false"
    @open-modal.window="isModalOpen = true"
    :inert="!isModalOpen" 
>
    <div class="top-1/2 left-1/2 fixed bg-white dark:bg-neutral-950 p-8 border border-neutral-200 dark:border-neutral-800 rounded w-80 sm:w-full {{ $widthClass[$width] }} -translate-x-1/2 -translate-y-1/2 transform">
        <x-button-ghost type="button" class="top-2 right-2 absolute !p-2" aria-controls="{{ $id }}" aria-label="Close modal."
            @click="isModalOpen = false"
            ::aria-expanded="isModalOpen"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
        </x-button-ghost>
        
            <form action="{{ $action }}" method="POST">
                @csrf
                @method($method)
                <div class="space-y-2">
                    @if(isset($title))
                        <x-text-title>{{ $title }}</x-text-title>
                    @endif
                    {{ $slot }}
                </div>
            <div class="flex flex-wrap justify-end gap-2 mt-8">
                    <x-button-outline type="button" aria-controls="{{ $id}}"
                        @click="isModalOpen = false"
                        ::aria-expanded="isModalOpen"
                    >
                        <span>{{ __('Cancel') }}</span>
                    </x-button-outline>
                    @isset($submitButton)
                        {{ $submitButton }}
                    @else
                        <x-button type="submit">
                            <span>{{ __('Confirm') }}</span>
                        </x-button>
                    @endif
            </div>
        </form>
    </div>  
</div>