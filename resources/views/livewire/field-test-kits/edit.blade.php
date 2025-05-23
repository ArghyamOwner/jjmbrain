<div>
    <x-slot name="title">Edit FTK</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('fieldtestkits') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit FTK
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="update">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
                <x-select label="Division" name="divisionId" wire:model="divisionId">
                    <option value="">--Select a Division--</option>
                    @foreach ($this->divisions as $divisionKey => $divisionName)
                        <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                    @endforeach
                </x-select>

                <x-select label="District" name="districtId" wire:model="districtId">
                    <option value="">--Select a district--</option>
                    @foreach ($this->districts as $districtKey => $districtValue)
                        <option value="{{ $districtKey }}">{{ $districtValue }}</option>
                    @endforeach
                </x-select>

                <x-select label="Block" name="blockId" wire:model="blockId">
                    <option value="">--Select a block--</option>
                    @foreach ($blocks as $blockKey => $blockValue)
                        <option value="{{ $blockKey }}">{{ $blockValue }}</option>
                    @endforeach
                </x-select>

                <x-select label="Gaon Panchayat" name="gramPanchayatId" wire:model="gramPanchayatId">
                    <option value="">--Select a Gaon Panchayat--</option>
                    @foreach ($panchayats as $panchayatKey => $panchayatValue)
                        <option value="{{ $panchayatKey }}">{{ $panchayatValue }}</option>
                    @endforeach
                </x-select>

                <x-select label="Village" name="villageId" wire:model="villageId">
                    <option value="">--Select a Village--</option>
                    @foreach ($villages as $villageKey => $villageValue)
                        <option value="{{ $villageKey }}">{{ $villageValue }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-input label="Assigned Person Name" name="assignedPersonName" wire:model.defer="assignedPersonName" />

                <x-input label="Assigned Person Phone Number" name="assignedPersonPhone"
                    wire:model.defer="assignedPersonPhone" />

                <x-select label="Brand Name" name="brandName" wire:model.defer="brandName">
                    <option value="">--Select a brand--</option>
                    @foreach ($this->brands as $brandObject)
                        <option value="{{ $brandObject->value }}">{{ $brandObject->name }}</option>
                    @endforeach
                </x-select>

                <x-input type="date" label="Issue Date" name="issueDate" wire:model.defer="issueDate" />
            </div>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="update">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
