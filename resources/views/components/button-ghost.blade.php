<button {{ $attributes->merge(['class' => 'hover:bg-neutral-100 focus:bg-neutral-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 disabled:opacity-60 px-3 py-2 rounded font-medium text-black dark:text-white [&>svg]:stroke-black dark:[&>svg]:stroke-white text-sm cursor-pointer disabled:pointer-events-none']) }}>
    {{ $slot }}
</button>