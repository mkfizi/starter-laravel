<button {{ $attributes->merge(['class' => 'bg-black hover:bg-neutral-800 focus:bg-neutral-800 dark:bg-neutral-100 dark:hover:bg-white dark:focus:bg-white disabled:opacity-60 px-3 py-2 rounded font-medium text-white [&_svg]:stroke-white dark:[&_svg]:stroke-black dark:text-black text-sm cursor-pointer disabled:pointer-events-none']) }}>
    {{ $slot }}
</button>