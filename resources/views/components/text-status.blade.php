@props(['status'])

@if ($status)
    <p {{ $attributes->merge(['class' => 'text-sm text-green-600 dark:text-green-400']) }}>
        {{ $status }}
    </p>
@endif
