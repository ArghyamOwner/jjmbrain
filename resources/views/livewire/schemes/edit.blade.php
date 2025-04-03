<div>
    <x-slot name="title">Edit Scheme</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $schemeId) }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                Edit Scheme
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card-form form-action="save">
            <x-slot name="title">Scheme Details</x-slot>
            <x-slot name="description">Add the necessary details.</x-slot>

            @if (auth()->user()->isAdministrator() || auth()->user()->isExecutiveEngineer())
                <x-input label="Scheme Name" name="name" wire:model.defer="name" />
            @endif

            {{--
                <x-input label="Scheme UIN" name="scheme_uin" wire:model.defer="scheme_uin" /> --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-select label="Financial Year" name="financial_year" wire:model.defer="financial_year">
                    <option value="">--Select financial year--</option>
                    @foreach ($this->financialYears as $financialYear)
                        <option value="{{ $financialYear->id }}">{{ $financialYear->financialYear }}</option>
                    @endforeach
                </x-select>
                {{-- <x-select label="Scheme Type" name="scheme_type" wire:model.defer="scheme_type">
                        <option value="">--Select scheme type--</option>
                        @foreach ($this->schemeTypes as $schemeType)
                        <option value="{{ $schemeType->value }}">{{ $schemeType->name }}</option>
                        @endforeach
                    </x-select> --}}

                {{-- <x-select label="Work Status" name="work_status" wire:model.defer="work_status">
                        <option value="">--Select work status--</option>
                        @foreach ($this->schemeWorkStatuses as $schemeWorkStatus)
                        <option value="{{ $schemeWorkStatus->value }}">{{ $schemeWorkStatus->name }}</option>
                        @endforeach
                    </x-select> --}}
                <x-select label="Approved On" name="approved_on" wire:model.defer="approved_on">
                    <option value="">--Select--</option>
                    @foreach ($approvedOnOptions as $optionKey => $optionValue)
                        <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                    @endforeach
                </x-select>
                {{--
                    <x-input optional label="Habitation" name="habitation" wire:model.defer="habitation" /> --}}
                {{--
                    <x-input optional label="Approved On" name="approved_on" wire:model.defer="approved_on" /> --}}
                {{-- <x-select label="Approved On" name="approved_on" wire:model.defer="approved_on">
                        <option value="">--Select--</option>
                        @foreach ($approvedOnOptions as $optionKey => $optionValue)
                        <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                        @endforeach
                    </x-select>
                    --}}
                @unless (auth()->user()->isPanchayat())
                    <x-input optional label="IMIS ID" name="imis_id" wire:model.defer="imis_id" />
                @endunless
                @if (auth()->user()->isAdministrator() || auth()->user()->isExecutiveEngineer())
                    <x-input optional label="SMT ID" name="old_scheme_id" wire:model.defer="old_scheme_id" />
                    <x-select label="Scheme Water Source" name="water_source" wire:model.defer="water_source">
                        <option value="">--Select scheme water source--</option>
                        @foreach ($this->schemeWaterSource as $source)
                            <option value="{{ $source->value }}">{{ $source->name }}</option>
                        @endforeach
                    </x-select>
                    <x-money label="Total Amount (in Rs.)" name="total_cost" wire:model.defer="total_cost" />
                    <x-money label="Central Share (in Rs.)" name="central_share" wire:model.defer="central_share" />
                    <x-money label="State Amount (in Rs.)" name="state_share" wire:model.defer="state_share" />
                @endif
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                {{--
                    <x-input optional label="Planned FHTC" name="planned_fhtc" wire:model.defer="planned_fhtc" /> --}}
                <x-select label="Scheme Nature" name="scheme_nature" wire:model.defer="scheme_nature">
                    <option value="">--Select an Option--</option>
                    @foreach ($this->schemeNature as $nature)
                        <option value="{{ $nature->value }}">{{ $nature->name }}</option>
                    @endforeach
                </x-select>

                <x-select label="Scheme Energy Type" name="energy_type" wire:model.defer="energy_type">
                    <option value="">--Select Energy Type--</option>
                    @foreach ($energyType as $energy)
                        <option value="{{ $energy }}">{{ $energy }}</option>
                    @endforeach
                </x-select>

                <x-input optional label="SLSSC Year" placeholder="2021-22" name="slssc_year"
                    wire:model.defer="slssc_year" />

                @unless (auth()->user()->isPanchayat())
                    <x-input optional label="Actual FHTC" name="achieved_fhtc" wire:model.defer="achieved_fhtc" />
                @endunless
            </div>

            <x-select label="Funding Agency" name="funding_agency" wire:model.defer="funding_agency">
                <option value="">--Select funding agency--</option>
                @foreach ($agencies as $agenciesOption)
                    <option value="{{ $agenciesOption }}">{{ $agenciesOption }}</option>
                @endforeach
            </x-select>
            {{-- "Request pending at SDO" "Waiting for Resltion" "Resolved Status pending at SDO" "Resolved" --}}
            @if ($showOperatingStatus)
                @if ($this->isPendingWaterDisruption)
                    <x-heading size="md" class="mb-2">
                        <div class="flex text-sm font-normal">Note:
                            <x-icon-flag class="mr-1 ml-1 text-red-600 w-4 h-4" />
                            Please complete the previous water disruption report to update the 
                            <span class="font-bold ml-1 text-red-600"> Operating Status </span>
                        </div>
                    </x-heading>
                @else
                    <x-section-border />
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                        <x-select label="Operating Status" name="operating_status" wire:model="operating_status">
                            <option value="">--Select operating status--</option>
                            @foreach ($this->schemeOperatingStatuses as $schemeOperatingStatus)
                                <option value="{{ $schemeOperatingStatus->value }}">{{ $schemeOperatingStatus->name }}
                                </option>
                            @endforeach
                        </x-select>
                        @if ($this->showFlowOption)
                            <x-select label="Reason for disruption" name="reasons_disruption"
                                wire:model="reasons_disruption">
                                <option value="">--Select Reason Type--</option>
                                @foreach ($this->issueTypes as $key => $issue)
                                    <option value="{{ $key }}">{{ $issue }}</option>
                                @endforeach
                            </x-select>
                            <x-virtual-select label="Specific reasons for disruption" name="specific_reasons"
                                wire:model="specific_reasons" :options="[
                                    'options' => $this->reasonsDisruption,
                                    'multiple' => true,
                                    'showValueAsTags' => true,
                                ]" custom-label />
                            <x-input-number input-mode="numeric"
                                label="No. of days required to resolve water availability" name="days_to_resolve"
                                wire:model.defer="days_to_resolve" />
                        @endif
                    </div>

                @endif
            @endif
            @if ($errors->all(':message'))
                <div>
                    Errors :
                    <span class="text-red-500">
                        @foreach ($errors->all(':message') as $error)
                            &#8226; {{ $error }} <br />
                        @endforeach
                        {{-- {{ implode('', $errors->all(':message')) }} --}}
                    </span>
                </div>
            @endif
            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>

                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card-form>
        @unless (auth()->user()->isPanchayat())
            <x-section-border />

            @if (auth()->user()->isAdministrator() || auth()->user()->isExecutiveEngineer())
                <livewire:schemes.administrative-details :scheme-id="$schemeId" />
                <x-section-border />
            @endif
            <livewire:schemes.location :scheme-id="$schemeId" :latitude="$latitude" :longitude="$longitude" />
        @endunless
    </x-section-centered>
    @once
        @push('styles')
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.21/dist/virtual-select.min.css">
            <style>
                .vscomp-ele {
                    max-width: 100%;
                }

                .vscomp-toggle-button {
                    min-height: 38px;
                    border: 1px solid rgb(209 213 219);
                    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
                }

                .vscomp-toggle-button,
                .vscomp-dropbox-container {
                    border-radius: 0.5rem;
                    overflow: hidden;
                }

                .vscomp-search-wrapper .vscomp-search-input:focus {
                    box-shadow: 0 0 0 0px #fff !important;
                }

                .vscomp-wrapper {
                    font-family: inherit;
                }

                .vscomp-wrapper.focused .vscomp-toggle-button,
                .vscomp-wrapper:focus .vscomp-toggle-button {
                    outline: 2px solid transparent;
                    outline-offset: 2px;
                    --tw-ring-inset: var(--tw-empty,
                            /*!*/
                            /*!*/
                        );
                    --tw-ring-offset-width: 0px;
                    --tw-ring-offset-color: #fff;
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgba(99, 102, 241, var(--tw-ring-opacity));
                    --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                    --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                    --tw-border-opacity: 1;
                    box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
                    border-color: rgba(99, 102, 241, var(--tw-border-opacity));
                }

                .vscomp-wrapper .checkbox-icon::after {
                    border: 2px solid rgb(156 163 175);
                    border-radius: 4px;
                }

                .vscomp-option.focused,
                .vscomp-wrapper.show-value-as-tags .vscomp-value-tag {
                    background-color: rgb(0 0 0 / 0.05);
                }

                .vscomp-option.selected {
                    background-color: rgb(0 0 0 / 0.03);
                }

                .vscomp-arrow::after {
                    content: url("data:image/svg+xml, %3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='none' stroke='%239CA3AF'%3E%3Cpath d='M7 7l3-3 3 3m0 6l-3 3-3-3' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'%3E%3C/path%3E%3C/svg%3E");
                    -webkit-transform: none;
                    transform: none;
                    border: none;
                    width: 20px;
                    height: 20px;
                    margin-top: 0px;
                    margin-right: 7px;
                }

                .pop-comp-wrapper {
                    box-shadow: 0 -1px 1px 0 rgb(0 0 0 / 0.07), 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
                    border: 1px solid #e5e7eb;
                }

                .vscomp-options-container {
                    padding-top: 1px;
                    padding-bottom: 5px;
                }

                .vscomp-options-container::-webkit-scrollbar {
                    'hasOptionDescription'=>true height: 18px;
                }

                .vscomp-options-container::-webkit-scrollbar-corner {
                    background: 0 0;
                }

                .vscomp-options-container::-webkit-scrollbar-thumb {
                    background-color: rgb(0 0 0 / 0.15);
                }

                .vscomp-options-container::-webkit-scrollbar-track {
                    background-color: rgb(0 0 0 / 0.07);
                }

                .vscomp-wrapper.multiple .vscomp-option.selected .checkbox-icon::after {
                    border-color: #6366f1;
                    border-left-color: transparent;
                    border-top-color: transparent;
                    -webkit-transform: rotate(45deg) translate(1px, -4px);
                    transform: rotate(45deg) translate(1px, -4px);
                }

                .vscomp-option-description {
                    margin-top: -12px;
                }
            </style>
        @endpush
        @push('scripts-footer')
            <script src="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.21/dist/virtual-select.min.js"></script>
            <script>
                function customLabelRenderer(data) {
                    const prefix =
                        `<img src='https://api.dicebear.com/7.x/initials/svg/seed=${data.label}.svg?&width=64&height=64' loading='lazy' class='flex-shrink-0 h-6 w-6 rounded-full mr-2'>`;
                    return `<div class="flex items-center">${prefix}<div class="text-gray-700">${data.label}</div></div>`;
                }
            </script>
        @endpush
    @endonce
</div>
