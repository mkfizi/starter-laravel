<a href="{{ route('web.index') }}" class="flex items-center gap-2 font-bold text-neutral-800 dark:text-neutral-200 text-sm">
    <div class="bg-black dark:bg-white p-2 rounded">
        <span class="[&>svg]:w-5 [&>svg]:h-5 text-white dark:text-black shrink-0">
            <svg height="24" width="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M 0.92 0.92 L 23 0.92 M 23 0.92 L 23 6.44 M 23 6.44 L 14.72 6.44 M 14.72 6.44 L 14.72 9.2 M 14.72 9.2 L 23 9.2 M 23 9.2 L 23 14.72 M 23 14.72 L 14.72 14.72 M 14.72 14.72 L 14.72 23 M 14.72 23 L 9.2 23 M 9.2 23 L 9.2 6.44 M 9.2 6.44 L 6.44 6.44 M 6.44 6.44 L 6.44 23 M 6.44 23 L 0.92 23 M 0.92 23 L 0.92 0.92">
            </svg>
        </span>
    </div>
    <span>{{ config('app.name') }}</span>
</a>