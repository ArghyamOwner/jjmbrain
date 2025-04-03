<div>
    <x-slot name="title">Create Campaigns</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('campaigns') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Create Campaign
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card overflow-hidden form-action="save">

                <x-input label="Campaign Name" name="name" wire:model.defer="name" />

                <x-select label="Select Actor" name="role" wire:model.defer="role">
                    <option value="">--Select Actor--</option>
                    @foreach ($this->roles as $roleKey => $roleValue)
                        <option value="{{ $roleKey }}">{{ $roleValue }}</option>
                    @endforeach
                </x-select>

                <x-select label="Status" hint="Only One Campain can remain Active at a time" name="status"
                    wire:model.defer="status">
                    <option value="">--Select Status--</option>
                    @foreach ($statuses as $key => $status)
                        <option value="{{ $key }}">{!! $status !!}</option>
                    @endforeach
                </x-select>

                <x-slot name="footer" class="text-right">
                    <x-button with-spinner wire:target="save">Save</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>
