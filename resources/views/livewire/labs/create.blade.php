<div>
    <x-slot name="title">New Labs</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('labs') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                New Labs
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-select label="Office/Circle" name="office" wire:model.defer="office">
                        <option value="">--Select an office--</option>
                        @foreach ($this->offices as $officeKey => $officeName)
                            <option value="{{ $officeKey }}">{{ $officeName }}</option>
                        @endforeach
                    </x-select>

                    <x-input label="Lab Name" name="labName" wire:model.defer="labName" />
                    <x-input label="Contact Person" name="contactPerson" wire:model.defer="contactPerson" />
                    <x-input-number label="Phone Number" name="phone" wire:model.defer="phone" />
                </div>

                <div>
                    <x-filepond label="Lab Image" name="labImage" wire:model="labImage" optional />

                    <x-filepond label="Upload NABL Certification" name="document" wire:model.defer="document"
                        hint="Maximum file size: 2 MB. Allowed file type: PDF" accept-files="application/pdf" optional />

                    <x-input type="date" label="NABL Certification Expiry Date" name="expiryDate" wire:model.defer="expiryDate" optional />

                    <x-radio-pill label="NABL Certification" name="nablCertification" wire:model="nablCertification"
                        default-value="yes" :options="[
                            [
                                'label' => 'Yes',
                                'value' => 'yes',
                            ],
                            [
                                'label' => 'No',
                                'value' => 'no',
                            ],
                        ]" />
                </div>
            </div>

            <x-slot name="footer" class="text-right">
                <x-button type="submit" with-spinner wire:target="save,image">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
