<div>
    <div wire:init="getChrtsData">
        {{-- <x-slot name="secondaryTopbar">
            <x-navbar-top-transparent>
                <x-slot:beforeTitle>
                    <x-text-link with-back-icon
                        href="{{ route('schemes.iot', ['deviceid' => $deviceId, 'schemeid' => $schemeid]) }}">
                        Go Back
                    </x-text-link>
                </x-slot>
                <x-slot:title> IOT Charts </x-slot>
            </x-navbar-top-transparent>
        </x-slot> --}}
        <x-section-centered class="w-full mt-8 transition-opacity duration-500 ease-in-out opacity-0 animate-show"
        x-data="{ show: false }" 
        x-init="$nextTick(() => show = true)"
        x-bind:class="{ 'opacity-100': show, 'opacity-0': !show }"
        >
            <x-card overflow-hidden>
                @if ($this->typeName())
                <x-slot:header class="border-b">
                    <div class="flex space-x-2 items-center">
                        {{ $this->typeName() }}
                    </div>
                </x-slot>
                @else
                <div class="h-4 w-40 bg-slate-200 rounded-md mb-3"></div>
                @endif
                   
                @if ($data)
                    <div class="shadow bg-slate-800 h-full p-4 rounded-lg hidden md:block">
                        <div class="chart-container w-full pt-5 relation h-96">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div> 
                @else
                    <div class="h-60 base-spinner bg-slate-200 rounded-md mb-3"></div>
                @endif
            </x-card>
        </x-section-centered> 
    </div>
    @push('scripts-footer')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('refresh-iot-charts', function(data) {
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
                        if (data.lineChartsR) {
                            datasets.push({
                                label: 'Voltage R',
                                fill: false,
                                borderColor: "#FF0000",
                                pointBorderColor: '#FF0000',
                                pointBackgroundColor: '#FF0000',
                                data: data.lineChartsR
                            });
                        }
                        if (data.lineChartsY) {
                            datasets.push({
                                label: 'Voltage Y',
                                fill: false,
                                borderColor: "#FFFF00",
                                pointBorderColor: '#FFFF00',
                                pointBackgroundColor: '#FFFF00',
                                data: data.lineChartsY
                            });
                        }
                        if (data.lineChartsB) {
                            datasets.push({
                                label: 'Voltage B',
                                fill: false,
                                borderColor: "#0000FF",
                                pointBorderColor: '#0000FF',
                                pointBackgroundColor: '#0000FF',
                                data: data.lineChartsB
                            });
                        }
                        if (data.lineSurfacePumps) {
                            datasets.push({
                                label: 'Pump',
                                fill: false,
                                borderColor: "#0000FF",
                                pointBorderColor: '#0000FF',
                                pointBackgroundColor: '#0000FF',
                                data: data.lineSurfacePumps
                            });
                        }
                        if (data.lineChartsBulkFlowMeterReading) {
                            datasets.push({
                                label: '',
                                fill: true,
                                borderColor: "#FFFF00",
                                pointBorderColor: '#FFFF00',
                                pointBackgroundColor: '#FFFF00',
                                data: data.lineChartsBulkFlowMeterReading
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
        </script>
    @endpush
</div>
