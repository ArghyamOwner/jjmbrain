<div>
    <x-slot name="title">Water Disruption Report Details</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('no-water-report') }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                Water Disruption Report Details
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>
    <x-section-centered>
        <x-card overflow-hidden card-classes="mb-5">
            <div
                class="absolute inset-0 bg-grid-slate-400/20 bg-grid-3 -mt-px [mask-image:linear-gradient(180deg,black,transparent)]">
            </div>
            <div class="relative flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-6">
                <div class="flex-1">
                    {{-- <x-heading class="mb-4">Scheme Details</x-heading> --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                Scheme Operating Status
                            </div>
                            <p class="text-slate-900 text-sm">
                            <p class="text-slate-900 text-sm">
                                @if ($waterReport->operating_status && $waterReport->operating_status_from)
                                    <div class="flex">
                                        <x-badge
                                            variant="{{ $waterReport->operating_status_from->color() }}">{{ $waterReport->operating_status_from->label() }}</x-badge>
                                        <x-icon-arrow-right class="w-5 h-5" />
                                        <x-badge
                                            variant="{{ $waterReport->operating_status->color() }}">{{ $waterReport->operating_status->label() }}</x-badge>
                                    </div>
                                    @else
                                    --
                                @endif
                        </div>
                        <div>
                            <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                Scheme Name
                            </div>

                            {{ $waterReport->scheme?->name }}
                        </div>

                        <div>
                            <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                SMT ID
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $waterReport->scheme?->old_scheme_id }}
                            </p>
                        </div>

                        <div>
                            <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                IMIS ID
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $waterReport->scheme?->imis_id }}
                            </p>
                        </div>

                        <div>
                            <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                Date of Reporting
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $waterReport->created_at?->format('d F, Y') }}
                            </p>
                        </div>

                        <div>
                            <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                Reasons for disruption
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $waterReport->reasons_disruption }}
                            </p>
                        </div>
                        <div>
                            <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                Specific reasons for disruption
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{-- {{ $waterReport->specific_reasons }} --}}
                                {{ $waterReport->filtered_specific_reasons }}
                            </p>
                        </div>
                        <div>
                            <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                No. of days required to resolve water availability
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $waterReport->days }}
                            </p>
                        </div>
                        @if ($waterReport->resolved)
                            <div>
                                <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                    Resolved?
                                </div>
                                <p class="text-slate-900 text-sm">
                                    {{ $waterReport->resolved == true ? 'Yes' : 'No' }}
                                </p>
                            </div>
                            <div>
                                <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                    Date of Resolved
                                </div>
                                <p class="text-slate-900 text-sm">
                                    {{ $waterReport->resolved_date?->format('d F, Y') }}
                                </p>
                            </div>
                        @endif
                        @if ($waterReport->remarks)
                            <div>
                                <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                    Remarks
                                </div>
                                <p class="text-slate-900 text-sm">
                                    {{ $waterReport->remarks }}
                                </p>
                            </div>
                        @endif
                        @if ($waterReport->approvedBy)
                            <div>
                                <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                    Task Approved by
                                </div>
                                <p class="text-slate-900 text-sm">
                                    {{ $waterReport->approvedBy?->name }}
                                </p>
                            </div>
                            <div>
                                <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                    Task Approved on
                                </div>
                                <p class="text-slate-900 text-sm">
                                    {{ $waterReport->approved_date?->format('d F, Y') }}
                                </p>
                            </div>
                            @if ($waterReport->closedBy)
                                <div>
                                    <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                        Resolved Approved by
                                    </div>
                                    <p class="text-slate-900 text-sm">
                                        {{ $waterReport->closedBy?->name }}
                                    </p>
                                </div>
                                <div>
                                    <div class="uppercase text-xs tracking-wider text-slate-400 font-medium mb-1">
                                        Resolved Approved On
                                    </div>
                                    <p class="text-slate-900 text-sm">
                                        {{ $waterReport->updated_at?->format('d F, Y') }}
                                    </p>
                                </div>
                            @endif
                        @endif
                    </div>
                    {{-- Add Items --}}
                    @if (!$waterReport->resolved && auth()->user()->isSectionOfficer() && $waterReport->approved_by)
                        <div class="mt-8">
                            <x-checkbox no-margin name="isResolved" wire:model="isResolved" label="Resolved ?" />
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                <x-input type="date" label="Resolved date" name="resolvedDate"
                                    wire:model.defer="resolvedDate" max="{{ now()->format('Y-m-d') }}" />
                                <x-input label="Remarks" name="remarks" wire:model.defer="remarks" />
                            </div>
                            {{-- icon="refresh" --}}
                            <x-button type="button" wire:click="updateStatus" with-spinner wire:target="updateStatus">
                                Update
                            </x-button>
                        </div>
                    @endif
                    @if (!$waterReport->approved_by && auth()->user()->isSdo())
                        <div class="mt-8">
                            <x-button type="button" wire:click="approved" with-spinner wire:target="approved">
                                Approve
                            </x-button>
                        </div>
                    @endif
                    @if (!$waterReport->closed_by && $waterReport->resolved && auth()->user()->isSdo())
                        <div class="mt-8">
                            <x-select label="Operating Status" name="operating_status" wire:model="operating_status">
                                <option value="">--Select operating status--</option>
                                @foreach ($this->schemeOperatingStatuses as $schemeOperatingStatus)
                                    <option value="{{ $schemeOperatingStatus->value }}">
                                        {{ $schemeOperatingStatus->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-button type="button" wire:click="closed" with-spinner wire:target="closed">
                                Approve Issue Resolve
                            </x-button>
                        </div>
                    @endif
                </div>
            </div>
        </x-card></x-section-centered>
</div>
