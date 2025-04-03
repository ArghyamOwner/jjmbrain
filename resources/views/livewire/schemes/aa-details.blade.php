<div>
    <x-slot name="title">Scheme AA</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $schemeId) }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Scheme AA Details
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            @if($aaDetails->isNotEmpty())
            <x-card no-padding overflow-hidden>
                <div class="text-sm">
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>AA Number</x-table.thead>
                                <x-table.thead>AA Date</x-table.thead>
                                <x-table.thead>AA Document</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aaDetails as $aa)
                            <tr>
                                <x-table.tdata>{{ $aa->aa_number }}</x-table.tdata>
                                <x-table.tdata>{{ $aa->aa_date }}</x-table.tdata>
                                <x-table.tdata>
                                    <x-button class="truncate" target="_blank" tag="a" href="{{ $aa->aa_document }}" x-data="" color="white" with-icon icon="download">
                                    Download Document</x-button>
                                </x-table.tdata>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
            </x-card>
            @else
            <x-card-empty class="shadow-none rounded-none" />
            @endif
        </x-section-centered>
</div>