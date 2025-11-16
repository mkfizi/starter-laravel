<x-layouts.dashboard title="{{ __('Profile') }}">
    @include('dashboard.profile.partials.profile-form')
    @include('dashboard.profile.partials.password-form')
    @include('dashboard.profile.partials.delete-form')
</x-layouts.dashboard>