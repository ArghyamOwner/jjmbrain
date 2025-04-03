<div>
    <x-card>
        <div class="flex flex-col md:flex-row md:space-x-4 space-y-2">
            <div class="flex-1  grid grid-cols-3">
                {{-- <div class="col-span-1 md:col-span-1 px-4 py-2 border-r">
                        <div class="font-semibold text-gray-500 text-sm truncate">Total Number of Jal Shala</div>
                        <div class="text-gray-800 font-bold text-lg">{{ $totalJalshalaCount }}</div>
                    </div>
                --}}
                <div class="col-span-1 md:col-span-1 px-4 py-2 border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Total Jal Shala Planned</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $jalshalaPlanned }}</div>
                </div>

                <div class="col-span-1 md:col-span-1 px-4 py-2 border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Number of Jal Shala Conducted</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $jalshalaCompleted }}</div>
                </div>

                <div class="col-span-1 px-4 py-2 md:col-span-1">
                    <div class="font-semibold text-gray-500 text-sm truncate">Total Jaldoot Mapped</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $jaldootsCount }}</div>
                </div>

                <div class="col-span-1 md:col-span-1 px-4 py-2 border-r border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Number of Jaldoot Participated</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $jaldootsParticipatedCount }}</div>
                </div>

                <div class="col-span-1 px-4 py-2 md:col-span-1 border-r border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Number of School Covered</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $schoolsCount }}</div>
                </div>

                <div class="col-span-1 px-4 py-2 md:col-span-1 border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Number of PWSS Mapped</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $pwssMapped }}</div>
                </div>

            </div>
            <div class="w-full md:w-64">
                <img loading="lazy" src="https://sumatoimg.nyc3.digitaloceanspaces.com/jjm/uploads/Image%2047.png"
                    class="object-contain h-32 mx-auto" />
            </div>
        </div>
    </x-card>

    {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 mt-5">
        <x-card no-padding overflow-hidden>
            <x-heading size="md" class="p-2">Upcoming Jal Shala</x-heading>

            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>JS ID</x-table.thead>
                        <x-table.thead>District</x-table.thead>
                        <x-table.thead>Planned Date</x-table.thead>
                        <x-table.thead>Student</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($upcomingJalshalas as $jalshala)
                        <tr>
                            <x-table.tdata>
                                {{ $jalshala->jalshala_uin }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $jalshala->district?->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                @if ($jalshala->day_one)
                                    Day 1: {{ $jalshala->day_one?->format('d/m/Y h:i A') }}
                                    <p> Day 2: {{ $jalshala->day_two?->format('d/m/Y h:i A') }}</p>
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $jalshala->jalshala_schools_jaldoots_count }}
                            </x-table.tdata>
                        </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </x-card>


        <x-card class="mx-auto">
            <x-heading size="md" class="p-2 text-center">Jal Shala Meter</x-heading>
            <canvas id="jalshala"></canvas>
        </x-card>

        @push('charts')
            <script>
                // const chartWidth = document.querySelector('.chartBox').
                // getBoundingClientRect().width -46;

                const ctx = document.getElementById('jalshala').getContext('2d');
                const gradientSegment = ctx.createLinearGradient(0, 0, 435, 0);
                // gradientSegment.addColorStop(0, 'red');
                // gradientSegment.addColorStop(0.7, 'yellow');
                // gradientSegment.addColorStop(1, 'green');

                const score = {{ $score }};

                if (score < 30) {
                    gradientSegment.addColorStop(0, 'red');
                }
                if (score >= 30 && score < 60) {
                    gradientSegment.addColorStop(0, 'red');
                    gradientSegment.addColorStop(0.6, 'yellow');
                }
                if (score >= 60) {
                    gradientSegment.addColorStop(0, 'red');
                    gradientSegment.addColorStop(0.6, 'yellow');
                    gradientSegment.addColorStop(1, 'green');
                }


                const gaugeChartText = {
                    id: 'gaugeChartText',
                    afterDatasetDraw(chart, args, pluginOptions) {
                        const {
                            ctx,
                            data,
                            chartArea: {
                                top,
                                bottom,
                                left,
                                right,
                                center,
                                width,
                                height
                            },
                            scales: {
                                r
                            }
                        } = chart;

                        ctx.save();
                        const xCoor = chart.getDatasetMeta(0).data[0].x;
                        const yCoor = chart.getDatasetMeta(0).data[0].y;

                        ctx.font = '12px sans-serif';
                        ctx.fillStyle = '#666';
                        ctx.textBaseLine = 'top';
                        ctx.fillText(0, left + 12, yCoor + 9);
                        ctx.fillText(709, right - 22, yCoor + 9);

                        ctx.font = '50px sans-serif';
                        ctx.fillText('{{ $score }}%', xCoor - 40, yCoor - 20);
                    }
                };
                new Chart(
                    document.getElementById('jalshala'), {
                        type: 'doughnut',
                        options: {
                            aspectRatio: 1.4,
                            interaction: {
                                intersect: false,
                                mode: 'index',
                            },
                            plugins: {
                                datalabels: {
                                    display: false
                                },
                                tooltip: {
                                    enabled: false
                                }
                            }
                        },
                        plugins: [gaugeChartText],

                        data: {
                            datasets: [{
                                label: 'Jalshala', // Name the series
                                data: ['{{ $jalshalaPlanned }}', 0], // Specify the data values array
                                fill: true,
                                tension: 0.4,
                                backgroundColor: [
                                    gradientSegment,
                                    'rgba(0, 0, 0, 0.2)'
                                ], // Add custom color background (Points and Fill)
                                borderWidth: 2, // Specify bar border width
                                cutout: '85%',
                                circumference: 180,
                                rotation: 270,
                            }]
                        },
                    }
                );
            </script>
        @endpush
    </div> --}}

    @can('admin-or-state-jaldoot-cell')
    <div class="mt-5">
        <livewire:jalshalas.district-jalshala-statistics />
    </div>

    {{-- <x-card card-classes="mt-5">
        <x-slot name="header">
            <x-heading size="md">District wise Jal Shala Details</x-heading>
        </x-slot>

        <div class="mb-8">
            <div class="mx-auto">
                <canvas id="district_jalshala"></canvas>
            </div>
        </div>
    </x-card> --}}
    @endcan

    {{-- @push('charts')
        <script>
            new Chart(
                document.getElementById('district_jalshala'), {
                    type: 'bar',
                    options: {
                        indexAxis: 'x',
                    },
                    data: {
                        labels: @json(array_keys($districtTargetedJalshalaCount)),
                        datasets: [{
                                label: 'Jal Shala Planned', // Name the series
                                data: @json(array_values($districtTargetedJalshalaCount)), // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#4338ca',
                                pointBorderColor: '#4338ca',
                                borderColor: '#4f46e5', // Add custom color border (Line)
                                backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                                borderWidth: 1.5 // Specify bar border width
                            },
                            {
                                label: 'Jal Shala Conducted', // Name the series
                                data: @json(array_values($districtOrganisedJalshalaCount)), // Specify the data values array
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
    @endpush --}}
</div>
