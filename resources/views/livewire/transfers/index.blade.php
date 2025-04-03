<div>
    <x-slot name="title">Stocks Transfers</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('stocks') }}">Go back to stocks</x-text-link>
            </x-slot>

            <x-slot:title>
                Stocks Transfer Request
            </x-slot>

            <x-slot:action>
                {{-- <x-button with-icon icon="add">New Stock</x-button> --}}
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if ($transfers->isNotEmpty() || ($transfers->isEmpty() && $search))
                <div class="px-4 py-3 border-b">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
                </div>
            @endif

            @if ($transfers->isNotEmpty())
                <x-table.table :table-condensed="true" :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Item Name</x-table.thead>
                            <x-table.thead>Quantity</x-table.thead>
                            <x-table.thead>Source / Destination Lab Name</x-table.thead>
                            <x-table.thead>Transfered By</x-table.thead>
                            <x-table.thead>Accepted By</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transfers as $transfer)
                            <tr>
                                <x-table.tdata>
                                    {{ $transfer->item->item_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $transfer->quantity }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $transfer->sourceLab->lab_name }} &rarr;
                                    {{ $transfer->destinationLab->lab_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex items-center">
                                        <div class="shrink-0 w-6 h-6 rounded-full bg-slate-100 mr-2">
                                            <img src="{{ $transfer->transferedBy?->photo_url }}" alt="beneficiary_photo"
                                                loading="lazy" class="object-fit w-6 h-6 rounded-full">
                                        </div>
                                        <div>
                                            {{ $transfer->transferedBy->name }}
                                        </div>
                                    </div>
                                </x-table.tdata>
                                <x-table.tdata>
                                    @if ($transfer->acceptedBy)
                                        <div class="flex items-center">
                                            <div class="shrink-0 w-6 h-6 rounded-full bg-slate-100 mr-2">
                                                <img src="{{ $transfer->acceptedBy?->photo_url }}"
                                                    alt="beneficiary_photo" loading="lazy"
                                                    class="object-fit w-6 h-6 rounded-full">
                                            </div>
                                            <div>
                                                {{ $transfer->acceptedBy->name }}
                                            </div>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </x-table.tdata>
                                <x-table.tdata>
                                    @if($transfer->showAcceptButton())
                                        @if (!$transfer->acceptedBy)
                                            <x-button tag="a"
                                                href="{{ route('transfers.accept', $transfer->id) }}" class="py-1"
                                                color="white">Accept</x-button>
                                        @endif
                                    @endif
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty class="shadow-none rounded-none" />
            @endif
        </x-card>

        @if ($transfers->hasPages())
            <div class="mt-5">{{ $transfers->links() }}</div>
        @endif
    </x-section-centered>
</div>
