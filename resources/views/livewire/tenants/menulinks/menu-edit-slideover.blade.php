<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Edit Menu details</x-slot>

		@if ($menulink)
			<div class="p-4">
				<form wire:submit.prevent="save">
					<x-input
						label="Name" 
						name="menulink.name"
						wire:model.defer="menulink.name" 
						placeholder="eg. About Us, Contact Us ..."
					/>
		
					<x-input
						label="Slug" 
						name="menulink.slug"
						wire:model.defer="menulink.slug" 
					/>

                    <x-select label="Parent Link" name="menulink.parent_id" wire:model.defer="menulink.parent_id">
                        <option value="no-parent">No Parent</option>
                        @if (count($this->parentlinks))
                            @foreach ($this->parentlinks as $parentlinkKey => $parentlinkValue)
                                <option value="{{ $parentlinkKey }}">{{ $parentlinkValue }}</option>
                            @endforeach
                        @endif
                    </x-select>

					<x-select label="Menu Type" name="menulink.menu_type" wire:model.defer="menulink.menu_type">
						@if (count($this->menu_types))
							@foreach ($this->menu_types as $menu_type)
								<option value="{{ $menu_type }}">{{ $menu_type }}</option>
							@endforeach
						@endif
					</x-select>

					<x-input
						label="Link" 
						name="menulink.link"
						wire:model.defer="menulink.link" 
						placeholder="{{ url($menulink->slug) }}"
					/>
                        
                    <div class="flex justify-end space-x-2 items-center">
                        <x-button type="button" with-spinner wire:click="close" wire:target="close" color="white">Cancel</x-button>
                        <x-button with-spinner wire:target="save">Update menu</x-button>
                    </div>
				</form>
			</div>
		@else
			<x-card-empty class="shadow-none" />
		@endif
    </x-slideovers>
</div>