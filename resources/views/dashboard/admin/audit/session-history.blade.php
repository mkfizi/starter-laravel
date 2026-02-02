<x-layouts.dashboard title="{{ __('Session History') }}">
    <div class="space-y-4">
        <div class="flex sm:flex-row flex-col justify-between gap-4">
            <x-input-search route="{{ route('dashboard.admin.audit.session-history') }}" :searchText="__('Search user email.')" class="sm:w-72"/>
        </div>
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
                    <x-text>{{ __('Login At') }}</x-text>
                </x-table-th>
                <x-table-th>
                    <x-text>{{ __('Status') }}</x-text>
                </x-table-th>
            </x-slot>
            @if (count($sessions) > 0)
                @foreach ($sessions as $index => $session)
                    <tr>
                        <x-table-td>
                            <x-text>{{ $sessions->firstItem() + $index }}</x-text>
                        </x-table-td>
                        <x-table-td>
                            <x-text>{{ $session->user_email }}</x-text>
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
                            <x-text>{{ $session->login_at->format('Y-m-d H:i:s') }}</x-text>
                        </x-table-td>
                        <x-table-td>
                            <x-text>{{ $session->status }}</x-text>
                        </x-table-td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <x-table-td colspan="8" class="text-center">
                        <x-text>{{ __('No data available.') }}</x-text>
                    </x-table-td>
                </tr>
            @endif
        </x-table>
        <x-pagination :data="$sessions" :route="route('dashboard.admin.audit.session-history')" />
    </div>
</x-layouts.dashboard>