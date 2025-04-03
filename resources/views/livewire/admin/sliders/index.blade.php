<div>
    <x-slot name="title">All Sliders</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Sliders
            </x-slot>

            <x-slot name="action">
                {{-- <x-button
                    type="button"
                    x-data="{}" 
                    x-on:click.prevent="livewire.emitTo('admin.sliders.create-modal', 'openSliderCreateSlideover')" 
                    x-cloak
                    with-spinner
                    with-icon 
                    icon="add">New image</x-button> --}}
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if ($slidersCount < 5)
            <x-button
                class="mb-4"
                type="button"
                x-data="{}" 
                x-on:click.prevent="livewire.emitTo('admin.sliders.create-modal', 'openSliderCreateSlideover')" 
                x-cloak
                with-spinner
                with-icon 
                icon="add">New image</x-button>
        @endif

        @if($sliders->isNotEmpty())
            <x-alertbox variant="warning" class="mb-3"><strong>Note:</strong> You can drag n drop the order of the images.</x-alertbox>
            <x-card no-padding>
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Image</x-table.thead>
                            <x-table.thead>Order</x-table.thead>
                            <x-table.thead>Published at</x-table.thead>
                            <x-table.thead></x-table.thead>
                        </tr>
                    </thead>
                    <tbody wire:sortable="updateSliderOrder">
                        @foreach($sliders as $slider)
                            <tr  wire:sortable.item="{{ $slider->id }}" wire:sortable.handle>
                                <x-table.tdata>
                                    <img src="{{ $slider->image_url }}" loading="lazy" class="w-24 h-24 rounded-lg border" />
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $slider->order }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    @dateWithTime($slider->published_at)
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-link
                                        href="#"
                                        variant="danger"
                                        x-data="{}"
                                        x-cloak
                                        x-on:click.prevent="$wire.emitTo(
                                            'admin.sliders.delete',
                                            'showDeleteModal',
                                            '{{ $slider->id }}',
                                            'Confirm Deletion',
                                            'Are you sure you want to remove the image?'
                                        )"
                                    >Delete</x-link>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>
        @else 
            <x-card-empty />
        @endif        
    </x-section-centered>

    <livewire:admin.sliders.delete />
    <livewire:admin.sliders.create-modal />

@once
@push('scripts-footer')
    <script src="https://cdn.jsdelivr.net/npm/@nextapps-be/livewire-sortablejs@0.1.1/dist/livewire-sortable.min.js"></script>
@endpush
@endonce
</div>
