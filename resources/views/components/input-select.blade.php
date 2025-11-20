<div class="relative">
    <select {{ $attributes->merge(['class' => 'peer relative inset-ring inset-ring-neutral-400 dark:inset-ring-neutral-600 bg-transparent disabled:opacity-60 py-2 pr-8 pl-3 rounded w-full text-neutral-800 dark:text-neutral-200 text-sm appearance-none cursor-pointer disabled:pointer-events-none']) }}>
        {{ $slot }}
    </select>
    <x-icon class="top-2 right-2 -z-10 absolute peer-disabled:opacity-60 [&_svg]:stroke-black dark:[&_svg]:stroke-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M6 9l6 6l6 -6" /></svg>
    </x-icon>
</div>