<div>
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-6 min-h-0 mt-4">
        <x-card>
            <div class="mb-6">
                <x-description-list size="xs">
                    <x-slot name="heading">Scheme Basic Details</x-slot>

                    <x-description-list.item>
                        <x-slot name="title">IMIS ID</x-slot>
                        <x-slot name="description">{{ $scheme->imis_id }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">New Scheme Name</x-slot>
                        <x-slot name="description">{{ $scheme->new_name ?? '-' }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">SMT ID</x-slot>
                        <x-slot name="description">{{ $scheme->old_scheme_id }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">TPI Progress</x-slot>
                        <x-slot name="description">{{ $scheme->tpi_progress ? $scheme->tpi_progress . ' %' : '-' }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Panchayat User Verfication</x-slot>
                        <x-slot name="description">
                            <span class="flex space-x-2">
                                @if ($scheme->schemePanchayatVerification?->verified_by)
                                <x-badge variant="success">Panchayat Verified</x-badge>
                                <span class="text-gray-400">|</span>
                                <p>By
                                    {{ $scheme->schemePanchayatVerification?->verifiedBy?->name .
                                    '
                                    (' .
                                    $scheme->schemePanchayatVerification?->verified_at?->diffForHumans() .
                                    ')' }}
                                </p>
                                @elseif($scheme->schemePanchayatVerification?->rejected_by)
                                <x-badge variant="danger">Panchayat Rejected</x-badge>
                                <span class="text-gray-400">|</span>
                                <p>By
                                    {{ $scheme->schemePanchayatVerification?->rejectedBy?->name .
                                    '
                                    (' .
                                    $scheme->schemePanchayatVerification?->rejected_on?->diffForHumans() .
                                    ')' }}
                                </p>
                                @else
                                <x-badge variant="warning">Pending</x-badge>
                                @endif
                            </span>
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Funding Agency</x-slot>
                        <x-slot name="description">{{ $scheme->funding_agency ?? '-' }}</x-slot>
                    </x-description-list.item>
                    
                    <x-description-list.item>
                        <x-slot name="title">Consumer Number</x-slot>
                        <x-slot name="description">{{ $scheme->consumer_no ?? '-' }}</x-slot>
                    </x-description-list.item>

                    @if ($scheme->consumer_bill_url)
                    <x-description-list.item>
                        <x-slot name="title">APDCL Bill</x-slot>
                        <x-slot name="description">
                            <x-button tag="a" target="_blank" href="{{ $scheme->consumer_bill_url }}" color="white"
                                with-icon icon="download">APDCL Bill
                            </x-button>
                        </x-slot>
                    </x-description-list.item>
                    @endif

                    <x-description-list.item>
                        <x-slot name="title">Financial Year</x-slot>
                        <x-slot name="description">{{ $scheme->financialYear?->financialYear }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Type</x-slot>
                        <x-slot name="description">{{ $scheme->scheme_type }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Water Source</x-slot>
                        <x-slot name="description">{{ $scheme->water_source ?? '-' }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Work Status</x-slot>
                        <x-slot name="description">{{ $scheme->work_status ?? '-' }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Energy Type</x-slot>
                        <x-slot name="description">{{ $scheme->energy_type ?? '-' }}</x-slot>
                    </x-description-list.item>

                    @if ($scheme->work_status?->value === 'handed-over')
                    <x-description-list.item>
                        <x-slot name="title">Handover Date</x-slot>
                        <x-slot name="description">{{ $scheme->handover_date?->format('d/m/Y') }}</x-slot>
                    </x-description-list.item>

                    @if ($scheme->handover_document_url)
                    <x-description-list.item>
                        <x-slot name="title">Handover Document</x-slot>
                        <x-slot name="description">
                            <x-button tag="a" target="_blank" href="{{ $scheme->handover_document_url }}" color="white"
                                with-icon icon="download">Handover Document
                            </x-button>
                        </x-slot>
                    </x-description-list.item>
                    @endif
                    @endif

                    <x-description-list.item>
                        <x-slot name="title">Operating Status</x-slot>
                        <x-slot name="description">{{ $scheme->operating_status ?? '-' }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Actual FHTC / Planned FHTC</x-slot>
                        <x-slot name="description">{{ (int) $scheme->achieved_fhtc }} /
                            {{ (int) $scheme->planned_fhtc }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Approved On</x-slot>
                        <x-slot name="description">{{ $scheme->approved_on }} | ({{ $scheme->slssc_year ?? 'N/A' }})
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Location</x-slot>
                        <x-slot name="description">
                            Latitude : <span class="text-xs italic bold">{{ $scheme->latitude ?? '-' }}</span> |
                            Longitude : <span class="text-xs italic">{{ $scheme->longitude ?? '-' }}</span>
                        </x-slot>
                    </x-description-list.item>

                </x-description-list>
            </div>

            <div class="mb-6">
                <x-description-list size="xs">
                    <x-slot name="heading">Scheme Administrative Details</x-slot>

                    <x-description-list.item>
                        <x-slot name="title">Zone</x-slot>
                        <x-slot name="description">{{ $scheme->division?->zone?->name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Office / Circle</x-slot>
                        <x-slot name="description">{{ $scheme->division?->circle?->name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Division</x-slot>
                        <x-slot name="description">{{ $scheme->division?->name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Sub-Division</x-slot>
                        <x-slot name="description">{{ $scheme->subdivision_names }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">District</x-slot>
                        <x-slot name="description">{{ $scheme->district?->name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">LAC</x-slot>
                        <x-slot name="description">{{ $scheme->lac?->name ?? '-' }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Block</x-slot>
                        <x-slot name="description">{{ $scheme->block_names ?? '-' }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Village</x-slot>
                        <x-slot name="description">{{ $scheme->villages?->pluck('village_name')->join(', ') }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Panchayat</x-slot>
                        <x-slot name="description">{{ $scheme->panchayats?->pluck('panchayat_name')->join(', ') }}
                        </x-slot>
                    </x-description-list.item>


                    <x-description-list.item>
                        <x-slot name="title">Habitation ID / Name / Population</x-slot>
                        {{-- <x-slot name="description">{{ $scheme->habitations?->pluck('habitation_name')->join(', ')
                            }}
                            --}}
                            <x-slot name="description">
                                @if ($scheme->habitations)
                                <div class="text-sm divide-y divide-gray-100">
                                    @foreach ($scheme->habitations as $hab)
                                    <div class="py-1">
                                        <div class="text-sm">
                                            {{ $hab->habitation_id }} / {{ $hab->habitation_name ?? '' }} /
                                            {{ $hab->population }}
                                        </div>
                                        <x-button color="cyan" tag="a" href="#" x-data class="w-30"
                                            x-on:click.prevent="Livewire.emit('schemesOfHabitationSlideover', '{{ $hab->id }}')"
                                            x-cloak>
                                            View Related Schemes
                                        </x-button>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </x-slot>
                    </x-description-list.item>
                </x-description-list>
            </div>

            <div class="mb-6">
                <x-description-list size="xs">
                    <x-slot name="heading">Scheme Cost Details</x-slot>

                    <x-description-list.item>
                        <x-slot name="title">Certral Share</x-slot>
                        <x-slot name="description">
                            {{ $scheme->central_share
                            ? Str::money($scheme->central_share) .
                            '
                            (' .
                            Str::numberToWords($scheme->central_share) .
                            ')'
                            : '-' }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">State Share</x-slot>
                        <x-slot name="description">
                            {{ $scheme->state_share
                            ? Str::money($scheme->state_share) .
                            '
                            (' .
                            Str::numberToWords($scheme->state_share) .
                            ')'
                            : '-' }}
                            {{-- {{ $scheme->state_share ?? "-" }} --}}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Total Cost of Scheme</x-slot>
                        <x-slot name="description">
                            {{ $scheme->total_cost
                            ? Str::money($scheme->total_cost) .
                            '
                            (' .
                            Str::numberToWords($scheme->total_cost) .
                            ')'
                            : '-' }}
                            {{-- {{ $scheme->total_cost ?? '-' }} --}}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Cost per FHTC</x-slot>
                        <x-slot name="description">
                            {{ $costPerFhtc }}
                        </x-slot>
                    </x-description-list.item>
                </x-description-list>
            </div>

        </x-card>

        {{--
        <livewire:schemes.imis-basic-details :imis="$scheme->imis_id" /> --}}
    </div>

    <x-card>
        <div class="mb-6">
            <x-description-list size="xs">
                <x-slot name="heading">Scheme SHG Details</x-slot>
                <x-description-list.item>
                    <x-slot name="title">SHG Name</x-slot>
                    <x-slot name="description">{{ $scheme->schemeShg?->shg_name ?? 'N/A' }}</x-slot>
                </x-description-list.item>
                <x-description-list.item>
                    <x-slot name="title">Contact Person Name</x-slot>
                    <x-slot name="description">{{ $scheme->schemeShg?->contact_person_name ?? 'N/A' }}</x-slot>
                </x-description-list.item>
                <x-description-list.item>
                    <x-slot name="title">Contact Number</x-slot>
                    <x-slot name="description">{{ $scheme->schemeShg?->contact_person_phone ?? 'N/A' }}</x-slot>
                </x-description-list.item>
                <x-description-list.item>
                    <x-slot name="title">SHG Id</x-slot>
                    <x-slot name="description">{{ $scheme->schemeShg?->shg_id ?? 'N/A' }}</x-slot>
                </x-description-list.item>
            </x-description-list>
        </div>
        <div class="mb-6">
            <x-description-list size="xs">
                <x-slot name="heading">ISA Details</x-slot>
                @forelse ($isas as $isa)
                <x-description-list.item>
                    <x-slot name="title">ISA</x-slot>
                    <x-slot name="description">
                        Name: {{ $isa->name }}
                        <p>Type : {{ $isa->type }}</p>
                        <p>Contact Details : {{ "$isa->contact_name ($isa->contact_phone)" }}</p>
                    </x-slot>
                </x-description-list.item>
                @empty
                <x-card-empty />
                @endforelse
            </x-description-list>
        </div>
        {{-- <x-description-list size="xs">
            <x-slot name="heading">Flow Meter Details</x-slot>
            @if ($scheme->flowmeterDetails->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Value</x-table.thead>
                            <x-table.thead>Updated By</x-table.thead>
                            <x-table.thead>Updated At</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scheme->flowmeterDetails as $fmDetails)
                        <tr>
                            <x-table.tdata>
                                {{ $fmDetails->value }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $fmDetails?->createdBy?->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $fmDetails->created_at->diffForHumans() }}
                            </x-table.tdata>
                            <x-table.tdata>
                                @if ($loop->last && $showFlowmeterDeleteButton)
                                <x-button-icon-delete href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                                                'scheme-flowmeter.delete',
                                                'showDeleteModal',
                                                '{{ $fmDetails->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this Flowmeter Reading?',
                                                '{{ $fmDetails->value }}'
                                            )" />
                                @else
                                -
                                @endif
                            </x-table.tdata>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
            @else
            <x-card-empty variant="">
                <p class="text-center text-slate-500 mb-3 text-sm">No details found.</p>
            </x-card-empty>
            @endif
        </x-description-list> --}}
    </x-card>

    <div class="mt-6">
        <x-card>
            <x-description-list size="xs">
                <x-slot name="heading">Item-Wise Progress</x-slot>
            </x-description-list>
            <div class="h-64">
                <div class="flex flex-nowrap overflow-x-auto items-center px-12 h-full w-full">
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->tp_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->tp_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            TP
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->ugr_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->ugr_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            UGR
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->esr_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->esr_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            ESR
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->pump_house_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->pump_house_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Pump House
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->apdcl_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->apdcl_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Apdcl
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->internal_connection_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->internal_connection_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Internal Connection
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->gen_set_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->gen_set_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Gen Set
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->lds_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->lds_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Lds
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->site_development_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->site_development_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Site Development
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->boundary_wall_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->boundary_wall_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Boundary Wall
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->painting_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->painting_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Painting
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->rwp_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->rwp_date ? 'bg-green-600' : 'bg-red-50' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Rwp
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->cwp_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->cwp_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Cwp
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->network_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->network_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Network
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->fhtc_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->fhtc_date ? 'bg-green-600' : 'bg-red-500'}}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Fhtc
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->trial_run_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->trial_run_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Trial Run
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->work_completion_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->work_completion_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Work Completion
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->scheme_handover_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->scheme_handover_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Scheme Handover
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->panchayat_verified_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->panchayat_verified_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Panchayat Verified
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->preliminary_workorder_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->preliminary_workorder_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Preliminary Workorder
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->preliminary_activities_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->preliminary_activities_date ? 'bg-green-600' : 'bg-red-500'}}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Preliminary Activities
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                    <div class="relative shrink-0">
                        <div
                            class="whitespace-nowrap absolute left-[20px] -top-[20px] transform -rotate-[60deg] text-sm origin-bottom-left">
                            {{ $scheme->schemeBinaryData?->formal_workorder_date?->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="p-1.5 rounded-full {{ $scheme->schemeBinaryData?->formal_workorder_date ? 'bg-green-600' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div
                            class="whitespace-nowrap absolute top-4 right-6 flex justify-end transform -rotate-[60deg] text-sm origin-top-right">
                            Formal Workorder
                        </div>
                    </div>
                    <div class="w-16 h-0.5 bg-slate-200 shrink-0"></div>
                </div>
            </div>
        </x-card>
    </div>

    <livewire:schemes.habitation-schemes-index />
    {{-- <livewire:scheme-flowmeter.delete /> --}}
</div>