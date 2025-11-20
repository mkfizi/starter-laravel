<button {{ $attributes->merge(['class' => 'inline-block bg-red-500 hover:bg-red-600 focus:bg-red-600 dark:bg-red-700 dark:hover:bg-red-600 dark:focus:bg-red-600 disabled:opacity-60 px-3 py-2 rounded font-medium text-white dark:text-white [&_svg]:stroke-white dark:[&_svg]:stroke-white text-sm cursor-pointer disabled:pointer-events-none']) }}>
    {{ $slot }}
</button>