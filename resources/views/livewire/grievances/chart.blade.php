<div>
    <x-card>
        <div class="flex flex-col md:flex-row md:space-x-4 space-y-2">
            <div class="flex-1  grid grid-cols-2">
                <a class="hover:underline" href="{{ route('grievances') }}">
                    <div class="col-span-1 md:col-span-1 px-4 py-2 border-r">
                        <div class="font-semibold text-gray-500 hover:text-indigo-700 text-sm truncate">Total Grievances
                        </div>
                        <div class="text-gray-800 font-bold text-lg">{{ $counts->grievances ?? 'N/A' }}</div>
                    </div>
                </a>

                <a class="hover:underline" href="{{ route('grievances', ['status'=>'pending']) }}">
                    <div class="col-span-1 md:col-span-1 px-4 py-2">
                        <div class="font-semibold text-gray-500  hover:text-indigo-700 text-sm truncate">Pending
                            Grievances</div>
                        <div class="text-gray-800 font-bold text-lg">{{ $counts->pending ?? 'N/A' }}</div>
                    </div>
                </a>

                <a class="hover:underline" href="{{ route('grievances', ['status'=>'resolved']) }}">
                    <div class="col-span-1 px-4 py-2 md:col-span-1 border-r border-t">
                        <div class="font-semibold text-gray-500  hover:text-indigo-700 text-sm truncate">Resolved
                            Grievances</div>
                        <div class="text-gray-800 font-bold text-lg">{{ $counts->resolved ?? 'N/A' }}</div>
                    </div>
                </a>

                <a class="hover:underline" href="{{ route('grievances', ['status'=>'unresolved']) }}">
                    <div class="col-span-1 px-4 py-2 md:col-span-1 border-t">
                        <div class="font-semibold text-gray-500  hover:text-indigo-700 text-sm truncate">Un-Resolved
                            Grievances</div>
                        <div class="text-gray-800 font-bold text-lg">{{ $counts->unresolved ?? 'N/A' }}</div>
                    </div>
                </a>

            </div>
            <div class="w-full md:w-64">
                <img loading="lazy" src="https://sumatoimg.nyc3.digitaloceanspaces.com/ino2021/galleries/11104.png"
                    class="object-contain h-32 mx-auto" />
            </div>
        </div>
    </x-card>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 mt-4">
        <x-card>
            Grievances By Status
            <x-pie-chart type="doughnut" legend-align="center"
                :labels="['Pending Grievances', 'Resolved Grievances', 'Un-Resolved Grievances']"
                :data="$grievancesData" />
        </x-card>
        <x-card>
            Grievances By Chanel
            <x-pie-chart type="doughnut" legend-align="center"
                :labels="['Call Center', 'Mobile App', 'Web', 'Whatsapp', 'Facebook', 'QR Code', 'Others']"
                :data="$platformData" />
        </x-card>
        <x-card>
            Grievances By Issues
            <x-pie-chart type="doughnut" legend-align="center" :labels="$issuesData->keys()"
                :data="$issuesData->values()" />
        </x-card>
    </div>
    <div class="relative mt-2 mb-5 flex items-center shadow bg-gray-50 p-4 transition duration-300 ease-out rounded-lg">
        <div class="flex-1 mt-10">
            <div class=" font-medium text-lg leading-none absolute left-4 top-4">
                Month-On-Month Grievances Count
            </div>
            <div class="chart-container mx-auto w-full relative h-56">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <x-card card-classes="mb-5">
        <x-slot name="header">
            <x-heading size="md">Grievance By Chanel</x-heading>
        </x-slot>

        <div class="mb-8">
            <div class="mx-auto">
                <canvas id="grievance_by_chanel"></canvas>
            </div>
        </div>
    </x-card>

    <x-card card-classes="mb-5">
        <x-slot name="header">
            <x-heading size="md">Grievance By Division</x-heading>
        </x-slot>

        <div class="mb-8">
            <div class="mx-auto">
                <canvas id="grievance_by_division"></canvas>
            </div>
        </div>
    </x-card>

    @if (auth()->user()->isDPMU())
    <x-card no-padding overflow-hidden>
        @if ($blockWise->isNotEmpty())
        <x-table.table :rounded="false">

            <thead>
                <tr>
                    <x-table.thead>Block Name</x-table.thead>
                    <x-table.thead>All Grievances</x-table.thead>
                    <x-table.thead>Pending</x-table.thead>
                    <x-table.thead>Resolved</x-table.thead>
                    <x-table.thead>Un-Resolved</x-table.thead>
                </tr>
            </thead>

            <tbody>
                @foreach ($blockWise as $block)
                <tr>
                    <x-table.tdata>
                        {{ $block->name }}
                    </x-table.tdata>
                    <x-table.tdata>
                        {{ $block->grievances_count }}
                    </x-table.tdata>
                    <x-table.tdata>
                        {{ $block->pending }}
                    </x-table.tdata>
                    <x-table.tdata>
                        {{ $block->resolved }}
                    </x-table.tdata>
                    <x-table.tdata>
                        {{ $block->unresolved }}
                    </x-table.tdata>
                </tr>
                @endforeach
            </tbody>
        </x-table.table>
        @else
        <x-card-empty class="shadow-none" />
        @endif
    </x-card>
    @endif

    @push('scripts-footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-treemap@2.0.2/dist/chartjs-chart-treemap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>

    <script>
        Chart.defaults.font.size = 12;
            Chart.defaults.color = "#242424";
            Chart.defaults.font.family = 'Inter';
            Chart.defaults.borderColor = 'rgba(51, 65, 85, 0.65)'; // #334155

            Chart.defaults.plugins.tooltip.usePointStyle = true;
            Chart.defaults.plugins.tooltip.boxPadding = 4;
            Chart.defaults.plugins.tooltip.boxWidth = 8;
            Chart.defaults.plugins.tooltip.boxHeight = 8;
            Chart.defaults.plugins.tooltip.caretSize = 0;

            var ctx = document.getElementById("lineChart").getContext("2d");

            var gradient = ctx.createLinearGradient(0, 0, 0, 462);
            gradient.addColorStop(0, 'rgba(147, 197, 253, 0.45)');
            gradient.addColorStop(1, 'transparent');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json(array_keys($lineChartData)),
                    datasets: [
                        
                        {
                            label: 'All Grievances',
                            // backgroundColor: gradient,
                            fill: true,
                            // borderWidth: 2,
                            borderColor: "#2563eb",
                            pointBorderColor: '#60a5fa',
                            pointBackgroundColor: '#60a5fa',
                            data: @json(array_values($lineChartData))
                        },
                        {
                            label: 'Pending Grievances',
                            // backgroundColor: gradient,
                            fill: true,
                            // borderWidth: 2,
                            borderColor : "#f45a5a",
                            pointBorderColor: '#FF0000',
                            pointBackgroundColor: '#FF0000',
                            data: @json(array_values($pendingLineChartData))
                        },
                        {
                            label: 'Resolved Grievances',
                            // backgroundColor: gradient,
                            fill: true,
                            // borderWidth: 2,
                            borderColor : "#0b9e26",
                            pointBorderColor: '#00ff2e',
                            pointBackgroundColor: '#00ff2e',
                            data: @json(array_values($resolvedLineChartData))
                        },
                        {
                            label: 'Un-Resolved Grievances',
                            // backgroundColor: gradient,
                            fill: true,
                            // borderWidth: 2,
                            borderColor : "#FDCD56",
                            pointBorderColor: '#FB9F40',
                            pointBackgroundColor: '#FB9F40',
                            data: @json(array_values($unresolvedLineChartData))
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            }
                        }
                    },
                    maintainAspectRatio: false,
                    // plugins: {
                    //     legend: {
                    //         display: true,
                    //     }
                    // },
                    tension: 0
                }
            });
  
        new Chart(
            document.getElementById('grievance_by_chanel'), {
                type: 'bar',
                options: {
                    indexAxis: 'x',
                },
                data: {
                    labels: @json(array_keys($lineChartData)),
                    datasets: [
                        {
                            label: 'Web', // Name the series
                            data: @json($webBarChartData), // Specify the data values array
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#4338ca',
                            pointBorderColor: '#4338ca',
                            borderColor: '#4f46e5', // Add custom color border (Line)
                            backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                            borderWidth: 1.5 // Specify bar border width
                        },
                        {
                            label: 'Whatsapp', // Name the series
                            data: @json($whatsappBarChartData), // Specify the data values array
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#a16207',
                            pointBorderColor: '#a16207',
                            borderColor: '#ca8a04', // Add custom color border (Line)
                            backgroundColor: 'rgb(255, 205, 86)', // Add custom color background (Points and Fill)
                            borderWidth: 1.5 // Specify bar border width
                        },
                        {
                            label: 'QR-Code', // Name the series
                            data: @json($qrBarChartData), // Specify the data values array
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '##A960F2',
                            pointBorderColor: '##A960F2',
                            borderColor: '##8b24f2', // Add custom color border (Line)
                            backgroundColor: 'rgb(191, 140, 242)', // Add custom color background (Points and Fill)
                            borderWidth: 1.5 // Specify bar border width
                        },
                        {
                            label: 'Call-Center', // Name the series
                            data: @json($qrBarChartData), // Specify the data values array
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '##e0d055',
                            pointBorderColor: '##e0d055',
                            borderColor: '##a0953e', // Add custom color border (Line)
                            backgroundColor: 'rgb(237, 225, 139)', // Add custom color background (Points and Fill)
                            borderWidth: 1.5 // Specify bar border width
                        },
                    ]
                },
            }
        );

        new Chart(
            document.getElementById('grievance_by_division'), {
                type: 'bar',
                options: {
                    indexAxis: 'x',
                },
                data: {
                    labels: @json(array_keys($divisionsBarChartData)),
                    datasets: [
                        {
                            label: 'All Grievances', // Name the series
                            data: @json(array_values($divisionsBarChartData)), // Specify the data values array
                            fill: true,
                            tension: 1,
                            pointBackgroundColor: '#4338ca',
                            pointBorderColor: '#4338ca',
                            borderColor: '#4f46e5', // Add custom color border (Line)
                            backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                            borderWidth: 1.5 // Specify bar border width
                        },
                        {
                            label: 'Resolved Grievances', // Name the series
                            data: @json(array_values($divisionsResolvedBarChartData)), // Specify the data values array
                            fill: true,
                            tension: 1,
                            pointBackgroundColor: '#a16207',
                            pointBorderColor: '#a16207',
                            borderColor: '#ca8a04', // Add custom color border (Line)
                            backgroundColor: 'rgb(255, 205, 86)', // Add custom color background (Points and Fill)
                            borderWidth: 1.5 // Specify bar border width
                        }
                    ]
                },
            }
        );

    </script>

    {{-- <script>
        var ctx = document.getElementById("barChart-check").getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March'],
                datasets: [{
                    label: 'Outgoing Calls',
                    backgroundColor: "red",
                    borderColor: "red",
                    data: [5776, 8885, 7665],
                    fill: false,
                }, {
                    label: 'Connected Calls',
                    fill: false,
                    backgroundColor: "blue",
                    borderColor: "blue",
                    data: [2133, 3715, 2842],
                }, {
                    label: 'Incoming Calls',
                    fill: false,
                    backgroundColor: "green",
                    borderColor: "green",
                    data: [380, 324, 441],
                }],
            }
        });
    </script> --}}
    @endpush

</div>