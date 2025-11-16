<a {{ $attributes->class(['bg-green-500 hover:bg-green-600 focus:bg-green-600 dark:bg-green-700 dark:hover:bg-green-600 dark:focus:bg-green-600 disabled:opacity-60 px-3 py-2 rounded font-medium text-white dark:text-white text-sm cursor-pointer disabled:pointer-events-none'])->merge() }}>
    {{ $slot }}
</a>