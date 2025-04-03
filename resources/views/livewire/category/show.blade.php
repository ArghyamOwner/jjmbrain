<div>
    <x-slot name="title">Category Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('categories') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Category Details
        </x-slot>
        <x-slot name="action">
            <x-button tag="a" href="#" with-icon icon="add" x-data="{}"
                x-on:click.prevent="$dispatch('show-modal', 'question-create-form')" x-cloak>Sub-Category
            </x-button>
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card card-classes="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-4">
                    <div class="md:col-span-3">
                        <x-heading size="xl" class="mb-2">{{ $category->name }}</x-heading>
                        <div class="text-sm grid grid-cols-1 md:grid-cols-3 gap-y-1.5 gap-x-6">
                            <div class="text-slate-500">
                                Status : @if ($category->status)
                                    <x-badge variant="success">Active</x-badge>
                                @else
                                    <x-badge variant="success">In-Active</x-badge>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>

            <x-heading size="lg" class="mb-2">Details of Sub-Categories</x-heading>
            @if ($category->subCategories->isNotEmpty())
                <x-card no-padding overflow-hidden>
                    <x-table.table :rounded="false" :with-shadow="false">
                        <thead>
                            <tr>
                                <x-table.thead>Subcategory Name</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category->subCategories as $subCat)
                                <tr>
                                    <x-table.tdata>
                                        {{ $subCat->name }}
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </x-card>
            @else
                <x-card-empty>
                    No sub-categries added yet.
                </x-card-empty>
            @endif
        </x-section-centered>

        <x-modal-simple max-width="lg" name="question-create-form" form-action="save">
            <x-slot name="title">Add Sub-Category Details</x-slot>

            <x-input label="Sub Category" name="subCategoryName" wire:model.defer="subCategoryName" />

            <x-slot name="footer">
                <x-button type="submit" with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-modal-simple>
</div>
