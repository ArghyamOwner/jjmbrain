<x-public-scheme-layout title="District Dashboard">
    <div class="mt-6 mb-12">
        <x-section-centered>

            <div x-data="app()" x-cloak>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6" wire:init="getStats">
                    <div class="md:col-span-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            @if (count($schemesInfoCounts))
                                @foreach ($schemesInfoCounts as $statName => $statValue)
                                    <x-card-stats>
                                        <x-slot name="iconRight"><img class='h-12' src="{{ $statValue['icon'] }}">
                                        </x-slot>
                                        <x-slot name="title">{{ $statName }}</x-slot>
                                        <p class="mt-2 text-xl font-medium text-slate-800">{{ $statValue['value'] }}</p>
                                    </x-card-stats>
                                @endforeach
                            @else
                                <div class="bg-white shadow-sm border rounded-md h-24 p-5">
                                    <div class="h-4 w-1/2 bg-slate-200 rounded-md mb-3"></div>
                                    <div class="h-4 bg-slate-100 rounded-md"></div>
                                </div> 
                                <div class="bg-white shadow-sm border rounded-md h-24 p-5">
                                    <div class="h-4 w-1/2 bg-slate-200 rounded-md mb-3"></div>
                                    <div class="h-4 bg-slate-100 rounded-md"></div>
                                </div>
                                <div class="bg-white shadow-sm border rounded-md h-24 p-5">
                                    <div class="h-4 w-1/2 bg-slate-200 rounded-md mb-3"></div>
                                    <div class="h-4 bg-slate-100 rounded-md"></div>
                                </div>
                                <div class="bg-white shadow-sm border rounded-md h-24 p-5">
                                    <div class="h-4 w-1/2 bg-slate-200 rounded-md mb-3"></div>
                                    <div class="h-4 bg-slate-100 rounded-md"></div>
                                </div>
                            @endif
                            {{-- <x-card-stats>
                                <x-slot name="iconRight"><img class='h-12' src="/img/icons/water-tank.png">
                                </x-slot>
                                <x-slot name="title">Total Schemes</x-slot>
                                <p class="mt-2 text-xl font-medium text-slate-800">27749</p>
                            </x-card-stats>
                            <x-card-stats>
                                <x-slot name="iconRight"><img class='h-12' src="/img/icons/competed-scheme.png">
                                </x-slot>
                                <x-slot name="title">Total Completed Schemes</x-slot>
                                <p class="mt-2 text-xl font-medium text-slate-800">16972</p>
                            </x-card-stats>
                            <x-card-stats>
                                <x-slot name="iconRight"><img class='h-12' src="/img/icons/work-progress.png">
                                </x-slot>
                                <x-slot name="title">Total Ongoing Schemes</x-slot>
                                <p class="mt-2 text-xl font-medium text-slate-800">10777</p>
                            </x-card-stats>
                            <x-card-stats>
                                <x-slot name="iconRight"><img class='h-12' src="/img/icons/handover.png">
                                </x-slot>
                                <x-slot name="title">Total Handed-over Schemes</x-slot>
                                <p class="mt-2 text-xl font-medium text-slate-800">13380</p>
                            </x-card-stats>
                            <x-card-stats>
                                <x-slot name="iconRight"><img class='h-12' src="/img/icons/handover.png">
                                </x-slot>
                                <x-slot name="title">Functional</x-slot>
                                <p class="mt-2 text-xl font-medium text-slate-800">13380</p>
                            </x-card-stats>
                            <x-card-stats>
                                <x-slot name="iconRight"><img class='h-12' src="/img/icons/handover.png">
                                </x-slot>
                                <x-slot name="title">Partially functional</x-slot>
                                <p class="mt-2 text-xl font-medium text-slate-800">13380</p>
                            </x-card-stats>
                            <x-card-stats>
                                <x-slot name="iconRight"><img class='h-12' src="/img/icons/handover.png">
                                </x-slot>
                                <x-slot name="title">Non-functional</x-slot>
                                <p class="mt-2 text-xl font-medium text-slate-800">13380</p>
                            </x-card-stats> --}}
                        </div>
                    </div>
                </div>
                <x-card no-padding>
                    <div class="p-2">
                        <x-input-search x-model.debounce.500ms="search" class="block" placeholder="Search district" />
                    </div>

                    <div class="overflow-x-auto border-b rounded-lg shadow-sm border-gray-50">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="sticky left-0 z-10 whitespace-nowrap border-b bg-red-100 border-gray-200 px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                        District Name</th>
                                    <td
                                        class="whitespace-nowrap border-b bg-orange-100 border-gray-200 px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                        Handed Over</td>
                                    {{-- <td
                                        class="whitespace-nowrap border-b bg-orange-100 border-gray-200 px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                        Completed</td> --}}
                                    <td
                                        class="whitespace-nowrap border-b bg-green-100 border-gray-200 px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                        Functional</td>
                                    <td
                                        class="whitespace-nowrap border-b bg-yellow-100 border-gray-200 px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                        Partially Functional</td>
                                    <td
                                        class="whitespace-nowrap border-b bg-pink-100 border-gray-200 px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                        Non Functional</td>
                                </tr>
                            </thead>

                            <tbody>
                                <template x-for="item in searchResults">

                                    <tr>
                                        <td
                                            class="sticky left-0 z-10 bg-gray-50 text-left px-6 py-3 border-t border-gray-200 whitespace-nowrap">
                                            <a :href="`jjm-scheme-list/${item.id}/details/`"
                                                class="font-medium text-indigo-600 hover:text-indigo-700 hover:underline"
                                                x-text="item.name">
                                            </a>
                                        </td>
                                        <td class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                            <p class="font-medium " x-text="item.work_status">
                                            </p>
                                        </td>
                                        {{-- <td class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                            <p class="font-medium " x-text="item.completed_work_status">
                                            </p>
                                        </td> --}}
                                        <td class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                            <a :href="`jjm-scheme-list/${item.id}/operative/details/`"
                                                class="font-medium text-indigo-600 hover:text-indigo-700 hover:underline"
                                                x-text="`${item.operative_schemes} (${(item.operative_schemes / item.work_status * 100).toFixed(2)}%)`">
                                            </a>
                                        </td>

                                        <td class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                            <a :href="`jjm-scheme-list/${item.id}/partially-operative/details/`"
                                                class="font-medium text-indigo-600 hover:text-indigo-700 hover:underline"
                                                x-text="`${item.partially_operative} (${(item.partially_operative / item.work_status * 100).toFixed(2)}%)`">
                                            </a>
                                        </td>
                                        <td class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                            <a :href="`jjm-scheme-list/${item.id}/non-operative/details/`"
                                                class="font-medium text-indigo-600 hover:text-indigo-700 hover:underline"
                                                x-text="`${item.non_operative_schemes} (${(item.non_operative_schemes / item.work_status * 100).toFixed(2)}%)`">
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="searchResults.length === 0">
                                    <td colspan="14">
                                        <x-card-empty class="shadow-none" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>
        </x-section-centered>
    </div>

    @push('scripts')
        <script>
            function app() {
                return {
                    search: '',
                    items: {!! $districts !!},
                    get searchResults() {
                        if (this.search.length) {
                            let result = this.items.filter(item => item.name.toLowerCase().includes(this.search
                                .toLowerCase()))
                            if (result) {
                                return result
                            }
                        } else {
                            return this.items
                        }
                    }
                }
            }
        </script>
    @endpush
</x-public-scheme-layout>
