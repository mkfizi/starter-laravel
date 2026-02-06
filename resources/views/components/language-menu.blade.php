@props([
    'position' => 'right',
])

<x-dropdown 
    id="language-menu"
    position="{{ $position }}"
>
    <x-slot name="trigger">
        <x-button-ghost type="button" class="p-2! w-9!" aria-controls="language-menu" aria-label="{{ __('Toggle language menu.') }}">
            {{ strtoupper(app()->getLocale()) }}
        </x-button-ghost>
    </x-slot>
    <form method="GET" action="{{ url()->current() }}" class="space-y-1">
        @foreach(request()->except('lang') as $key => $value)
            @if(is_array($value))
                @foreach($value as $arrayValue)
                    <input type="hidden" name="{{ $key }}[]" value="{{ $arrayValue }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach
        
        <x-dropdown-button type="submit" name="lang" value="en" 
            class="flex items-center gap-2 w-full" 
            aria-label="{{ __('Set English language.') }}"
            ::class="{'bg-neutral-100 dark:bg-neutral-800': '{{ app()->getLocale() }}' === 'en'}"
        >
            <span>{{ __('English') }}</span>
        </x-dropdown-button>
        
        <x-dropdown-button type="submit" name="lang" value="ms" 
            class="flex items-center gap-2 w-full" 
            aria-label="{{ __('Set Malay language.') }}"
            ::class="{'bg-neutral-100 dark:bg-neutral-800': '{{ app()->getLocale() }}' === 'ms'}"
        >
            <span>{{ __('Malay') }}</span>
        </x-dropdown-button>
    </form>
</x-dropdown>