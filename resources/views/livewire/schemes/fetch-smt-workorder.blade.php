<div>
    <x-slot name="title">Fetch Workorder</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $schemeId) }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                Scheme : {{ $schemeName }}
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-card card-classes="whitespace-normal">
                <div class="mb-2">
                    @if(count($workorderDetails) && $workorderDetails['status'] == 200)
                    <x-description-list size="xs">
                        <x-slot name="heading">SMT Workorder Details</x-slot>
                        {{-- {{ dd($workorderDetails) }} --}}
                        <x-description-list.item>
                            <x-slot name="title">SMT Workorder ID</x-slot>
                            <x-slot name="description">{{ $workorderDetails['workorder']['workOrderId'] }}
                            </x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">SMT Scheme ID</x-slot>
                            <x-slot name="description">{{ $workorderDetails['workorder']['scheme_id'] }}
                            </x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Issuing Authority</x-slot>
                            <x-slot name="description">{{ $workorderDetails['workorder']['issuingAuthority'] }}
                            </x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Contractor Bid Id</x-slot>
                            <x-slot name="description">{{ $workorderDetails['workorder']['contractor_bid'] }}
                            </x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Workorder Number</x-slot>
                            <x-slot name="description">{{ $workorderDetails['workorder']['workorder_number'] }}
                            </x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Workorder Amount</x-slot>
                            <x-slot name="description">{{ $workorderDetails['workorder']['workorder_amount'] }}
                            </x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Workorder Estimated Date</x-slot>
                            <x-slot name="description">{{
                                $workorderDetails['workorder']['workorder_estimated_date'] }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">PG Status</x-slot>
                            <x-slot name="description">{{ $workorderDetails['workorder']['pg_status'] }}
                            </x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Workorder Status</x-slot>
                            <x-slot name="description">{{ $workorderDetails['workorder']['workorder_status'] }}
                            </x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Formal Workorder Number</x-slot>
                            <x-slot name="description">{{
                                $workorderDetails['workorder']['formal_workorder_number'] }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Formal Workorder Date</x-slot>
                            <x-slot name="description">{{
                                $workorderDetails['workorder']['formal_workorder_date'] }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Formal Workorder Amount</x-slot>
                            <x-slot name="description">{{
                                $workorderDetails['workorder']['formal_workorder_amount'] }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">TS Amount</x-slot>
                            <x-slot name="description">{{ $workorderDetails['workorder']['ts_amount'] }}
                            </x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">TS Document</x-slot>
                            <x-slot name="description">
                                {{ basename($workorderDetails['workorder']['ts_document']) }}
                            </x-slot>
                        </x-description-list.item>
                    </x-description-list>  

                    {{-- @if($brainWorkorders->isNotEmpty()) --}}
                    <x-button class="truncate w-full mt-4" wire:click="updateDataFromSmt"
                        with-icon icon="file">Save this Data</x-button>
                    {{-- @endif     --}}

                    @else
                    <x-card-empty class="shadow-none rounded-none" />
                    @endif
                </div>
            </x-card>
            @foreach ($brainWorkorders as $workorder)    
                <x-card>
                    <div class="mb-6">
                        <x-description-list size="xs">
                            <x-slot name="heading">Brain Workorder Details</x-slot>
                            {{-- {{ dd($workorderDetails) }} --}}
                            <x-description-list.item>
                                <x-slot name="title">SMT Workorder ID</x-slot>
                                <x-slot name="description">{{ $workorder->old_workorder_id }}
                                </x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">SMT Scheme ID</x-slot>
                                <x-slot name="description">{{ $workorder->scheme_smt_ids }}
                                </x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">Issuing Authority</x-slot>
                                <x-slot name="description">{{ $workorder->issuing_authority }}
                                </x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">Contractor Bid Id</x-slot>
                                <x-slot name="description">{{ $workorder->contractor?->contractor?->bid_no }}
                                </x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">Workorder Number</x-slot>
                                <x-slot name="description">{{ $workorder->workorder_number }}
                                </x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">Workorder Amount</x-slot>
                                <x-slot name="description">{{ $workorder->workorder_amount }}
                                </x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">Workorder Estimated Date</x-slot>
                                <x-slot name="description">{{ $workorder->workorder_estimated_date }}</x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">PG Status</x-slot>
                                <x-slot name="description">{{ $workorder->pg_status }}
                                </x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">Workorder Status</x-slot>
                                <x-slot name="description">{{ $workorder->workorder_status }}
                                </x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">Formal Workorder Number</x-slot>
                                <x-slot name="description">{{
                                    $workorder->formal_workorder_number }}</x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">Formal Workorder Date</x-slot>
                                <x-slot name="description">{{
                                    $workorder->formal_workorder_date }}</x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">Formal Workorder Amount</x-slot>
                                <x-slot name="description">{{
                                    $workorder->formal_workorder_amount }}</x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">TS Amount</x-slot>
                                <x-slot name="description">{{ $workorder->ts_amount }}
                                </x-slot>
                            </x-description-list.item>
                            <x-description-list.item>
                                <x-slot name="title">TS Document</x-slot>
                                <x-slot name="description">{{ $workorder->ts_document }}
                                </x-slot>
                            </x-description-list.item>
                        </x-description-list>
                    </div>
                </x-card>
            @endforeach
        </div>
    </x-section-centered>
</div>