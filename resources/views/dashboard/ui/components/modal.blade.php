<x-layouts.dashboard title="{{ __('Modal') }}">
    <x-card>
        <div class="space-y-8">
            <div class="space-y-4">
                <x-title>{{ __('Modal Sizes') }}</x-text-title>
                <div class="flex flex-wrap gap-16">
                    <x-button
                        x-data="{ isModalOpen: false }"
                        @click="$dispatch('open-modal-sm')"
                        @set-modal-sm.window="isModalOpen = $event.detail"
                        ::aria="isModalOpen"
                        aria-controls="modal-sm"
                    >{{ __('Modal Small') }}</x-button>
                    <x-button
                        x-data="{ isModalOpen: false }"
                        @click="$dispatch('open-modal-md')"
                        @set-modal-md.window="isModalOpen = $event.detail"
                        ::aria="isModalOpen"
                        aria-controls="modal-md"
                    >{{ __('Modal Medium') }}</x-button>
                    <x-button
                        x-data="{ isModalOpen: false }"
                        @click="$dispatch('open-modal-lg')"
                        @set-modal-lg.window="isModalOpen = $event.detail"
                        ::aria="isModalOpen"
                        aria-controls="modal-lg"
                    >{{ __('Modal Large') }}</x-button>
                </div>
                <x-title>{{ __('Modal Form') }}</x-text-title>
                <div class="flex flex-wrap gap-16">
                    <x-button
                        x-data="{ isModalOpen: false }"
                        @click="$dispatch('open-modal-form')"
                        @set-modal-form.window="isModalOpen = $event.detail"
                        ::aria="isModalOpen"
                        aria-controls="modal-form"
                    >{{ __('Modal Form') }}</x-button>
                    <x-button
                        x-data="{ isModalOpen: false }"
                        @click="$dispatch('open-modal-form-custom')"
                        @set-modal-form-custom.window="isModalOpen = $event.detail"
                        ::aria="isModalOpen"
                        aria-controls="modal-form-custom"
                    >{{ __('Modal Form Custom') }}</x-button>
                </div>
            </div>
        </div>
    </x-card>
    <x-modal
        id="modal-sm"
        title="{{ __('Modal Small') }}" 
    >   
        <x-text>{{ __('This is a small modal.') }}</x-text>
    </x-modal>
    <x-modal
        id="modal-md"
        width="md"
        title="{{ __('Modal Medium') }}" 
    >   
        <x-text>{{ __('This is a medium modal.') }}</x-text>
    </x-modal>
    <x-modal
        id="modal-lg"
        width="lg"
        title="{{ __('Modal Large') }}" 
    >   
        <x-text>{{ __('This is a large modal.') }}</x-text>
    </x-modal>
    <x-modal-form
        id="modal-form"
        title="{{ __('Modal Form') }}" 
        route="#"
        method="POST"
    >   
        <div class="space-y-1">
            <x-text>{{ __('Input Label') }}</x-text>
            <x-input id="input" name="input" type="text" placeholder="{{ __('Enter your input') }}" required />
        </div>
    </x-modal-form>
    <x-modal-form
        id="modal-form-custom"
        title="{{ __('Modal Form Custom') }}" 
        route="#"
        method="POST"
    >   
        <div class="space-y-1">
            <x-text>{{ __('Input Label') }}</x-text>
            <x-input id="input" name="input" type="text" placeholder="{{ __('Enter your input') }}" required />
        </div>
        <x-slot name="submit">
            <x-button-success type="submit">{{ __('Confirm') }}</x-button-success>
        </x-slot>
    </x-modal-form>
</x-layouts.dashboard>