<div>
    <x-slot name="title">Edit Scheme</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create Scheme
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Scheme Details</x-slot>
                <x-slot name="description">Add the necessary details.</x-slot>

                <x-input label="Scheme Name" name="name" wire:model.defer="name" />

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <x-input label="Scheme UIN" name="scheme_uin" wire:model.defer="scheme_uin" />

                    <x-select label="Funding Agency" name="funding_agency" wire:model.defer="funding_agency">
                        <option value="">--Select funding agency--</option>
                        @foreach ($agenciesOptions as $agenciesOption)
                        <option value="{{ $agenciesOption }}">{{ $agenciesOption }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Financial Year" name="financial_year" wire:model.defer="financial_year">
                        <option value="">--Select financial year--</option>
                        @foreach ($this->financialYears as $financialYear)
                        <option value="{{ $financialYear->id }}">{{ $financialYear->financialYear }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Scheme Type" name="scheme_type" wire:model.defer="scheme_type">
                        <option value="">--Select scheme type--</option>
                        @foreach ($this->schemeTypes as $schemeType)
                        <option value="{{ $schemeType->value }}">{{ $schemeType->name }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Work Status" name="work_status" wire:model.defer="work_status">
                        <option value="">--Select work status--</option>
                        @foreach ($this->schemeWorkStatuses as $schemeWorkStatus)
                        <option value="{{ $schemeWorkStatus->value }}">{{ $schemeWorkStatus->name }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Operating Status" name="operating_status" wire:model.defer="operating_status">
                        <option value="">--Select operating status--</option>
                        @foreach ($this->schemeOperatingStatuses as $schemeOperatingStatus)
                        <option value="{{ $schemeOperatingStatus->value }}">{{ $schemeOperatingStatus->name }}
                        </option>
                        @endforeach
                    </x-select>

                    {{--
                    <x-input optional label="Habitation" name="habitation" wire:model.defer="habitation" /> --}}
                    {{--
                    <x-input optional label="Approved On" name="approved_on" wire:model.defer="approved_on" /> --}}
                    <x-select label="Approved On" name="approved_on" wire:model.defer="approved_on">
                        <option value="">--Select--</option>
                        @foreach ($approvedOnOptions as $optionKey => $optionValue)
                        <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Scheme Water Source" name="water_source" wire:model.defer="water_source">
                        <option value="">--Select scheme water source--</option>
                        @foreach ($this->schemeWaterSource as $source)
                        <option value="{{ $source->value }}">{{ $source->name }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <x-input label="IMIS ID" name="imis_id" wire:model.defer="imis_id" />
                    <x-input label="SMT ID" name="old_scheme_id" wire:model.defer="old_scheme_id" />
                    <x-input optional label="Planned FHTC" name="planned_fhtc" wire:model.defer="planned_fhtc" />
                    <x-input optional label="Actual FHTC" name="achieved_fhtc" wire:model.defer="achieved_fhtc" />
                </div>

                <x-money label="Total Amount (in Rs.)" name="total_cost" wire:model.defer="total_cost" />
                <x-money label="Central Share (in Rs.)" name="central_share" wire:model.defer="central_share" />
                <x-money label="State Amount (in Rs.)" name="state_share" wire:model.defer="state_share" />
            </x-card-form>

            <x-section-border />

            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Scheme Administrative Details</x-slot>
                <x-slot name="description">Add the necessary details like division, district, block...</x-slot>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">

                    <x-select label="Division" name="division" wire:model="division">
                        <option value="">--Select a division--</option>
                        @foreach ($this->divisions as $divisionKey => $divisionName)
                        <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Sub-Division" name="subdivision_id" wire:model.defer="subdivision_id">
                        <option value="">--Select a Sub-Division--</option>
                        @foreach ($subdivisions as $subdivisionKey => $subdivisionName)
                        <option value="{{ $subdivisionKey }}">{{ $subdivisionName }}</option>
                        @endforeach
                    </x-select>

                    <div class="md:col-span-2">
                        <x-virtual-select label="LAC" name="lac_id" wire:model.defer="lac_id" :options="[
                                'options' => $this->lacs,
                            ]" />
                    </div>

                    <x-select label="District" name="district" wire:model="district">
                        <option value="">--Select a district--</option>
                        @foreach ($this->districts as $districtKey => $districtName)
                        <option value="{{ $districtKey }}">{{ $districtName }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Block" name="block" wire:model="block">
                        <option value="">--Select a block--</option>
                        @foreach ($blocks as $blockKey => $blockName)
                        <option value="{{ $blockKey }}">{{ $blockName }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div class="mb-8">
                    <x-label class="mb-2">Select Panchayat(s)</x-label>
                    @if ($panchayats)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                        @foreach ($panchayats as $panchayatOption)
                        <div wire:key="panchayat-{{ $panchayatOption['value'] }}">
                            <x-checkbox no-margin name="panchayat-{{ Str::slug($panchayatOption['label']) }}"
                                wire:model="panchayat" value="{{ $panchayatOption['value'] }}"
                                label="{{ $panchayatOption['label'] }}" />
                        </div>
                        @endforeach
                    </div>

                    <x-input-error for="panchayat" class="mt-2" />
                    @else
                    <p class="text-slate-500 text-sm">Please select Block first.</p>
                    @endif
                </div>

                <div class="mb-8">
                    <x-label class="mb-2">Select Village(s)</x-label>
                    @if ($villageOptions)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                        @foreach ($villageOptions as $villageOption)
                        <div wire:key="village-{{ $villageOption['value'] }}">
                            <x-checkbox no-margin name="village-{{ Str::slug($villageOption['label']) }}"
                                wire:model="village" value="{{ $villageOption['value'] }}"
                                label="{{ $villageOption['label'] }}" />
                        </div>
                        @endforeach
                    </div>

                    <x-input-error for="village" class="mt-2" />
                    @else
                    <p class="text-slate-500 text-sm">Please select Panchayat first.</p>
                    @endif
                </div>

                <div class="mb-8">
                    <x-label class="mb-2">Select Habitation(s)</x-label>
                    @if ($habitationOptions)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                        @foreach ($habitationOptions as $habitationOption)
                        <div wire:key="habitation-{{ $habitationOption['value'] }}">
                            <x-checkbox no-margin name="habitation-{{ Str::slug($habitationOption['label']) }}"
                                wire:model="habitation" value="{{ $habitationOption['value'] }}"
                                label="{{ $habitationOption['label'] }}" />
                        </div>
                        @endforeach
                    </div>

                    <x-input-error for="habitation" class="mt-2" />
                    @else
                    <p class="text-slate-500 text-sm">Please select Village first.</p>
                    @endif
                </div>

            </x-card-form>

            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>