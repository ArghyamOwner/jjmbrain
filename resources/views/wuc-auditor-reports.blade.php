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
                            DTISAR
                        </x-table.tdata>
                        <x-table.tdata>
                            ISA Report
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            District-Wise ISA report for Villages
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('districtIsa.report') }}">View
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            DTVSWR
                        </x-table.tdata>
                        <x-table.tdata>
                            District Summary
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            District Wise Summary of Villages, Schemes & WUCs 
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('districtWise.summary') }}">View
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            VWTISA
                        </x-table.tdata>
                        <x-table.tdata>
                            Villages without ISA
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Villages where ISA is not assigned
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('villagesWithoutIsa.report') }}">Generate
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            DTSWTW
                        </x-table.tdata>
                        <x-table.tdata>
                            Scheme without WUC
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Scheme where WUC is not uploaded
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('schemeWithOutWuc.report') }}">View
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            SWUCWI
                        </x-table.tdata>
                        <x-table.tdata>
                            Schemes without ISA
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Schemes having WUC without ISA
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('schemesWithoutIsa.report') }}">Generate
                            </x-button>
                        </x-table.tdata>
                    </tr>
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