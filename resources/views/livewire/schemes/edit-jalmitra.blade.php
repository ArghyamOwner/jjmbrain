<div>
    <x-button tag="a" href="#" with-icon icon="edit" x-data="{}"
        x-on:click.prevent="$dispatch('show-modal', 'jalmitra-edit-form')" x-cloak>Edit Jalmitra
    </x-button>

    <x-modal-simple max-width="lg" name="jalmitra-edit-form" form-action="update">
        <x-slot name="title">Edit Jal-Mitra Details</x-slot>

        <x-input label="Name" name="name" wire:model.defer="name" />
        <x-input type="date" label="Date of Engagement" name="doj" wire:model.defer="doj" />

        @if(!$this->jalmitra->joining_document)
        <x-filepond optional accept-files="application/pdf" label="Upload Joinig document" name="joining_document"
            wire:model.defer="joining_document" />
        @endif

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="update">Update</x-button>
        </x-slot>
    </x-modal-simple>
</div>