<div>
    <x-slot name="title">Create WUC</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('wucs') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Create a new WUC
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card overflow-hidden form-action="save">

                <x-input label="WUC Name" name="name" wire:model.defer="name" />
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <x-input label="President Name" name="president_name" wire:model.defer="president_name" />
                    <x-input label="Secretary Name" name="secretary_name" wire:model.defer="secretary_name" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
                    <x-select label="District" name="district_id" wire:model="district_id">
                        <option value="">--Select an option--</option>
                        @foreach ($this->districts as $districtKey => $value)
                            <option value="{{ $districtKey }}">{{ $value }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Revenue Circle" name="revenue_circle_id" wire:model="revenue_circle_id">
                        <option value="">--Select an option--</option>
                        @foreach ($circles as $circlekey => $val)
                            <option value="{{ $circlekey }}">{{ $val }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Block" name="block_id" wire:model="block_id">
                        <option value="">--Select an option--</option>
                        @foreach ($blocks as $blockKey => $blockVal)
                            <option value="{{ $blockKey }}">{{ $blockVal }}</option>
                        @endforeach
                    </x-select>


                    {{-- <x-virtual-select 
                    label="Contractor Name" 
                    name="contractor" 
                    wire:model="contractor" 
                    :options="[
                        'options' => $this->contractorUsers
                    ]"
                    custom-label
                /> --}}
                </div>

                <div class="mb-5">
                    <x-label class="mb-2">Select Panchayat(s)</x-label>
                    @if ($panchayats)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2">
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

                <div class="mb-5">
                    <x-label class="mb-2">Select Village(s)</x-label>
                    @if ($villageOptions)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2">
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
                    <x-label class="mb-2">Select Scheme(s)</x-label>
                    @if ($schemeOptions)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2">
                            @foreach ($schemeOptions as $schemeOption)
                                <div wire:key="schemes-{{ $schemeOption['value'] }}">
                                    <x-checkbox no-margin name="schemes-{{ Str::slug($schemeOption['label']) }}"
                                        wire:model="schemes" value="{{ $schemeOption['value'] }}"
                                        label="{{ $schemeOption['label'] }}" />
                                </div>
                            @endforeach
                        </div>

                        <x-input-error for="schemes" class="mt-2" />
                    @else
                        <p class="text-slate-500 text-sm">Please select Village first.</p>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-input type="date" label="Date of Formation" name="formation_date"
                        wire:model.defer="formation_date" />
                    <x-input type="date" label="Approval Date of GPWSC" name="approval_date"
                        wire:model.defer="approval_date" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-filepond accept-files="application/pdf" label="Upload WUC Approval document"
                        name="approval_document" wire:model.defer="approval_document" />
                    <x-filepond optional accept-files="application/pdf" label="Upload Constitution document"
                        name="constitution_document" wire:model.defer="constitution_document" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-input optional label="Bank Name" name="bank_name" wire:model.defer="bank_name" />
                    <x-input optional label="Bank Account Number" name="account_number" wire:model.defer="account_number" />
                    <x-input optional label="IFS Code" name="ifsc" wire:model.defer="ifsc" />

                    <x-input-number 
                        input-mode="numeric" 
                        label="No. of FHTC"
                        name="fhtc" 
                        wire:model="fhtc" 
                    />

                    <x-input-number 
                        input-mode="numeric" 
                        label="No. of Household"
                        name="household" 
                        wire:model="household" 
                    />

                    <x-input-number 
                        readonly
                        input-mode="numeric" 
                        label="Difference"
                        name="difference" 
                        wire:model.defer="difference" 
                    />

                    <x-input-number 
                        input-mode="numeric" 
                        label="Tariff (Per Household)"
                        name="tariff_per_hh" 
                        wire:model.defer="tariff_per_hh" 
                    />

                </div>



                {{-- <x-textarea-simple optional label="Remarks" name="remarks" wire:model.defer="remarks" /> --}}

                <x-slot name="footer" class="text-right">
                    <x-button with-spinner wire:target="save,document">Save</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>
