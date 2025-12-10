<x-layouts.auth>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="space-y-1">
            <x-title class="text-center">{{ __('Log in to your account') }}</x-title>
            <x-text class="text-center">{{ __('Enter your email and password below to log in') }}</x-text>
        </div>
        <div class="space-y-4 mt-8">
            <div class="space-y-1">
                <x-label for="email">{{ __('Email') }}</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter email') }}" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="password">{{ __('Password') }}</x-label>
                <div class="relative rounded overflow-hidden"
                    x-data="{ isOpen: false }"
                >
					<button type="button" @click="isOpen = !isOpen" class="right-0 absolute inset-y-0 flex items-center pr-3 cursor-pointer" aria-label="Toggle show password">
						<span class="[&_svg]:stroke-black dark:[&_svg]:stroke-white [&_svg]:w-5 [&_svg]:h-5 shrink-0">
							<svg xmlns="http://www.w3.org/2000/svg" :class="isOpen ? 'hidden' : 'block'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-eye-closed"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" :class="isOpen ? 'block' : 'hidden'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
						</span>
					</button>
					<x-input ::type="isOpen ? 'text' : 'password'" id="password" name="password" value="" placeholder="{{ __('Enter password') }}" required autocomplete="current-password" />
				</div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <div class="flex justify-between items-center mt-2">
                    <x-label for="remember_me" class="flex items-center gap-1">
                        <x-input-checkbox id="remember_me" name="remember" value="1" />
                        <span>{{ __('Remember me') }}</span>
                    </x-label>
                    <x-link href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</x-link>
                </div>
            </div>
            @if (session('status'))
                <x-text-status :status="session('status')" />
            @endif
        </div>
        <div class="space-y-2 mt-8">
            <x-button type="submit" class="w-full">
                <span>{{ __('Login') }}</span>
            </x-button>
            <div class="flex justify-center gap-1">
                <x-text>{{ __('Don\'t have an account?') }}</x-text>
                <x-link href="{{ route('register') }}" class="underline">{{ __('Sign up') }}</x-link>
            </div>
        </div>
    </form>
</x-layouts.auth>