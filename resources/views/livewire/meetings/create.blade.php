<div>
    <x-slot name="title">Create Meeting</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('meetings') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create Meeting
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Create a meeting</x-slot>
                <x-slot name="description">Add the necessary details for a meeting.</x-slot>

                <x-textarea label="Meeting Title" name="title" wire:model.defer="title" rows="2" />

                <div class="md:w-1/2">
                    <x-input type="datetime-local" label="Meeting Date & Time" name="date_time" wire:model.defer="date_time" />
                </div>

                <x-input label="Venue" name="venue" wire:model.defer="venue" />
               
            </x-card-form>
           
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>