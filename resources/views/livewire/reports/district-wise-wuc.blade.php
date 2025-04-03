<div>
    <x-slot name="title">WUC | District-Wise</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('reports') }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                District-Wise WUC Report
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if($reports->isNotEmpty())
        <x-card no-padding overflow-hidden>
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Title</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <x-table.tdata>{{ $report->title }}</x-table.tdata>
                            <x-table.tdata>
                                <x-button type='button' color="white" wire:click="download('{{ $report->file }}')"
                                    wire:target="download('{{ $report->file }}')" with-spinner>Download</x-button>
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

        {{-- @if($this->districts)
        <x-card no-padding overflow-hidden>
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>District</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->districts as $district)
                        <tr>
                            <x-table.tdata>{{ $district->name }}</x-table.tdata>
                            <x-table.tdata>
                                <x-button type="button" color="white" wire:click="generate('{{ $district->id }}')"
                                    wire:target="generate('{{ $district->id }}')" with-spinner>Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        </x-card>
        @else
        <x-card-empty class="shadow-none rounded-none" />
        @endif --}}
    </x-section-centered>
</div>