<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Edit Service: {{ $title }}</x-slot>

        <div class="py-3 px-6">
            <form wire:submit.prevent="update">
                <x-input label="Link" name="link" wire:model.defer="service.link" />

                <x-button with-spinner wire:target="update">Update</x-button>
            </form>
        </div>
    </x-slideovers>
</div>