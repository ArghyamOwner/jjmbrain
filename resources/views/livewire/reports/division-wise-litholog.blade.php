<div>
    <x-slot name="title">Division-Wise Litholog</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('reports') }}">Go Back</x-text-link>
    </x-slot>
    <x-slot:title>
        Division-Wise Litholog Report
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
                            @foreach($reports as $div => $report)
                            <tr>
                                <x-table.tdata>{{ $div }}</x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex gap-4">
                                    @foreach ($report as $lithoReport)    
                                    <x-button type='button' color="white" wire:click="download('{{ $lithoReport->file }}')" 
                                        wire:target="download('{{ $lithoReport->file }}')" with-spinner>{{ $lithoReport->title }}</x-button>
                                    @endforeach
                                    </div>
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
                                        <div class="flex gap-4">
                                            <div>
                                                <a :href="`/${item.id}/litholog-reports`"
                                                    class="font-medium text-indigo-600 hover:underline">Location</a>
                                            </div>
                                            |
                                            <div>
                                                <a :href="`/${item.id}/orientation-reports`"
                                                    class="font-medium text-indigo-600 hover:underline">Orientation</a>
                                            </div>
                                            |
                                            <div>
                                                <a :href="`/${item.id}/lithology-reports`"
                                                    class="font-medium text-indigo-600 hover:underline">Lithology</a>
                                            </div>
                                            |
                                            <div>
                                                <a :href="`/${item.id}/casing-reports`"
                                                    class="font-medium text-indigo-600 hover:underline">Well-Construction</a>
                                            </div>
                                            |
                                            <div>
                                                <a :href="`/${item.id}/aquifer-reports`"
                                                    class="font-medium text-indigo-600 hover:underline">Aquifer</a>
                                            </div>
                                        </div>
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