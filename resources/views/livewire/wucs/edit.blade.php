<div>
    <x-button tag="a" class="w-full" href="#" color="white" with-icon icon="edit" x-data="{}"
        x-on:click.prevent="$dispatch('show-modal', 'edit-form')" x-cloak>
        WUC Name
    </x-button>

    <x-modal-simple max-width="2xl" name="edit-form" form-action="update">
        <x-slot name="title">Update WUC Name</x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <x-input label="Name" name="name" wire:model.defer="name" />
        </div>

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="update">Update</x-button>
        </x-slot>
    </x-modal-simple>
</div>
