<div>
    <x-slot name="title">All Schemes</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Schemes Dashboard
            </x-slot>
            @if (auth()->user()->isAdministrator())
                <x-slot name="action">
                    <x-button tag="a" href="{{ route('schemes.create') }}" with-icon icon="add">New
                        Scheme</x-button>
                </x-slot>
            @endif
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        @unless (auth()->user()->isPanchayat())
            {{-- <div class="mb-8">
            <livewire:schemes.stats />
        </div> --}}
        @endunless

        <x-heading size="md" class="mb-2">Schemes
            <div class="flex text-sm font-normal">Note:
                <x-icon-user class="mr-1 ml-1 text-red-600 w-4 h-4" />
                Indicates Jal Mitra is missing from the Handed Over Schemes.
            </div>
            {{-- <div class="flex text-sm font-normal">
                <x-icon-building class="mr-1 ml-10 text-red-600 w-4 h-4" />
                Indicates Lithog data for the scheme exists
            </div> --}}
            <div class="flex text-sm font-normal">
                <x-icon-flag class="mr-1 ml-10 text-green-600 w-4 h-4" />
                Indicates Scheme is Verified by Panchayat
            </div>
        </x-heading>

        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: true }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search SMT ID / IMIS ID" name="search"
                            wire:model.defer="search" placeholder="Search SMT ID / IMIS ID..." />
                    </div>
                    <div class="pt-6">
                        <div class="space-x-2 items-center">
                            <x-button type="button" color="white" x-on:click="showFilter = !showFilter">
                                <x-icon-filter class="w-4 h-4 mr-1 -ml-1" />Filter
                            </x-button>
                            <x-button type="button" color="white" wire:click="resetFilter" wire:target="resetFilter"
                                with-spinner>
                                <x-icon-refresh class="w-4 h-4 mr-1 -ml-1" />Reset all
                            </x-button>
                        </div>
                    </div>
                </div>

                <div x-show="showFilter" x-collapse
                    class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-4 sm:px-0">
                    <x-select no-margin name="division" wire:model="division">
                        <option value="all">--Select Division--</option>
                        @foreach ($this->divisions as $divisionKey => $divisionName)
                            <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="district" wire:model="district">
                        <option value="all">--Select District--</option>
                        @foreach ($this->districts as $districtKey => $districtName)
                            <option value="{{ $districtKey }}">{{ $districtName }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="block" wire:model="block">
                        <option value="all">--Select Block--</option>
                        @foreach ($this->blocks as $blockKey => $blockName)
                            <option value="{{ $blockKey }}">{{ $blockName }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="panchayat" wire:model="panchayat">
                        <option value="all">--Select Panchayat--</option>
                        @foreach ($this->panchayats as $panchayatKey => $panchayatName)
                            <option value="{{ $panchayatKey }}">{{ $panchayatName }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="status" wire:model.defer="status">
                        <option value="all">--Work Status--</option>
                        @foreach ($this->schemeStatuses as $scheme)
                            <option value="{{ $scheme->value }}">{{ Str::title($scheme->name) }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="operating_status" wire:model.defer="operating_status">
                        <option value="all">--Operating Status--</option>
                        @foreach ($this->operatingStatuses as $scheme)
                            <option value="{{ $scheme->value }}">{{ Str::title($scheme->name) }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="showType" wire:model.defer="showType">
                        <option value="">--Select Option--</option>
                        <option value="parent">Parent Schemes</option>
                        <option value="child">Child Schemes</option>
                    </x-select>

                    <x-select no-margin name="hasLocation" wire:model.defer="hasLocation">
                        <option value="">--Location Option--</option>
                        <option value="without">Without Lat Long</option>
                        <option value="with">With Lat Long</option>
                    </x-select>

                    <x-select no-margin name="tracking" wire:model.defer="tracking">
                        <option value="all">--Tracking Option--</option>
                        <option value="yes">Has Tracking</option>
                        <option value="incomplete">Incomplete Tracking</option>
                        <option value="no">Without Tracking</option>
                    </x-select>

                    <x-select no-margin name="pipeAttribute" wire:model.defer="pipeAttribute">
                        <option value="all">--Pipe Attributes--</option>
                        <option value="yes">Has Attributes</option>
                        <option value="no">Without Attributes</option>
                    </x-select>

                    <x-select no-margin name="qrInstalled" wire:model.defer="qrInstalled">
                        <option value="all">--QR Status--</option>
                        <option value="yes">QR Installed</option>
                        <option value="no">QR Not Installed</option>
                    </x-select>

                    <x-select no-margin name="workorders" wire:model.defer="workorders">
                        <option value="all">--Workorders--</option>
                        <option value="yes">Has Workorder(s)</option>
                        <option value="no">Without Workorder(s)</option>
                    </x-select>

                    <x-select no-margin name="fhtc" wire:model.defer="fhtc">
                        <option value="all">--Beneficiaries--</option>
                        <option value="yes">Has Beneficiaries</option>
                        <option value="no">Without Beneficiaries</option>
                    </x-select>

                    <x-select no-margin name="imisIssue" wire:model.defer="imisIssue">
                        <option value="all">--IMIS Issue--</option>
                        <option value="yes">Has IMIS Issue</option>
                    </x-select>

                    <x-select no-margin name="tpiProgress" wire:model.defer="tpiProgress">
                        <option value="">--TPI Progress--</option>
                        <option value="no">Without Progress</option>
                        <option value="yes">With Progress</option>
                        <option value="upto_30">Below 30%</option>
                        <option value="upto_50">30-50% Progress</option>
                        <option value="upto_80">50-80% Progress</option>
                        <option value="upto_90">80-90% Progress</option>
                        <option value="above_90">Above 90% Progress</option>
                    </x-select>

                    <x-select no-margin name="without_subdivision" wire:model.defer="without_subdivision">
                        <option value="">--Subdivision--</option>
                        <option value="yes">Without Subdivisions</option>
                        <option value="no">With Subdivisions</option>
                    </x-select>

                    <x-select no-margin name="hasWuc" wire:model.defer="hasWuc">
                        <option value="">--WUC--</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                        <option value="multiple">Multiple</option>
                    </x-select>

                    <x-select no-margin name="has_litholog" wire:model.defer="has_litholog">
                        <option value="">--Litholog--</option>
                        <option value="yes">With Litholog</option>
                        <option value="no">Without Litholog</option>
                    </x-select>

                    <x-select no-margin name="has_jm" wire:model.defer="has_jm">
                        <option value="">--Jalmitra--</option>
                        <option value="yes">Has Jalmitra</option>
                        <option value="no">Without Jalmitra</option>
                    </x-select>

                    <x-select no-margin name="has_so" wire:model.defer="has_so">
                        <option value="">--Section Officers--</option>
                        <option value="yes">Has SO</option>
                        <option value="no">Without SO</option>
                    </x-select>
                    <x-select no-margin name="has_iot" wire:model.defer="has_iot">
                        <option value="">--Section IOT--</option>
                        <option value="yes">Has IOT</option>
                        <option value="no">Without IOT</option>
                    </x-select>

                    <x-select no-margin name="fundingAgency" wire:model.defer="fundingAgency">
                        <option value="">--Funding Agency--</option>
                        @foreach ($agencies as $agency)
                            <option value="{{ $agency }}">{{ $agency }}</option>
                        @endforeach
                    </x-select>

                    <div class="flex space-x-6 mb-6 items-center">
                        <x-button type="button" x-on:click.prevent="$wire.filterData()">Filter</x-button>
                    </div>
                </div>

            </div>
        </x-card>

        <x-card no-padding overflow-hidden>

            @if ($schemes->isNotEmpty())
                <div class="text-sm">
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead></x-table.thead>
                                <x-table.thead>Name / Type / IMIS-ID</x-table.thead>
                                <x-table.thead>Division</x-table.thead>
                                <x-table.thead>District</x-table.thead>
                                {{-- <x-table.thead>Block</x-table.thead> Removed For Optimization --}}
                                {{-- <x-table.thead>Type</x-table.thead> --}}
                                {{-- <x-table.thead>Scheme Status</x-table.thead> --}}
                                <x-table.thead>Work Status</x-table.thead>
                                <x-table.thead>Operating Status</x-table.thead>
                                <x-table.thead>Beneficiaries</x-table.thead>
                                @if ($showEditButton)
                                    <x-table.thead>Action</x-table.thead>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ dd($schemes) }} --}}
                            @foreach ($schemes as $scheme)
                                <tr>
                                    <x-table.tdata>
                                        @if ($scheme->verified_by)
                                            <x-icon-check-circle class="inline-block  text-green-600 w-6 h-6" />
                                        @else
                                            <x-icon-exclamation-circle class="inline-block  text-red-600 w-6 h-6" />
                                        @endif
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-text-link
                                            href="{{ route('schemes.show', [$scheme->id, 'tab' => 'details']) }}">
                                            {{ $scheme->name }}
                                            @if ($scheme?->work_status?->value === 'handed-over' && !$scheme->user_id)
                                                <x-icon-user class="ml-2 text-red-600 w-4 h-4" />
                                            @endif
                                            {{-- @if ($scheme->lithologs->isNotEmpty())
                                    <x-icon-building class="ml-2 text-red-600 w-4 h-4" />
                                    @endif --}}
                                            @if ($scheme->schemePanchayatVerification)
                                                <x-icon-flag class="ml-2 text-green-600 w-4 h-4" />
                                            @endif
                                        </x-text-link>
                                        <p>
                                            {{ $scheme->scheme_type }}
                                        </p>
                                        <p class="text-xs">
                                            IMIS : {{ $scheme->imis_id ?? 'N/A' }} | SMT :
                                            {{ $scheme->old_scheme_id ?? 'N/A' }}
                                            @if ($scheme->parent_id)
                                                <x-badge class="mb-2" variant="warning">Child Scheme</x-badge>
                                            @endif
                                        </p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $scheme->division?->name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $scheme->district?->name }}
                                    </x-table.tdata>

                                    {{-- Removed Blocks for optimization --}}

                                    {{-- <x-table.tdata>
                                <x-readmore content="{{ $scheme->block_names ?? '-' }}" limit="15"
                                    link-class="text-indigo-600 underline whitespace-normal" />
                            </x-table.tdata> --}}


                                    {{-- <x-table.tdata>
                                {{ $scheme->scheme_type }}
                            </x-table.tdata> --}}
                                    {{-- <x-table.tdata>
                                @if ($scheme->scheme_status)
                                <x-badge variant="{{ $scheme->scheme_status->color() }}">{{ $scheme->scheme_status }}
                                </x-badge>
                                @endif
                            </x-table.tdata> --}}
                                    <x-table.tdata>
                                        @if ($scheme->work_status)
                                            <x-badge
                                                variant="{{ $scheme->work_status->color() }}">{{ $scheme->work_status->label() }}</x-badge>
                                            @if ($scheme->work_status->value == "handed-over")
                                                <p class="mt-1">
                                                    <x-badge variant="{{ $scheme->dlp_badge_color }}"
                                                        class="mb-2">DLP
                                                        days
                                                        left:
                                                        {{ $scheme->dlp_days_left }}</x-badge>
                                                </p>
                                                @else
                                            @endif
                                        @endif
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        @if ($scheme->operating_status)
                                            <x-badge
                                                variant="{{ $scheme->operating_status->color() }}">{{ $scheme->operating_status->label() }}</x-badge>
                                        @endif
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ (int) $scheme->achieved_fhtc }} / {{ (int) $scheme->planned_fhtc }}
                                    </x-table.tdata>
                                    @if ($showEditButton)
                                        <x-table.tdata>
                                            <div class="flex space-x-1">
                                                <x-button-icon-edit href="{{ route('schemes.edit', $scheme->id) }}" />
                                            </div>
                                        </x-table.tdata>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
            @else
                <x-card-empty class="shadow-none rounded-none" />
            @endif
        </x-card>
        @if ($schemes->hasPages())
            <div class="mt-5">{{ $schemes->links() }}</div>
        @endif
    </x-section-centered>
</div>
