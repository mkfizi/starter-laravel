<x-layouts.dashboard title="{{ __('Activity Log') }}">
    <div class="space-y-4">
        <div class="flex justify-between gap-2">
            <x-button-link-outline href="{{ route('dashboard.admin.audit.activity-log.index') }}">{{ __('Back') }}</x-button-link-outline>
        </div>
        <x-card>
            <div class="space-y-4 max-w-screen-sm">
                <x-title>{{ __('Activity Details') }}</x-title>
                <div class="space-y-1">
                    <x-label>{{ __('Date & Time') }}</x-label>
                    <x-input type="text" class="w-full" value="{{ $activity->created_at->format('Y-m-d H:i:s') }}" disabled />
                    <x-text class="text-neutral-500 dark:text-neutral-400 text-xs">{{ $activity->created_at->diffForHumans() }}</x-text>
                </div>
                <div class="space-y-1">
                    <x-label>{{ __('Action') }}</x-label>
                    <div>
                        <span class="inline-flex px-2 py-1 rounded text-xs font-medium capitalize
                            @if(str_contains($activity->description, 'created')) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                            @elseif(str_contains($activity->description, 'updated')) bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                            @elseif(str_contains($activity->description, 'deleted')) bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                            @elseif(str_contains($activity->description, 'login')) bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                            @elseif(str_contains($activity->description, 'logout')) bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                            @else bg-neutral-100 text-neutral-800 dark:bg-neutral-900 dark:text-neutral-200
                            @endif">
                            {{ $activity->description }}
                        </span>
                    </div>
                </div>
                <div class="space-y-1">
                    <x-label>{{ __('User') }}</x-label>
                    @if($activity->causer)
                        <x-input type="text" class="w-full" value="{{ $activity->causer->name }} ({{ $activity->causer->email }})" disabled />
                    @else
                        <x-input type="text" class="w-full" value="{{ __('System') }}" disabled />
                    @endif
                </div>
                <div class="space-y-1">
                    <x-label>{{ __('Log Name') }}</x-label>
                    <x-input type="text" class="w-full" value="{{ $activity->log_name }}" disabled />
                </div>
                @if($activity->subject_type)
                    <div class="space-y-1">
                        <x-label>{{ __('Subject') }}</x-label>
                        <x-input type="text" class="w-full" value="{{ $activity->subject_type }} (ID: {{ $activity->subject_id }})" disabled />
                    </div>
                @endif
                @if($activity->properties && $activity->properties->count() > 0)
                    <div class="space-y-1">
                        <x-label>{{ __('Changes') }}</x-label>
                        @if($activity->properties->has('old'))
                            <div class="space-y-2">
                                <x-text>{{ __('Old Values:') }}</x-text>
                                <div class="bg-neutral-50 dark:bg-neutral-800 p-4 rounded-lg">
                                    <pre class="overflow-x-auto text-neutral-800 dark:text-neutral-200 text-xs">{{ json_encode($activity->properties->get('old'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                </div>
                            </div>
                        @endif
                        @if($activity->properties->has('attributes'))
                            <div class="space-y-2">
                                <x-text>{{ __('New Values:') }}</x-text>
                                <div class="bg-neutral-50 dark:bg-neutral-800 p-4 rounded-lg">
                                    <pre class="overflow-x-auto text-neutral-800 dark:text-neutral-200 text-xs">{{ json_encode($activity->properties->get('attributes'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                </div>
                            </div>
                        @endif
                        @if(!$activity->properties->has('old') && !$activity->properties->has('attributes'))
                            <div class="bg-neutral-50 dark:bg-neutral-800 p-4 rounded-lg">
                                <pre class="overflow-x-auto text-neutral-800 dark:text-neutral-200 text-xs">{{ json_encode($activity->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </x-card>
    </div>
</x-layouts.dashboard>
