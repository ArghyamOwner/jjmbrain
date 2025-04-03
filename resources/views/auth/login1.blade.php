<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="mb-1">
                <a href="/">
                    <x-application-logo class="text-xl" width="65" />
                </a>       
            </div>
        </x-slot>

        <x-heading class="mb-4" size="xl">Login to get started.</x-heading>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <x-auth-validation-errors class="mb-4" :status="session('errors')" />

        <x-form method="POST" action="{{ route('login') }}">

            <!-- School Code / Email -->
            <div>
                <x-label class="mb-1" for="login" :value="__('Email')" />
                <x-input type="email" name="email" class="w-full" :value="old('email')" required autofocus :with-error-message="false" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <div class="flex justify-between">
                    <x-label class="mb-1" for="password" :value="__('Password')" />
    
                    @if (Route::has('password.request'))
                        <div class="mb-1">
                            <a tabindex="3" class="underline text-sm text-slate-600 hover:text-slate-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif
                </div>

                <x-input-password id="password"
                                type="password"
                                name="password"
                                class="w-full"
                                required autocomplete="current-password" />
            </div>

      
            <x-button type="submit" class="w-full mt-2" color="black">
                {{ __('Log in') }}
            </x-button>
        </x-form>

        <x-slot name="footer">
            <div class="space-x-3 flex mt-5 text-sm">
                <span>{{ date('Y') }} &copy; {{ config('app.name') }}</span>
                <div class="text-slate-400">/</div>
                <x-link href="{{ route('privacy') }}">Privacy Policy</x-link>
                {{-- 
                <div>
                    New user? <x-link href="{{ route('register') }}">Register here</x-link>
                </div> --}}
            </div>
        </x-slot>
    </x-auth-card>
</x-guest-layout>
