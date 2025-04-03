<div>
    {{-- <div class="shadow bg-slate-800 h-full p-4 rounded-lg mt-6 hidden md:block">
        <div class="relative font-medium text-lg text-slate-300 leading-none absolute left-4 top-4">
            District wise WUC
        </div>
        <div class="chart-container  w-full pt-5" style="height: 600px">
            <canvas id="groupHorizontalBarChart"></canvas>
        </div>
    </div> --}}

    <x-card card-classes="mb-5 mt-6">
        <x-slot name="header">
            <x-heading size="md">District wise WUC</x-heading>
        </x-slot>

        <div class="mb-8">
            <div class="mx-auto">
                <canvas id="district_jalshala"></canvas>
            </div>
        </div>
    </x-card>

    @push('charts')
        <script>
            new Chart(
                document.getElementById('district_jalshala'), {
                    type: 'bar',
                    options: {
                        indexAxis: 'x',
                        scales: {
                        // y: {
                        //     beginAtZero: true,
                        //     grid: {
                        //         display: false,
                        //         drawBorder: false
                        //     }
                        // },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            }
                        }
                    },
                    },
                    data: {
                        labels: @json(array_keys($handedOverCount)),
                        datasets: [{
                                label: 'Handed Over Schemes', // Name the series
                                data: @json(array_values($handedOverCount)), // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#4338ca',
                                pointBorderColor: '#4338ca',
                                borderColor: '#4f46e5', // Add custom color border (Line)
                                backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                                borderWidth: 1.5 // Specify bar border width
                            },
                            {
                                label: 'WUC Created', // Name the series
                                data: @json(array_values($wucCount)), // Specify the data values array
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
    @endpush

    <div class="shadow bg-slate-800 h-full p-4 rounded-lg mt-6 hidden md:block">
        <div class="relative font-medium text-lg text-slate-300 leading-none absolute left-4 top-4">
            Month-On-Month Handover Scheme Vs WUC Creation
        </div>
        <div class="chart-container w-full pt-5 relation h-56">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    @push('scripts-footer')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script>
        Chart.defaults.color = "#94a3b8";
        Chart.defaults.font.family = 'HKGrotesk';
        Chart.defaults.borderColor = 'rgba(51, 65, 85, 0.65)'; // #334155

        Chart.defaults.plugins.tooltip.usePointStyle = true;
        Chart.defaults.plugins.tooltip.boxPadding = 4;
        Chart.defaults.plugins.tooltip.boxWidth = 8;
        Chart.defaults.plugins.tooltip.boxHeight = 8;
        Chart.defaults.plugins.tooltip.caretSize = 0;

    // Horizontal Group Bar Chart
    // const groupBarChartData = {
    //     labels: @json($barChart1->keys()->all()),
    //     datasets:  [
    //         {
    //             label: "Handed Over Schemes",
    //             backgroundColor: "#fb923c",
    //             stack: 'Stack 0',
    //             borderWidth: 0,
    //             barThickness: 20,
    //             data: @json($barChart1->values()->pluck('handoverSchemes')->all())
    //         },
    //         {
    //             label: "WUC Created",
    //             backgroundColor: "#60a5fa",
    //             borderWidth: 0,
    //             stack: 'Stack 0',
    //             barThickness: 20,
    //             data:  @json($barChart1->values()->pluck('wucs')->all())
    //         },
    //     ]
    // };
    // let groupHorizontalBarCtx = document.getElementById("groupHorizontalBarChart").getContext("2d");
    // new Chart(groupHorizontalBarCtx, {
    //     type: 'bar',
    //     data: groupBarChartData,
    //     plugins: [ChartDataLabels],
    //     options: {
    //         interaction: {
    //             mode: 'index'
    //         },
    //         scales: {
    //             y: {
    //                 stacked: true, // remove stack groups
    //                 beginAtZero: true,
    //                 grid: {
    //                     display: false,
    //                     drawBorder: false
    //                 }
    //             },
    //             x: {
    //                 stacked: true,
    //                 grid: {
    //                     display: false,
    //                     drawBorder: false
    //                 },
    //                 ticks: {
    //                     display: true,
    //                     // min: 0,
    //                     labelOffset: -7,
    //                     autoSkip: false,
    //                     maxRotation: 90,
    //                     minRotation: 90,
    //                     align: 'start', // start|center|end
    //                     callback: function(val, index) {
    //                         let tickDisplay = this.getLabelForValue(val).split(' ');
    //                         return tickDisplay.includes('District') ? tickDisplay.slice(0, -1).toString() : this.getLabelForValue(val);
    //                     },
    //                 }
    //             }
    //         },
    //         maintainAspectRatio: false,
    //         plugins: {
    //             legend: {
    //                 display: true,
    //                 labels: {
    //                     boxWidth: 6,
    //                     boxHeight: 6,
    //                     usePointStyle: true
    //                 }
    //             },
    //             datalabels: {
    //                 // anchor: 'end',
    //                 align: 'center',
    //                 color: '#ffffff',
    //                 // offset: 10
    //             }
    //         }
    //     }
    // });

    var ctx = document.getElementById("lineChart").getContext("2d");
    new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [
                        
                        {
                            label: 'WUC Creation',
                            // backgroundColor: gradient,
                            fill: false,
                            // borderWidth: 2,
                            borderColor: "#2563eb",
                            pointBorderColor: '#60a5fa',
                            pointBackgroundColor: '#60a5fa',
                            data: @json(array_values($wucLineChart))
                        },
                        {
                            label: 'Handover Schemes',
                            // backgroundColor: gradient,
                            fill: false,
                            // borderWidth: 2,
                            borderColor : "#f45a5a",
                            pointBorderColor: '#FF0000',
                            pointBackgroundColor: '#FF0000',
                            data: @json(array_values($schemeLineChart))
                        },
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: false,
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
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                boxWidth: 6,
                                boxHeight: 6,
                                usePointStyle: true
                            }
                        },
                        datalabels: {
                            // anchor: 'end',
                            align: 'center',
                            color: '#ffffff',
                            offset: 10
                        }
                    },
                    tension: 0
                }
            });  
    </script>
    @endpush
</div>