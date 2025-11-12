<a {{ $attributes->class(['font-medium text-black hover:dark:text-neutral-200 hover:text-neutral-700 focus:dark:text-neutral-200 focus:text-neutral-700 dark:text-white text-sm cursor-pointer'])->merge() }}>
    {{ $slot }}
</a>