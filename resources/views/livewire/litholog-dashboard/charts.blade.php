<div>
    <x-card card-classes="mb-5 mt-6 h-full">
        <x-slot name="header">
            <x-heading size="md">Division wise Lithologs</x-heading>
        </x-slot>

        <div class="mb-8">
            <div class="mx-auto my-auto">
                <canvas id="division_litholog"></canvas>
            </div>
        </div>
    </x-card>

    @push('charts')
    <script>
        new Chart(
            document.getElementById('division_litholog'), {
                type: 'bar',
                options: {
                    indexAxis: 'x',
                    scales: {
                        y: {
                            stacked: false, // remove stack groups
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            barPercentage: 0.9, 
                            categoryPercentage: 1, // Adjust this value to change the spacing between the bars
                        },
                        x: {
                            stacked: false,
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                display: true,
                                // min: 0,
                                labelOffset: -7,
                                autoSkip: false,
                                maxRotation: 90,
                                minRotation: 90,
                                align: 'start', // start|center|end
                                callback: function(val, index) {
                                    let tickDisplay = this.getLabelForValue(val).split(' ');
                                    return tickDisplay.includes('District') ? tickDisplay.slice(0, -1).toString() : this.getLabelForValue(val);
                                },
                            }
                        }
                    },
                },
                data: {
                    labels: @json(array_keys($completeLithologs)),
                    datasets: [{
                            label: 'Total Lithologs', // Name the series
                            data: @json(array_values($completeLithologs)), // Specify the data values array
                            fill: true,
                            tension: 1,
                            pointBackgroundColor: '#4338ca',
                            pointBorderColor: '#4338ca',
                            borderColor: '#4f46e5', // Add custom color border (Line)
                            backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                            borderWidth: 1.5 // Specify bar border width
                        },
                        {
                            label: 'Verified Lithologs', // Name the series
                            data: @json(array_values($verifiedLithologs)), // Specify the data values array
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
        <div class="relative font-medium text-lg text-slate-300 leading-none left-4 top-4">
            Month-On-Month Lithology Creation
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

        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [
                        
                        {
                            label: 'Lithology Creation',
                            // backgroundColor: gradient,
                            fill: true,
                            // borderWidth: 2,
                            borderColor: "#2563eb",
                            pointBorderColor: '#60a5fa',
                            pointBackgroundColor: '#60a5fa',
                            data: @json(array_values($lithologyLineChart))
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