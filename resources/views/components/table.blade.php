@props([
    'divider' => true,
    'headerBg' => true, 
])

@php
    $dividerClasses = $divider ? 'divide-y divide-neutral-200 dark:divide-neutral-800' : '';
    $headerBgClasses = $headerBg ? 'bg-neutral-50 dark:bg-neutral-900' : '';
@endphp

<div class="border border-neutral-200 dark:border-neutral-800 rounded overflow-hidden">
    <div class="overflow-x-auto">
        <table class="{{ $dividerClasses }} w-full whitespace-nowrap">
            <thead class="{{ $headerBgClasses }} text-left">
                <tr>
                    {{ $header }}
                </tr>
            </thead>
            <tbody class="{{ $dividerClasses }}">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>