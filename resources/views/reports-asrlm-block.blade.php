<x-app-layout title="Reports">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Reports
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding>
            <x-table.table>
                <thead>
                    <tr>
                        <x-table.thead>ID</x-table.thead>
                        <x-table.thead>Report Type</x-table.thead>
                        <x-table.thead class="w-32">Description</x-table.thead>
                        <x-table.thead>View</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            DTWUCR
                        </x-table.tdata>
                        <x-table.tdata>
                            WUC Report
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            District-Wise WUC report
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('districtWuc.report') }}">View
                            </x-button>
                        </x-table.tdata>
                    </tr>
                </tbody>
            </x-table.table>
        </x-card>

    </x-section-centered>
</x-app-layout>