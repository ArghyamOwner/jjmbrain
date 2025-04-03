<div>
    @if($contractor->workorders->isNotEmpty())
    <x-card no-padding overflow-hidden>
        <div>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>Est. Date</x-table.thead>
                        <x-table.thead>Issuing Authority</x-table.thead>
                        <x-table.thead>WO Number</x-table.thead>
                        <x-table.thead>Amount</x-table.thead>
                        <x-table.thead>Workorder Type</x-table.thead>
                        <x-table.thead>Created At</x-table.thead>
                        @unless (auth()->user()->isTechSupport())
                        <x-table.thead>Action</x-table.thead>
                        @endunless
                    </tr>
                </thead>
                <tbody>
                    @foreach($contractor->workorders as $workorder)
                    <tr>
                        <x-table.tdata>
                            {{ $workorder->workorder_estimated_date?->format('j M, Y') }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $workorder->issuing_authority }}
                        </x-table.tdata>
                        <x-table.tdata>
                            @if(auth()->user()->isTechSupport())
                            {{ $workorder->workorder_number }}
                            @else
                            <x-text-link href="{{ route('workorders.show', $workorder->id) }}">
                                {{ $workorder->workorder_number }}
                            </x-text-link>
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $workorder->workorder_amount ? Str::money($workorder->workorder_amount) : '-' }}
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-badge variant="{{ $workorder->workorder_type->color() }}">{{ $workorder->workorder_type
                                }}
                            </x-badge>
                        </x-table.tdata>
                        <x-table.tdata>
                            @date($workorder->created_at)
                        </x-table.tdata>
                        @unless (auth()->user()->isTechSupport())
                        <x-table.tdata>
                            <div class="flex space-x-1">
                                <x-button-icon-show href="{{ route('workorders.show', $workorder->id) }}" />
                            </div>
                        </x-table.tdata>
                        @endunless
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </div>
    </x-card>
    @else
    <x-card-empty class="shadow-none" />
    @endif
</div>