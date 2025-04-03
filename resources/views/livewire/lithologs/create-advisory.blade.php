<div>
    <x-button tag="a" href="#" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'advisory-form')" x-cloak>Add
        Advisory
    </x-button>

    <x-modal-simple max-width="md" name="advisory-form" form-action="save">
        <x-slot name="title">Advisory</x-slot>

        <x-textarea-simple label="Advisory" name="advisory" wire:model.defer="advisory" />

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>