<div>
    <x-slot name="title">Stock Transfers</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('transfers') }}">Go back to transfers</x-text-link>
            </x-slot>

            <x-slot:title>
                Stock Transfers
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <div class="md:w-1/3">
                <x-input 
                    label="Item Name" 
                    name="sourceItemName" 
                    wire:model.defer="sourceItemName"
                    disabled 
                />

                <x-input 
                    label="Source Lab Name" 
                    name="sourceLabName" 
                    wire:model.defer="sourceLabName"
                    disabled 
                />

                <x-select label="Destination Lab Name" name="destinationLab" wire:model.defer="destinationLab">
                    <option value="">--Select a Lab--</option>
                    @foreach($this->labs as $lab)
                        <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                    @endforeach
                </x-select>

                <x-input-number 
                    label="Quantity" 
                    name="quantity" 
                    wire:model.defer="quantity" 
                    append-after="/{{ $sourceItemQuantity }}"
                />
            </div>
            
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Transfer Stock</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>