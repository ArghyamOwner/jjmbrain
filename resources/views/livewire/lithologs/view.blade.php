<div>
    <x-slot name="title">Litholog Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $litholog->scheme_id) }}">
                    {{ $litholog->scheme?->name }}
                </x-text-link>
    </x-slot>

    <x-slot:title>
        Litholog - {{ $litholog->scheme?->name }} ({{ $litholog->scheme?->division?->name }})
        </x-slot>

        <x-slot name="action">

            <div class="flex space-x-2">
                @if($showSdoVerification)
                <livewire:lithologs.sdo-verification :litholog="$litholog" />
                @endif

                @if($showAdvisory)
                <livewire:lithologs.create-advisory :litholog="$litholog" />
                @endif
                <x-button class="truncate" tag="a" href="{{ route('lithologs.edit', $litholog->id) }}" with-icon
                    icon="edit">Update Litho</x-button>
                @if($showDeleteButton)
                    <x-button 
                        color="red"
                        with-icon icon="trash" 
                        x-data="{ tooltip: 'Delete' }" x-cloak
                        x-on:click.prevent="window.Livewire.emitTo(
                            'lithologs.delete-litholog',
                            'showDeleteModal',
                            '{{ $litholog->id }}',
                            'Confirm Deletion',
                            'Are you sure you want to remove this litholog and all its related Data?',
                            '{{ $litholog->well_id }}'
                        )">Delete
                    </x-button>
                @endif    
            </div>
        </x-slot>

        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <x-card>
                    <x-description-list size="xs">

                        <x-description-list.item>
                            <x-slot name="title">Well Id</x-slot>
                            <x-slot name="description">
                                {{ $litholog->well_id }}
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">SDO Verification</x-slot>
                            <x-slot name="description">
                                {{ $litholog->verification_status ?? 'N/A'}}
                                <p>{{ $litholog->verifiedBy?->name }}</p>
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Starting Date
                                <p>Completion Date</p>
                            </x-slot>
                            <x-slot name="description">
                                @date($litholog->starting_date)
                                <p>
                                    @if($litholog->completion_date)
                                    @date($litholog->completion_date)
                                    @else
                                    -
                                    @endif
                                </p>
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Drilling Type</x-slot>
                            <x-slot name="description" class="capitalize">{{ $litholog->drilling_type }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Driller Details</x-slot>
                            <x-slot name="description">{{ $litholog->driller_name }} ({{ $litholog->driller_phone }})
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Drill Vehicle Number</x-slot>
                            <x-slot name="description">
                                {{ $litholog->drill_vehicle_number }}
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Hole Diameter</x-slot>
                            <x-slot name="description">{{ $litholog->hole_diameter }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Casing Size</x-slot>
                            <x-slot name="description">{{ $litholog->casing_size }}</x-slot>
                        </x-description-list.item>

                        {{-- <x-description-list.item>
                            <x-slot name="title">Attached Schemes</x-slot>
                            <x-slot name="description">{{ $litholog->schemes?->pluck('name')->join(',') }}</x-slot>
                        </x-description-list.item> --}}

                    </x-description-list>
                </x-card>
                <x-card>
                    <x-description-list size="xs">

                        <x-description-list.item>
                            <x-slot name="title">SDO Verification</x-slot>
                            <x-slot name="description">
                                @if($litholog->verified_by)
                                    <x-badge variant="warning">{{ $litholog->verification_status.' - By SDO' }}</x-badge>
                                @else
                                    <x-badge variant="danger">Pending</x-badge>
                                @endif
                            </x-slot>
                        </x-description-list.item>
                        
                        <x-description-list.item>
                            <x-slot name="title">Compressor Pressure</x-slot>
                            <x-slot name="description">
                                {{ $litholog->compressor_pressure ? $litholog->compressor_pressure.' (Kg/cm2)' : "N/A" }}
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Static Water</x-slot>
                            <x-slot name="description">
                                {{ $litholog->static_water ? $litholog->static_water.' (meters)' : "N/A" }}
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Pump Duration (in Hrs.)</x-slot>
                            <x-slot name="description">{{ $litholog->duration_pump ? $litholog->duration_pump.' (Hrs.)'
                                : "N/A" }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Discharge</x-slot>
                            <x-slot name="description">{{ $litholog->discharge ? $litholog->discharge.' (L/H)' : "N/A"
                                }}
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Drawdown</x-slot>
                            <x-slot name="description">
                                {{ $litholog->drawdown ? $litholog->drawdown.' (Meters)' : "N/A" }}
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Status</x-slot>
                            <x-slot name="description">{{ $litholog->status ?? "N/A" }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Location</x-slot>
                            <x-slot name="description">
                                {{ $litholog->latitude ? ("Latitude - $litholog->latitude") : 'N/A' }}
                                <p>
                                    {{ $litholog->longitude ? ("Longitude - $litholog->longitude") : 'N/A' }}
                                </p>
                                <p>
                                    {{ "Elevation - ".($litholog->elevation ?? 'N/A') }}
                                </p>
                            </x-slot>
                        </x-description-list.item>

                        {{-- <x-description-list.item>
                            <x-slot name="title">Comment</x-slot>
                            <x-slot name="description">{{ $litholog->comment ?? "N/A" }}</x-slot>
                        </x-description-list.item> --}}

                        {{-- <x-description-list.item>
                            <x-slot name="title">Attached Schemes</x-slot>
                            <x-slot name="description">{{ $litholog->schemes?->pluck('name')->join(',') }}</x-slot>
                        </x-description-list.item> --}}

                    </x-description-list>
                </x-card>
                <x-card noPadding>
                    <x-google-map :coordinates="[
                            'lat' => floatval($litholog->latitude) ?? 26.1158, 
                            'lng' => floatval($litholog->longitude) ?? 91.7086
                        ]" zoom="12" info-content="{{ $litholog->well_id }}" class="h-100" />
                </x-card>
            </div>

            <div class="mt-5">
                <x-card>
                    <x-description-list size="xs">

                        <x-description-list.item>
                            <x-slot name="title">Advisory</x-slot>
                            <x-slot name="description">{{ $litholog->advisory ?? "N/A" }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Comment</x-slot>
                            <x-slot name="description">{{ $litholog->comment ?? "N/A" }}</x-slot>
                        </x-description-list.item>

                    </x-description-list>
                </x-card>
            </div>

            <div class="mt-5 mb-5">
                <x-alert :close="false" variant="error">Please update casing diagram and water level diagram, to initialize the approval process.</x-alert>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-5">

                @if($litholog->lithologies->isNotEmpty())
                <x-card no-padding overflow-hidden>
                    <x-heading size="md" class="p-2">Lithologies</x-heading>

                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Start</x-table.thead>
                                <x-table.thead>End</x-table.thead>
                                <x-table.thead>Layer</x-table.thead>
                                <x-table.thead>Remarks</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($litholog->lithologies as $lithology)
                            <tr>
                                <x-table.tdata>
                                    {{ $lithology->start }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $lithology->end }}
                                </x-table.tdata>
                                <x-table.tdata class="capitalize">
                                    {{ $lithology?->pattern?->category }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $lithology->remarks }}
                                </x-table.tdata>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>

                </x-card>
                @else
                <x-card-empty />
                @endif

                <x-card no-padding overflow-hidden>
                    <div class="flex items-center">
                        <div class="flex-1">
                            <x-heading size="md" class="pt-3 pb-3 pl-3">Casing Diagram</x-heading>
                        </div>
                        <livewire:lithologs.add-casing-diagram :litholog="$litholog" />
                        <x-button-icon-delete x-on:click.prevent="$wire.emitTo(
                                'lithologs.delete-casing-diagram',
                                'showDeleteModal',
                                '{{ $litholog->id }}',
                                'Confirm Deletion',
                                'Are you sure you want to remove the Casing Diagram Details?',
                            )" />
                    </div>
                    @if($litholog->casingDiagrams->isNotEmpty())
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Start</x-table.thead>
                                <x-table.thead>End</x-table.thead>
                                <x-table.thead>Layer</x-table.thead>
                                <x-table.thead>Remarks</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($litholog->casingDiagrams as $caseDiagram)
                            <tr>
                                <x-table.tdata>
                                    {{ $caseDiagram->start }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $caseDiagram->end }}
                                </x-table.tdata>
                                <x-table.tdata class="capitalize">
                                    {{ $caseDiagram?->pattern?->category }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $caseDiagram->remarks }}
                                </x-table.tdata>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                    @else
                    <x-card-empty variant="">
                        <p class=" text-slate-500 mb-3 text-sm">Casing Diagram details not found.</p>
                    </x-card-empty>

                    @endif
                </x-card>

                <x-card no-padding overflow-hidden>
                    <div class="flex items-center">
                        <div class="flex-1">
                            <x-heading size="md" class="pt-3 pb-3 pl-3">Water Level</x-heading>
                        </div>
                        <livewire:lithologs.add-water-level :litholog="$litholog" />
                        <x-button-icon-delete x-on:click.prevent="$wire.emitTo(
                                'lithologs.delete-water-level',
                                'showDeleteModal',
                                '{{ $litholog->id }}',
                                'Confirm Deletion',
                                'Are you sure you want to remove the Water Level Details?',
                            )" />
                    </div>
                    @if($litholog->waterLevels->isNotEmpty())
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Start</x-table.thead>
                                <x-table.thead>End</x-table.thead>
                                <x-table.thead>Layer</x-table.thead>
                                <x-table.thead>Remarks</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($litholog->waterLevels as $level)
                            <tr>
                                <x-table.tdata>
                                    {{ $level->start }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $level->end }}
                                </x-table.tdata>
                                <x-table.tdata class="capitalize">
                                    {{ $level?->pattern?->category }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $level->remarks }}
                                </x-table.tdata>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                    @else
                    <x-card-empty variant="">
                        <p class=" text-slate-500 mb-3 text-sm">Water Level details not found.</p>
                    </x-card-empty>

                    @endif
                </x-card>
            </div>

            @if($litholog->show_diagram)
                <livewire:lithologs.diagram :litholog="$litholog->id" />
            @else
            <x-button class="truncate w-full" color="purple" type="button" with-spinner wire:click="generateDiagram"
                with-icon icon="eye">Generate Lithology Diagram</x-button>
            @endif

        </x-section-centered>
        <livewire:lithologs.delete-casing-diagram />
        <livewire:lithologs.delete-water-level />
        <livewire:lithologs.delete-litholog />

</div>