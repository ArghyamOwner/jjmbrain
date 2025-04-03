<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Update Division</x-slot>

        <div class="py-3 px-6">
            <form wire:submit.prevent="update">

                <x-virtual-select label="Division" name="divisionId" wire:model="divisionId" :options="[
                            'options' => $this->divisions,
                        ]" />

                <x-button with-spinner wire:target="update">Update</x-button>
            </form>
        </div>
    </x-slideovers>
</div>