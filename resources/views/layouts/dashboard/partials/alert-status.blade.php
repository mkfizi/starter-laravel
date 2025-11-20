@if (session('status'))
    <x-alert id="dashboard-alert">
        {{ session('status') }}
    </x-alert>
@endif