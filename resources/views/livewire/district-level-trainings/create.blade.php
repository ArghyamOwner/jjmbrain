<div>
    <x-slot name="title">Create District Level Training</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('districtleveltraings') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create District Level Training
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-input type="datetime-local" label="Day 1" name="dayOne" wire:model.defer="dayOne" />
                <x-input type="datetime-local" label="Day 2" name="dayTwo" wire:model.defer="dayTwo" optional />

                <x-input-number input-mode="numeric" label="No. of Participants" name="numberOfParticipant"
                wire:model.defer="numberOfParticipant" />
            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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

                <x-select optional label="Trainer 3" name="trainerThree" wire:model="trainerThree"
                    hint="Select trainer 3 if required">
                    <option value="">--Select a trainer--</option>
                    @foreach ($this->trainers as $trainerValue => $trainerLabel)
                        <option value="{{ $trainerValue }}">{{ $trainerLabel }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-filepond label="Upload Day 1 Image" name="dayOneImage" wire:model.defer="dayOneImage" />
                <x-filepond label="Upload Day 2 Image" name="dayTwoImage" wire:model.defer="dayTwoImage" optional />
            </div>

            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>

                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>

    </x-section-centered>
</div>
