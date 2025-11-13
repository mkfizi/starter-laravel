@props(['messages'])

@if ($messages && count($messages) > 0)
    <ul class="space-y-1 text-red-600 dark:text-red-400 text-sm">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif