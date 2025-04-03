<div>
    <x-slot name="title">Article Categories</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Article Categories
            </x-slot>
            <x-slot name="action">
                <x-button tag="a" href="{{ route('articlecategories.create') }}" with-icon icon="add">
                    New Category
                </x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if ($categories->isNotEmpty())
                <x-table.table :rounded="false">

                    <thead>
                        <tr>
                            <x-table.thead>Category</x-table.thead>
                            <x-table.thead>Icon</x-table.thead>
                            <x-table.thead>Actions</x-table.thead>
                        </tr>
                    </thead>

                    <tbody wire:sortable="updateCategoryOrder">
                        @foreach ($categories as $category)
                            <tr wire:sortable.item="{{ $category->id }}" wire:sortable.handle>
                                <x-table.tdata>
                                    {{ $category->name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    @if ($category->icon)
                                        @svg($category->icon, 'w-6 h-6 text-slate-500')
                                    @endif
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-2">
                                        <x-button-icon-edit href="{{ route('articlecategories.edit', $category->id) }}" />
                                        <x-button-icon-delete  />
                                    </div>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>
    </x-section-centered>

    @once
    @push('scripts-footer')
        <script src="https://cdn.jsdelivr.net/npm/@nextapps-be/livewire-sortablejs@0.1.1/dist/livewire-sortable.min.js"></script>
    @endpush
    @endonce
</div>
