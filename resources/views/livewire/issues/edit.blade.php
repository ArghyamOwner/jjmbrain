<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Edit Issue</x-slot>

        <div class="py-3 px-6">
            <form wire:submit.prevent="update">

                <x-textarea-simple 
                    label="Title" 
                    name="issueName" 
                    wire:model.defer="issueName" 
                />

                <x-input
                    label="Category Type" 
                    name="categoryType" 
                    wire:model.defer="categoryType"
                    readonly
                />

                <x-input
                    label="Sub-Category Type" 
                    name="subCategoryType" 
                    wire:model.defer="subCategoryType"
                    readonly
                />

                <x-button with-spinner wire:target="update">Update</x-button>
            </form>
        </div>
    </x-slideovers>
</div>
