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
                            DVSD01
                        </x-table.tdata>
                        <x-table.tdata>
                            Schemes
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Division wise details of all Schemes
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button with-spinner color="white" tag="a" href="{{ route('reports.division') }}">View
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            DVNETR
                        </x-table.tdata>
                        <x-table.tdata>
                            Distribution Network Report
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Division-Wise Distribution Network Report
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('divisionNetwork.report') }}">View
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            PGDETR
                        </x-table.tdata>
                        <x-table.tdata>
                            PG Report
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            PG Detailed Report
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('pgDetailReport') }}">View
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            FMR001
                        </x-table.tdata>
                        <x-table.tdata>
                            Latest Flowmeter Report
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Scheme-wise Jal-Mitra reporting of Flowmeter Reading
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('latestFlowmeter.report') }}">Generate
                            </x-button>
                        </x-table.tdata>
                    </tr>
                </tbody>
            </x-table.table>
        </x-card>

    </x-section-centered>
</x-app-layout>