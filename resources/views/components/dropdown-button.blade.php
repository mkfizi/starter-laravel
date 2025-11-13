<li>
    <button {{ $attributes->class(['hover:bg-neutral-100 dark:hover:bg-neutral-800 px-3 py-2 rounded w-full font-medium text-black dark:text-white text-sm text-left cursor-pointer'])->merge() }}>{{ $slot }}</button>
</li>