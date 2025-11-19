<a {{ $attributes->class(['inline-block inset-ring inset-ring-neutral-300 hover:inset-ring-neutral-400 focus:inset-ring-neutral-400 dark:hover:inset-ring-neutral-600 dark:focus:inset-ring-neutral-600 dark:inset-ring-neutral-700 disabled:opacity-60 px-3 py-2 rounded font-medium text-black dark:text-white text-sm cursor-pointer disabled:pointer-events-none'])->merge() }}>
    {{ $slot }}
</a>