@extends('dashboard.settings.index')

@section('content')
    @php
        if (session('status') === 'two-factor-authentication-enabled') {
            session()->flash('status', __('Two-factor authentication has been enabled.'));
        } elseif (session('status') === 'two-factor-authentication-confirmed') {
            session()->flash('status', __('Two-factor authentication has been confirmed.'));
        } elseif (session('status') === 'two-factor-authentication-disabled') {
            session()->flash('status', __('Two-factor authentication has been disabled.'));
        }elseif (session('status') === 'recovery-codes-generated') {
            session()->flash('status', __('New recovery codes have been generated.'));
        }
    @endphp
    <x-card>
        <x-title>{{ __('Two-Factor Authentication') }}</x-text-title>
        @if(!auth()->user()->two_factor_secret)
            <div class="space-y-4 mt-4">
                <x-text>{{ __('When you enable two-factor authentication, you will be prompted for a secure pin during login. This pin can be retrieved from a TOTP-supported application on your phone.') }}</x-text>
                <form method="POST" action="{{ route('two-factor.enable') }}">
                    @csrf
                    <x-button-success type="submit">{{ __('Enable') }}</x-button-success>
                </form>
            </div>
        @elseif(auth()->user()->two_factor_secret && !auth()->user()->two_factor_confirmed_at)
            <div class="space-y-4 mt-4">
                <x-text>{{ __('You have enabled two-factor authentication. Please scan the QR code using your authentication application and enter the code to complete the setup.') }}</x-text>
                <div>
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
                <form method="POST" action="{{ route('two-factor.confirm') }}">
                    @csrf
                    <div class="space-y-1 mt-4">
                        <x-label for="code">{{ __('Authentication Code') }}</x-label>
                        <x-input id="code" name="code" type="text" class="w-full" required autofocus />
                        <x-input-error :messages="$errors->getBag('confirmTwoFactorAuthentication')->get('code')" class="mt-1" />
                    </div>
                    <div class="mt-4">
                        <x-button-success type="submit">{{ __('Confirm') }}</x-button-success>
                    </div>
                </form>
            </div>
        @elseif(auth()->user()->two_factor_secret && auth()->user()->two_factor_confirmed_at)
            <div class="space-y-4 mt-4">
                <x-text>{{ __('With two-factor authentication enabled, you will be prompted for a secure, random pin during login, which you can retrieve from the TOTP-supported application on your phone.') }}</x-text>
                <div class="space-y-1">
                    <x-label for="recovery_codes">{{ __('Recovery Codes:') }}</x-label>
                    @foreach(auth()->user()->recoveryCodes() as $index => $code)
                        <div class="relative max-w-xs"
                            x-data="{ isCopied: false }"
                        >
                            <x-input id="recovery_code_{{ $index }}" name="recovery_code_{{ $index }}" type="text" class="pr-10 w-full" :value="$code" readonly
                                x-ref="recovery_code_{{ $index }}" 
                            />
                            <button type="button" class="top-2 right-2 absolute" aria-label="Copy recovery code to clipboard."
                                @click="
                                    if (navigator.clipboard) {
                                        isCopied = true;
                                        navigator.clipboard.writeText($refs.recovery_code_{{ $index }}.value).then(() => {
                                            setTimeout(() => isCopied = false, 2000);
                                        });
                                    } else {
                                        alert('Clipboard API not supported in this browser.');
                                    }
                                "
                            >
                                <svg x-show="!isCopied" xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"/><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"/></svg>
                                <svg x-show="isCopied" x-cloak xmlns="http://www.w3.org/2000/svg" class="stroke-black dark:stroke-white w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"/><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"/><path d="M9 14l2 2l4 -4"/></svg>
                            </button>
                        </div>
                    @endforeach
                </div>
                <form method="POST" action="{{ route('two-factor.recovery-codes') }}">
                    @csrf
                    <x-button type="submit">{{ __('Regenerate Recovery Codes') }}</x-button>
                </form>
                <form method="POST" action="{{ route('two-factor.disable') }}">
                    @csrf
                    @method('DELETE')
                    <x-button-danger type="submit">{{ __('Disable') }}</x-button-danger>
                </form>
            </div>
        @endif
    </x-card>
@endsection