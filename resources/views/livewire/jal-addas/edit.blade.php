<div>
    <x-slot name="title">Edit Jal Adda</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jaladdas.index') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Edit Jal Adda
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card form-action="update">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input type="datetime-local" label="Select Date" name="dayOne" wire:model.defer="dayOne" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <x-select label="Trainer 1" name="trainerOne" wire:model="trainerOne" hint="Select trainer 1">
                        <option value="">--Select a trainer--</option>
                        @foreach ($this->trainers as $trainerValue => $trainerLabel)
                        <option value="{{ $trainerValue }}">{{ $trainerLabel }}</option>
                        @endforeach
                    </x-select>

                    <x-select optional label="Trainer 2" name="trainerTwo" wire:model="trainerTwo"
                        hint="Select trainer 2 if required">
                        <option value="">--Select a trainer--</option>
                        @foreach ($this->trainers as $trainerValue => $trainerLabel)
                        <option value="{{ $trainerValue }}">{{ $trainerLabel }}</option>
                        @endforeach
                    </x-select>
                </div>

                <x-textarea-simple label="Attendee" name="attendee" wire:model.defer="attendee"
                    hint="Name, Phone Number, Designation" />

                <x-textarea-simple label="Venue" name="venue" wire:model.defer="venue" />

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="update">Save</x-button>
                </x-slot>
            </x-card>

        </x-section-centered>
</div>