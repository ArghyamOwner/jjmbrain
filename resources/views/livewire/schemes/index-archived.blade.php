<div>
    <x-slot name="title">Archived Schemes</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Archived Schemes
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-heading size="md" class="mb-2">
            <div class="flex text-sm font-normal">Note:
                <x-icon-user class="mr-1 ml-1 text-red-600 w-4 h-4" />
                Indicates Jal Mitra is missing from the Handed Over Schemes.
            </div>
            <div class="flex text-sm font-normal">
                <x-icon-building class="mr-1 ml-10 text-red-600 w-4 h-4" />
                Indicates Lithog data for the scheme exists
            </div>
            <div class="flex text-sm font-normal">
                <x-icon-flag class="mr-1 ml-10 text-green-600 w-4 h-4" />
                Indicates Scheme is Verified by Panchayat
            </div>
        </x-heading>

        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search" name="search" wire:model.debounce.600ms="search"
                            placeholder="Search schemes..." />
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

                    <x-select no-margin name="status" wire:model="status">
                        <option value="all">--Work Status--</option>
                        @foreach ($this->schemeStatuses as $scheme)
                        <option value="{{ $scheme->value }}">{{ Str::title($scheme->name) }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="operating_status" wire:model="operating_status">
                        <option value="all">--Operating Status--</option>
                        @foreach ($this->operatingStatuses as $scheme)
                        <option value="{{ $scheme->value }}">{{ Str::title($scheme->name) }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="showType" wire:model="showType">
                        <option value="">--Select Option--</option>
                        <option value="parent">Parent Schemes</option>
                        <option value="child">Child Schemes</option>
                    </x-select>
                </div>
            </div>
        </x-card>

        <x-card no-padding overflow-hidden>
            {{-- <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                        placeholder="Search schemes..." />
                </div>
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

                <x-select no-margin name="status" wire:model="status">
                    <option value="all">--Work Status--</option>
                    @foreach ($this->schemeStatuses as $scheme)
                    <option value="{{ $scheme->value }}">{{ Str::title($scheme->name) }}</option>
                    @endforeach
                </x-select>

                <x-select no-margin name="operating_status" wire:model="operating_status">
                    <option value="all">--Operating Status--</option>
                    @foreach ($this->operatingStatuses as $scheme)
                    <option value="{{ $scheme->value }}">{{ Str::title($scheme->name) }}</option>
                    @endforeach
                </x-select>
            </div> --}}

            @if ($schemes->isNotEmpty())
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead></x-table.thead>
                            <x-table.thead>Name / Type / IMIS-ID</x-table.thead>
                            <x-table.thead>Division</x-table.thead>
                            <x-table.thead>District</x-table.thead>
                            <x-table.thead>Block</x-table.thead>
                            {{-- <x-table.thead>Type</x-table.thead> --}}
                            {{-- <x-table.thead>Scheme Status</x-table.thead> --}}
                            <x-table.thead>Work Status</x-table.thead>
                            <x-table.thead>Operating Status</x-table.thead>
                            <x-table.thead>Beneficiaries</x-table.thead>
                            {{-- <x-table.thead>Action</x-table.thead> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ dd($schemes) }} --}}
                        @foreach ($schemes as $scheme)
                        <tr>
                            <x-table.tdata>
                                @if($scheme->verified_by)
                                <x-icon-check-circle class="inline-block  text-green-600 w-6 h-6" />
                                @else
                                <x-icon-exclamation-circle class="inline-block  text-red-600 w-6 h-6" />
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-text-link href="#">
                                    {{ $scheme->name }}
                                    @if ($scheme?->work_status?->value === 'handed-over' && !$scheme->user)
                                    <x-icon-user class="ml-2 text-red-600 w-4 h-4" />
                                    @endif
                                    @if ($scheme->lithologs_exists)
                                    <x-icon-building class="ml-2 text-red-600 w-4 h-4" />
                                    @endif
                                    @if ($scheme->schemePanchayatVerification)
                                    <x-icon-flag class="ml-2 text-green-600 w-4 h-4" />
                                    @endif
                                </x-text-link>
                                <p>
                                    {{ $scheme->scheme_type }}
                                </p>
                                <p>
                                    IMIS-ID : {{ $scheme->imis_id ?? 'N/A' }}
                                    @if($scheme->parent_id)
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
                            <x-table.tdata>
                                {{-- {{ $scheme->block?->name }} --}}
                                <x-readmore content="{{ $scheme->block_names ?? '-' }}" limit="15"
                                    link-class="text-indigo-600 underline whitespace-normal" />
                            </x-table.tdata>
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
                                <x-badge variant="{{ $scheme->work_status->color() }}">{{ $scheme->work_status->label()
                                    }}</x-badge>
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                @if ($scheme->operating_status)
                                <x-badge variant="{{ $scheme->operating_status->color() }}">{{
                                    $scheme->operating_status->label() }}</x-badge>
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ (int) $scheme->achieved_fhtc }} / {{ (int) $scheme->planned_fhtc }}
                            </x-table.tdata>
                            {{-- <x-table.tdata>
                                <div class="flex space-x-1">
                                    <x-button-icon-edit href="{{ route('schemes.edit', $scheme->id) }}" />
                                </div>
                            </x-table.tdata> --}}
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