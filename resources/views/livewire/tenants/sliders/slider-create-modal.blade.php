<div>
    <x-slideovers wire:model="openSlideover">
        <x-slot name="header">Slider Image Upload</x-slot>
        
        <div class="py-3 px-6">
            <form wire:submit.prevent="save">
                <x-filepond 
                    hint="The ideal size for a slider image is 1200 pixels wide with a 16:9 aspect ratio."
                    label="Add Image"
                    name="image"
                    wire:model.defer="image"
                />

                <x-button with-spinner wire:target="image,save">Upload image</x-button>
            </form>
        </div>
    </x-slideovers>    
</div>