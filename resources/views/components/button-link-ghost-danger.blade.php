<a {{ $attributes->class(['inline-block hover:bg-red-100 focus:bg-red-100 dark:hover:bg-red-900 dark:focus:bg-red-900 disabled:opacity-60 px-3 py-2 rounded font-medium text-red-600 dark:text-red-400 text-sm cursor-pointer disabled:pointer-events-none'])->merge() }}>
    {{ $slot }}
</a>
