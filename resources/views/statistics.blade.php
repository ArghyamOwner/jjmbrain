<x-app-layout title="Statistics">
	<x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
				Overall Statistics
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- <x-card>
                <canvas id="acquisitions"></canvas> 
            </x-card> --}}
            
            <x-card>
                <x-slot name="header">
                    <x-heading size="md">Students Status</x-heading>
                </x-slot>
                <livewire:statistics.student-status />
            </x-card>

            <x-card>
                <x-slot name="header">
                    <x-heading size="md">Student Gender Stats</x-heading>
                </x-slot>
                <livewire:statistics.gender />
            </x-card>
        </div>
	</x-section-centered>

    @push('scripts-footer')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
        <script>
            Chart.defaults.font.size = 12;
            Chart.defaults.font.family = 'Inter';
            Chart.defaults.borderColor = '#f1f5f9';
            Chart.defaults.plugins.tooltip.usePointStyle = true;
            Chart.defaults.plugins.tooltip.boxPadding = 4;
            Chart.defaults.plugins.tooltip.boxWidth = 8;
            Chart.defaults.plugins.tooltip.boxHeight = 8;
            Chart.defaults.plugins.tooltip.caretSize = 0;

            const data = [
                { year: 2010, count: 10 },
                { year: 2011, count: 20 },
                { year: 2012, count: 15 },
                { year: 2013, count: 25 },
                { year: 2014, count: 22 },
                { year: 2015, count: 30 },
                { year: 2016, count: 28 },
            ];

            new Chart(
                document.getElementById('acquisitions'),
                {
                type: 'bar',
                data: {
                    labels: data.map(row => row.year),
                    datasets: [
                    {
                        label: 'Acquisitions by year',
                        data: data.map(row => row.count)
                    }
                    ]
                }
                }
            );
        </script>
    @endpush
</x-app-layout>