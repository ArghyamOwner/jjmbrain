<div>
    <x-card no-padding overflow-hidden>
        @if($assets->isNotEmpty() || ($assets->isEmpty() && $search))
        <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
            <div class="md:col-span-5">
                <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search Item Name / Asset UIN..." />
            </div>
            <div class="md:col-span-1">
                <x-button tag="a" color="blue" href="{{ route('schemes.assetCreate', $schemeId) }}" with-icon icon="add">Add New Asset
                </x-button>
            </div>
        </div>
        @endif

        @if($assets->isNotEmpty())
        <div>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>Office</x-table.thead>
                        <x-table.thead>Item Name</x-table.thead>
                        <x-table.thead>Asset UIN</x-table.thead>
                        <x-table.thead>Type</x-table.thead>
                        <x-table.thead>Category</x-table.thead>
                        <x-table.thead>Financial Year</x-table.thead>
                        <x-table.thead>Serial Number</x-table.thead>
                        <x-table.thead>Action</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assets as $asset)
                    <tr>
                        <x-table.tdata>
                            {{ $asset->circle?->name }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $asset->item_name }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $asset->asset_uin }}
                        </x-table.tdata>
                        <x-table.tdata>
                            <span class="uppercase">{{ $asset->asset_type }}</span>
                        </x-table.tdata>
                        <x-table.tdata>
                            <span class="uppercase">{{ $asset->asset_category }}</span>
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $asset->financialYear->financialYear }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $asset->serial_number }}
                        </x-table.tdata>
                        <x-table.tdata>
                            <div class="flex space-x-1">
                                {{-- <x-button-icon-edit href="{{ route('assets.edit', $asset->id) }}" /> --}}
                                <x-button-icon-delete href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                                                'assets.delete',
                                                'showDeleteModal',
                                                '{{ $asset->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this asset?',
                                                '{{ $asset->item_name }}'
                                            )" />
                            </div>
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </div>
        @else
        <x-card-empty variant="">
            <p class="text-center text-slate-500 mb-3 text-sm">No assets found.</p>
            <x-button tag="a" href="{{ route('schemes.assetCreate', $schemeId) }}" with-icon icon="add">Add New Asset</x-button>
        </x-card-empty>
        @endif
    </x-card>

    @if ($assets->hasPages())
    <div class="mt-5">{{ $assets->links() }}</div>
    @endif
</div>