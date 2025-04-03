<div>
    <x-slot name="title">New ISA</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('isa') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        New ISA
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card form-action="save">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">ISA Details</x-slot>
                    <x-slot name="description">Add the necessary details of the ISA.</x-slot>

                    <x-input label="ISA Name" name="name" wire:model.defer="name" />

                    <x-radio-pill class="!grid-cols-3" label="Type" name="type" wire:model="type" default-value="NGO"
                        :options="[
                            [
                                'label' => 'NGO',
                                'value' => 'NGO',
                            ],
                            [
                                'label' => 'CLF',
                                'value' => 'CLF',
                            ],
                        ]" />

                    <x-input label="Contact Name" name="contact_name" wire:model.defer="contact_name" />

                    <x-input-number maxlength="10" minlength="10" input-mode="numeric" label="Phone"
                        name="contact_phone" wire:model.defer="contact_phone" placeholder="eg. 7896XXXXXX" />

                </x-card-form>

                <x-section-border />

                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">ISA Administrative Details</x-slot>
                    <x-slot name="description">Add the necessary details like district, block, villages...</x-slot>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">

                        <x-select label="District" name="district" wire:model="district">
                            <option value="">--Select a district--</option>
                            @foreach ($this->districts as $districtKey => $districtName)
                                <option value="{{ $districtKey }}">{{ $districtName }}</option>
                            @endforeach
                        </x-select>

                        <x-select label="Block" name="block" wire:model="block">
                            <option value="">--Select a block--</option>
                            @foreach ($blocks as $blockKey => $blockName)
                                <option value="{{ $blockKey }}">{{ $blockName }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="mb-8">
                        <x-label class="mb-2">Select Panchayat(s)</x-label>
                        @if ($panchayats)
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                                @foreach ($panchayats as $panchayatOption)
                                    <div wire:key="panchayat-{{ $panchayatOption['value'] }}">
                                        <x-checkbox no-margin
                                            name="panchayat-{{ Str::slug($panchayatOption['label']) }}"
                                            wire:model="panchayat" value="{{ $panchayatOption['value'] }}"
                                            label="{{ $panchayatOption['label'] }}" />
                                    </div>
                                @endforeach
                            </div>

                            <x-input-error for="panchayat" class="mt-2" />
                        @else
                            <p class="text-slate-500 text-sm">Please select Block first.</p>
                        @endif
                    </div>

                    <div class="mb-8">
                        <x-label class="mb-2">Select Village(s)</x-label>
                        @if ($villageOptions)
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                                @foreach ($villageOptions as $villageOption)
                                    <div wire:key="village-{{ $villageOption['value'] }}">
                                        <x-checkbox no-margin name="village-{{ Str::slug($villageOption['label']) }}"
                                            wire:model.defer="village" value="{{ $villageOption['value'] }}"
                                            label="{{ $villageOption['label'] }}" />
                                    </div>
                                @endforeach
                            </div>

                            <x-input-error for="village" class="mt-2" />
                        @else
                            <p class="text-slate-500 text-sm">Please select Panchayat first.</p>
                        @endif
                    </div>

                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="save">Save</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>
