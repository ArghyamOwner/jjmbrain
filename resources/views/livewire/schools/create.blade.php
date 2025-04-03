<div>
    <x-slot name="title">Create New School</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schools') }}">Back to schools</x-text-link>
            </x-slot>

            <x-slot:title>
                Create new school
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">School Details</x-slot>
                <x-slot name="description">Basic details of the school.</x-slot>
            
                <x-input label="School Name" name="name" wire:model.defer="name" />
            
                <x-radio-pill 
                    label="School Geographic Location" 
                    name="schoolType" 
                    wire:model.defer="schoolType"
                    :default-value="$schoolType"
                    :options="[
                        ['label' => 'Urban', 'value' => 'urban'],
                        ['label' => 'Rural', 'value' => 'rural'],
                    ]" 
                />
            
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    {{-- <x-select label="Board" name="board" wire:model.defer="board">
                        <option value="">--Select Board--</option>
                        @foreach($this->affiliatedBoards as $affiliatedBoard)
                            <option value="{{ $affiliatedBoard->value }}">{{ $affiliatedBoard->name }}</option>
                        @endforeach
                    </x-select> --}}
                    <x-select label="School category" name="category" wire:model.defer="category">
                        <option value="">--Select Category--</option>
                        @foreach($this->schoolCategories as $schoolCategory)
                            <option value="{{ $schoolCategory->value }}">{{ $schoolCategory->name }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="School Management Type" name="managementType" wire:model.defer="managementType">
                        <option value="">--Select Management Type--</option>
                        @foreach($this->schoolManagementTypes as $schoolManagementType)
                            <option value="{{ $schoolManagementType->value }}">{{ $schoolManagementType->name }}</option>
                        @endforeach
                    </x-select>
                </div>

                <x-radio-pill 
                    class="!grid-cols-3"
                    label="School Operation Type" 
                    name="schoolOperationType" 
                    wire:model.defer="schoolOperationType"
                    :default-value="$schoolOperationType"
                    :options="[
                        ['label' => 'Self-Funded', 'value' => 'self-funded'],
                        ['label' => 'Government Funded', 'value' => 'government-funded'],
                    ]" 
                />

                <x-input
                    label="School UIN Code" 
                    name="uin_code" 
                    wire:model.defer="uin_code" 
                    hint="Enter a unique code of a school"
                />

                <x-input 
                    optional
                    label="Cluster No." 
                    name="clusterNo" 
                    wire:model.defer="clusterNo" 
                />
            </x-card-form>

            <x-section-border />

            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">School Address</x-slot>
                <x-slot name="description">Address of the school.</x-slot>
            
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-select label="District" name="district" wire:model="district">
                        <option value="">--Select District--</option>
                        @foreach($this->districts as $districtKey => $districtValue)
                            <option value="{{ $districtKey }}">{{ $districtValue }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Block" name="block" wire:model.defer="block">
                        <option value="">--Select Block--</option>
                        @foreach($this->blocks as $blockKey => $blockValue)
                            <option value="{{ $blockKey }}">{{ $blockValue }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input type="url" label="Website" name="website" wire:model.defer="website" />
                    <x-input label="Phone" name="phone" wire:model.defer="phone" />
                </div>
                <x-input type="email" label="Email" name="email" wire:model.defer="email" />
                <x-input label="Street Address" name="streetAddress" wire:model.defer="streetAddress" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <x-input label="City" name="city" wire:model.defer="city" />
                    <x-input label="Village" name="village" wire:model.defer="village" />
                    <x-input-number maxlength="6" minlength="6" label="Postal Code" name="postalCode" wire:model.defer="postalCode" />
                </div>
            </x-card-form>

            <x-section-border />
 
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Additional Information</x-slot>
                <x-slot name="description">Some extra information of the school.</x-slot>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <x-input-number label="Total Land Area (in sq. m.)" name="totalLandArea" wire:model.defer="totalLandArea" />
                    <x-input-number label="Student Capacity" name="studentCapacity" wire:model.defer="studentCapacity" />
                    <x-input-number label="Total Toilets" name="totalToilets" wire:model.defer="totalToilets" />
                    <x-input-number label="Total Functional Toilets" name="functionalToilets" wire:model.defer="functionalToilets" />
                </div>
            </x-card-form>

            <x-section-border />
 
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Available Classes</x-slot>
                <x-slot name="description">No. of classes available for a school.</x-slot>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <x-select label="From" name="from" wire:model.defer="from">
                        <option value="">--Select class from --</option>
                        @foreach($this->classes as $classKey => $classValue)
                            <option value="{{ $classKey }}">{{ $classValue }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="To" name="to" wire:model.defer="to">
                        <option value="">--Select class to --</option>
                        @foreach($this->classes as $classKey => $classValue)
                            <option value="{{ $classKey }}">{{ $classValue }}</option>
                        @endforeach
                    </x-select>
                </div>
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>