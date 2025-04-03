<div>
    <x-dialog-modal wire:model="show" form-action="update">
        <x-slot name="title">Update Gallery Image Details</x-slot>

        <x-slot name="content">
            <x-input label="Image Caption" name="caption" wire:model.defer="caption" />
    
            <x-select label="Image Type" name="image_type" wire:model.defer="image_type">
                <option value="">--Select a type--</option>
                @foreach($this->galleryTypes as $galleryType)
                    <option value="{{ $galleryType->value }}">{{ $galleryType->name }}</option>
                @endforeach
            </x-select>
        </x-slot>
 
        <x-slot name="footer">
            <div class="flex items-center space-x-3 justify-end">
                <x-button color="white" type="button" wire:click="closeModal" with-spinner wire:target="closeModal">Cancel</x-button>
                <x-button with-spinner wire:target="update">Save</x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
