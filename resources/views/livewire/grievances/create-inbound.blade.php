<div>
    <x-slot name="title">Inbound Calls</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('grievanceDashboard') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Inbound Calls
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>

            <div class="grid grid-cols-2 gap-5">

                <x-card overflow-hidden form-action="save">

                    <x-select label="Is this issue related to?" name="hasIssue" wire:model="hasIssue">
                        <option value="">-- Select--</option>
                        <option value="scheme">Scheme</option>
                        <option value="office">Office</option>
                    </x-select>

                    <x-select label="Division" name="divisionId" wire:model="divisionId">
                        <option value="">-- Select Division --</option>
                        @foreach ($divisions as $divisionKey => $divisionValue)
                            <option value="{{ $divisionKey }}">{{ $divisionValue }}</option>
                        @endforeach
                    </x-select>

                    @if ($showHasSchemeFields)
                        <x-select label="{{ __('Select District') }}" name="districtId" wire:model="districtId">
                            <option value="">--Select a district--</option>
                            @foreach ($this->districts as $districtKey => $districtValue)
                                <option value="{{ $districtKey }}">{{ $districtValue }}</option>
                            @endforeach
                        </x-select>

                        <x-select label="{{ __('Select Block') }}" name="blockId" wire:model="blockId">
                            <option value="">--Select a block--</option>
                            @foreach ($blocks as $blockKey => $blockValue)
                                <option value="{{ $blockKey }}">{{ $blockValue }}</option>
                            @endforeach
                        </x-select>

                        <x-select label="{{ __('Gaon Panchayat') }}" name="gramPanchayatId"
                            wire:model="gramPanchayatId">
                            <option value="">--Select a Gram Panchayat--</option>
                            @foreach ($panchayats as $panchayatKey => $panchayatValue)
                                <option value="{{ $panchayatKey }}">{{ $panchayatValue }}</option>
                            @endforeach
                        </x-select>

                        <x-select label="{{ __('Village') }}" name="villageId" wire:model="villageId">
                            <option value="">--Select a Village--</option>
                            @foreach ($villages as $villageKey => $villageValue)
                                <option value="{{ $villageKey }}">{{ $villageValue }}</option>
                            @endforeach
                        </x-select>

                        <x-select label="Scheme" name="schemeId" wire:model="schemeId">
                            <option value="">-- Select Scheme --</option>
                            @foreach ($schemes as $schemeKey => $schemeValue)
                                <option value="{{ $schemeKey }}">{{ $schemeValue }}</option>
                            @endforeach
                        </x-select>

                        <x-radio-pill label="Is this issue related to a particular Beneficiary ?" name="hasBeneficiary"
                            wire:model="hasBeneficiary" :default-value="$beneficiary" class="md:grid-cols-6" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        @if ($showHasBeneficiaryFields)
                            <x-select label="Select Beneficiary" name="beneficiaryId" wire:model="beneficiaryId">
                                <option value="">-- Select Beneficiary --</option>
                                @foreach ($beneficiaries as $beneficiaryKey => $beneficiaryValue)
                                    <option value="{{ $beneficiaryKey }}">{{ $beneficiaryValue }}</option>
                                @endforeach
                            </x-select>
                        @endif
                    @endif

                    @if ($showCitizenFields)
                        <x-input label="Citizen Name" name="citizenName" wire:model.defer="citizenName" />

                        <x-input-number label="Citizen Phone" maxlength="10" minlength="10" input-mode="numeric"
                            name="citizenPhone" wire:model.defer="citizenPhone" />
                    @endif

                    {{-- <x-select label="Issue" name="issueId" wire:model="issueId">
                        <option value="">-- Select Issue --</option>
                        @foreach ($this->issues as $issueKey => $issueValue)
                        <option value="{{ $issueKey }}">{{ $issueValue }}</option>
                        @endforeach
                    </x-select> --}}

                    @if ($showHasSchemeFields)
                    <x-select label="Select category" name="categoryId" wire:model="categoryId">
                        <option value="">-- Select category --</option>
                        @foreach ($this->categories as $categoryKey => $categoryValue)
                            <option value="{{ $categoryKey }}">{{ __($categoryValue) }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Select sub category" name="subCategoryId" wire:model="subCategoryId">
                        <option value="">--Select a sub-category--</option>
                        @foreach ($subCategories as $subcategorykKey => $subcategorykValue)
                            <option value="{{ $subcategorykKey }}">{{ $subcategorykValue }}</option>
                        @endforeach
                    </x-select>
                    @endif

                    <x-select label="Priority" name="priority" wire:model="priority">
                        <option value="">-- Select Grievance Priority --</option>
                        @foreach ($priorityOptions as $priorityKey => $priorityValue)
                            <option value="{{ $priorityKey }}">{{ $priorityValue }}</option>
                        @endforeach
                    </x-select>

                    <div class="col-span-3">
                        <x-textarea-simple label="Description" name="description" wire:model.defer="description"
                            optional />
                    </div>

                    <x-slot name="footer" class="text-right">
                        <x-button with-spinner wire:target="save">Submit</x-button>
                    </x-slot>
                </x-card>
            </div>
        </x-section-centered>
</div>
