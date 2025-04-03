<div>
    <x-slot name="title">Add Performance Guarantee</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('pg.dashboard') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Add Performance Guarantee
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card overflow-hidden form-action="save">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-select label="Select Type" name="pgType" wire:model.defer="pgType">
                        <option value="">--Select a type--</option>
                        @foreach($this->pgTypes as $performanceType)
                        <option value="{{ $performanceType->value }}">
                            {{ $performanceType->name.' ('.$performanceType->value .' )' }}
                        </option>
                        @endforeach
                    </x-select>

                    <x-virtual-select label="Contractor Name / BID Nos" name="contractor_id" wire:model="contractor_id"
                        :options="[
                        'options' => $this->contractors
                    ]" custom-label />


                    {{--
                    <x-input label="Contractor Name and Bid No" optional name="contractor_name"
                        wire:model.defer="contractor_name" /> --}}

                </div>
                <x-virtual-select label="Workorders" name="workorder_ids" wire:model="workorder_ids" :options="[
                        'options' => $this->contractorWos,
                        'multiple' => true,
                    'showValueAsTags' => true,
                    ]" />

                {{--
                <x-input label="Pledged infavour of" name="pledgedInfavourOf" wire:model.defer="pledgedInfavourOf" />
                --}}
                <x-virtual-select label="Pledged In Favour Of" name="pledgedInfavourOf" wire:model="pledgedInfavourOf"
                    :options="[
                    'options' => $this->pledgedInfavourOfOptions,
                ]" />
                <x-input label="Performance Guarantee Reference Number" name="pgNumber" wire:model.defer="pgNumber" />
                <x-money label="Amount (in Rs.) {{ $this->amountLabel }}" name="pgAmount" wire:model.defer="pgAmount" />

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{--
                    <x-input-money label="Amount (in Rs.)" name="pgAmount" wire:model.defer="pgAmount" /> --}}
                    <x-input type="date" label="PG Issue Date" name="pgDate" wire:model.defer="pgDate" />
                    <x-input type="date" label="PG Expiry Date" name="pgExpiryDate" wire:model.defer="pgExpiryDate" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-select label="Select Bank" name="bankName" wire:model.defer="bankName">
                        <option value="">---Select a bank---</option>
                        @foreach($this->banks as $bankKey => $bankValue)
                        <option value="{{ $bankValue }}">{{ $bankValue }}</option>
                        @endforeach
                    </x-select>
                    {{--
                    <x-input label="Bank Name" name="bankName" wire:model.defer="bankName" /> --}}
                    <x-input label="Bank Branch" name="bankBranch" wire:model.defer="bankBranch" />
                </div>
                {{--
                <x-input label="Account Number" name="account_no" wire:model.defer="account_no" /> --}}

                <x-filepond accept-files="application/pdf" label="Upload BG Scanned Copy"
                    hint="File : PDF | Max Size : 2 MB" name="pgBankCopyDocument" wire:model.defer="pgBankCopyDocument"
                    labelIdle="Please Upload (Drag & Drop) physical Performance Guarantee Document or <span class='filepond--label-action text-indigo-600 !decoration-indigo-400'>Browse</span>" />

                <x-slot name="footer" class="text-right">
                    <x-button with-spinner wire:target="save,document">Save</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>