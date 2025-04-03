<div>
    <x-slot name="title">Banners</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Banners
            </x-slot>
            @if($showCreateButton)
            <x-slot name="action">
                <x-button tag="a" href="{{ route('banner.create') }}" with-icon icon="add">New Banner</x-button>
            </x-slot>
            @endif
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card card-classes="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-x-6">
                <div class="col-span-3">
                    <x-input-search no-margin name="search" wire:model.debounce.600ms="search"
                        placeholder="Search Banner..." />
                </div>
                <x-select name="app_name" wire:model="app_name">
                    <option value="all">--Select App--</option>
                    @foreach ($appOptions as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </x-select>
            </div>
        </x-card>

        <x-card no-padding overflow-hidden>
            @if ($banners->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Title</x-table.thead>
                            <x-table.thead>App Name</x-table.thead>
                            <x-table.thead>Image</x-table.thead>
                            <x-table.thead>Link</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                            <x-table.thead>Created By</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                        <tr>
                            <x-table.tdata>
                                <p>
                                    @if ($banner->status === 'Active')
                                    <x-badge variant="success">Active</x-badge>
                                    @else
                                    <x-badge variant="danger">Archived</x-badge>
                                    @endif
                                </p>
                                {{ $banner->title ?? 'N/A' }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $banner->app_name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                @if($banner->image_url)
                                <x-lightbox>
                                    <x-lightbox.item image-url="{{ $banner->image_url }}">
                                        <img src="{{ $banner->image_url }}" alt="" class="h-16 object-fit" />
                                    </x-lightbox.item>
                                </x-lightbox>
                                @else
                                N/A
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                @if ($banner->link)
                                <x-text-link href="{{ $banner->link }}">Open Link</x-text-link>
                                @else
                                N/A
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                <livewire:banner.archive wire:key="banner-{{ $banner->id }}" :banner-id="$banner->id" />
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $banner->createdBy?->name }}
                                <p>
                                    @date($banner->created_at)
                                </p>
                            </x-table.tdata>
                            {{-- <x-table.tdata>
                                <div class="flex space-x-1">
                                    @if($showDeleteButton)
                                    <x-button-icon-delete href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                                                'wucs.delete',
                                                'showDeleteModal',
                                                '{{ $banner->id }}',
                                                'Confirm Deletion',
                                                'All the data related to this WUC will be deleted. Are you sure you want to delete this WUC ?',
                                                '{{ $banner->name }}'
                                            )" />
                                    @endif
                                </div>
                            </x-table.tdata> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
            @else
            <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        @if ($banners->hasPages())
        <div class="mt-5">{{ $banners->links() }}</div>
        @endif
    </x-section-centered>
    <livewire:wucs.delete />
</div>