<div>
    <x-slot name="title">Add Trainer</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('trainers.index') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Add Trainer
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">

                <x-select label="Type of trainer" name="trainerType" wire:model="trainerType">
                    <option value="">--Select a type--</option>
                    @foreach ($this->trainerTypes as $trainerTypeKey => $trainerTypeName)
                        <option value="{{ $trainerTypeKey }}">{{ $trainerTypeName }}</option>
                    @endforeach
                </x-select>


                <x-select label="District" name="district" wire:model="district">
                    <option value="">--Select a district--</option>
                    @foreach ($this->districts as $districtKey => $districtName)
                        <option value="{{ $districtKey }}">{{ $districtName }}</option>
                    @endforeach
                </x-select>

                @if ($trainerType === 'block_trainer')
                    <x-select label="Education Block" name="education_block_id" wire:model.defer="education_block_id">
                        <option value="">--Select an Education block--</option>
                        @foreach ($educationBlocks as $eduBlockKey => $eduBlockName)
                            <option value="{{ $eduBlockKey }}">{{ $eduBlockName }}</option>
                        @endforeach
                    </x-select>
                @endif


                <x-select label="Organisation" name="organisation" wire:model.defer="organisation">
                    <option value="">--Select an organisation--</option>
                    @foreach ($this->organisations as $organisationObject)
                        <option value="{{ $organisationObject->value }}">{{ $organisationObject->name }}</option>
                    @endforeach
                </x-select>

                <div class="col-span-2">
                    <x-input label="Name of Trainer" name="trainer_name" wire:model.defer="trainer_name" />
                </div>

                <x-input-number label="Phone Number" name="phone_number" wire:model.defer="phone_number" />

                <x-input label="Bank Name" name="bank_name" wire:model.defer="bank_name" />
                <x-input label="Account Number" name="account_number" wire:model.defer="account_number" />
                <x-input label="IFSC Code" name="ifsc_code" wire:model.defer="ifsc_code" />

                <div class="col-span-2">
                    <x-filepond-image label="Upload Bank Document" name="bank_document" wire:model.defer="bank_document"
                        hint="Bank Passbook or Cancelled Cheque | Max Size : 2 MB" maxFileSize="2MB" />
                </div>
            </div>

            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>

                <x-button with-spinner wire:target="save,bank_document">Save</x-button>
            </x-slot>
        </x-card>

    </x-section-centered>
</div>
