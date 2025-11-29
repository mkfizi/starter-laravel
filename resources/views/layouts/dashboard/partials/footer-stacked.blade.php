<footer class="bottom-1 absolute w-full">
            <div class="flex justify-between items-center mx-auto px-4 sm:px-8 max-w-screen-xl">
        <x-text>{{ __('Copyright © :year', ['year' => date('Y')]) }}</x-text>
        <span>
            <span class="text-neutral-800 dark:text-neutral-200 text-sm">{{ __('Developed by') }}</span><x-link href="https://mkfizi.dev" target="_blank">mkfizi</x-link>
        </span>
    </div>
</footer>