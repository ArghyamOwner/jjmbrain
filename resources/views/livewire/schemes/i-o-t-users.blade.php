<div>
    <x-slot name="title">Scheme Schemes</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Scheme Dashboard
            </x-slot>
            {{-- @if(auth()->user()->isAdministrator())
            <x-slot name="action">
                <x-button tag="a" href="{{ route('schemes.create') }}" with-icon icon="add">New Scheme</x-button>
            </x-slot>
            @endif --}}
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered> 
        {{-- <x-heading size="md" class="mb-2">Schemes
            <div class="flex text-sm font-normal">Note:
                <x-icon-user class="mr-1 ml-1 text-red-600 w-4 h-4" />
                Indicates Jal Mitra is missing from the Handed Over Schemes.
            </div> 
            <div class="flex text-sm font-normal">
                <x-icon-flag class="mr-1 ml-10 text-green-600 w-4 h-4" />
                Indicates Scheme is Verified by Panchayat
            </div>
        </x-heading> --}}

        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search SMT ID / IMIS ID" name="search" wire:model.debounce.600ms="search"
                            placeholder="Search SMT ID / IMIS ID..." />
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

                    <x-select no-margin name="hasLocation" wire:model="hasLocation">
                        <option value="">--Location Option--</option>
                        <option value="without">Without Lat Long</option>
                        <option value="with">With Lat Long</option>
                    </x-select>

                    <x-select no-margin name="tracking" wire:model="tracking">
                        <option value="all">--Tracking Option--</option>
                        <option value="yes">Has Tracking</option>
                        <option value="incomplete">Incomplete Tracking</option>
                        <option value="no">Without Tracking</option>
                    </x-select>

                    <x-select no-margin name="pipeAttribute" wire:model="pipeAttribute">
                        <option value="all">--Pipe Attributes--</option>
                        <option value="yes">Has Attributes</option>
                        <option value="no">Without Attributes</option>
                    </x-select>

                    <x-select no-margin name="qrInstalled" wire:model="qrInstalled">
                        <option value="all">--QR Status--</option>
                        <option value="yes">QR Installed</option>
                        <option value="no">QR Not Installed</option>
                    </x-select>

                    <x-select no-margin name="workorders" wire:model="workorders">
                        <option value="all">--Workorders--</option>
                        <option value="yes">Has Workorder(s)</option>
                        <option value="no">Without Workorder(s)</option>
                    </x-select>
                    
                    <x-select no-margin name="fhtc" wire:model="fhtc">
                        <option value="all">--Beneficiaries--</option>
                        <option value="yes">Has Beneficiaries</option>
                        <option value="no">Without Beneficiaries</option>
                    </x-select>

                    <x-select no-margin name="imisIssue" wire:model="imisIssue">
                        <option value="all">--IMIS Issue--</option>
                        <option value="yes">Has IMIS Issue</option>
                    </x-select>

                    <x-select no-margin name="tpiProgress" wire:model="tpiProgress">
                        <option value="">--TPI Progress--</option>
                        <option value="no">Without Progress</option>
                        <option value="yes">With Progress</option>
                        <option value="upto_30">Below 30%</option>
                        <option value="upto_50">30-50% Progress</option>
                        <option value="upto_80">50-80% Progress</option>
                        <option value="upto_90">80-90% Progress</option>
                        <option value="above_90">Above 90% Progress</option>
                    </x-select>

                    <x-select no-margin name="without_subdivision" wire:model="without_subdivision">
                        <option value="">--Subdivision--</option>
                        <option value="yes">Without Subdivisions</option>
                        <option value="no">With Subdivisions</option>
                    </x-select>

                    <x-select no-margin name="hasWuc" wire:model="hasWuc">
                        <option value="">--WUC--</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                        <option value="multiple">Multiple</option>
                    </x-select>

                    <x-select no-margin name="has_litholog" wire:model="has_litholog">
                        <option value="">--Litholog--</option>
                        <option value="yes">With Litholog</option>
                        <option value="no">Without Litholog</option>
                    </x-select>

                    <x-select no-margin name="has_jm" wire:model="has_jm">
                        <option value="">--Jalmitra--</option>
                        <option value="yes">Has Jalmitra</option>
                        <option value="no">Without Jalmitra</option>
                    </x-select>
                </div>
            </div>
        </x-card>

        <x-card no-padding overflow-hidden>

            @if ($iotSchemes->isNotEmpty())
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Name / Type / IMIS-ID</x-table.thead>
                            <x-table.thead>Division</x-table.thead>
                            <x-table.thead>District</x-table.thead>
                            {{-- <x-table.thead>Work Status</x-table.thead> --}}
                            <x-table.thead>Operating Status</x-table.thead>
                            <x-table.thead>Device ID</x-table.thead>
                            <x-table.thead>MQTT Username</x-table.thead>
                            <x-table.thead>MQTT Password</x-table.thead>
                            <x-table.thead>IOT</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($iotSchemes as $iotScheme)
                        {{-- @json($scheme) --}}
                        <tr>
                            <x-table.tdata>
                                <x-text-hint >
                                    {{ $iotScheme->scheme->name }}
                                    @if ($iotScheme->scheme->work_status?->value === 'handed-over' && !$iotScheme->scheme->user_id)
                                    <x-icon-user class="ml-2 text-red-600 w-4 h-4" />
                                    @endif
                                    {{-- @if ($iotScheme->scheme->lithologs->isNotEmpty())
                                    <x-icon-building class="ml-2 text-red-600 w-4 h-4" />
                                    @endif --}}
                                    @if ($iotScheme->scheme->schemePanchayatVerification)
                                    <x-icon-flag class="ml-2 text-green-600 w-4 h-4" />
                                    @endif
                                </x-text-hint>
                                <p>
                                    {{ $iotScheme->scheme->scheme_type }}
                                </p>
                                <p class="text-xs">
                                    IMIS : {{ $iotScheme->scheme->imis_id ?? 'N/A' }} | SMT : {{ $iotScheme->scheme->old_scheme_id ?? 'N/A' }}
                                    @if($iotScheme->scheme->parent_id)
                                    <x-badge class="mb-2" variant="warning">Child Scheme</x-badge>
                                    @endif
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $iotScheme->scheme->division?->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $iotScheme->scheme->district?->name }}
                            </x-table.tdata>  
                            <x-table.tdata>
                                @if ($iotScheme->scheme->operating_status)
                                <x-badge variant="{{ $iotScheme->scheme->operating_status->color() }}">{{
                                    $iotScheme->scheme->operating_status->label() }}</x-badge>
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                @if ($iotScheme->iotDevice?->mqtt_device_id)
                                {{ $iotScheme->iotDevice?->mqtt_device_id }}
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $iotScheme->iotDevice?->mqtt_username }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $iotScheme->iotDevice?->mqtt_password }}
                            </x-table.tdata>
                            @if($iotScheme->iotDevice?->mqtt_device_id)
                            <x-table.tdata>
                                {{-- deviceid}/{schemeid --}}
                                <div class="flex space-x-1">
                                    <x-button-icon-iot href="{{ route('schemes.iot', ['deviceid'=> $iotScheme->iotDevice->mqtt_device_id, 'schemeid' => $iotScheme->iotDevice->scheme_id]  ) }}" />
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
        @if ($iotSchemes->hasPages())
        <div class="mt-5">{{ $iotSchemes->links() }}</div>
        @endif
    </x-section-centered>
</div>