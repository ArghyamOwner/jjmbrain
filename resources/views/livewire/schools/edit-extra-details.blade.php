<div>
    <x-card overflow-hidden form-action="save">
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

        <x-slot name="footer" class="text-right">
            <x-button with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-card>
</div>
