<div>
    <x-slot name="title">Create Contractor</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('contractors') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create Contractor
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Contractor Details</x-slot>
                <x-slot name="description">Add the necessary details.</x-slot>

                <x-input 
                    label="Entity / Organization Name" 
                    name="entity_name" 
                    wire:model.defer="entity_name" 
                />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-select label="Business Type" name="business_type" wire:model.defer="business_type">
                        <option value="">--Select a business type--</option>
                        @foreach($this->entityTypes as $entityType)
                            <option value="{{ $entityType->value }}">{{ $entityType->name }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Contractor Type" name="contractor_type" wire:model.defer="contractor_type">
                        <option value="">--Select a contractor type--</option>
                        @foreach($this->contractorTypes as $contractor)
                            <option value="{{ $contractor->value }}">{{ $contractor->name }}</option>
                        @endforeach
                    </x-select>
                </div>

                <x-input 
                    label="Owner / Contact Person Name" 
                    name="name" 
                    wire:model.defer="name" 
                />

                <x-input 
                    label="Email" 
                    type="email" 
                    name="email" 
                    wire:model.defer="email" 
                />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input
                        maxlength="15" 
                        minlength="15"
                        label="GST Number" 
                        name="gst"
                        wire:model.defer="gst"
                        class="uppercase"
                    />

                    <x-input
                        maxlength="10" 
                        minlength="10"
                        label="PAN Number" 
                        name="pan" 
                        wire:model.defer="pan"
                        class="uppercase"
                    />

                    <x-input-number 
                        maxlength="10" 
                        minlength="10" 
                        input-mode="numeric" 
                        label="Phone"
                        name="phone" 
                        wire:model.defer="phone" 
                        placeholder="eg. 7896XXXXXX" 
                    />

                    <x-input-number
                        maxlength="9" 
                        input-mode="numeric" 
                        label="Bid Id" 
                        name="bid_no"
                        wire:model.defer="bid_no"
                        class="uppercase"
                    />

                    {{-- <x-input 
                        optional
                        label="Registration Number" 
                        name="registration_number" 
                        wire:model.defer="registration_number" 
                    /> --}}
 
                    <div class="col-span-2">
                        <x-textarea
                            rows="2"
                            label="Address" 
                            name="address"
                            wire:model.defer="address"
                        />
                    </div>
                </div>
            </x-card-form>

            <x-section-border />

            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Bank Details</x-slot>
                <x-slot name="description">Details of the bank account.</x-slot>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input 
                        label="Bank Name" 
                        name="bank_name" 
                        wire:model.defer="bank_name" 
                    />

                    <x-input 
                        label="Branch Name" 
                        name="branch_name" 
                        wire:model.defer="branch_name" 
                    />

                    <x-input 
                        label="Account Number" 
                        name="account_number" 
                        wire:model.defer="account_number" 
                    />

                    <x-input 
                        label="IFSC Code"
                        name="ifsc_code" 
                        wire:model.defer="ifsc_code" 
                    />
                </div>
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
