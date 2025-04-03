<div>
    <x-button tag="a" class="w-full" href="#" color="white" with-icon icon="add" x-data="{}"
        x-on:click.prevent="$dispatch('show-modal', 'question-create-form')" x-cloak>
        Volunteer
    </x-button>

    <x-modal-simple max-width="2xl" name="question-create-form" form-action="save">
        <x-slot name="title">Add Volunteer / Caretaker Details</x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <x-input label="Name of Volunteer / Caretaker" name="name" wire:model.defer="name" />

            {{-- <x-input label="Email" type="email" name="email" wire:model.defer="email" /> --}}

            <x-input-number maxlength="10" minlength="10" input-mode="numeric" label="Phone" name="phone"
                wire:model.defer="phone" placeholder="eg. 7896XXXXXX" />

            <x-input label="Nature of Engagement" name="nature" wire:model.defer="nature" />

            <x-select label="Whether Trained ?" name="is_trained" wire:model="is_trained">
                <option value="">--Select Yes / No--</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </x-select>

            @if ($showTrainingFields)
                <x-input-number maxlength="10" input-mode="numeric" label="Total No. of Trainings"
                    name="no_of_trainings" wire:model.defer="no_of_trainings" />

                <x-input-number maxlength="10" input-mode="numeric" label="No. of Days of Training" name="training_days"
                    wire:model.defer="training_days" />
            @endif
        </div>

        @if ($showTrainingFields)
            <x-textarea-simple optional label="Training Description" name="training_description"
                wire:model.defer="training_description" />
        @endif

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>
