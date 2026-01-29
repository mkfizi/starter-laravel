<x-layouts.dashboard title="{{ __('Session History') }}">
    <div class="space-y-4">
        <x-table>
            <x-slot name="header">
                <x-table-th>
                    <x-text>{{ __('No') }}</x-text>
                </x-table-th>
                <x-table-th>
                    <x-text>{{ __('User') }}</x-text>
                </x-table-th>
                <x-table-th>
                    <x-text>{{ __('IP Address') }}</x-text>
                </x-table-th>
                <x-table-th>
                    <x-text>{{ __('Browser') }}</x-text>
                </x-table-th>
                <x-table-th>
                    <x-text>{{ __('Operating System') }}</x-text>
                </x-table-th>
                <x-table-th>
                    <x-text>{{ __('Device') }}</x-text>
                </x-table-th>
                <x-table-th>
                    <x-text>{{ __('Last Activity') }}</x-text>
                </x-table-th>
            </x-slot>
            @if (count($sessions) > 0)
                @foreach ($sessions as $index => $session)
                    <tr>
                        <x-table-td>
                            <x-text>{{ $index + 1 }}</x-text>
                        </x-table-td>
                        <x-table-td>
                            <x-text>{{ $session->user_name }}</x-text>
                        </x-table-td>
                        <x-table-td>
                            <x-text>{{ $session->ip_address }}</x-text>
                        </x-table-td>
                        <x-table-td>
                            <x-text>{{ $session->browser }}</x-text>
                        </x-table-td>
                        <x-table-td>
                            <x-text>{{ $session->os }}</x-text>
                        </x-table-td>
                        <x-table-td>
                            <x-text>{{ $session->device }}</x-text>
                        </x-table-td>
                        <x-table-td>
                            <x-text>{{ $session->last_activity }}</x-text>
                        </x-table-td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <x-table-td colspan="7" class="text-center">
                        <x-text>{{ __('No session history found.') }}</x-text>
                    </x-table-td>
                </tr>
            @endif
        </x-table>
        <x-pagination :data="$sessions" :route="route('dashboard.admin.audit.session-history')" />
    </div>
</x-layouts.dashboard>