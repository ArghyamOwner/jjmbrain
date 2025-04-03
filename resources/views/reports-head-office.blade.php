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
                            <x-button color="white" tag="a" href="{{ route('reports.division') }}">View</x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            DVSS02
                        </x-table.tdata>
                        <x-table.tdata>
                            Division Wise Summary
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Division wise Summary of Schemes, JM, Handed Over Schemes, APDCL Consumer
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('divisionSummary.report') }}">Generate
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            PGSR03
                        </x-table.tdata>
                        <x-table.tdata>
                            PG Sumary
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Issuing Authority Wise Performance Gurantee Summary
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('pgSummary.report') }}">Generate
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            RBUR04
                        </x-table.tdata>
                        <x-table.tdata>
                            User's Report
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Role Based User's List
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('roleUser.report') }}">View
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata class="text-xs font-bold">
                            DVFTKR
                        </x-table.tdata>
                        <x-table.tdata>
                            FTK Report
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Division-Wise FTK report for Villages
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('divisionFtk.report') }}">View
                            </x-button>
                        </x-table.tdata>
                    </tr>
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
                            DVHOSR
                        </x-table.tdata>
                        <x-table.tdata>
                            Handover Summary
                        </x-table.tdata>
                        <x-table.tdata class="w-32 whitespace-normal">
                            Division-Wise Ready to Handover Summary (Parent Schemes)
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button color="white" tag="a" href="{{ route('divisionHandoverSummary.report') }}">Generate
                            </x-button>
                        </x-table.tdata>
                    </tr>
                </tbody>
            </x-table.table>
        </x-card>

    </x-section-centered>
</x-app-layout>