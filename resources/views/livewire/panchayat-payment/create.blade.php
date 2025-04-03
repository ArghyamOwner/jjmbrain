<div>
    <x-slot name="title">Create Panchayat Payment</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', [$schemeId, 'tab' => 'details']) }}">Go Back to scheme details</x-text-link>
            </x-slot>
            <x-slot:title>Create Panchayat Payment</x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden>

            <x-card-form :with-shadow="false" no-padding>

                <x-slot name="title">Create a new payment</x-slot>
                <x-slot name="description"></x-slot>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <x-select label="Panchayat" name="panchayat_id" wire:model.defer="panchayat_id">
                        <option value="">--Select Panchayat--</option>
                        @foreach ($panchayatOptions as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="WUC" name="wuc_id" wire:model.defer="wuc_id">
                        <option value="">--Select WUC--</option>
                        @foreach ($wucOptions as $wucKey => $wucValue)
                        <option value="{{ $wucKey }}">{{ $wucValue }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Amount For" name="amount_for" wire:model.defer="amount_for">
                        <option value="">--Select Payment For--</option>
                        @foreach ($this->panchayatPaymentTypes as $type)
                        <option value="{{ $type->value }}">{{ $type->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input type="date" max="{{ $currentDate }}" label="Payment for Month" name="payment_date" wire:model.defer="payment_date" />

                    {{-- <x-input type="date" label="WUC Ack. Date" name="wuc_ack" wire:model.defer="wuc_ack" /> --}}
                </div>

                <x-money label="Amount Paid (in Rs.)" name="amountPaid" wire:model.defer="amountPaid" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- <x-select label="Amount For" name="amount_for" wire:model.defer="amount_for">
                        <option value="">--Select Payment For--</option>
                        @foreach ($this->panchayatPaymentTypes as $type)
                        <option value="{{ $type->value }}">{{ $type->name }}</option>
                        @endforeach
                    </x-select> --}}
                <x-input type="date" max="{{ $currentDate }}" label="Date of Payment" name="payment_made_on" wire:model.defer="payment_made_on" />
                <x-input label="Transaction ID" name="transaction_id" wire:model.defer="transaction_id" />
                </div>

                {{-- <x-input label="Created By" name="created_by" hint="Name & Phone No." wire:model.defer="created_by" /> --}}
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button
                    type="button" 
                    wire:click="save"
                    onclick="confirm('Are you sure you want to submit the data?') || event.stopImmediatePropagation()" 
                    with-spinner wire:target="save,beneficiaryPhoto">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>

