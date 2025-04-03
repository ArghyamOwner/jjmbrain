<div>
    <div class="flex justify-between">
        <x-heading size="md" class="mb-2">Flow Meter Details</x-heading>
        <div class="mb-2">
            <x-text-link href="{{ route('schemes.show', [$scheme->id, 'tab' => 'flow-meter-index']) }}">View
                Details</x-text-link>
        </div>
    </div>
    {{-- @if ($scheme->flowmeterDetails->isNotEmpty())
        <canvas id="meterChart" width="400" height="200"></canvas>
    @else
        <x-card-empty variant="">
            <p class="text-center text-slate-500 mb-3 text-sm">No Flow Meter Details found.</p>
        </x-card-empty>
    @endif --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4" wire:init="getStats">
        <div class="md:col-span-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if (count($stats))
                    @foreach ($stats as $statName => $statValue)
                        <x-card-stats>
                            @if ($statValue['icon'])
                                <x-slot name="iconLeft">
                                    <img class='h-12' src="{{ $statValue['icon'] }}" alt="{{ $statName }} icon">
                                </x-slot>
                            @endif
                            <x-slot name="title">{{ $statName }}</x-slot>
                            <p class="mt-2 text-xl font-medium text-slate-800">{{ $statValue['value'] }}</p>
                        </x-card-stats>
                    @endforeach
                @else
                    <div class="bg-white shadow-sm border rounded-md h-24 p-5">
                        <div class="h-4 w-1/2 bg-slate-200 rounded-md mb-3"></div>
                        <div class="h-4 bg-slate-100 rounded-md"></div>
                    </div>
                    <div class="bg-white shadow-sm border rounded-md h-24 p-5">
                        <div class="h-4 w-1/2 bg-slate-200 rounded-md mb-3"></div>
                        <div class="h-4 bg-slate-100 rounded-md"></div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- @once
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            const dates = @json($dates);
            console.log(dates);
            const readings = @json($readings);
            const ctx = document.getElementById('meterChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Flow Meter Details',
                        data: readings,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Flow Meter Details'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endonce --}}
</div>
