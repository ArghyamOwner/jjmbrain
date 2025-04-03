<div>
    <x-button tag="a" href="#" x-data="{}"
        x-on:click.prevent="$dispatch('show-modal', 'verification-form')" x-cloak>Verify
    </x-button>

    <x-modal-simple max-width="md" name="verification-form" form-action="save">
        <x-slot name="title">Verification</x-slot>

            <x-select label="Status" name="verification_status" wire:model.defer="verification_status">
                <option value="">--Select a status--</option>
                @foreach ($statuses as $val)
                <option value="{{ $val }}">{{ $val }}</option>
                @endforeach
            </x-select>

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>