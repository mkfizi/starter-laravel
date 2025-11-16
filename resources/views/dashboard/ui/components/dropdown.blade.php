<x-layouts.dashboard title="{{ __('Dropdown') }}">
    <x-card class="!pb-64 max-w-screen-sm">
        <div class="space-y-8">
            <div class="space-y-4">
                <x-text-title>{{ __('Dropdown Sizes') }}</x-text-title>
                <div class="space-y-16">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <x-button>{{ __('Dropdown Small') }}</x-button>
                        </x-slot>
                        <x-dropdown-link href="#">{{ __('Action 1') }}</x-dropdown-link>
                        <x-dropdown-link href="#">{{ __('Action 2') }}</x-dropdown-link>
                        <x-dropdown-link href="#">{{ __('Action 3') }}</x-dropdown-link>
                    </x-dropdown>
                    <x-dropdown width="md">
                        <x-slot name="trigger">
                            <x-button>{{ __('Dropdown Medium') }}</x-button>
                        </x-slot>
                        <x-dropdown-link href="#">{{ __('Action 1') }}</x-dropdown-link>
                        <x-dropdown-link href="#">{{ __('Action 2') }}</x-dropdown-link>
                        <x-dropdown-link href="#">{{ __('Action 3') }}</x-dropdown-link>
                    </x-dropdown>
                    <x-dropdown width="lg">
                        <x-slot name="trigger">
                            <x-button>{{ __('Dropdown Large') }}</x-button>
                        </x-slot>
                        <x-dropdown-link href="#">{{ __('Action 1') }}</x-dropdown-link>
                        <x-dropdown-link href="#">{{ __('Action 2') }}</x-dropdown-link>
                        <x-dropdown-link href="#">{{ __('Action 3') }}</x-dropdown-link>
                    </x-dropdown>
                </div>
            </div>
            <div class="space-y-4">
                <x-text-title>{{ __('Dropdown Positions') }}</x-text-title>
                <div class="space-y-16">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <x-button>{{ __('Dropdown Left') }}</x-button>
                        </x-slot>
                        <x-dropdown-link href="#">{{ __('Action 1') }}</x-dropdown-link>
                        <x-dropdown-link href="#">{{ __('Action 2') }}</x-dropdown-link>
                        <x-dropdown-link href="#">{{ __('Action 3') }}</x-dropdown-link>
                    </x-dropdown>
                    <div class="flex justify-end">
                        <x-dropdown position="right">
                            <x-slot name="trigger">
                                <x-button>{{ __('Dropdown Right') }}</x-button>
                            </x-slot>
                            <x-dropdown-link href="#">{{ __('Action 1') }}</x-dropdown-link>
                            <x-dropdown-link href="#">{{ __('Action 2') }}</x-dropdown-link>
                            <x-dropdown-link href="#">{{ __('Action 3') }}</x-dropdown-link>
                        </x-dropdown>
                    </div>
                    <x-dropdown position="left-16">
                        <x-slot name="trigger">
                            <x-button>{{ __('Dropdown Custom Position') }}</x-button>
                        </x-slot>
                        <x-dropdown-link href="#">{{ __('Action 1') }}</x-dropdown-link>
                        <x-dropdown-link href="#">{{ __('Action 2') }}</x-dropdown-link>
                        <x-dropdown-link href="#">{{ __('Action 3') }}</x-dropdown-link>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </x-card>
</x-layouts.dashboard>