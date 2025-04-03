<div class="mb-12">
    <x-section-centered class="mt-12">
        <x-card card-classes="mb-6">
            <div>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search IMIS ID" name="search" wire:model.defer="search"
                            placeholder="Search IMIS ID..." />
                    </div>
                    <div class="pt-6">
                        <div class="space-x-2 items-center">
                            <x-button type="button" color="white" wire:click="filterData">
                                <x-icon-filter class="w-4 h-4 mr-1 -ml-1" />Search
                            </x-button>
                            <x-button type="button" color="white" wire:click="resetFilter" wire:target="resetFilter"
                                with-spinner>
                                <x-icon-refresh class="w-4 h-4 mr-1 -ml-1" />Reset
                            </x-button>
                        </div>
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
                            <x-table.thead>Name / Type / IMIS-ID</x-table.thead>
                            <x-table.thead>Division</x-table.thead>
                            <x-table.thead>District</x-table.thead>
                            <x-table.thead>Block / GP / Vill.</x-table.thead>
                            <x-table.thead>Operating Status</x-table.thead>
                            <x-table.thead>Reason for disruption</x-table.thead>
                            <x-table.thead>Tentative resolution date</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schemes as $scheme)
                        <tr>
                            <x-table.tdata>
                                <x-text-link href="{{ route('schemes.qrcodeDetails', $scheme->id) }}">
                                    {{ $scheme->name }}
                                </x-text-link>
                                <p>
                                    {{ $scheme->scheme_type }}
                                </p>
                                <p class="text-xs">
                                    IMIS : {{ $scheme->imis_id ?? 'N/A' }}
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $scheme->division?->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $scheme->district?->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $scheme->block_name }}
                                <p class="text-xs">GP: {{ $scheme->panchayat_names }}</p>
                                <p class="text-xs">
                                    <x-readmore content="Vill : {{ $scheme->village_names ?? '-' }}"
                                        limit="20" link-class="text-indigo-600 underline whitespace-normal text-xs" />
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>
                                @if ($scheme->operating_status)
                                <x-badge variant="{{ $scheme->operating_status->color() }}">{{
                                    $scheme->operating_status->label() }}</x-badge>
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $scheme->waterReport?->filtered_reasons_disruption }}
                                <p>
                                    <x-readmore content="{{ $scheme->waterReport?->filtered_specific_reasons ?? '-' }}"
                                        limit="20" link-class="text-indigo-600 underline whitespace-normal" />
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $scheme->tentative_date_for_resolution }}
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
        @if ($schemes->hasPages())
        <div class="mt-5">{{ $schemes->links() }}</div>
        @endif
    </x-section-centered>
</div>