<div>
    <x-slot name="title">{{ $wuc->name }}</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('wucs') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                WUC Details
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
            <x-card>
                <x-description-list size="xs">
                    <x-description-list.item>
                        <x-slot name="title">WUC Name</x-slot>
                        <x-slot name="description">{{ $wuc->name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Revenue Circle</x-slot>
                        <x-slot name="description">{{ $wuc?->revenueCircle?->name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">District</x-slot>
                        <x-slot name="description">{{ $wuc->district?->name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Block</x-slot>
                        <x-slot name="description">{{ $wuc?->block?->name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Bank Name</x-slot>
                        <x-slot name="description">{{ $wuc->bank_name ?? '-'}}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Account Number | IFSC </x-slot>
                        <x-slot name="description">{{ $wuc->account_number ?? '-' }} | {{ $wuc->ifsc ?? '-' }}
                        </x-slot>
                    </x-description-list.item>
                </x-description-list>
            </x-card>
            <x-card>
                <x-heading size="md" class="mb-2">Quick Actions</x-heading>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @if($showQuickActions)    
                    <livewire:wucs.edit :wuc="$wuc" />
                    <x-button tag="a" href="{{ route('wucs.editBank', $wuc->id) }}" color="white" with-icon
                        icon="edit">Bank Details</x-button>
                    <x-button tag="a" href="{{ route('wucs.updateDocuments', $wuc->id) }}" color="white" with-icon
                        icon="edit">Documents</x-button>
                    <livewire:wuc-volunteers.create :wuc="$wuc->id" />
                    <livewire:wuc-members.create :wuc="$wuc" />
                    <x-button tag="a" href="{{ route('estimate.create', $wuc->id) }}" color="white" with-icon
                        icon="add">O & M Estimate</x-button>
                    <livewire:wucs.assign-isa :wuc="$wuc" />
                    @endif
                    @if($wuc->approval_document_url)    
                    <x-button tag="a" target="_blank" href="{{ $wuc->approval_document_url }}" color="white"
                        with-icon icon="download">Approval Doc.</x-button>
                    @endif
                    @if($wuc->constitution_document_url)    
                    <x-button tag="a" target="_blank" href="{{ $wuc->constitution_document_url }}" color="white"
                        with-icon icon="download">Constitution</x-button>
                    @endif
                </div>
            </x-card>
        </div>

        @if($wuc->wuc_documents_exists)
        <livewire:wucs.document-index :wuc="$wuc" />
        @endif

        <x-heading size="md" class="mb-2 mt-5">Schemes associated with this WUC</x-heading>
        <x-card no-padding overflow-hidden>
            @if ($wuc->schemes->isNotEmpty())
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Scheme Name</x-table.thead>
                            <x-table.thead>SMT / IMIS Ids</x-table.thead>
                            <x-table.thead>Division</x-table.thead>
                            <x-table.thead>District | Block</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wuc->schemes as $scheme)
                        <tr>
                            <x-table.tdata>
                                @if ($scheme->scheme_status)
                                <x-badge variant="{{ $scheme->scheme_status->color() }}">
                                    {{ $scheme->scheme_status }}</x-badge>
                                @endif
                                <p>
                                    @if($showQuickActions)    
                                    <x-text-link href="{{ route('schemes.show', [$scheme->id, 'tab' => 'details']) }}">
                                        {{ $scheme->name }}
                                    </x-text-link>
                                    @else
                                    {{ $scheme->name }}
                                    @endif
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>
                                <span class="text-xs">
                                    SMT-ID : <span class="font-bold">{{ $scheme->old_scheme_id ?? 'N/A' }}</span>
                                </span>
                                <p class="text-xs">
                                    IMIS-ID : <span class="font-bold">{{ $scheme->imis_id ?? 'N/A' }}</span>
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $scheme?->division?->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $scheme?->district?->name }}
                                {{ $scheme?->block_names }}
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

        <livewire:wucs.isa-index :wuc="$wuc" />
        <livewire:monthly-expenditure.index :wuc="$wuc" />
        <livewire:wucs.panchayat-payments-index :wuc="$wuc->id" />
        <livewire:wuc-volunteers.index :wuc="$wuc->id" />
        <livewire:wuc-members.index :wuc="$wuc->id" />
        <livewire:o-and-m-estimates.index :wuc="$wuc->id" />
    </x-section-centered>
</div>