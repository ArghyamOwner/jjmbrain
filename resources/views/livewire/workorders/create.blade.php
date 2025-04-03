<div>
    <x-slot name="title">Create Workorder</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('workorders') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Create a new workorder
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card overflow-hidden form-action="save">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
                    {{-- <x-select label="Issuing Authority" name="issuingAuthority"
                        wire:model.defer="issuingAuthority">
                        <option value="">--Select an option--</option>
                        @foreach ($this->issuingAuthorities as $issuingAuthorityValue)
                        <option value="{{ $issuingAuthorityValue }}">{{ $issuingAuthorityValue }}</option>
                        @endforeach
                    </x-select> --}}

                    <x-virtual-select label="Issuing Authority" name="issuingAuthority" wire:model="issuingAuthority"
                        :options="[
                            'options' => $this->issuingAuthorities,
                        ]" />

                    <x-virtual-select label="Division" name="division_id" wire:model="division_id"
                        :options="[
                            'options' => $this->divisions,
                        ]" />

                    {{-- <x-select label="Office" name="office" wire:model.defer="office">
                        <option value="">--Select an office--</option>
                        @foreach ($this->offices as $officeKey => $officeName)
                        <option value="{{ $officeKey }}">{{ $officeName }}</option>
                        @endforeach
                    </x-select> --}}

                    <x-select label="Workorder Type" name="workorderType" wire:model.defer="workorderType">
                        <option value="">--Select a type--</option>
                        @foreach ($this->categories as $taskCategory)
                        <option value="{{ $taskCategory->value }}">{{ $taskCategory->name }}</option>
                        @endforeach
                    </x-select>



                    <x-virtual-select label="Contractor Name / BID Nos" name="contractor" wire:model="contractor"
                        :options="[
                            'options' => $this->contractorUsers,
                        ]" custom-label />

                    {{-- <div class="col-span-2">
                        <x-input label="Workorder Name" name="workorderName" wire:model.defer="workorderName" />
                    </div> --}}
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input label="Preliminary Workorder Number" name="workorderNumber"
                        wire:model.defer="workorderNumber" />

                    <x-input optional label="Workorder Number" name="formal_workorder_number"
                        wire:model.defer="formal_workorder_number" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-input type="date" label="Workorder Date" name="workorderDate" wire:model.defer="workorderDate" />

                    {{--
                    <x-input-money label="Workorder Amount (in Rs.)" name="workorderAmount"
                        wire:model.defer="workorderAmount" /> --}}

                    <x-money label="Workorder Amount (in Rs.)" name="workorderAmount"
                        wire:model.defer="workorderAmount" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-input optional label="AA Number" name="aaNumber" wire:model.defer="aaNumber" />
                    <x-input label="TS Number" name="tsNumber" wire:model.defer="tsNumber" />

                    {{--
                    <x-input label="Funding Agency Name" name="fundingAgency" wire:model.defer="fundingAgency" /> --}}
                </div>

                <x-filepond optional accept-files="application/pdf" label="Upload BG Scanned Copy"
                    hint="File : PDF | Max Size : 2 MB" name="document" wire:model.defer="document"
                    labelIdle="Please Upload (Drag & Drop) Physical Workorder Document or <span class='filepond--label-action text-indigo-600 !decoration-indigo-400'>Browse</span>" />

                {{--
                <x-filepond optional accept-files="application/pdf" label="Upload workorder document" name="document"
                    wire:model.defer="document" /> --}}

                <x-textarea-simple optional label="Remarks" name="remarks" wire:model.defer="remarks" />

                <x-slot name="footer" class="text-right">
                    <x-button with-spinner wire:target="save,document">Save</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>