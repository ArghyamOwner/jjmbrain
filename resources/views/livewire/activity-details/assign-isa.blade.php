<div>
    <x-slot name="title">Add ISA to Activity</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('activityDetails.show', $activity->id) }}">Go Back
                </x-text-link>
            </x-slot>

            <x-slot:title>
                Add ISA to Activity
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card card-classes="mb-8" form-action="assignIsa">

            <x-virtual-select 
                label="Select ISA(s)" 
                name="isas" 
                wire:model="isas" 
                :options="[
                    'options' => $isaOptions,
                    'multiple' => true,
                    'showValueAsTags' => true,
                ]" custom-label 
            />

            <x-slot name="footer" class="text-right">
                <x-button with-spinner>Assign ISA</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>