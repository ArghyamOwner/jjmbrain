<x-guest-layout title="Login">

    <div class="min-h-screen flex items-stretch bg-white">
        <div class="w-full md:w-2/5 flex flex-col items-center">
            <div class="w-full flex-1 flex items-center">
                <div class="w-full px-6 md:px-16 lg:px-20">
                    <img src="{{ url('img/Azadi-Ka-Amrit-Mahotsav.png') }}" alt="azadi-mahotsav" class="h-24">
                    <div class="my-6">
                        <x-heading>
                            <span>Welcome to <br> Jal Jeevan Mission, Assam Portal</span>
                        </x-heading>
                        <span class="text-slate-600 font-medium mt-1">Har Ghar Nal Se Jal</span>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :status="session('errors')" />

                    <x-form method="POST" action="{{ route('login') }}">
                        <div>
                            <x-label class="mb-1" for="login" :value="__('Email')" />
                            <x-input type="email" name="email" class="w-full" :value="old('email')" required autofocus
                                :with-error-message="false" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <div class="flex justify-between">
                                <x-label class="mb-1" for="password" :value="__('Password')" />

                                @if (Route::has('password.request'))
                                    <div class="mb-1">
                                        <a tabindex="3" class="underline text-sm text-slate-600 hover:text-slate-900"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <x-input-password id="password" type="password" name="password" class="w-full" required
                                autocomplete="current-password" />
                        </div>


                        <x-button type="submit" class="w-full mt-2" color="blue">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>{{ __('Log in') }}
                        </x-button>
                    </x-form>
                    <div class="text-center mt-3 text-sm">
                        <x-link href="{{ route('privacy') }}">Privacy Policy</x-link>
                        <span>|</span>
                        <x-link href="{{ route('grievance') }}">Public Grievance</x-link>
                    </div>
                    <x-button tag="a" href="{{ route('public.district.dashboard') }}" class="w-full mt-8"
                        color="black">
                        District Wise-Functional Schemes
                    </x-button>
                </div>
            </div>
            <div class="bg-blue-50 py-4 w-full">
                <p class="text-center text-xs font-semibold text-gray-700 tracking-wider">Powered by INO</p>
            </div>
        </div>

        <div class="hidden md:block flex-1 bg-cover bg-bottom" style="background-image: url('img/login.jpeg')">
        </div>
    </div>

</x-guest-layout>
