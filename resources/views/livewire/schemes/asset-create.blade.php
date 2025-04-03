<div>
    <x-slot name="title">Create Scheme Asset</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $schemeId) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create a new scheme asset
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
                {{-- <x-select label="Circle" name="circle" wire:model.defer="circle">
                    <option value="">--Select a circle--</option>
                    @foreach($this->offices as $officeKey => $officeName)
                    <option value="{{ $officeKey }}">{{ $officeName }}</option>
                    @endforeach
                </x-select> --}}

                <x-select label="Type" name="asset_type" wire:model="asset_type">
                    <option value="">--Select a type--</option>
                    @foreach($this->assetTypes as $assetTypeObject)
                    <option value="{{ $assetTypeObject->value }}">{{ $assetTypeObject->name }}</option>
                    @endforeach
                </x-select>

                <x-select label="Category" name="asset_category" wire:model="asset_category">
                    <option value="">--Select a category--</option>
                    @foreach($this->assetCategories as $key => $assetCategoryObject)
                    <option value="{{ $key }}">{{ $assetCategoryObject }}</option>
                    @endforeach
                </x-select>

                <x-select label="Item Name" name="item_name" wire:model="item_name">
                    <option value="">--Select Item--</option>
                    @foreach($this->itemOptions as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-select>
            </div>

            <x-filepond label="Asset Image" name="image" wire:model.defer="image"
                hint="Only JPG/PNG image allowed." />

            <x-section-border />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
                {{--
                <x-input label="Asset UIN" name="asset_uin" wire:model.defer="asset_uin" /> --}}

                <x-select label="Year of Installation" name="financial_year" wire:model.defer="financial_year">
                    <option value="">--Select Year of Installation--</option>
                    @foreach($this->financialYears as $financialYear)
                    <option value="{{ $financialYear->id }}">{{ $financialYear->financialYear }}</option>
                    @endforeach
                </x-select>

                @if($showCapacityField)
                <x-input-number input-mode="numeric" label="Capacity(in Litres)" name="capacity" wire:model.defer="capacity" />
                @endif

                <x-filepond optional label="Certificate" name="certificate_file" wire:model.defer="certificate_file"
                hint="Only PDF allowed." acceptFiles="application/pdf"
                 />

                @if($showCertificationField)
                <x-input optional label="Certificate(BIS & Installation)" name="certification" wire:model.defer="certification" />
                @endif

                @if($showAdditionalFieldOne)    
                <x-select label="{{ $labelAdditionalOne }}" name="additional_detail_one" wire:model.defer="additional_detail_one">
                    <option value="">--Select Option--</option>
                    @foreach($additionalOneOptions as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </x-select>
                @endif

                @if($showAdditionalFieldTwo)    
                <x-select label="{{ $labelAdditionalTwo }}" name="additional_detail_two" wire:model.defer="additional_detail_two">
                    <option value="">--Select Option--</option>
                    @foreach($additionalTwoOptions as $optionTwo)
                    <option value="{{ $optionTwo }}">{{ $optionTwo }}</option>
                    @endforeach
                </x-select>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
                @if($showSizeField)
                    <x-input-number input-mode="numeric" label="Length (in Metres)" name="length" wire:model.defer="length" />
                    <x-input-number input-mode="numeric" label="Breadth (in Metres)" name="breadth" wire:model.defer="breadth" />
                    <x-input-number input-mode="numeric" label="Height (in Metres)" name="height" wire:model.defer="height" />
                @endif
            </div>

            <x-section-border />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">

                <x-input optional label="Serial Number" name="serial_number" wire:model.defer="serial_number" />
                <x-input optional label="Allocated To" placeholder="Name and Phone No." name="allocated_to"
                    wire:model.defer="allocated_to" />
                <x-input optional type="date" label="Allocated On" name="allocated_on"
                    wire:model.defer="allocated_on" />
                    <div class="col-span-2">
                        <x-input optional label="Specification" name="specification" wire:model.defer="specification" />
                    </div>
                

                <x-input optional label="Manufacturer / Brand" name="manufacturer" wire:model.defer="manufacturer" />
                <x-input optional label="Installed By" name="installed_by" wire:model.defer="installed_by" />
                <x-input type="date" optional label="Commissioned Date" name="commissioned_date"
                    wire:model.defer="commissioned_date" />
                <x-input optional label="Warranty Certificate" name="warranty_period"
                    wire:model.defer="warranty_period" />
                <x-input type="date" optional label="Warranty Valid Upto" name="warranty_valid_upto"
                    wire:model.defer="warranty_valid_upto" />
                <x-input optional label="Service Provided By" name="service_provided_by"
                    wire:model.defer="service_provided_by" />
                <x-input optional label="Service Cycle" name="service_cycle" wire:model.defer="service_cycle" />
            </div>

            <x-textarea-simple optional label="Remarks" name="remarks" wire:model.defer="remarks" />

            @if($errors->all(':message'))
            <div>
                Errors : <br />
                <span class="text-red-500">
                    @foreach ($errors->all(':message') as $error)
                    &#8226; {{ $error }} <br />
                    @endforeach
                    {{-- {{ implode('', $errors->all(':message')) }} --}}
                </span>
            </div>
            @endif

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,document">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>