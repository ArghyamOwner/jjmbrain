<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Get APDCL Consumer Details</x-slot>

        <div class="py-3 mt-5 px-6">
            <form wire:submit.prevent="getDetails">
                {{--
                <x-input type="text" label="Consumer Number" name="consumer_no" wire:model.defer="consumer_no" /> --}}
                <x-select label="Month" name="month" wire:model.defer="month">
                    <option value="">--Select Month--</option>
                    @foreach ($monthOptions as $monthKey => $monthValue)
                    <option value="{{ $monthKey }}">{{ $monthValue }}</option>
                    @endforeach
                </x-select>
                <x-select label="Year" name="year" wire:model.defer="year">
                    <option value="">--Select Year--</option>
                    @foreach (range(date('Y'), 2020) as $yearValue)
                    <option value="{{ $yearValue }}">{{ $yearValue }}</option>
                    @endforeach
                </x-select>
                <x-button with-spinner wire:target="getDetails">Get Details</x-button>
            </form>


            @if($data)

            <x-card cardClasses="mt-5">
                <div class="mb-6">

                    @if($data['status'] == 'success')
                    <x-description-list size="xs">
                        <x-slot name="heading">Consumer Details</x-slot>

                        <x-description-list.item>
                            <x-slot name="title">BillMonth</x-slot>
                            <x-slot name="description"> {{ $data['BillMonth'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Due Date</x-slot>
                            <x-slot name="description">{{ $data['dueDate'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Bill Period</x-slot>
                            <x-slot name="description">{{ $data['billPeriodStartDt'] ? ($data['billPeriodStartDt'].' to
                                '.$data['billPeriodEndDt']) : '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Settlement</x-slot>
                            <x-slot name="description">{{ $data['settlementMode'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Net Bill</x-slot>
                            <x-slot name="description">{{ $data['netBill'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Paid Amount</x-slot>
                            <x-slot name="description">{{$data['paidAmount'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Load</x-slot>
                            <x-slot name="description">{{ $data['load'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Unit Consumed</x-slot>
                            <x-slot name="description">{{ $data['unitConsumed'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Contract Demand</x-slot>
                            <x-slot name="description">{{ $data['contractDemand'] ?? '-'}}
                            </x-slot>
                        </x-description-list.item>
                    </x-description-list>
                    @else
                    <x-description-list size="xs">
                        <x-slot name="heading">Consumer Details</x-slot>

                        <x-description-list.item>
                            <x-slot name="title">Error Code</x-slot>
                            <x-slot name="description"> {{ $data['errorCode'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Status</x-slot>
                            <x-slot name="description">{{ $data['status'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Error Msg</x-slot>
                            <x-slot name="description">{{ $data['errorMsg'] ?? '-' }}</x-slot>
                        </x-description-list.item>
                    </x-description-list>
                    @endif


                    
                </div>
            </x-card>

            {{-- <x-heading size="lg" class="mb-2 mt-5">Consumer Details</x-heading>

            <div class="divide-y-2 mt-5">
                <div class="mb-2">BillMonth: {{ $data['BillMonth'] ?? '-' }}</div>
                <div class="mb-2">Due Date: {{ $data['dueDate'] ?? 0 }}</div>
                <div class="mb-2">Bill Period: {{ $data['billPeriodStartDt'].' to '.$data['billPeriodEndDt'] }}</div>
                <div class="mb-2">Settlement: {{ $data['settlementMode'] ?? 0 }}</div>
                <div class="mb-2">Net Bill: {{ $data['netBill'] ?? 0 }}</div>
                <div class="mb-2">Paid Amount: {{ $data['paidAmount'] ?? 0 }}</div>
                <div class="mb-2">Load: {{ $data['load'] ?? 0 }}</div>
                <div class="mb-2">Unit Consumed: {{ $data['unitConsumed'] ?? 0 }}</div>
                <div class="mb-2">Contract Demand: {{ $data['contractDemand'] ?? 0 }}</div>
            </div> --}}
            @endif
        </div>
    </x-slideovers>
</div>