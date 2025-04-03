<div>
    <div class="shadow bg-slate-800 h-full p-4 rounded-lg mt-6 hidden md:block">
        <div class="relative font-medium text-lg text-slate-300 leading-none absolute left-4 top-4">
            District Wise Jal-Mitra
        </div>
        <div class="chart-container  w-full pt-5" style="height: 600px">
            <canvas id="groupHorizontalBarChart"></canvas>
        </div>
    </div>
    
    <div class="shadow bg-slate-800 h-full p-4 rounded-lg mt-6 hidden md:block">
        <div class="relative font-medium text-lg text-slate-300 leading-none absolute left-4 top-4">
            Division Wise Jal-Mitra
        </div>
        <div class="chart-container  w-full pt-5" style="height: 600px">
            <canvas id="groupBarChartDataDivision"></canvas>
        </div>
    </div>

    {{-- <div class="shadow bg-slate-800 h-full p-4 rounded-lg mt-6 hidden md:block">
        <div class="relative font-medium text-lg text-slate-300 leading-none absolute left-4 top-4">
            Month-On-Month Handover Scheme Vs WUC Creation
        </div>
        <div class="chart-container w-full pt-5 relation h-56">
            <canvas id="lineChart"></canvas>
        </div>
    </div> --}}

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
    const groupBarChartData = {
        labels: @json($districtJm->pluck('name')->all()),
        datasets:  [
            {
                label: "Jal-Mitra",
                backgroundColor: "#fb923c",
                borderWidth: 0,
                stack: 'Stack 0',
                barThickness: 20,
                data:  @json($districtJm->pluck('count')->all())
            },
        ]
    };
    let groupHorizontalBarCtx = document.getElementById("groupHorizontalBarChart").getContext("2d");
    new Chart(groupHorizontalBarCtx, {
        type: 'bar',
        data: groupBarChartData,
        plugins: [ChartDataLabels],
        options: {
            interaction: {
                mode: 'index'
            },
            scales: {
                y: {
                    stacked: true, // remove stack groups
                    beginAtZero: true,
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                },
                x: {
                    stacked: true,
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
                    // offset: 10
                }
            }
        }
    });


    // Horizontal Group Bar Chart
    const groupBarChartDataDivision = {
        labels: @json($divisionJm->pluck('name')->all()),
        datasets:  [
            {
                label: "Jal-Mitra",
                backgroundColor: "#fb923c",
                borderWidth: 0,
                stack: 'Stack 0',
                barThickness: 10,
                data:  @json($divisionJm->pluck('count')->all())
            },
        ]
    };
    let groupHorizontalBarCtxDivision = document.getElementById("groupBarChartDataDivision").getContext("2d");
    new Chart(groupHorizontalBarCtxDivision, {
        type: 'bar',
        data: groupBarChartDataDivision,
        plugins: [ChartDataLabels],
        options: {
            interaction: {
                mode: 'index'
            },
            scales: {
                y: {
                    stacked: true, // remove stack groups
                    beginAtZero: true,
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                },
                x: {
                    stacked: true,
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
                            return tickDisplay.includes('Division') ? tickDisplay.slice(0, -1).toString() : this.getLabelForValue(val);
                        },
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
                    anchor: 'end',
                    align: 'center',
                    color: '#ffffff',
                    // offset: 10
                }
            }
        }
    });
    </script>
    @endpush
</div>