<div>
    <x-slot name="title">Create Asset</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('assets') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create a new asset
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-x-6">
                <x-select label="Circle" name="circle" wire:model.defer="circle">
                    <option value="">--Select a circle--</option>
                    @foreach($this->offices as $officeKey => $officeName)
                        <option value="{{ $officeKey }}">{{ $officeName }}</option>
                    @endforeach
                </x-select>

                <x-select label="Office" name="newOffice" wire:model.defer="newOffice">
                    <option value="">--Select an Office--</option>
                    @foreach($this->newOffices as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-select>

                {{-- <x-select label="Type" name="asset_type" wire:model.defer="asset_type">
                    <option value="">--Select a type--</option>
                    @foreach($this->assetTypes as $assetTypeObject)
                        <option value="{{ $assetTypeObject->value }}">{{ $assetTypeObject->name }}</option>
                    @endforeach
                </x-select> --}}

                {{-- <x-select label="Category" name="asset_category" wire:model.defer="asset_category">
                    <option value="">--Select a category--</option>
                    @foreach($this->assetCategories as $assetCategoryObject)
                        <option value="{{ $assetCategoryObject->value }}">{{ $assetCategoryObject->name }}</option>
                    @endforeach
                </x-select> --}}

                <x-select label="Category" name="asset_category" wire:model.defer="asset_category">
                    <option value="">--Select a category--</option>
                    @foreach($this->assetCategories as $key => $assetCategoryObject)
                        <option value="{{ $key }}">{{ $assetCategoryObject }}</option>
                    @endforeach
                </x-select>


                <x-select label="Financial Year" name="financial_year" wire:model.defer="financial_year">
                    <option value="">--Select a financial year--</option>
                    @foreach($this->financialYears as $financialYear)
                        <option value="{{ $financialYear->id }}">{{ $financialYear->financialYear }}</option>
                    @endforeach
                </x-select>
            </div>

            <x-input label="Item Name" name="item_name" wire:model.defer="item_name" />

            <x-filepond optional label="Asset Image" name="image" wire:model.defer="image" hint="Only JPG/PNG image allowed." />
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
                {{-- <x-input label="Asset UIN" name="asset_uin" wire:model.defer="asset_uin" /> --}}
                <x-input optional label="Serial Number" name="serial_number" wire:model.defer="serial_number" />
                <x-input optional label="Allocated To" placeholder="Name and Phone No." name="allocated_to" wire:model.defer="allocated_to" />
                <x-input optional type="date" label="Allocated On" name="allocated_on" wire:model.defer="allocated_on" />
            </div>
 
            <x-input optional label="Specification" name="specification" wire:model.defer="specification" />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
                <x-input optional label="Manufacturer" name="manufacturer" wire:model.defer="manufacturer" />
                <x-input optional label="Installed By" name="installed_by" wire:model.defer="installed_by" />
                <x-input type="date" optional label="Commissioned Date" name="commissioned_date" wire:model.defer="commissioned_date" />
                <x-input optional label="Warranty Period" name="warranty_period" wire:model.defer="warranty_period" />
                <x-input type="date" optional label="Warranty Valid Upto" name="warranty_valid_upto" wire:model.defer="warranty_valid_upto" />
                <x-input optional label="Service Provided By" name="service_provided_by" wire:model.defer="service_provided_by" />
                <x-input optional label="Service Cycle" name="service_cycle" wire:model.defer="service_cycle" />
            </div>
            
            <x-textarea-simple optional label="Remarks" name="remarks" wire:model.defer="remarks" />
          
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,document">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>