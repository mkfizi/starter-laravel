<x-layouts.dashboard title="{{ __('Styleguide') }}">
    <div class="space-y-8 max-w-screen-sm">
        <x-card>
            <x-title>{{ __('Typography') }}</x-title>
            <div class="space-y-4 mt-4">
                <x-h1>{{ __('This is Heading 1') }}</x-h1>
                <x-h2>{{ __('This is Heading 2') }}</x-h2>
                <x-h3>{{ __('This is Heading 3') }}</x-h3>
                <x-h4>{{ __('This is Heading 4') }}</x-h4>
                <x-link href="#" class="block">{{ __('This is a link.') }}</x-link>
                <x-text>{{ __('This is a text sentence.') }}</x-text>
                <x-title>{{ __('This is title text.') }}</x-title>
            </div>
        </x-card>
        <x-card>
            <x-title>{{ __('Elements') }}</x-title>
            <div class="space-y-4 mt-4">
                <div class="flex flex-wrap gap-2">
                    <x-button>{{ __('Button Primary') }}</x-button>
                    <x-button-secondary>{{ __('Button Secondary') }}</x-button-secondary>
                    <x-button-success>{{ __('Button Success') }}</x-button-success>
                    <x-button-danger>{{ __('Button Danger') }}</x-button-danger>
                    <x-button-outline>{{ __('Button Outline') }}</x-button-outline>
                    <x-button-ghost>{{ __('Button Ghost') }}</x-button-ghost>
                </div>
                <div class="flex flex-wrap gap-2">
                    <x-button-link>{{ __('Button Link Primary') }}</x-button-link>
                    <x-button-link-secondary>{{ __('Button Link Secondary') }}</x-button-link-secondary>
                    <x-button-link-success>{{ __('Button Link Success') }}</x-button-link-success>
                    <x-button-link-danger>{{ __('Button Link Danger') }}</x-button-link-danger>
                    <x-button-link-outline>{{ __('Button Link Outline') }}</x-button-link-outline>
                    <x-button-link-ghost>{{ __('Button Link Ghost') }}</x-button-link-ghost>
                </div>
                <x-divider />
            </div>
        </x-card>
        <x-card>
            <x-title>{{ __('Forms') }}</x-title>
            <div class="space-y-4 mt-4">
                <div class="space-y-1">
                    <x-label for="input_example">{{ __('Input Label') }}</x-label>
                    <x-input id="input_example" name="input_example" type="text" class="w-full" placeholder="{{ __('Input placeholder') }}" />
                    <x-input-error :messages="['This is an error message.']" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label for="textarea_example">{{ __('Textarea Label') }}</x-label>
                    <x-input-textarea id="textarea_example" name="textarea_example" class="w-full" rows="4" placeholder="{{ __('Textarea placeholder') }}"></x-input-textarea>
                </div>
                <x-label for="input-checkbox" class="flex items-center gap-1">
                    <x-input-checkbox id="input-checkbox" name="checkbox" value="" />
                    <span>{{ __('Checkbox Label') }}</span>
                </x-label>
            </div>
        </x-card>
    </div>
</x-layouts.dashboard>