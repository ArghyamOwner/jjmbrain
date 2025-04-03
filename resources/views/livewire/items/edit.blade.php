<div>
    <x-slot name="title">Edit Item</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('items') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit Item
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Item Details</x-slot>
                <x-slot name="description">Update the necessary details of the item.</x-slot>
                
                <x-select label="Category" name="category" wire:model.defer="category">
                    <option value="">--Select category--</option>
                    @foreach($this->itemTypes as $itemType)
                        <option value="{{ $itemType->value }}">{{ $itemType->name }}</option>
                    @endforeach
                </x-select>
                
                <x-input 
                    label="Item Name" 
                    name="itemName" 
                    wire:model.defer="itemName" 
                />
    
                <x-input 
                    label="Item Code" 
                    name="itemCode" 
                    wire:model.defer="itemCode" 
                />
    
                <x-radio-pill
                    class="!grid-cols-3"
                    label="Item Type"
                    name="itemType"
                    wire:model="itemType"
                    default-value="Consumable"
                    :options="[
                        [
                            'label' => 'Consumable',
                            'value' => 'Consumable',
                        ],
                        [
                            'label' => 'Non-consumable',
                            'value' => 'Non-consumable',
                        ]
                    ]"
                />
    
                <x-textarea
                    rows="2"
                    optional 
                    label="Item Description" 
                    name="itemDescription" 
                    wire:model.defer="itemDescription" 
                />

                <x-filepond 
                    optional
                    label="Item Image"
                    name="itemImage"
                    wire:model="itemImage"
                />
    
                <x-input 
                    optional
                    label="Nature of use" 
                    name="natureOfUse" 
                    wire:model.defer="natureOfUse" 
                />
    
                <x-input 
                    optional
                    label="Hazard Level" 
                    name="hazardLevel" 
                    wire:model.defer="hazardLevel" 
                />

                <x-input 
                    optional
                    label="Unit" 
                    name="unit" 
                    wire:model.defer="unit" 
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