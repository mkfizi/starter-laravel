@if(session('status') || $errors->any())
    <x-alert id="dashboard-alert">
        {{ session('status') }}
        @if($errors->any())
            @php
                count($errors->all()) > 1 ? $bullet = true : $bullet = false;
            @endphp
            <x-input-error :messages="$errors->all()" :bullet="$bullet" />
        @endif
    </x-alert>
@endif