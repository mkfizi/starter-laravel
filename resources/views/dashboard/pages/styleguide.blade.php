<x-dashboard-layout title="{{ __('Style Guide') }}">
    <x-card>
        <x-text-title>{{ __('Typography') }}</x-text-title>
        <div class="space-y-4 mt-4">
            <x-h1>{{ __('This is a H1 Heading') }}</x-h1>
            <x-h2>{{ __('This is a H2 Heading') }}</x-h2>
            <x-h3>{{ __('This is a H3 Heading') }}</x-h3>
            <x-h4>{{ __('This is a H4 Heading') }}</x-h4>
            <x-text>{{ __('This is a standard text paragraph. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.') }}</x-text>
            <x-text-title>{{ __('This is a Text Title') }}</x-text-title>
            <x-text-status status="{{ __('This is a Text Status') }}"></x-text-status>
            <x-link href="#">{{ __('This is a standard link') }}</x-link>
        </div>
    </x-card>
    <x-card>
        <x-text-title>{{ __('Elements') }}</x-text-title>
        <div class="space-y-4 mt-4">
            <div class="flex flex-wrap gap-2">
                <x-button type="button">{{ __('Primary Button') }}</x-button>
                <x-button-secondary type="button">{{ __('Secondary Button') }}</x-button-secondary>
                <x-button-ghost type="button">{{ __('Ghost Button') }}</x-button-ghost>
                <x-button-outline type="button">{{ __('Outline Button') }}</x-button-outline>
                <x-button-danger type="button">{{ __('Danger Button') }}</x-button-danger>
            </div>
            <div class="flex flex-wrap gap-2">
                <x-button-link href="#">{{ __('Primary Button Link') }}</x-button-link>
                <x-button-link-secondary href="#">{{ __('Secondary Button Link') }}</x-button-link-secondary>
                <x-button-link-ghost href="#">{{ __('Ghost Button Link') }}</x-button-link-ghost>
                <x-button-link-outline href="#">{{ __('Outline Button Link') }}</x-button-link-outline>
                <x-button-link-danger href="#">{{ __('Danger Button Link') }}</x-button-link-danger>
            </div>
            <x-divider />
        </div>
    </x-card>
    <x-card>
        <x-text-title>{{ __('Forms') }}</x-text-title>
        <div class="space-y-4 mt-4">
            
        </div>
    </x-card>
</x-dashboard-layout>