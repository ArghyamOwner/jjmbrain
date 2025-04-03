<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Edit Class Milestone Details</x-slot>

        <div class="py-4 px-5">
            <form wire:submit.prevent="save">
                <x-input label="Milestone Title" name="milestoneTitle" wire:model.defer="milestoneTitle" /> 
                
                <x-button class="w-full" with-spinner wire:target="save">Save</x-button>
            </form>
        </div>
    </x-slideovers>
</div>
