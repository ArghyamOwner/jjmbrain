<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Update APDCL Consumer Number</x-slot>

        <div class="py-3 mt-5 px-6">
            <form wire:submit.prevent="update">
                <x-input type="text" label="Consumer Number" name="consumer_no" wire:model.defer="consumer_no" />
                <x-button with-spinner wire:target="update">Update</x-button>
            </form>
        </div>
    </x-slideovers>
</div>