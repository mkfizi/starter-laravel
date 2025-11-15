@props([
    'id' => 'alert-' . \Illuminate\Support\Str::random(8),
])

<div id="{{ $id }}" class="flex items-center gap-4 bg-neutral-50 dark:bg-neutral-900 py-2 pr-2 pl-4 border border-neutral-200 dark:border-neutral-800 rounded"
    x-data
>
    <div class="grow">
        {{ $slot }}
    </div>
    <x-button-ghost type="button" class="!p-2" aria-controls="{{ $id }}" aria-label="Close alert."
        @click="$root.remove()"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
    </x-button-ghost>
</div>