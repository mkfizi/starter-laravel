@if (session('status'))
    <x-alert id="dashboard-alert">
        {{ session('status') }}
    </x-alert>
@endif

@if (session('error'))
    <x-alert type="error" id="dashboard-alert">
        {{ session('error') }}
    </x-alert>
@endif