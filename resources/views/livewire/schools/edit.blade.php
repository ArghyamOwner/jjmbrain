<div>
    <x-slot name="title">Edit School</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schools') }}">Back to schools</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit School
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
                    <x-select label="Board" name="board" wire:model.defer="board">
                        <option value="">--Select Board--</option>
                        @foreach($this->affiliatedBoards as $affiliatedBoard)
                            <option value="{{ $affiliatedBoard->value }}">{{ $affiliatedBoard->name }}</option>
                        @endforeach
                    </x-select>
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
                    optional
                    label="Cluster No." 
                    name="clusterNo" 
                    wire:model.defer="clusterNo" 
                />
            </x-card-form>
 
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>

        <x-section-border />

        <livewire:schools.edit-address :school-id="$schoolId" />

        <x-section-border />

        <livewire:schools.edit-extra-details :school-id="$schoolId" />

        <x-section-border />

        <livewire:schools.amenities :school-id="$schoolId" />
    </x-section-centered>
</div>