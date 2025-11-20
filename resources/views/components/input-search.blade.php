@props(['route' => '#'])

<form action="{{ $route }}" class="flex items-center gap-2 grow sm:grow-0">
    <input type="text" id="search" name="search" value="" class="inset-ring inset-ring-neutral-400 dark:inset-ring-neutral-600 bg-transparent disabled:opacity-60 px-3 py-2 rounded w-full text-neutral-800 dark:text-neutral-200 text-sm appearance-none cursor-text disabled:pointer-events-none" placeholder="Search Input"/>
    <x-button type="submit" class="!p-2" aria-label="Search.">
        <x-icon>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"/><path d="M21 21l-6 -6"/></svg>
        </x-icon>
    </x-button>
</form>