@props([
    'messages',
    'bullet' => false,
])

@php
    $bullet = $bullet ? 'disc' : 'none';
    $messages = Arr::flatten((array) $messages);
@endphp

@if ($messages && count($messages) > 0)
    <x-list type="{{ $bullet }}">
        @foreach ((array) $messages as $message)
            <x-list-item class="text-red-600! dark:text-red-400!">{{ $message }}</x-list-item>
        @endforeach
    </x-list>
@endif