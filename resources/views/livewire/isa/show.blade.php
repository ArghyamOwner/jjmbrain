<div>
    <x-slot name="title">ISA</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('isa') }}">
                    Go Back
                </x-text-link>
            </x-slot>
            <x-slot:title>
                ISA Details
            </x-slot>
            @if(!$isa->activity_details_exists && $showDeleteButton)
            <x-slot:action>
                <x-button color="red" href="#" x-data="" x-cloak with-icon icon="trash"
                    x-on:click.prevent="window.Livewire.emitTo(
                        'isa.delete',
                        'showDeleteModal',
                        '{{ $isa->id }}',
                        'Confirm Deletion',
                        'Are you sure you want to Delete this ISA?'
                    )">Delete
                ISA</x-button>
            </x-slot>
            @endif
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8"> --}}
            <x-card>
                <x-description-list size="xs">

                    <x-description-list.item>
                        <x-slot name="title">ISA Name</x-slot>
                        <x-slot name="description">
                            {{ $isa->name }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">ISA Type</x-slot>
                        <x-slot name="description">
                            <x-badge variant="success">{{ $isa->type }}</x-badge>
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Block</x-slot>
                        <x-slot name="description">
                            {{ $isa->block?->name }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">
                            District
                        </x-slot>
                        <x-slot name="description">
                            {{ $isa->district?->name }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Villages</x-slot>
                        <x-slot name="description">
                            {{ $isa->village_names }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Contact Person</x-slot>
                        <x-slot name="description">
                            {{ $isa->contact_name }} ({{ $isa->contact_phone }})
                        </x-slot>
                    </x-description-list.item>
                </x-description-list>
            </x-card>

            <x-card overflow-hidden card-classes="mt-5">
                <x-heading size="md" class="mb-2">WUCs</x-heading>
                @if ($isa->wucs->isNotEmpty())
                    <div>
                        <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                            <thead>
                                <tr>
                                    <x-table.thead>Name</x-table.thead>
                                    <x-table.thead>Revenue Circle</x-table.thead>
                                    <x-table.thead>Formation Date</x-table.thead>
                                    <x-table.thead>Action</x-table.thead>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($isa->wucs as $wuc)
                                    <tr>
                                        <x-table.tdata>
                                            {{ $wuc->name }}
                                        </x-table.tdata>
                                        <x-table.tdata>
                                            <p>{{ $wuc?->revenueCircle?->name }}</p>
                                        </x-table.tdata>
                                        <x-table.tdata>
                                            @date($wuc->formation_date)
                                        </x-table.tdata>
                                        <x-table.tdata>
                                            <div class="flex space-x-1">
                                                <x-button-icon-show href="{{ route('wucs.show', $wuc->id) }}" />
                                            </div>
                                        </x-table.tdata>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-table.table>
                    </div>
                @else
                    <x-card-empty class="shadow-none" />
                @endif
            </x-card>
    </x-section-centered>
    <livewire:isa.delete />
</div>