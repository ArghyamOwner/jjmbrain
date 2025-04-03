<div>
    <x-slot name="title">Workorder Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('workorders') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Workorder Details
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <x-card>
                    <x-description-list size="xs">

                        <x-description-list.item>
                            <x-slot name="title">Issuing Authority</x-slot>
                            <x-slot name="description">
                                {{ $workorder->issuing_authority }}
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Office</x-slot>
                            <x-slot name="description">
                                {{ $workorder->circle?->name ?? '-' }}
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Division</x-slot>
                            <x-slot name="description">
                                {{ $workorder->division?->name ?? '-' }}
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Workorder Number</x-slot>
                            <x-slot name="description">{{ $workorder->workorder_number }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Workorder Date</x-slot>
                            <x-slot name="description">{{ $workorder->workorder_estimated_date?->format('j M, Y') }}
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Contractor Name</x-slot>
                            <x-slot name="description">
                                @if ($workorder->contractor && $workorder->contractor->contractor)
                                {{-- {{ dd($workorder->contractor) }} --}}
                                <x-text-link
                                    href="{{ route('contractors.show', $workorder->contractor->contractor->id) }}">
                                    {{ $workorder->contractor?->name }}
                                </x-text-link>
                                @else
                                {{ $workorder->contractor?->name ?? 'N / A' }}
                                @endif
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Workorder Type</x-slot>
                            <x-slot name="description">{{ $workorder->workorder_type }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Workorder Status</x-slot>
                            <x-slot name="description">{{ $workorder->workorder_status ?? 'ongoing' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Workorder Amount</x-slot>
                            <x-slot name="description">{{ Str::money($workorder->workorder_amount ?? 0) }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Workorder PG Status</x-slot>
                            <x-slot name="description">{{ $workorder->pg_status }}</x-slot>
                        </x-description-list.item>

                        {{-- <x-description-list.item>
                            <x-slot name="title">Attached Schemes</x-slot>
                            <x-slot name="description">{{ $workorder->schemes?->pluck('name')->join(',') }}</x-slot>
                        </x-description-list.item> --}}

                    </x-description-list>
                </x-card>

                <x-card>
                    <x-heading size="md" class="mb-2">Quick Actions</x-heading>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        {{-- <x-button class="truncate" tag="a" href="{{ route('pg.create', $workorder->id) }}"
                            color="white" with-icon icon="add">Add New PG</x-button> --}}
                        <x-button class="truncate" tag="a" href="#" color="white" with-icon icon="edit" x-data
                            x-on:click.prevent="Livewire.emit('updateDivisionSlideover', '{{ $workorder->id }}')"
                            x-cloak>Update Division</x-button>

                        <x-button class="truncate" tag="a" href="{{ route('workorders.assignTasks', $workorder->id) }}"
                            color="white" with-icon icon="link">Assign Task</x-button>
                        <x-button class="truncate" tag="a" href="{{ route('workorders.assignScheme', $workorder->id) }}"
                            color="white" with-icon icon="link">Attached Scheme</x-button>

                        <x-button class="truncate" tag="a" href="{{ route('workorders.progress', $workorder->id) }}"
                            color="white" with-icon icon="eye">View Progress</x-button>
                        {{-- <x-button class="truncate" tag="a" href="#" color="white" with-icon icon="eye">TPA Report --}}
                        {{-- </x-button> --}}
                        <x-button class="truncate" tag="a" href="{{ route('workorders.edit', $workorder->id) }}"
                            color="white" with-icon icon="edit">Edit Workorder</x-button>
                        <x-button class="truncate" tag="a" href="#" color="white" with-icon icon="eye">WO Details
                        </x-button>
                        <x-button class="truncate" tag="a" href="#" color="white" with-icon icon="info-circle" x-data
                            x-on:click.prevent="Livewire.emit('updateWorkorderStatusSlideover', '{{ $workorder->id }}')"
                            x-cloak>Update Status</x-button>

                        <x-button tag="a" href="#" color="white" with-icon icon="trash" class="text-red-600" x-data=""
                            x-cloak x-on:click.prevent="$wire.emitTo(
                            'workorders.delete',
                            'showDeleteModal',
                            '{{ $workorder->id }}',
                            'Confirm Deletion',
                            'Are you sure you want to remove this task & its associated subtasks details?'
                            {{-- '{{ $workorder->name }}' --}}
                        )">Delete
                            task</x-button>
                    </div>
                </x-card>
            </div>

            <div class="mb-6">
                <x-card>
                    <x-heading size="md" class="mb-2">Workorder Documents</x-heading>

                    <x-card>
                        <x-description-list size="xs">

                            <x-description-list.item>
                                <x-slot name="title">Documents</x-slot>
                                <x-slot name="description">
                                    @forelse ( $workorder->workdocuments as $document )
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                        <x-button class="truncate" target="_blank" tag="a"
                                            href="{{ $document->document_url }}" x-data="" color="white" with-icon
                                            icon="download">
                                            Download Document</x-button>
                                    </div>
                                    @empty
                                        -
                                    @endforelse 
                                </x-slot>
                            </x-description-list.item>

                            <x-description-list.item>
                                <x-slot name="title">TS Number</x-slot>
                                <x-slot name="description">
                                    {{ $workorder->ts_number ?? '-' }}
                                </x-slot>
                            </x-description-list.item>

                            <x-description-list.item>
                                <x-slot name="title">TS Date</x-slot>
                                <x-slot name="description">
                                    {{ $workorder->ts_date ?? '-'}}
                                </x-slot>
                            </x-description-list.item>

                            <x-description-list.item>
                                <x-slot name="title">TS Amount</x-slot>
                                <x-slot name="description">
                                    {{ $workorder->ts_amount ? Str::money($workorder->ts_amount) : '-' }}
                                </x-slot>
                            </x-description-list.item>

                        </x-description-list>
                    </x-card>

                </x-card>
            </div>

            <div class="mb-6">
                <livewire:workorders.associated-schemes :workorder-id="$workorder->id" />
            </div>

            <livewire:workorders.performance-guarantees :workorder-id="$workorder->id"
                :workorder-status="$workorder->pg_status" :workorder-pg-amount="$workorder->pg_amount" />

            {{--
            <livewire:workorders.delete /> --}}
        </x-section-centered>
        <livewire:workorders.update-division />

        <livewire:workorders.update-status />
</div>