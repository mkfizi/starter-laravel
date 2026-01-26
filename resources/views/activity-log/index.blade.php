<x-layouts.dashboard title="{{ __('Activity Log') }}">
    <div class="space-y-4">
        <x-card>
            <form method="GET" action="{{ route('dashboard.admin.activity-log.index') }}" class="gap-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                <div class="space-y-1">
                    <x-label for="description">{{ __('Action') }}</x-label>
                    <x-input 
                        id="description" 
                        name="description" 
                        type="text" 
                        class="w-full" 
                        :value="request('description')" 
                        placeholder="created, updated, deleted..."
                    />
                </div>
                
                <div class="space-y-1">
                    <x-label for="log_name">{{ __('Log Name') }}</x-label>
                    <x-input 
                        id="log_name" 
                        name="log_name" 
                        type="text" 
                        class="w-full" 
                        :value="request('log_name')" 
                        placeholder="default"
                    />
                </div>

                <div class="space-y-1">
                    <x-label for="date_from">{{ __('Date From') }}</x-label>
                    <x-input 
                        id="date_from" 
                        name="date_from" 
                        type="date" 
                        class="w-full" 
                        :value="request('date_from')"
                    />
                </div>

                <div class="space-y-1">
                    <x-label for="date_to">{{ __('Date To') }}</x-label>
                    <x-input 
                        id="date_to" 
                        name="date_to" 
                        type="date" 
                        class="w-full" 
                        :value="request('date_to')"
                    />
                </div>

                <div class="flex gap-2 md:col-span-2 lg:col-span-4">
                    <x-button type="submit">{{ __('Filter') }}</x-button>
                    <x-button-outline type="button" onclick="window.location.href='{{ route('dashboard.admin.activity-log.index') }}'">
                        {{ __('Reset') }}
                    </x-button-outline>
                </div>
            </form>
        </x-card>
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
                                    <x-link href="{{ route('dashboard.admin.activity-log.show', $activity) }}" aria-label="{{ __('View activity details.') }}">
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
        <x-pagination :data="$activities" :route="route('dashboard.admin.activity-log.index')" />
    </div>
</x-layouts.dashboard>
