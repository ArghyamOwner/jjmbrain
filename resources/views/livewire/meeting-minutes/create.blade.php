<div>
    <x-slot name="title">Create Meeting</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('meetingMinutes') }}">Go Back</x-text-link>
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

                <x-textarea label="Meeting Title" name="meeting_name" wire:model.defer="meeting_name" rows="2" />

                <x-select label="Name of Vertical / Training" name="vertical" wire:model.defer="vertical">
                    <option value="">--Select an Options--</option>
                    @foreach ($verticalOptions as $verticalKey => $verticalValue)
                    <option value="{{ $verticalKey }}">{{ $verticalValue }}</option>
                    @endforeach
                </x-select>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <x-input type="datetime-local" label="Meeting Date & Time" name="meeting_date"
                        wire:model.defer="meeting_date" />

                    <x-select label="User Group" name="user_group" wire:model.defer="user_group">
                        <option value="">--Select a User Group--</option>
                        @foreach ($this->roles as $roleKey => $roleValue)
                        <option value="{{ $roleKey }}">{{ $roleValue }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Meeting Mode" name="meetingType" wire:model="meetingType">
                        <option value="">--Select a Mode of Meeting--</option>
                        @foreach ($typeOptions as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Meeting Type" name="type" wire:model="type">
                        <option value="">--Select Type of Meeting--</option>
                        @foreach ($meetingTypeOptions as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </x-select>
                </div>


                @if($this->meetingType == 'Online')
                <x-input label="Link" name="link" wire:model.defer="link" />
                @else
                <x-input label="Venue" name="venue" wire:model.defer="venue" />
                @endif

                <div class="col-span-2">
                    <x-textarea-simple optional label="Description" name="description"
                        wire:model.defer="description" />
                </div>
            </x-card-form>
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>