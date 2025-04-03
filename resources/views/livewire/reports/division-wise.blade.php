<div>
    <x-slot name="title">Division Wise Report</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('reports') }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                Division-Wise Report
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
                                {{-- <x-button type="button" color="white" wire:click="generate('{{ $report->id }}')"
                                    wire:target="generate('{{ $report->id }}')" with-spinner>Generate
                                </x-button> --}}
                                {{-- <x-button type="button" color="white" tag="a" href="{{ $report->file_url }}" with-spinner>Generate
                                </x-button> --}}
                                {{-- <x-text-link target="_blank" href="{{ $report->file_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link> --}}

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

        {{-- <div x-data="app()" x-cloak>
            <div>
                <x-input-search x-model.debounce.500ms="search" class="block" placeholder="Search Division" />
            </div>
            <x-card no-padding>
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Division</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="item in searchResults">
                            <tr>
                                <x-table.tdata>
                                    <div x-text="item.name"></div>
                                </x-table.tdata>
                                <x-table.tdata>
                                    <a :href="`/report-generate/${item.id}`"
                                        class="font-medium text-indigo-600 hover:underline">Generate</a>
                                </x-table.tdata>
                            </tr>

                        </template>
                        <tr x-show="searchResults.length === 0">
                            <td colspan="14">
                                <x-card-empty class="shadow-none" />
                            </td>
                        </tr>

                    </tbody>
                </x-table.table>
            </x-card>
        </div>
        
        @push('scripts')
        <script>
            function app(){
                return {
                    search: '',
                    items: {!! $divisions !!},
                    get searchResults () {
                        if(this.search.length) {
                            let result = this.items.filter(item => item.name.toLowerCase().includes(this.search.toLowerCase()))
                            if(result) {
                            return result
                            }
                        } else {
                            return this.items
                        }
                    }
                }
            }
        </script>
        @endpush --}}
    </x-section-centered>
</div>