<div>
    <x-slot name="title">Menus</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Menus
            </x-slot>

            <x-slot name="action">
                <x-button type="button"
                    x-data="{}"
                    x-on:click="livewire.emit('MenuCreateSlideover.slideover.toggle')"
                    x-cloak
                   with-icon icon="add">New menu</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card-form>
            <x-slot name="title">Menu Lists</x-slot>
            <x-slot name="description">
                <div class="space-y-2">
                    <p>This menu list appears at the top navigation of the website. The menu list appears in the order displayed here.</p>
                    <p>Drag and drop to update your menu lists.</p>
                </div>
            </x-slot>

            <div>
                @if ($groups->isNotEmpty())
                    <div wire:sortable="updateMenuGroupOrder" wire:sortable-group="updateLinksOrder" class="space-y-4">
                        @foreach ($groups as $group)
                            <div wire:key="group-{{ $group->id }}" wire:sortable.item="{{ $group->id }}" class="px-4 py-2 border rounded-lg text-sm shadow-sm">
                                <div class="flex justify-between items-center pt-2">
                                    <div wire:sortable.handle class="cursor-move flex items-center space-x-2">
                                        <x-iconic-dots class="w-5 h-5 text-gray-500" />
                                        <h4>{{ $group->order }}. {{ $group->name }}</h4>
                                    </div>
                                    
                                    <div class="flex space-x-2">
                                        <button wire:click="$emit('openMenuEditSlideover', '{{ $group->id }}')" type="button" class="text-gray-500 text-sm hover:underline">Edit</button>
                                        <button onclick="confirm('Are you sure you want to remove the parent menu?') || event.stopImmediatePropagation()" wire:click="removeMenu('{{ $group->id }}')" type="button" class="text-red-500 text-sm hover:underline">Delete</button>
                                    </div>
                                </div>
                                
                                <ul wire:sortable-group.item-group="{{ $group->id }}" class="space-y-2 mt-2 border-l">
                                    @foreach ($group->children as $link)
                                        <li wire:key="link-{{ $link->id }}" wire:sortable-group.item="{{ $link->id }}" class="flex justify-between items-center space-x-2">
                                            <div class="text-gray-600 h-1 w-5 border-b"></div>
                                            <div class="px-4 py-1 border rounded-lg flex-1 bg-gray-50">
                                                {{ $link->order }}. {{ $link->name }}
                                            </div>
                                            <div class="w-24 flex-shrink-0 flex space-x-2 justify-end">
                                                <button wire:click="$emit('openMenuEditSlideover', '{{ $link->id }}')" type="button" class="text-gray-500 text-sm hover:underline">Edit</button>
                                                <button onclick="confirm('Are you sure you want to remove the link?') || event.stopImmediatePropagation()" wire:click="removeLink('{{ $link->id }}')" type="button" class="text-red-500 text-sm hover:underline">Delete</button>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-sm">No menu added yet.</div>
                @endif
            </div>
        </x-card-form>

        <x-section-border />

        <x-card-form>
            <x-slot name="title">Footer Menu Lists</x-slot>
            <x-slot name="description">
                <div class="space-y-2">
                    <p>This menu list appears at the footer of the website. The menu list appears in the order displayed here.</p>
                    <p>Drag and drop to update your menu lists.</p>
                </div>
            </x-slot>

            <div>
                @if ($footermenulinks->isNotEmpty())
                    <div wire:sortable="updateMenuGroupOrder" class="space-y-4">
                        @foreach ($footermenulinks as $footermenulink)
                            <div wire:key="footermenulink-{{ $footermenulink->id }}" wire:sortable.item="{{ $footermenulink->id }}" class="px-4 py-2 border rounded-lg text-sm">
                                <div class="flex justify-between items-center">
                                    <h4 wire:sortable.handle>{{ $footermenulink->order }}. {{ $footermenulink->name }}</h4>
                                    
                                    <div class="flex space-x-2">
                                        <button wire:click="$emit('openMenuEditSlideover', '{{ $footermenulink->id }}')" type="button" class="text-gray-500 text-sm hover:underline">Edit</button>
                                        <button onclick="confirm('Are you sure you want to remove the menu link?') || event.stopImmediatePropagation()" wire:click="removeMenu('{{ $footermenulink->id }}')" type="button" class="text-red-500 text-sm hover:underline">Delete</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-sm">No menu added yet.</div>
                @endif
            </div>
        </x-card-form>

        <x-section-border />

        <x-card-form>
            <x-slot name="title">Other Menu Lists</x-slot>
            <x-slot name="description">
                <div class="space-y-2">
                    <p>This menu list is available for the website. The menu list appears in the order displayed here.</p>
                    <p>Drag and drop to update your menu lists.</p>
                </div>
            </x-slot>

            <div>
                @if ($othermenulinks->isNotEmpty())
                    <div wire:sortable="updateMenuGroupOrder" class="space-y-4">
                        @foreach ($othermenulinks as $othermenulink)
                            <div wire:key="othermenulink-{{ $othermenulink->id }}" wire:sortable.item="{{ $othermenulink->id }}" class="px-4 py-2 border rounded-lg text-sm">
                                <div class="flex justify-between items-center">
                                    <h4 wire:sortable.handle>{{ $othermenulink->order }}. {{ $othermenulink->name }}</h4>
                                    
                                    <div class="flex space-x-2">
                                        <button wire:click="$emit('openMenuEditSlideover', '{{ $othermenulink->id }}')" type="button" class="text-gray-500 text-sm hover:underline">Edit</button>
                                        <button onclick="confirm('Are you sure you want to remove the menu link?') || event.stopImmediatePropagation()" wire:click="removeMenu('{{ $othermenulink->id }}')" type="button" class="text-red-500 text-sm hover:underline">Delete</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-sm">No menu added yet.</div>
                @endif
            </div>
        </x-card-form>
    </x-section-centered>   

    <livewire:admin.menulinks.menu-edit-slideover />
    <livewire:admin.menulinks.menu-create-slideover />

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@nextapps-be/livewire-sortablejs@0.1.1/dist/livewire-sortable.min.js"></script>
    @endpush
</div>