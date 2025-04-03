<div>
    <x-slot name="title">Edit WUC</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('wucs.show', $wuc->id) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Update WUC Details
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="update"> 
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-select label="Bank Name" name="bank_name" wire:model.defer="bank_name">
                    <option value="">--Select an option--</option>
                    @foreach($this->banks as $banks)
                        <option value="{{ $banks }}">{{ $banks }}</option>
                    @endforeach
                </x-select>
                <x-input label="Bank Account Number" name="account_number" wire:model.defer="account_number" />
                <x-input label="IFS Code" name="ifsc" wire:model.defer="ifsc" />
            </div>
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="update">Update</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>