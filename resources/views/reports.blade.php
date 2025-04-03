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
                        <x-table.thead>Report ID</x-table.thead>
                        <x-table.thead>Report Type</x-table.thead>
                        <x-table.thead class="w-32">Description</x-table.thead>
                        <x-table.thead>View</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @unless (auth()->user()->isLabHo())
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
                                Division Summary
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                Division-Summary of Schemes, JM, Handover Schemes, APDCL Consumer
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button color="white" tag="a"
                                    href="{{ route('divisionSummary.report') }}">Generate
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
                    @endunless

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

                    @unless (auth()->user()->isLabHo())
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
                    @endunless
                    @if (auth()->user()->isAdministrator())
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                DTJSJD
                            </x-table.tdata>
                            <x-table.tdata>
                                Jalshala Summary
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                District-Wise Jalshala and Jaldoot Summary
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button with-spinner color="white" tag="a"
                                    href="{{ route('jalshala.summary') }}">Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                DVSOTS
                            </x-table.tdata>
                            <x-table.tdata>
                                SO Task Summary
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                Division-Wise Section-Officer Task Assignment Summary
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button with-spinner color="white" tag="a"
                                    href="{{ route('divisionSoTask.summary') }}">
                                    Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                SOTASK
                            </x-table.tdata>
                            <x-table.tdata>
                                SO Task Report
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                Section-Officer's Task Assignment Completion Report
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button with-spinner color="white" tag="a"
                                    href="{{ route('soTask.report') }}">
                                    Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                SCWOSO
                            </x-table.tdata>
                            <x-table.tdata>
                                Schemes W/O SO's
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                List of Schemes without Section-Officers Assigned
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button with-spinner color="white" tag="a"
                                    href="{{ route('schemesWoSo.report') }}">
                                    Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                CONCTR
                            </x-table.tdata>
                            <x-table.tdata>
                                Contractor's Tasks
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                List of Contractor's Completed Task Report
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button with-spinner color="white" tag="a"
                                    href="{{ route('contractorsCompletedTask.report') }}">
                                    Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                NOIMIS
                            </x-table.tdata>
                            <x-table.tdata>
                                Schemes Without IMIS
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                List of Schemes Without or Wrong IMIS-Id
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button with-spinner color="white" tag="a"
                                    href="{{ route('schemesWoImis.report') }}">
                                    Generate
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
                                <x-button with-spinner color="white" tag="a"
                                    href="{{ route('districtWise.summary') }}">
                                    Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                WOWTPG
                            </x-table.tdata>
                            <x-table.tdata>
                                W/Os Without PG
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                List of Workorders Without Performance Guarantee
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button with-spinner color="white" tag="a"
                                    href="{{ route('woWithoutPg.report') }}">
                                    Generate
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
                                <x-button color="white" tag="a"
                                    href="{{ route('villagesWithoutIsa.report') }}">Generate
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
                                District wise Schemes where WUC is not uploaded
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button color="white" tag="a"
                                    href="{{ route('schemeWithOutWuc.report') }}">View
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
                                <x-button color="white" tag="a"
                                    href="{{ route('schemesWithoutIsa.report') }}">Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                DVLITHO
                            </x-table.tdata>
                            <x-table.tdata>
                                Litholog Data
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                Division-Wise Lithologs Report
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button color="white" tag="a"
                                    href="{{ route('reports.divisionLitholog') }}">View
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
                                <x-button color="white" tag="a"
                                    href="{{ route('divisionHandoverSummary.report') }}">Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        {{-- Pending --}}
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                SMULWC
                            </x-table.tdata>
                            <x-table.tdata>
                                Schemes - WUCs
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                Schemes having Multiple WUCs
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button color="white" tag="a"
                                    href="{{ route('multipleWucReport') }}">Generate
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
                                <x-button color="white" tag="a"
                                    href="{{ route('divisionNetwork.report') }}">View
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
                                <x-button color="white" tag="a"
                                    href="{{ route('latestFlowmeter.report') }}">Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                DISTSCH
                            </x-table.tdata>
                            <x-table.tdata>
                                School Report
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                District-Wise School's report
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button color="white" tag="a"
                                    href="{{ route('districtSchool.report') }}">View
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                MTREAD
                            </x-table.tdata>
                            <x-table.tdata>
                                Meter Reading
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                Meter Reading Report
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button color="white" tag="a"
                                    href="{{ route('meter.readings') }}">View
                                </x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata class="text-xs font-bold">
                                WDRREP
                            </x-table.tdata>
                            <x-table.tdata>
                                Water Disruption
                            </x-table.tdata>
                            <x-table.tdata class="w-32 whitespace-normal">
                                Water Disruption Report
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button color="white" tag="a"
                                    href="{{ route('water-disruption-weekly.report') }}">Generate
                                </x-button>
                            </x-table.tdata>
                        </tr>
                    @endif
                </tbody>
            </x-table.table>
        </x-card>

    </x-section-centered>
</x-app-layout>
