<div>
    <div class="mx-auto">
        <canvas id="student-status"></canvas> 
    </div>

    @push('charts')
        <script>
            new Chart(
                document.getElementById('student-status'),
                {
                    type: 'bar',
                    data: {
                        labels: @json(array_keys($data)),
                        datasets: [{
                            data: @json(array_values($data)),
                            backgroundColor: [
                                'rgb(54, 162, 235)',
                                'rgb(255, 99, 132)',
                                'rgb(255, 205, 86)'
                            ],
                            hoverOffset: 4,
                            borderWidth: 0
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                labels: false
                            }
                        },

                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    // display: false,
                                    // drawBorder: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                            }
                        }
                    }
                }
            );
        </script>
    @endpush
</div>
