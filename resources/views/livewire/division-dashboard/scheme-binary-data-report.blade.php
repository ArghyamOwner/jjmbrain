<div>
    <x-heading size="md" class="mb-2">Scheme Item-Wise Progress</x-heading>
    <x-card no-padding overflow-hidden>
        @if (count($data))
        <div>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead class="sticky left-0 z-10 text-left whitespace-nowrap">Name</x-table.thead>
                        <x-table.thead>Amount</x-table.thead>
                        <x-table.thead>Source</x-table.thead>
                        <x-table.thead>TP</x-table.thead>
                        <x-table.thead>UGR</x-table.thead>
                        <x-table.thead>ESR</x-table.thead>
                        <x-table.thead>Pump House</x-table.thead>
                        <x-table.thead>APDCL</x-table.thead>
                        <x-table.thead>Internal Connection</x-table.thead>
                        <x-table.thead>Gen Set</x-table.thead>
                        <x-table.thead>LDS</x-table.thead>
                        <x-table.thead>Site Development</x-table.thead>
                        <x-table.thead>Boundary Wall</x-table.thead>
                        <x-table.thead>Painting</x-table.thead>
                        <x-table.thead>RWP</x-table.thead>
                        <x-table.thead>CWP</x-table.thead>
                        <x-table.thead>Network</x-table.thead>
                        <x-table.thead>FHTC</x-table.thead>
                        <x-table.thead>Trail-run Completion</x-table.thead>
                        <x-table.thead>100% Work</x-table.thead>
                        <x-table.thead>Handover of Scheme</x-table.thead>
                        <x-table.thead>Verified by Panchayat</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $result)
                    <tr>
                        <x-table.tdata
                            class="md:w-1/5 sticky left-0 z-10 bg-white text-left whitespace-nowrap leading-none">
                            <x-text-link href="{{ route('schemes.show', $result['id']) }}">
                                {{ $result['name'] }}
                            </x-text-link>
                            <p class="text-xs">IMIS ID : {{ $result['imis_id'] }}</p>
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ Str::money($result['amount'] ?? 0) }}
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['source'] === 'yes')

                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['source_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['tp'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['tp_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['ugr'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['ugr_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['esr'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['esr_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['pump_house'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['pump_house_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['apdcl'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['apdcl_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['internal_connection'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['internal_connection_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['gen_set'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['gen_set_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['lds'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['lds_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['site_development'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['site_development_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['boundary_wall'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['boundary_wall_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['painting'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['painting_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['rwp'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['rwp_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['cwp'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['cwp_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['network'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['network_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['fhtc'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['fhtc_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['trial_run'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['trial_run_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['work_completion'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['work_completion_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['scheme_handover'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['scheme_handover_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($result['panchayat_verified'] === 'yes')
                            <x-icon-check-circle class="text-green-600 w-5 hover:bg-gray-100 hover:text-red-500"
                                x-data="{ tooltip: '{{ $result['panchayat_verified_date'] }}' }" x-tooltip="tooltip" />
                            @else
                            <x-icon-xclose class="text-red-600 w-5" />
                            @endif
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
</div>