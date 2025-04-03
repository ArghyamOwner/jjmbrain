<div>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title> IOT Graph Dashboard </x-slot>
        </x-navbar-top-transparent>
    </x-slot>
    <x-section-centered>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10 mt-8 mb-8" wire:init="initCall('power')">
            <div class="rounded-xl shadow-sm ring-1 ring-slate-200 bg-white md:p-6 relative overflow-hidden p-6">
                <div class="absolute inset-0 bg-gradient-to-r from-white via-indigo-50/75 to-transparent" style="z-index: 2"></div>
                <div class="absolute bg-grid-slate-200/50 bg-dot-5 inset-0" style="z-index: 1"></div>
                <div class="relative z-10">
                    <div class="mb-4">
                        <x-icon-link />
                    </div>
                    <p class="text-slate-500 mb-3">Power consumed yesterday</p>
                    @if ($totalPower)
                    <h2 class="font-semibold text-slate-800 mb-1">{{ $totalPower }} 
                        Kwh 
                    </h2>
                    @else
                    <div class="h-3 w-8 bg-slate-200 rounded-md"></div>
                    @endif
                </div>
            </div> 
            <div class="rounded-xl shadow-sm ring-1 ring-slate-200 bg-white md:p-6 relative overflow-hidden p-6">
                <div class="absolute inset-0 bg-gradient-to-r from-white via-indigo-50/75 to-transparent" style="z-index: 2"></div>
                <div class="absolute bg-grid-slate-200/50 bg-dot-5 inset-0" style="z-index: 1"></div>
                <div class="relative z-10">
                    <div class="mb-4">
                        <x-icon-link />
                    </div>
                    <p class="text-slate-500 mb-3">Water supply yesterday</p>
                    @if ($totalFlow)
                    <h2 class="font-semibold text-slate-800 mb-1">{{ $totalFlow }} 
                        Kl 
                    </h2>
                    @else
                    <div class="h-3 w-8 bg-slate-200 rounded-md"></div>
                    @endif
                </div>
            </div> 
        </div>
        <x-card no-padding overflow-hidden>
            {{-- <x-slot:header class="border-b">
                <div class="flex space-x-2 items-center">
                    <div>Graph</div>
                </div>
            </x-slot:header>  --}}
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>Name</x-table.thead>
                        <x-table.thead>Description</x-table.thead>
                        <x-table.thead>Action</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <x-table.tdata>
                            Pumps
                        </x-table.tdata>
                        <x-table.tdata>
                            For Submersible and Centrifugal
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getChrtsData('pumps')" wire:target="getChrtsData('pumps')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Power Consumed
                        </x-table.tdata>
                        <x-table.tdata>
                            For Power Consumed
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getChrtsData('power')"
                                wire:target="getChrtsData('power')" with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Flow
                        </x-table.tdata>
                        <x-table.tdata>
                            For Flow
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getChrtsData('flow')" wire:target="getChrtsData('flow')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Average ESR/UGR
                        </x-table.tdata>
                        <x-table.tdata>
                            For Average ESR/UGR
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getChrtsData('avgEsr')" wire:target="getChrtsData('avgEsr')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Flow Daily
                        </x-table.tdata>
                        <x-table.tdata>
                            For Daily Flow 
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getChrtsData('flowdiff')" wire:target="getChrtsData('flowdiff')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Submersible Pump
                        </x-table.tdata>
                        <x-table.tdata>
                            Submersible Pump ( Time series ) last 24 hours
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getLineChrtsData('submersible_pump')" 
                                wire:target="getLineChrtsData('submersible_pump')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Valve Operation
                        </x-table.tdata>
                        <x-table.tdata>
                            For Valve Operation
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getLineChrtsData('valve_operation')" 
                                wire:target="getLineChrtsData('valve_operation')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Level Indications
                        </x-table.tdata>
                        <x-table.tdata>
                            For Level Indications
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getLineChrtsData('level_indications')" 
                                wire:target="getLineChrtsData('level_indications')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Ground Water Level
                        </x-table.tdata>
                        <x-table.tdata>
                            For Ground Water Level
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getLineChrtsData('ground_water_level')" 
                                wire:target="getLineChrtsData('ground_water_level')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Surface/Submersible Time Series
                        </x-table.tdata>
                        <x-table.tdata>
                            For Surface/Submersible Time Series
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getLineChrtsData('surface_submersible')" 
                                wire:target="getLineChrtsData('surface_submersible')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Power Factor
                        </x-table.tdata>
                        <x-table.tdata>
                            For Power Factor
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getLineChrtsData('power_factor')" 
                                wire:target="getLineChrtsData('power_factor')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Flowmeter
                        </x-table.tdata>
                        <x-table.tdata>
                            For Flow Meter
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getLineChrtsData('flowmeter')" 
                                wire:target="getLineChrtsData('flowmeter')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                            Chlorine Analyzer
                        </x-table.tdata>
                        <x-table.tdata>
                            For Chlorine Analyzer
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getLineChrtsData('chlorineanalyzer')" 
                                wire:target="getLineChrtsData('chlorineanalyzer')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                          3 phase Electrical Parameters
                        </x-table.tdata>
                        <x-table.tdata>
                         For 3 phase Electrical Parameters
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getLineChrtsData('3phase_lectrical_arameters')" 
                                wire:target="getLineChrtsData('3phase_lectrical_arameters')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                    <tr>
                        <x-table.tdata>
                          Remote Flow Meter Data
                        </x-table.tdata>
                        <x-table.tdata>
                         For Remote Flow Meter Data
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-button wire:click.live="getLineChrtsData('remoteAnalytics')" 
                                wire:target="getLineChrtsData('remoteAnalytics')"
                                with-spinner>
                                Show Graph
                            </x-button>
                        </x-table.tdata>
                    </tr>
                </tbody>
            </x-table.table>
        </x-card>
        @if ($this->type == 'power' || $this->type == 'flow')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10 mt-8">
            <div class="rounded-xl shadow-sm ring-1 ring-slate-200 bg-white md:p-6 relative overflow-hidden p-6">
                <div class="absolute inset-0 bg-gradient-to-r from-white via-indigo-50/75 to-transparent" style="z-index: 2"></div>
                <div class="absolute bg-grid-slate-200/50 bg-dot-5 inset-0" style="z-index: 1"></div>
                <div class="relative z-10">
                    <div class="mb-4">
                        <x-icon-link />
                    </div>
                    <p class="text-slate-500 mb-3">{{ Str::upper($this->type) }}</p>
                    <h2 class="font-semibold text-slate-800 mb-1">{{ $totalCount }} 
                        @if ($this->type == 'power')
                        Kwh
                        @elseif ($this->type == 'flow')
                        Kl
                        @endif
                    </h2>
                </div>
            </div> 
        </div>
        @else
        @if ($data)
            <div class="shadow bg-slate-800 h-full p-4 rounded-lg hidden md:block mt-8">
                <div class="mb-8">
                    <div class="mx-auto my-auto">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        @elseif ($loading)
            <div class="h-60 base-spinner bg-slate-200 rounded-md mb-3 mt-8"></div>
        @endif
        @endif
        @if ($dataLinechart)
        <div class="shadow bg-slate-800 h-full p-4 rounded-lg hidden md:block mt-8">
            <div class="chart-container w-full pt-5 relation h-96">
                <canvas id="lineChart"></canvas>
            </div>
        </div> 
        @endif
    </x-section-centered>
    @push('charts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <script>
            let chartInstance = null;
            document.addEventListener('livewire:load', function() {
                Livewire.on('refresh-iot-graph-dashboard', function(data, type) {
                    if (data) {
                        var datasets = [];
                        let labels = [];
                        let submersibles = [];
                        let surface = [];
                        let power = [];
                        let flow = [];
                        let avgEsr = [];
                        let avgUgr = [];
                        let flowdiff = [];
                        let meterReading1 = [];
                        let meterReading2 = [];
                        const tooltipCallbacks = {
                            label: function(context) {
                                const value = context.raw;
                                console.log(value);
                                if(type == 'pumps'){
                                    return context.dataset.label + ': ' + secondsToHms(value);
                                }
                                if(type == 'avgEsr' || type == 'avgUgr'){
                                    return context.dataset.label + ': ' + value + ' %';
                                }
                                if(type == 'flowdiff'){
                                    return context.dataset.label + ': ' + value + ' KL';
                                }
                                if(type == 'remoteAnalytics'){
                                   
                                    return context.dataset.label + ': ' + value + '';
                                }
                            }
                        };
                        console.log(type);
                        if(type == 'remoteAnalytics'){
                            data.forEach(e => { 
                                labels.push(formatDate(e.date));
                                meterReading1.push(e.analytics.meterReading1);
                                meterReading2.push(e.analytics.meterReading2);
                            });
                            // console.log(meterReading1);
                        }else {
                            data.forEach(e => {
                            labels.push(formatDate(e.date));
                            submersibles.push(e.analytics.submersible);
                            surface.push(e.analytics.surface);
                            power.push(e.analytics.power);
                            flow.push(e.analytics.flow);
                            avgEsr.push(e.analytics.avgEsr);
                            avgUgr.push(e.analytics.avgUgr);
                            flowdiff.push(e.analytics.flowdiff);
                        });
                        } 
                        if (type == 'pumps') {
                            datasets.push({
                                label: 'Submersible', // Name the series
                                data: submersibles, // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#4338ca',
                                pointBorderColor: '#4338ca',
                                borderColor: '#4f46e5', // Add custom color border (Line)
                                backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                                borderWidth: 1.5 // Specify bar border width
                            });
                            datasets.push({
                                label: 'Surface', // Name the series
                                data: surface, // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#66f5ff', // Updated point background color
                                pointBorderColor: '#66f5ff', // Updated point border color
                                borderColor: '#66f5ff', // Add custom color border (Line)
                                backgroundColor: '#66f5ff', // Updated background color with opacity
                                borderWidth: 1.5 // Specify bar border width
                            });
                        }
                        if (type == 'power') {
                            datasets.push({
                                label: 'Electrical', // Name the series
                                data: power, // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#4338ca',
                                pointBorderColor: '#4338ca',
                                borderColor: '#4f46e5', // Add custom color border (Line)
                                backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                                borderWidth: 1.5 // Specify bar border width
                            });
                        }
                        if (type == 'flow') { 
                            datasets.push({
                                label: 'Flow', // Name the series
                                data: flow, // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#4338ca',
                                pointBorderColor: '#4338ca',
                                borderColor: '#4f46e5', // Add custom color border (Line)
                                backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                                borderWidth: 1.5 // Specify bar border width
                            });
                        }
                        if (type == 'avgEsr' || type == 'avgUgr') { 
                            datasets.push({
                                label: 'Average ESR', // Name the series
                                data: avgEsr, // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#4338ca',
                                pointBorderColor: '#4338ca',
                                borderColor: '#4f46e5', // Add custom color border (Line)
                                backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                                borderWidth: 1.5 // Specify bar border width
                            });
                            datasets.push({
                                label: 'Average UGR', // Name the series
                                data: avgUgr, // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#66f5ff', // Updated point background color
                                pointBorderColor: '#66f5ff', // Updated point border color
                                borderColor: '#66f5ff', // Add custom color border (Line)
                                backgroundColor: '#66f5ff', // Add custom color background (Points and Fill)
                                borderWidth: 1.5 // Specify bar border width
                            });
                        }
                        if (type == 'remoteAnalytics') { 
                            datasets.push({
                                label: 'MeterReading1', // Name the series
                                data: meterReading1, // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#4338ca',
                                pointBorderColor: '#4338ca',
                                borderColor: '#4f46e5', // Add custom color border (Line)
                                backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                                borderWidth: 1.5 // Specify bar border width
                            });
                            datasets.push({
                                label: 'MeterReading2', // Name the series
                                data: meterReading2, // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#66f5ff', // Updated point background color
                                pointBorderColor: '#66f5ff', // Updated point border color
                                borderColor: '#66f5ff', // Add custom color border (Line)
                                backgroundColor: '#66f5ff', // Add custom color background (Points and Fill)
                                borderWidth: 1.5 // Specify bar border width
                            });
                        }
                        
                        if (type == 'flowdiff') { 
                            datasets.push({
                                label: 'Daily Flow Meter', // Name the series
                                data: flowdiff, // Specify the data values array
                                fill: true,
                                tension: 1,
                                pointBackgroundColor: '#4338ca',
                                pointBorderColor: '#4338ca',
                                borderColor: '#4f46e5', // Add custom color border (Line)
                                backgroundColor: 'rgb(54, 162, 235)', // Add custom color background (Points and Fill)
                                borderWidth: 1.5 // Specify bar border width
                            });
                        }

                        if (chartInstance) {
                            chartInstance.destroy();
                        }
                        chartInstance = new Chart(
                            document.getElementById('barChart'), {
                                type: 'bar',
                                options: {
                                    indexAxis: 'x',
                                    plugins: {
                                        tooltip: {
                                            callbacks: tooltipCallbacks
                                        }
                                    },
                                    scales: {
                                        y: {
                                            stacked: false, // remove stack groups
                                            grid: {
                                                display: false,
                                                drawBorder: false
                                            },
                                            barPercentage: 0.9,
                                            categoryPercentage: 1,
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
                                                // callback: function(val, index) {
                                                    // let tickDisplay = this.getLabelForValue(val).split(
                                                    //     ' ');
                                                    // return tickDisplay.includes('District') ?
                                                    //     tickDisplay.slice(0, -1).toString() : this
                                                    //     .getLabelForValue(val);
                                                    // return "fhfh";
                                                // },

                                            }
                                        }
                                    },
                                },
                                data: {
                                    labels: labels,
                                    datasets: datasets,
                                },
                            }
                        );
                    }
                });
                Livewire.on('refresh-iot-graph', function(data, name) {
                    if (data) {
                        Chart.defaults.color = "#94a3b8";
                        Chart.defaults.font.family = 'HKGrotesk';
                        Chart.defaults.borderColor = 'rgba(51, 65, 85, 0.65)'; // #334155
                        Chart.defaults.plugins.tooltip.usePointStyle = true;
                        Chart.defaults.plugins.tooltip.boxPadding = 4;
                        Chart.defaults.plugins.tooltip.boxWidth = 8;
                        Chart.defaults.plugins.tooltip.boxHeight = 8;
                        Chart.defaults.plugins.tooltip.caretSize = 0;
                        var ctx = document.getElementById("lineChart").getContext("2d");
                        var datasets = [];
                        console.log(data);
                        if (data.remoteFlowMeter) {
                            datasets.push({
                                label: name,
                                fill: false,
                                borderColor: "#FF0000",
                                pointBorderColor: '#FF0000',
                                pointBackgroundColor: '#FF0000',
                                data: data.remoteFlowMeter
                            });
                        } 
                        if (data.submersible_pump) {
                            datasets.push({
                                label: name,
                                fill: false,
                                borderColor: "#FF0000",
                                pointBorderColor: '#FF0000',
                                pointBackgroundColor: '#FF0000',
                                data: data.submersible_pump
                            });
                        } 
                        if (data.level_indications1) {
                            datasets.push({
                                label: 'UGR',
                                fill: false,
                                borderColor: "#4338ca",
                                pointBorderColor: '#4338ca',
                                pointBackgroundColor: '#4338ca',
                                data: data.level_indications1
                            });
                            datasets.push({
                                label: "ESR",
                                fill: false,
                                borderColor: "#FF0000",
                                pointBorderColor: '#FF0000',
                                pointBackgroundColor: '#FF0000',
                                data: data.level_indications2
                            });
                        }
                        if (data.phase_electrical_arameters) {
                            datasets.push({
                                label: 'Voltage R',
                                fill: false,
                                borderColor: "#4338ca",
                                pointBorderColor: '#4338ca',
                                pointBackgroundColor: '#4338ca',
                                data: data.phase_electrical_arameters
                            });
                            datasets.push({
                                label: "Voltage Y",
                                fill: false,
                                borderColor: "#FF0000",
                                pointBorderColor: '#FF0000',
                                pointBackgroundColor: '#FF0000',
                                data: data.phase_electrical_arameters1
                            });
                            datasets.push({
                                label: "Voltage B",
                                fill: false,
                                borderColor: "#FF0000",
                                pointBorderColor: '#FF0000',
                                pointBackgroundColor: '#FF0000',
                                data: data.phase_electrical_arameters2
                            });
                        } 
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.labels || [],
                                datasets: datasets
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
                                        align: 'center',
                                        color: '#ffffff',
                                        offset: 10
                                    }
                                },
                                tension: 0
                            }
                        });
                    }

                });
            });

            function formatDate(dateString) {
                const options = {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                };
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', options);
            }
            function secondsToHms(d) {
    d = Number(d); // Ensure the input is a number
    var h = Math.floor(d / 3600); // Calculate hours
    var m = Math.floor((d % 3600) / 60); // Calculate minutes
    var s = Math.floor(d % 60); // Calculate remaining seconds

    var hDisplay = h > 0 ? h + (h === 1 ? " hour, " : " hours, ") : "";
    var mDisplay = m > 0 ? m + (m === 1 ? " minute, " : " minutes, ") : "";
    var sDisplay = s > 0 ? s + (s === 1 ? " second" : " seconds") : "";
    return hDisplay + mDisplay + sDisplay.trim();
}

        </script>
    @endpush
</div>
