@props([
    'id' => 'alert-' . \Illuminate\Support\Str::random(8),
    'type' => 'default',
])

@php
    $alertClass = 'bg-neutral-50 dark:bg-neutral-900 border-neutral-200 dark:border-neutral-800';
    $textClass = '';
    $iconClass = 'stroke-black dark:stroke-white';
    $buttonComponent = 'button-ghost';
    
    if ($type === 'error') {
        $alertClass = 'bg-red-50 dark:bg-red-900 border-red-200 dark:border-red-800';
        $textClass = 'text-red-600! dark:text-red-400!';
        $iconClass = 'stroke-red-600! dark:stroke-red-400!';
        $buttonComponent = 'button-ghost-danger';
    }
@endphp

<div id="{{ $id }}" class="flex items-center gap-4 py-2 pr-2 pl-4 border {{ $alertClass }} rounded"
    x-data
>
    <div class="grow">
        <x-text class="{{ $textClass }}">{{ $slot }}</x-text>
    </div>
    <x-dynamic-component :component="$buttonComponent" type="button" class="!p-2" aria-controls="{{ $id }}" aria-label="Close alert."
        x-on:click="$root.remove()"
    >
        <span class="{{ $iconClass }} [&>svg]:w-5 [&>svg]:h-5 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
        </span>
    </x-dynamic-component>
</div>