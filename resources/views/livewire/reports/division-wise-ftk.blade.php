<div>
    <x-slot name="title">Division-Wise FTK</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('reports') }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                Division-Wise FTK Report
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

        {{-- @if($this->divisions)
        <x-card no-padding overflow-hidden>
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Division</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->divisions as $division)
                        <tr>
                            <x-table.tdata>{{ $division->name }}</x-table.tdata>
                            <x-table.tdata>
                                <x-button type="button" color="white" wire:click="generate('{{ $division->id }}')"
                                    wire:target="generate('{{ $division->id }}')" with-spinner>Generate
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