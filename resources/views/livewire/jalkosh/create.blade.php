<div>
    <x-slot name="title">Create Jal Kosh Link</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jalkoshlinks') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create a new Jal Kosh Link
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card-form form-action="save">
            <x-slot name="title">Scheme Details</x-slot>
            <x-slot name="description">Add the necessary details.</x-slot>

            <x-select label="Type" name="type" wire:model="type">
                <option value="">--Select a type--</option>
                @foreach ($this->types as $typeKey => $typeName)
                    <option value="{{ $typeKey }}">{{ $typeName }}</option>
                @endforeach
            </x-select>

            <x-select label="Status" name="status" wire:model.defer="status">
                <option value="">--Select a status--</option>
                @foreach ($this->statuses as $statusObject)
                    <option value="{{ $statusObject->value }}">{{ $statusObject->name }}</option>
                @endforeach
            </x-select>

            @if ($this->type === 'video')
                <x-input label="Youtube Link" name="video" wire:model.defer="video" hint="hint: https://www.youtube.com/embed/Nbcd8if4tM8" />
            @endif

            @if ($this->type === 'image')
                <x-filepond-image label="{{ __('Upload Photo') }}" name="image" wire:model.defer="image"
                    hint="Max Size : 2 MB" />
            @endif

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
            </x-card>
    </x-section-centered>
</div>
