@props([
    'data',
    'route' => url()->current()
])

<div class="flex sm:flex-row flex-col items-center gap-4">
    <div class="flex justify-between items-center w-full sm:w-auto grow">
        <x-text>
            <span>{{ __('Showing') }}</span>
            @if ($data->firstItem())
                <span class="font-medium">{{ $data->firstItem() }}</span>
                <span>{{ __('to') }}</span>
                <span class="font-medium">{{ $data->lastItem() }}</span>
            @else
                <span class="font-medium">{{ $data->count() }}</span>
            @endif
            {{ __('of') }}
            <span class="font-medium">{{ $data->total() }}</span>
            {{ __('results') }}
        </x-text>
        <form action="{{ $route }}" method="POST" class="flex items-center gap-2"
            x-data
        >
            @csrf
            <x-input-select name="per_page" x-on:change="$el.form.submit()">
                @foreach ([10, 50, 100] as $size)
                    <option value="{{ $size }}" @if (request('per_page', $data->perPage()) == $size) selected @endif>{{ $size }}</option>
                @endforeach
            </x-input-select>
            <x-text>{{ __('per page') }}</x-text>
        </form>
    </div>
    @if ($data->lastPage() > 1)
        @php
            $start = max(1, $data->currentPage() - 2);
            $end = min($start + 4, $data->lastPage());
            if ($end - $start + 1 < 5) {
                $start = max(1, $end - 4);
            }
        @endphp
        <div class="flex gap-2">
            @if ($data->onFirstPage())
                <x-button-outline class="!p-2" disabled aria-label="{{ __('Go to first page.') }}">
                    <x-icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M7 6v12" /><path d="M18 6l-6 6l6 6" /></svg>
                    </x-icon>
                </x-button-outline>
                <x-button-outline class="!p-2" disabled aria-label="{{ __('Go to previous page.') }}">
                    <x-icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M15 6l-6 6l6 6" /></svg>
                    </x-icon>
                </x-button-outline>
            @else
                <x-button-link-outline class="!p-2" href="{{ $data->url(1) }}" aria-label="{{ __('Go to first page.') }}">
                    <x-icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M7 6v12" /><path d="M18 6l-6 6l6 6" /></svg>
                    </x-icon>
                </x-button-link-outline>
                <x-button-link-outline class="!p-2" href="{{ $data->previousPageUrl() }}" aria-label="{{ __('Go to previous page.') }}">
                    <x-icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M15 6l-6 6l6 6" /></svg>
                    </x-icon>
                </x-button-link-outline>
            @endif
            <x-input-select name="current_page" x-on:change="console.log('test'); window.location.href=this.value">
                @for ($i = $start; $i <= $end; $i++)
                    <option value="{{ $data->url($i) }}" @if ($i == $data->currentPage()) selected @endif>{{ $i }}</option>
                @endfor
            </x-input-select>
            @if ($data->onLastPage())
                <x-button-outline class="!p-2" disabled aria-label="{{ __('Go to next page.') }}">
                    <x-icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M9 6l6 6l-6 6" /></svg>
                    </x-icon>
                </x-button-outline>
                <x-button-outline class="!p-2" disabled aria-label="{{ __('Go to last page.') }}">
                    <x-icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M6 6l6 6l-6 6" /><path d="M17 5v13" /></svg>
                    </x-icon>
                </x-button-outline>
            @else
                <x-button-link-outline class="!p-2" href="{{ $data->nextPageUrl() }}" aria-label="{{ __('Go to next page.') }}">
                    <x-icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M9 6l6 6l-6 6" /></svg>
                    </x-icon>
                </x-button-link-outline>
                <x-button-link-outline class="!p-2" href="{{ $data->url($data->lastPage()) }}" aria-label="{{ __('Go to last page.') }}">
                    <x-icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M6 6l6 6l-6 6" /><path d="M17 5v13" /></svg>
                    </x-icon>
                </x-button-link-outline>
            @endif
        </div>
    @endif
</div>