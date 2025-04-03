<div>
    <x-slot name="title">Add New Stock</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('stocks') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Add New Stock
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Stock Details</x-slot>
                <x-slot name="description">Add the necessary details of the item stock.</x-slot>
                
                <x-input label="Item Name" name="itemName" wire:model.defer="itemName" disabled />
                   
                <x-select label="Select Lab" name="lab" wire:model.defer="lab">
                    <option value="">--Select a lab--</option>
                    @foreach($this->labs as $labKey => $labValue)
                        <option value="{{ $labKey }}">{{ $labValue }}</option>
                    @endforeach
                </x-select>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input 
                        type="date"
                        label="Manufacturing/Calibration Date" 
                        name="manufacturingDate" 
                        wire:model.defer="manufacturingDate" 
                    />
    
                    <x-input 
                        type="date"
                        label="Expiry Date" 
                        name="expiryDate" 
                        wire:model.defer="expiryDate" 
                        hint="Not required for Apparatus Category"
                    />

                    <x-input-number
                        label="Quantity" 
                        name="quantity" 
                        wire:model.defer="quantity" 
                    />

                    <x-input-number
                        label="Minimum Quantity Alert" 
                        name="minimumQtyAlert" 
                        wire:model.defer="minimumQtyAlert" 
                    />
                </div>

                <x-filepond 
                    optional
                    label="Receipt"
                    name="receipt"
                    wire:model="receipt"
                />
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>
    
                <x-button
                    with-spinner
                    wire:target="save"
                >Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>