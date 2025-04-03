<div>
    <div class="w-64 mx-auto">
        <canvas id="gender"></canvas> 
    </div>

    @push('charts')
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
        <script>
            new Chart(
                document.getElementById('gender'),
                {
                    type: 'pie',
                    data: {
                        labels: @json(array_keys($genderData)),
                        datasets: [{
                            data: @json(array_values($genderData)),
                            backgroundColor: [
                                'rgb(54, 162, 235)',
                                'rgb(255, 99, 132)',
                                'rgb(255, 205, 86)'
                            ],
                            hoverOffset: 4
                        }]
                    },
                    plugins: [ChartDataLabels],
                    options: {
                        plugins: {
                            legend: {
                                labels: {
                                    usePointStyle: true
                                }
                            },

                            datalabels: {
                                formatter: (value, ctx) => {
                                    const datapoints = ctx.chart.data.datasets[0].data
                                    const total = datapoints.reduce((total, datapoint) => total + datapoint, 0)
                                    const percentage = value / total * 100
                                    return percentage.toFixed(2) + "%";
                                },
                                color: '#fff',
                            }
                        }
                    }
                }
            );
        </script>
    @endpush
</div>
