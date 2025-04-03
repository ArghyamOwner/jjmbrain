<div>
    <div class="mb-6 mt-4">
        <x-card>
            TPI Progress

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-6 mt-4">
                <x-pie-chart legend-align="center" :labels="$keys" :data="$data" />

                <div class="grid grid-cols-2 gap-2 mb-6 mt-4 p-6">
                    <x-button class="bg-green-100 h-16 border-green-400 leading-none" color="white" tag="a" href="{{ route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'above_90']) }}">
                        <div class="flex text-left space-x-3 -ml-16">
                            <div>
                                <span class="font-medium">{{ (int)$tpiData->where('key',
                                    'tpi_above_90')->first()?->value
                                    ?? 'N/A' }}</span>
                                <div class="flex space-x-1 text-left leading-tight mt-1">
                                    <span class="text-sm leading-none">Progress Above 90</span>
                                </div>
                            </div>
                        </div>
                    </x-button>

                    <x-button class="bg-indigo-100 h-16 border-indigo-400 leading-none" color="white" tag="a" href="{{ route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'upto_90']) }}">
                        <div class="flex text-left space-x-3 -ml-16">
                            <div>
                                <span class="font-medium">{{ (int)$tpiData->where('key',
                                    'tpi_upto_90')->first()?->value ?? 'N/A' }}</span>
                                <div class="flex space-x-1 text-left leading-tight mt-1">
                                    <span class="text-sm leading-none">80-90% Progress</span>
                                </div>
                            </div>
                        </div>
                    </x-button>

                    <x-button class=" bg-yellow-100 h-16 border-yellow-300 grid-rows-2 leading-none" color="white"
                        tag="a" href="{{ route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'upto_80']) }}">
                        <div class="flex text-left space-x-3 -ml-16">
                            <div>
                                <span class="font-medium">{{ (int)$tpiData->where('key',
                                    'tpi_upto_80')->first()?->value ?? 'N/A' }}</span>
                                <div class="flex space-x-1 text-left leading-tight mt-1">
                                    <span class="text-sm leading-none">50-80% Progress</span>
                                </div>
                            </div>
                        </div>
                    </x-button>

                    <x-button class=" bg-orange-100 h-16 border-orange-300 leading-none" color="white"
                        tag="a" href="{{ route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'upto_50']) }}">
                        <div class="flex space-x-3 -ml-16">
                            <div>
                                <span class="font-medium">{{ (int)$tpiData->where('key',
                                    'tpi_upto_50')->first()?->value ?? 'N/A' }}</span>
                                <div class="flex space-x-1 leading-tight mt-1">
                                    <span class="text-sm leading-none">30-50% Progress</span>
                                </div>
                            </div>
                        </div>
                    </x-button>

                    <x-button class=" bg-teal-100 h-16 border-teal-300 leading-none" color="white"
                        tag="a" href="{{ route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'upto_30']) }}">
                        <div class="flex space-x-3 -ml-16">
                            <div>
                                <span class="font-medium">{{ (int)$tpiData->where('key',
                                    'tpi_upto_30')->first()?->value ?? 'N/A' }}</span>
                                <div class="flex space-x-1 leading-tight mt-1">
                                    <span class="text-sm leading-none">Below 30% Progress</span>
                                </div>
                            </div>
                        </div>
                    </x-button>



                    <x-button class="bg-red-100 h-16 border-red-400 leading-none" color="white" tag="a" href="{{ route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'no']) }}">
                        <div class="flex space-x-3 -ml-16">
                            <div>
                                <span class="font-medium">{{ (int)$tpiData->where('key',
                                    'without_tpi_progress')->first()?->value ?? 'N/A' }}</span>
                                <div class="flex space-x-1 leading-tight mt-1">
                                    <span class="text-sm leading-none">Without TPI Progress</span>
                                </div>
                            </div>
                        </div>
                    </x-button>
                </div>
            </div>
        </x-card>
    </div>
</div>