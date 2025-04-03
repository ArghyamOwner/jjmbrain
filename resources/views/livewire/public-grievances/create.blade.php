<div>
    <div class="bg-cover bg-no-repeat min-h-screen pb-10"
        style="background-image: url('{{ url('img/background-grievance.svg') }}')">
        <x-section-centered class="pt-6 pb-12">

            <div class="md:px-24">
                <!-- Logo -->
                <a href="#" aria-label="Home" class="flex items-center shrink-0">
                    <img class="h-16 md:h-20 object-contain" src="{{ url('img/jjm-logo.png') }}" alt="jjm-Logo"
                        loading="lazy">
                    <div class="font-bold md:text-3xl text-sky-500">
                        Jal Jeevan Mission
                    </div>
                </a>
                <!-- ./Logo -->


                <div class="flex flex-1 justify-between my-5">
                    <x-heading>{{ __('Submit your Grievance') }}</x-heading>
                    <div class="flex items-center">
                        <span class="mr-1 font-medium">{{ __('Language') }}:</span>
                        <x-select name="lang" wire:model="lang" class="w-24" no-margin>
                            <option value="en">English</option>
                            <option value="as">Assamese</option>
                            <option value="hi">Hindi</option>
                            <option value="bn">Bangla</option>
                        </x-select>
                    </div>
                </div>

                <x-card form-action="save">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-select label="{{ __('Select District') }}" name="districtId" wire:model="districtId">
                            <option value="">--Select a district--</option>
                            @foreach ($this->districts as $districtKey => $districtValue)
                                <option value="{{ $districtKey }}">{{ $districtValue }}</option>
                            @endforeach
                        </x-select>

                        <x-select label="{{ __('Select Block') }}" name="blockId" wire:model="blockId">
                            <option value="">--Select a block--</option>
                            @foreach ($blocks as $blockKey => $blockValue)
                                <option value="{{ $blockKey }}">{{ $blockValue }}</option>
                            @endforeach
                        </x-select>

                        <x-select label="{{ __('Gaon Panchayat') }}" name="gramPanchayatId"
                            wire:model="gramPanchayatId">
                            <option value="">--Select a Gaon Panchayat--</option>
                            @foreach ($panchayats as $panchayatKey => $panchayatValue)
                                <option value="{{ $panchayatKey }}">{{ $panchayatValue }}</option>
                            @endforeach
                        </x-select>

                        <x-select label="{{ __('Village') }}" name="villageId" wire:model="villageId">
                            <option value="">--Select a Village--</option>
                            @foreach ($villages as $villageKey => $villageValue)
                                <option value="{{ $villageKey }}">{{ $villageValue }}</option>
                            @endforeach
                        </x-select>

                        @if (!$sid)
                            <x-select label="{{ __('Scheme') }}" name="schemeId" wire:model="schemeId">
                                <option value="">--Select a scheme--</option>
                                @foreach ($schemes as $schemeKey => $schemeValue)
                                    <option value="{{ $schemeKey }}">{{ $schemeValue }}</option>
                                @endforeach
                            </x-select>
                        @endif
                    </div>

                    <div class="flex items-center bg-indigo-50 rounded-md px-2 py-1.5 mb-2 mt-10">
                        <div class="shrink-0 mr-2">
                            <x-icon-user class="w-6 h-6 text-indigo-600" />
                        </div>
                        <div>
                            <div class="text-sm uppercase tracking-wider font-semibold text-indigo-600">
                                {{ __('Personal Details') }}
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">

                        <x-input label="{{ __('Name') }}" name="name" wire:model.defer="name" />

                        <x-input label="{{ __('Mobile Number') }}" name="phone" wire:model.defer="phone" />

                        <div>
                            <div class="mt-6">
                                @if (!$otpSent)
                                    <x-button color="blue" with-spinner wire:target="verifyPhone" class="truncate"
                                        type="button" wire:click="verifyPhone">Send OTP</x-button>
                                @endif

                                @if ($phoneIsVerified)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#16a34a"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm45.66,85.66-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35a8,8,0,0,1,11.32,11.32Z">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($otpStatusMessage)
                        <x-alert class="mb-4" :close="false">{{ $otpStatusMessage }}</x-alert>
                    @endif

                    @if ($otpSent && !$phoneIsVerified)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                            <div class="col-span-2 md:col-span-1">
                                <x-input-number maxlength="6" minlength="6" label="Enter your OTP" name="otp"
                                    wire:model.defer="otp" />
                            </div>
                            <div>
                                <x-button with-spinner wire:target="verifyOtp" class="mt-6 truncate" type="button"
                                    wire:click="verifyOtp">Verify OTP</x-button>
                            </div>
                        </div>

                        <div x-data="{ showResendOtpLink: false }" x-init="() => setTimeout(() => {
                            showResendOtpLink = true
                        }, 10000)" x-cloak class="truncate"
                            x-show="showResendOtpLink">
                            Click here to <x-text-link color="blue" class="font-bold" href="#"
                                x-on:click.prevent="$wire.resendOtp">Resend
                                OTP</x-text-link>.
                        </div>
                    @endif

                    <div>
                        <div class="flex items-center bg-indigo-50 rounded-md px-2 py-1.5 mb-2 mt-10">
                            <div class="shrink-0 mr-2">
                                <x-icon-category class="w-6 h-6 text-indigo-600" />
                            </div>
                            <div>
                                <div class="text-sm uppercase tracking-wider font-semibold text-indigo-600">
                                    {{ __('Issue') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="grid w-3/4 gap-4 md:grid-cols-3">
                        @foreach ($this->categories as $category)
                            <li>
                                <input type="radio" id="{{ Str::slug($category->name) }}" name="categoryId"
                                    wire:model="categoryId" value="{{ $category->id }}" class="hidden peer">
                                <label for="{{ Str::slug($category->name) }}"
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-indigo-600 peer-checked:text-indigo-600 hover:text-gray-600 hover:bg-gray-100">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">
                                            <img src="{{ url('img/' . Str::slug($category->name) . '.png') }}"
                                                alt="leakage-related" class="rounded w-12 h-12 object-fit">
                                        </div>
                                        <div class="w-full">{{ __($category->name) }}</div>
                                    </div>
                                </label>
                            </li>
                        @endforeach
                    </ul>

                    @if ($categoryId)
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-8">
                            <x-radio-group name="subCategoryId" wire:model.defer="subCategoryId"
                                class="md:grid-cols-4" :options="$subCategories" />
                        </div>
                    @endif

                    {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <x-select label="{{ __('Select category') }}" name="categoryId" wire:model="categoryId">
                            <option value="">-- Select category --</option>
                            @foreach ($this->categories as $categoryKey => $categoryValue)
                                <option value="{{ $categoryKey }}">{{ __($categoryValue) }}</option>
                            @endforeach
                        </x-select>
    
                        <x-select label="{{ __('Select sub category') }}" name="subCategoryId" wire:model="subCategoryId">
                            <option value="">--Select a sub-category--</option>
                            @foreach ($subCategories as $subcategorykKey => $subcategorykValue)
                                <option value="{{ $subcategorykKey }}">{{ $subcategorykValue }}</option>
                            @endforeach
                        </x-select>
                    </div> --}}

                    <div class="flex items-center bg-indigo-50 rounded-md px-2 py-1.5 mb-2 mt-10">
                        <div class="shrink-0 mr-2">
                            <x-icon-messages class="w-6 h-6 text-indigo-600" />
                        </div>
                        <div>
                            <div class="text-sm uppercase tracking-wider font-semibold text-indigo-600">
                                {{ __('Description') }}
                            </div>
                        </div>
                    </div>

                    <x-textarea-simple label="{{ __('Description') }}" name="description"
                        wire:model.defer="description" optional />

                    <div class="flex items-center bg-indigo-50 rounded-md px-2 py-1.5 mb-2 mt-10">
                        <div class="shrink-0 mr-2">
                            <x-icon-file class="w-6 h-6 text-indigo-600" />
                        </div>
                        <div>
                            <div class="text-sm uppercase tracking-wider font-semibold text-indigo-600">
                                {{ __('Supporting Photos') }}
                            </div>
                        </div>
                    </div>
                    <x-filepond-image optional label="{{ __('Upload Photo') }}" name="images"
                        wire:model.defer="images" hint="File : Max 4 Images | Max Size : 8 MB" maxFileSize="8MB" multiple
                        maxFiles=4 />

                    @if ($phoneIsVerified)
                        <x-slot name="footer" class="text-center">
                            <x-button class="py-2.5 w-1/3" with-spinner wire:target="save,images">{{ __('Submit') }}
                            </x-button>
                        </x-slot>
                    @else
                        <x-slot name="footer" class="text-center">
                            <x-button class="py-2.5 w-1/3" with-spinner disabled>{{ __('Submit') }}</x-button>
                        </x-slot>
                    @endif

                </x-card>
            </div>

        </x-section-centered>
    </div>

    @push('styles')
        <style>
            /* .filepond--panel-root {
                                        border: 3px solid rgb(0, 128, 0);
                                    } */

            input:checked+label {
                border: 2px solid #6366f1;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    @endpush
</div>
