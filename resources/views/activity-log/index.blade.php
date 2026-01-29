
    @php
        $activeFilters = collect(request('actions', []))->count() + (request('date_from') ? 1 : 0) + (request('date_to') ? 1 : 0);
        $hasFilters = $activeFilters > 0;
    @endphp

<x-layouts.dashboard title="{{ __('Activity Log') }}">
    <div class="space-y-4">
        <div class="flex sm:flex-row flex-col justify-between gap-4">
            <div class="flex gap-2">
                <x-input-search route="{{ route('dashboard.admin.audit.activity-log.index') }}" :searchText="__('Search user')" class="sm:w-72"/>
                <x-button class="p-2! relative {{ $hasFilters ? 'bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700' : '' }}" aria-label="{{ __('Filter activity log.') }}"
                    x-data="{ isOffcanvasOpen: false }"
                    x-on:click="$dispatch('open-offcanvas', { id: 'offcanvas-filter-activity-log' })"
                    x-on:offcanvas-filter-activity-log-expanded.window="$event.detail.id === 'offcanvas-filter-activity-log' ? isOffcanvasOpen = $event.detail.isOffcanvasOpen : null"
                    ::aria-expanded="isOffcanvasOpen"
                    aria-controls="offcanvas-filter-activity-log"
                >
                    <x-icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z"/></svg>
                    </x-icon>
                    @if($hasFilters)
                        <span class="top-0 right-0 absolute bg-white dark:bg-neutral-950 -mt-1 -mr-1 px-1.5 rounded-full font-semibold text-blue-600 dark:text-blue-400 text-xs">
                            {{ $activeFilters }}
                        </span>
                    @endif
                </x-button>
            </div>
        </div>
        @if($hasFilters)
            <div class="flex flex-wrap items-center gap-2">
                <x-text class="text-neutral-600 dark:text-neutral-400 text-sm">{{ __('Active filters:') }}</x-text>
                @foreach(request('actions', []) as $action)
                    <span class="inline-flex items-center gap-1 bg-blue-100 dark:bg-blue-900 px-2 py-1 rounded-full text-blue-800 dark:text-blue-200 text-xs">
                        <span class="capitalize">{{ $action }}</span>
                        <a href="{{ route('dashboard.admin.audit.activity-log.index', array_merge(request()->except('actions'), ['actions' => array_diff(request('actions', []), [$action])])) }}" 
                           class="hover:bg-blue-200 dark:hover:bg-blue-800 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                        </a>
                    </span>
                @endforeach
                @if(request('date_from'))
                    <span class="inline-flex items-center gap-1 bg-blue-100 dark:bg-blue-900 px-2 py-1 rounded-full text-blue-800 dark:text-blue-200 text-xs">
                        <span>{{ __('From:') }} {{ request('date_from') }}</span>
                        <a href="{{ route('dashboard.admin.audit.activity-log.index', request()->except('date_from')) }}" 
                           class="hover:bg-blue-200 dark:hover:bg-blue-800 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                        </a>
                    </span>
                @endif
                @if(request('date_to'))
                    <span class="inline-flex items-center gap-1 bg-blue-100 dark:bg-blue-900 px-2 py-1 rounded-full text-blue-800 dark:text-blue-200 text-xs">
                        <span>{{ __('To:') }} {{ request('date_to') }}</span>
                        <a href="{{ route('dashboard.admin.audit.activity-log.index', request()->except('date_to')) }}" 
                           class="hover:bg-blue-200 dark:hover:bg-blue-800 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                        </a>
                    </span>
                @endif
                <x-link href="{{ route('dashboard.admin.audit.activity-log.index') }}" class="text-blue-600 dark:text-blue-400 text-xs hover:underline">
                    {{ __('Clear all') }}
                </x-link>
            </div>
        @endif
        <x-table>
            <x-slot name="header">
                <x-table-th><x-text>{{ __('No') }}</x-text></x-table-th>
                <x-table-th><x-text>{{ __('Date & Time') }}</x-text></x-table-th>
                <x-table-th><x-text>{{ __('User') }}</x-text></x-table-th>
                <x-table-th><x-text>{{ __('Action') }}</x-text></x-table-th>
                <x-table-th><x-text>{{ __('Subject') }}</x-text></x-table-th>
                <x-table-th></x-table-th>
            </x-slot>
            @if (count($activities) > 0)
                @foreach ($activities as $index => $activity)
                    <tr>
                        <x-table-td class="w-1/12">
                            <x-text>{{ $activities->firstItem() + $index }}</x-text>
                        </x-table-td>
                        <x-table-td>
                            <x-text>{{ $activity->created_at->format('Y-m-d H:i:s') }}</x-text>
                        </x-table-td>
                        <x-table-td>
                            @if($activity->causer)
                                <x-text>{{ $activity->causer->email }}</x-text>
                            @else
                                <x-text>{{ __('System') }}</x-text>
                            @endif
                        </x-table-td>
                        <x-table-td>
                            <x-text>
                                <span class="inline-flex px-2 py-1 rounded text-xs font-medium capitalize
                                    @if(str_contains($activity->description, 'created')) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @elseif(str_contains($activity->description, 'updated')) bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                    @elseif(str_contains($activity->description, 'deleted')) bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                    @elseif(str_contains($activity->description, 'failed')) bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200
                                    @elseif(str_contains($activity->description, 'login')) bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                    @elseif(str_contains($activity->description, 'logout')) bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                    @else bg-neutral-100 text-neutral-800 dark:bg-neutral-900 dark:text-neutral-200
                                    @endif">
                                    {{ $activity->description }}
                                </span>
                            </x-text>
                        </x-table-td>
                        <x-table-td>
                            @if($activity->subject)
                                <x-text>{{ class_basename($activity->subject_type) }}</x-text>
                            @else
                                <x-text class="text-neutral-400 dark:text-neutral-500">-</x-text>
                            @endif
                        </x-table-td>
                        <x-table-td class="w-16">
                            <div class="flex gap-2">
                                <x-tooltip text="{{ __('View Details') }}">
                                    <x-link href="{{ route('dashboard.admin.audit.activity-log.show', $activity) }}" aria-label="{{ __('View activity details.') }}">
                                        <x-icon>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-note"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 20l7 -7" /><path d="M13 20v-6a1 1 0 0 1 1 -1h6v-7a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7" /></svg>
                                        </x-icon>
                                    </x-link>
                                </x-tooltip>
                            </div>
                        </x-table-td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <x-table-td :colspan="6" class="text-center">
                        <x-text>{{ __('No data available.') }}</x-text>
                    </x-table-td>
                </tr>
            @endif
        </x-table>
        <x-pagination :data="$activities" :route="route('dashboard.admin.audit.activity-log.index')" />
    </div>
    @include('activity-log.partials.offcanvas-filter-activity-log')
</x-layouts.dashboard>
