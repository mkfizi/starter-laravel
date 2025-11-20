<a {{ $attributes->class(['inline-block bg-neutral-100 hover:bg-neutral-200 focus:bg-neutral-200 dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:focus:bg-neutral-600 disabled:opacity-60 px-3 py-2 rounded font-medium text-black dark:text-white [&>svg]:stroke-black dark:[&>svg]:stroke-white text-sm cursor-pointer disabled:pointer-events-none'])->merge() }}>
    {{ $slot }}
</a>