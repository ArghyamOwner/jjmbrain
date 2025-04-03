<x-app-layout title="District Dashboard">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                District Dashboard
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding>
            <div x-data="app()" x-cloak>
                <div class="p-2">
                    <x-input-search x-model.debounce.500ms="search" class="block" placeholder="Search district" />
                </div>

                <div class="overflow-x-auto border-b rounded-lg shadow-sm border-gray-50">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th
                                    class="sticky left-0 z-10 whitespace-nowrap border-b bg-red-100 border-gray-200 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                    District Name</th>
                                <td
                                    class="whitespace-nowrap border-b bg-green-100 border-gray-200 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                    Schemes</td>
                                <td
                                    class="whitespace-nowrap border-b bg-yellow-100 border-gray-200 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                    Ongoing</td>
                                <td
                                    class="whitespace-nowrap border-b bg-yellow-100 border-gray-200 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                    Completed</td>
                                <td
                                    class="whitespace-nowrap border-b bg-yellow-100 border-gray-200 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                    Handed-Over</td>
                                <td
                                    class="whitespace-nowrap border-b bg-yellow-100 border-gray-200 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                    Jalmitra</td>
                                <td
                                    class="whitespace-nowrap border-b bg-yellow-100 border-gray-200 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">
                                    Actions</td>
                            </tr>
                        </thead>

                        <tbody>
                            <template x-for="item in searchResults">

                                <tr>
                                    <td
                                        class="sticky left-0 z-10 bg-gray-50 text-left px-6 py-3 border-t border-gray-200 whitespace-nowrap">
                                        <a :href="`/district-dashboard/${item.id}`"
                                            class="font-medium text-indigo-600 hover:text-indigo-700 hover:underline"
                                            x-text="item.name"></a>
                                    </td>
                                    <td x-text="item.total_schemes"
                                        class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                    </td>
                                    <td x-text="item.ongoing_schemes"
                                        class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                    </td>
                                    <td x-text="item.completed_schemes"
                                        class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                    </td>
                                    <td x-text="item.handedover_schemes"
                                        class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                    </td>
                                    <td x-text="item.jalmitra_assigned"
                                        class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                    </td>
                                    <td class="px-6 py-3 border-t border-gray-100 whitespace-nowrap">
                                        <x-button-icon-show href="`/district-dashboard/${item.id}`" />
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
            </div>
        </x-card>
    </x-section-centered>

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
</x-app-layout>