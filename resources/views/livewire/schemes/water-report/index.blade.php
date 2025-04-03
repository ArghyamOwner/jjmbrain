<div>
    <div wire:init="getWaterReportsProperty"></div>
    <x-slot name="title">Water Disruption Report</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Water Disruption Report
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>
    <x-section-centered>
        <livewire:schemes.water-report.stats id="schemes-water-report-stats" />
        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: true }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search Scheme name, IMIS etc...." name="search"
                            wire:model.defer="search" placeholder="Search Scheme name, IMIS etc...." />
                    </div>
                    <div class="pt-6">
                        <div class="space-x-2 items-center">
                            {{-- <x-button type="button" color="white" x-on:click="showFilter = !showFilter">
                                <x-icon-filter class="w-4 h-4 mr-1 -ml-1" />Filter
                            </x-button> --}}
                            <x-button type="button" color="white" wire:click="resetFilter" wire:target="resetFilter"
                                with-spinner>
                                <x-icon-refresh class="w-4 h-4 mr-1 -ml-1" />Reset all
                            </x-button>
                        </div>
                    </div>
                </div>

                <div x-show="showFilter" x-collapse class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-x-4 sm:px-0 mb-4">
                    <x-select label="Select Division" no-margin name="division" wire:model="division">
                        <option value="all">--Select Division--</option>
                        @foreach ($this->divisions as $divisionKey => $divisionName)
                            <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Select Sub Division" no-margin name="sub_division" wire:model.defer="sub_division">
                        <option value="all">--Select Sub Division--</option>
                        @foreach ($this->sub_divisions as $sub_divisionsKey => $sub_divisionsName)
                            <option value="{{ $sub_divisionsKey }}">{{ $sub_divisionsName }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Reason for disruption" name="reasons_disruption" wire:model="reasons_disruption">
                        <option value="">--Select Reason Type--</option>
                        @foreach ($this->issueTypes as $key => $issue)
                            <option value="{{ $key }}">{{ $issue }}</option>
                        @endforeach
                    </x-select>
                    <x-virtual-select label="Specific reasons for disruption" name="specific_reasons"
                        wire:model.defer="specific_reasons" :options="[
                            'options' => $this->reasonsDisruption,
                            'multiple' => true,
                            'showValueAsTags' => true,
                        ]" custom-label />
                    <x-select label="Select Water Disruption Status" no-margin name="water_disruption_status"
                        wire:model.defer="water_disruption_status">
                        <option value="all">--Select Water Disruption Status--</option>
                        @foreach ($this->water_disruption_statuses as $statusKey => $statusName)
                            <option value="{{ $statusKey }}">{{ $statusName }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="flex space-x-6 items-center">
                    <x-button type="button" x-on:click.prevent="$wire.filterData()">Search</x-button>
                </div>

            </div>
        </x-card>

        <x-card no-padding overflow-hidden>
            @if ($this->waterReports->isNotEmpty())
                <div class="text-sm">
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Name | IMIS | SMT | Operating Status</x-table.thead>
                                <x-table.thead>Issue Status</x-table.thead>
                                <x-table.thead>Division | Sub-Division</x-table.thead>
                                {{-- <x-table.thead>Block</x-table.thead> --}}
                                {{-- <x-table.thead>Date of Reporting</x-table.thead> --}}
                                <x-table.thead>Reason | Specific Reasons</x-table.thead>
                                <x-table.thead>Date of Reporting | Date of Resolved</x-table.thead>
                                <x-table.thead>View</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->waterReports as $waterReport)
                                <tr>
                                    <x-table.tdata>
                                        {{-- {{ $waterReport->scheme?->old_scheme_id }} --}}
                                        <x-text-hint>
                                            {{ $waterReport->scheme?->name }}
                                        </x-text-hint>
                                        <p class="text-xs">
                                            IMIS : {{ $waterReport->scheme?->imis_id ?? 'N/A' }} | SMT :
                                            {{ $waterReport->scheme?->old_scheme_id ?? 'N/A' }}
                                        </p>
                                        @if ($waterReport->operating_status_from && $waterReport->operating_status)
                                           <div class="flex">
                                            <x-badge
                                            variant="{{ $waterReport->operating_status_from->color() }}">{{ $waterReport->operating_status_from->label() }}</x-badge>
                                            <x-icon-arrow-right class="w-5 h-5" />
                                        <x-badge
                                            variant="{{ $waterReport->operating_status->color() }}">{{ $waterReport->operating_status->label() }}</x-badge>
                                           </div>
                                        @endif
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $waterReport->water_disruption_status }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <div class="font-bold"> {{ $waterReport->scheme?->division?->name }}</div>
                                        <p>
                                            {{ $waterReport->scheme?->subdivision_names }}
                                        </p>
                                    </x-table.tdata>
                                    {{-- <x-table.tdata>
                                        {{ $waterReport->scheme?->blocks?->pluck('name')->implode(', ') }}
                                    </x-table.tdata>   --}}
                                    {{-- <x-table.tdata>
                                        {{ $waterReport->created_at?->format('d F, Y') ?? '--' }}
                                    </x-table.tdata> --}}
                                    <x-table.tdata>
                                        <div class="font-bold">
                                            {{ $waterReport->filtered_reasons_disruption }}
                                        </div>
                                        <p><x-readmore content="{{ $waterReport->filtered_specific_reasons ?? '-' }}"
                                                limit="20"
                                                link-class="text-indigo-600 underline whitespace-normal" /></p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $waterReport->created_at?->format('d F, Y') ?? '--' }}
                                        <p class="text-green-600 font-bold">
                                            {{ $waterReport->resolved_date?->format('d F, Y') ?? '--' }}</p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <div class="flex space-x-1">
                                            <x-button-icon-eye
                                                href="{{ route('no-water-report.show', $waterReport->id) }}" />
                                        </div>
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
            @else
                <x-card-empty class="shadow-none rounded-none" />
            @endif
        </x-card>
        @if ($this->waterReports->hasPages())
            <div class="mt-5">{{ $this->waterReports->links() }}</div>
        @endif
    </x-section-centered>
</div>
