@props([
    'id' => 'autocomplete-' . \Illuminate\Support\Str::random(8),  
    'searchText' => 'Search',
    'data' => [],
    'endpoint' => null,
    'minChars' => 1,
])

<div class="relative space-y-1 w-full"
    x-data="{
        query: '',
        isOpen: false,
        selectedIndex: -1,
        allOptions: [ @json($data) ],
        getOptionLabel(option) {
            if (typeof option === 'string') return option;
            return option?.label ?? option?.value ?? '';
        },
        getOptionValue(option) {
            if (typeof option === 'string') return option;
            return option?.value ?? option?.label ?? '';
        },
        async fetchOptions() {
            if (!'{{ $endpoint }}') return;
            if (!this.query || this.query.length < {{ (int) $minChars }}) {
                this.allOptions = [];
                return;
            }
            try {
                const response = await fetch(`{{ $endpoint }}?q=${encodeURIComponent(this.query)}`);
                if (!response.ok) throw new Error('Failed to fetch');
                const result = await response.json();
                this.allOptions = Array.isArray(result) ? result : [];
            } catch (error) {
                this.allOptions = [];
            }
        },
        get filteredOptions() {
            if (!this.query) return [];
            if ('{{ $endpoint }}') return this.allOptions;

            const filtered = this.allOptions.filter(option =>
                this.getOptionLabel(option).toLowerCase().includes(this.query.toLowerCase())
            );

            return filtered.slice(0, 5);
        },
        selectOption(option) {
            const label = this.getOptionLabel(option);
            const value = this.getOptionValue(option);
            this.query = label;
            this.isOpen = false;
            this.selectedIndex = -1;
            this.$dispatch('autocomplete-selected', { id: '{{ $id }}', value, label });
        },
        handleKeydown(e) {
            if (!this.isOpen || this.filteredOptions.length === 0) return;
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                this.selectedIndex = Math.min(this.selectedIndex + 1, this.filteredOptions.length - 1);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                this.selectedIndex = Math.max(this.selectedIndex - 1, -1);
            } else if (e.key === 'Enter' && this.selectedIndex >= 0) {
                e.preventDefault();
                this.selectOption(this.filteredOptions[this.selectedIndex]);
            }
        },
        handleInput() {
            this.isOpen = this.query.length >= {{ (int) $minChars }};
            this.selectedIndex = -1;
            this.fetchOptions();
        }
    }"
    x-on:click.outside="isOpen = false"
    x-on:keydown.escape.window="isOpen = false"
    x-on:autocomplete-clear.window="$event.detail.id === '{{ $id }}' ? (query = '', isOpen = false, selectedIndex = -1) : null"
    >
    <x-label for="{{ $id }}" class="block text-neutral-800 dark:text-neutral-200 text-sm">{{ $searchText }}</x-label>


    <div class="relative">
        <x-input id="{{ $id }}-input" type="text" autocomplete="off" aria-autocomplete="list" aria-controls="{{ $id }}-dropdown" placeholder="{{ __('Type to search...') }}"
            x-model="query"
            x-on:input.debounce.300="handleInput"
            x-on:change="handleInput"
            x-on:keydown="handleKeydown"
            x-on:focus="isOpen = query.length > 0"
            x-bind:aria-expanded="isOpen && filteredOptions.length > 0"
        />

        <!-- Autocomplete Dropdown -->
        <div
            id="{{ $id }}-dropdown"
            x-show="isOpen && filteredOptions.length > 0"
            class="left-0 z-10 absolute bg-white dark:bg-neutral-950 mt-1 border border-neutral-200 dark:border-neutral-800 rounded w-full"
            role="listbox"
            x-cloak
        >
            <ul class="space-y-1 p-1 leading-0">
                <template x-for="(option, index) in filteredOptions" :key="getOptionValue(option) + index">
                    <div
                        x-on:click="selectOption(option)"
                        class="inline-block hover:bg-neutral-100 dark:hover:bg-neutral-800 px-3 py-2 rounded w-full font-medium text-black dark:text-white text-sm text-left cursor-pointer"
                        role="option"
                    >
                        <span x-text="getOptionLabel(option)"></span>
                    </div>
                </template>
            </ul>
        </div>
        <!-- END Autocomplete Dropdown -->
        
        <!-- No Results Message -->
        <div
            x-show="isOpen && query && filteredOptions.length === 0"
            class="z-10 absolute bg-white dark:bg-neutral-900 mt-1 px-4 py-3 border border-neutral-200 dark:border-neutral-800 rounded w-full"
            x-cloak
        >
            <p class="text-black dark:text-white text-sm text-left">{{ __('No results found') }}</p>
        </div>
    </div>
    </div>