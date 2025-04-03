<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Create Menu</x-slot>
        
        <div class="py-3 px-6">
            <form wire:submit.prevent="save">
                <x-input
                    label="Name" 
                    name="name"
                    wire:model.lazy="name" 
                    placeholder="eg. About Us, Contact Us ..."
                />

                <x-input
                    label="Slug" 
                    name="slug"
                    wire:model.defer="slug" 
                    placeholder="eg. about-us, contact-us..."
                />

                <x-select label="Parent Link" name="parent_id" wire:model.defer="parent_id">
                    <option value="no-parent">No Parent</option>
                    @if (count($this->parentlinks))
                        @foreach ($this->parentlinks as $parentlinkKey => $parentlinkValue)
                            <option value="{{ $parentlinkKey }}">{{ $parentlinkValue }}</option>
                        @endforeach
                    @endif
                </x-select>

                <x-select label="Menu Type" name="menu_type" wire:model.defer="menu_type">
                    @if (count($this->menu_types))
                        @foreach ($this->menu_types as $menu_type)
                            <option value="{{ $menu_type }}">{{ $menu_type }}</option>
                        @endforeach
                    @endif
                </x-select>

                <div class="flex justify-end space-x-2 items-center">
                    <x-button type="button" with-spinner wire:click="close" wire:target="close" color="white">Cancel</x-button>
                    <x-button with-spinner wire:target="save">Save menu</x-button>
                </div>
            </form>
        </div>
    </x-slideovers>    
</div>