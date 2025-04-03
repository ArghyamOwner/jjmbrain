<div>
    <x-slot name="title">API Log Stats</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                API Log Stats
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>
    <x-section-centered-wide>
        <div class="mb-4 flex space-x-2 items-center">
            <x-label for="filter">Filter By:</x-label>
            <div class="w-32">
                <x-select no-margin name="filter" wire:model.live="filter">
                    <option value="today">Today</option>
                    <option value="yesterday">Yesterday</option>
                    <option value="last_7_days">Last 7 Days</option>
                    <option value="last_10_days">Last 10 Days</option>
                    <option value="last_30_days">Last 30 Days</option>
                    <option value="last_60_days">Last 60 Days</option>
                    <option value="last_90_days">Last 90 Days</option>
                </x-select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-4 bg-white rounded-lg ring-1 ring-gray-200 shadow">
                <div class="flex">
                    <div class="shrink-0 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" strokewidth="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-5 h-5 textblue-500">
                            <path d="m16 3 4 4-4 4" />
                            <path d="M20 7H4" />
                            <path d="m8 21-4-4 4-4" />
                            <path d="M4 17h16" />
                        </svg>
                    </div>
                    <h3 class="text-gray-500 text-sm mb-1">Total Requests</h3>
                </div>
                <p class="text-xl font-bold text-gray-800 font-mono trackingtight" wire:loading.class="opacity-25">
                    {{ $totalRequests }}</p>
            </div>
            <div class="p-4 bg-white rounded-lg ring-1 ring-gray-200 shadow">
                <div class="flex">
                    <div class="shrink-0 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" strokewidth="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-5 h-5 textblue-500">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-gray-500 text-sm mb-1">Success Rate</h3>
                </div>
                <p class="text-xl font-bold text-gray-800 font-mono tracking-tight" wire:loading.class="opacity-25">
                    {{ $successRate }}%</p>
            </div>
            <div class="p-4 bg-white rounded-lg ring-1 ring-gray-200 shadow">
                <div class="flex">
                    <div class="shrink-0 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" strokewidth="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-5 h-5 textblue-500">
                            <path d="M5 22h14" />
                            <path d="M5 2h14" />
                            <path d="M17 22v4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
                            <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
                        </svg>
                    </div>
                    <h3 class="text-gray-500 text-sm mb1">Average Response Time</h3>
                </div>
                <p class="text-xl font-bold text-gray-800 font-mono trackingtight" wire:loading.class="opacity-25">
                    {{ $averageResponseTime }} ms</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="p-5 bg-white rounded-lg ring-1 ring-gray-200 shadow">
                <h3 class="font-semibold mb-4">Top Endpoints</h3>
                <table class="w-full" wire:loading.class="opacity-25">
                    <colgroup>
                        <col width="70%" />
                        <col width="15%" />
                        <col width="15%" />
                    </colgroup>
                    <thead class="sticky z-10 top-0 bg-white">
                        <tr>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-left">
                                Route Name</th>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-left">
                                Method</th>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-right">
                                Hits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topEndpoints as $index => $endpoint)
                            <tr wire:key="{{ $index }}-spacer" class="h-2 first:h-0"></tr>
                            <tr wire:key="{{ $index }}-row">
                                <td
                                    class="first:rounded-l-md last:rounded-rmd text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr-3 px-1 sm:px-3 py2 font-mono tracking-tight">
                                    {{ $endpoint->route_name }}
                                </td>
                                <td
                                    class="first:rounded-l-md last:rounded-rmd text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr-3 px-1 sm:px-3 py2">
                                    <div
                                        class="{{ match ($endpoint->method) {
                                            'POST' => 'text-green-600',
                                            'GET' => 'text-blue-600',
                                            'DELETE' => 'text-red-600',
                                            default => 'text-yellow-600',
                                        } }}">
                                        {{ $endpoint->method }}
                                    </div>
                                </td>
                                <td
                                    class="font-medium first:rounded-lmd last:rounded-r-md text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr3 px-1 sm:px-3 py-2 text-right">
                                    {{ $endpoint->hit_count }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="first:rounded-lmd last:rounded-r-md text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr3 px-1 sm:px-3 py-6 text-center">
                                    No data available yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-5 bg-white rounded-lg ring-1 ring-gray-200 shadow">
                <h3 class="font-semibold mb-4">Top Accessed Endpoints</h3>
                <div wire:ignore x-data="topEndpointsChart" wire:loading.class="opacity-25" class="h-96">
                    <canvas x-ref="canvas"></canvas>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="p-5 bg-white rounded-lg ring-1 ring-gray-200 shadow">
                <div class="flex mb-4">
                    <div class="shrink-0 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" heig ht="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" strokewidth="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-5 h-5 textblue-500">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <h3 class="font-semibold">Most Active Users</h3>
                </div>
                <table class="w-full" wire:loading.class="opacity-25">
                    <colgroup>
                        <col width="5%" />
                        <col width="80%" />
                        <col width="15%" />
                    </colgroup>
                    <thead class="sticky z-10 top-0 bg-white">
                        <tr>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-left">
                                Rank</th>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-left">
                                Name</th>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-right">
                                Hits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mostActiveUsers as $index => $user)
                            <tr wire:key="{{ $index }}-spacer" class="h-2 first:h-0"></tr>
                            <tr wire:key="{{ $index }}-row">
                                <td
                                    class="first:rounded-l-md last:rounded-rmd text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr-3 px-1 sm:px-3 py2 font-mono tracking-tight">
                                    {{ $loop->iteration }}
                                </td>
                                <td
                                    class="first:rounded-l-md last:rounded-rmd text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr-3 px-1 sm:px-3 py2">
                                    {{ $user->name }}
                                </td>
                                <td
                                    class="font-medium first:rounded-lmd last:rounded-r-md text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr3 px-1 sm:px-3 py-2 text-right">
                                    {{ $user->hit_count }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="first:rounded-lmd last:rounded-r-md text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr3 px-1 sm:px-3 py-6 text-center">
                                    No data available yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-5 bg-white rounded-lg ring-1 ring-gray-200 shadow">
                <div class="flex mb-4">
                    <div class="shrink-0 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" strokewidth="2"
                            stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 textblue-500">
                            <path d="M18 8V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h8" />
                            <path d="M10 19v-3.96 3.15" />
                            <path d="M7 19h5" />
                            <rect width="6" height="10" x="16" y="12" rx="2" />
                        </svg>
                    </div>
                    <h3 class="font-semibold">Most Used Platforms</h3>
                </div>
                <table class="w-full" wire:loading.class="opacity-25">
                    <colgroup>
                        <col width="5%" />
                        <col width="80%" />
                        <col width="15%" />
                    </colgroup>
                    <thead class="sticky z-10 top-0 bg-white">
                        <tr>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-left">
                                Rank</th>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-left">
                                Name</th>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-right">
                                Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($platformStats as $index => $platform)
                            <tr wire:key="{{ $index }}-spacerplatform" class="h-2 first:h-0"></tr>
                            <tr wire:key="{{ $index }}-row-platform">
                                <td
                                    class="first:rounded-l-md last:rounded-rmd text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr-3 px-1 sm:px-3 py2 font-mono tracking-tight">
                                    {{ $loop->iteration }}
                                </td>
                                <td
                                    class="first:rounded-l-md last:rounded-rmd text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr-3 px-1 sm:px-3 py2">
                                    {{ $platform->platform }}
                                </td>
                                <td
                                    class="font-medium first:rounded-lmd last:rounded-r-md text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr3 px-1 sm:px-3 py-2 text-right">
                                    {{ $platform->count }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="first:rounded-lmd last:rounded-r-md text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr3 px-1 sm:px-3 py-6 text-center">
                                    No data available yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-5 bg-white rounded-lg ring-1 ring-gray-200 shadow">
                <div class="flex mb-4">
                    <div class="shrink-0 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" strokewidth="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-5 h-5 textblue-500">
                            <circle cx="12" cy="12" r="10" />
                            <circle cx="12" cy="12" r="4" />
                            <line x1="21.17" x2="12" y1="8" y2="8" />
                            <line x1="3.95" x2="8.54" y1="6.06" y2="14" />
                            <line x1="10.88" x2="15.46" y1="21.94" y2="14" />
                        </svg>
                    </div>
                    <h3 class="font-semibold">Most Used Browsers</h3>
                </div>
                <table class="w-full" wire:loading.class="opacity-25">
                    <colgroup>
                        <col width="5%" />
                        <col width="80%" />
                        <col width="15%" />
                    </colgroup>
                    <thead class="sticky z-10 top-0 bg-white">
                        <tr>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-left">
                                Rank</th>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-left">
                                Name</th>
                            <th
                                class="tracking-wide text-xs text-gray500 uppercase py-2 first:pl-3 last:pr-3 px-1 sm:px-3 text-right">
                                Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($browserStats as $index => $browser)
                            <tr wire:key="{{ $index }}-spacerbrowser" class="h-2 first:h-0"></tr>
                            <tr wire:key="{{ $index }}-row-browser">
                                <td
                                    class="first:rounded-l-md last:rounded-rmd text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr-3 px-1 sm:px-3 py2 font-mono tracking-tight">
                                    {{ $loop->iteration }}
                                </td>
                                <td
                                    class="first:rounded-l-md last:rounded-rmd text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr-3 px-1 sm:px-3 py2">
                                    {{ $browser->browser ?? '' }}
                                </td>
                                <td
                                    class="font-medium first:rounded-lmd last:rounded-r-md text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr3 px-1 sm:px-3 py-2 text-right">
                                    {{ $browser->browser_count }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="first:rounded-lmd last:rounded-r-md text-sm bg-gray-50 dark:bg-gray-800/50 first:pl-3 last:pr3 px-1 sm:px-3 py-6 text-center">
                                    No data available yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @push('scripts-footer')
            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
            <script>
                Chart.defaults.borderColor = '#f1f5f9';
                Chart.defaults.plugins.tooltip.usePointStyle = true;
                Chart.defaults.plugins.tooltip.boxPadding = 4;
                Chart.defaults.plugins.tooltip.boxWidth = 8;
                Chart.defaults.plugins.tooltip.boxHeight = 8;
                Chart.defaults.plugins.tooltip.caretSize = 0;
                document.addEventListener('alpine:init', () => {
                    Alpine.data('topEndpointsChart', () => ({
                        init() {
                            const data = @json($topEndpoints);
                            const labels = data.map(endpoint => endpoint.route_name || 'Undefined');
                            const hitCounts = data.map(endpoint => endpoint.hit_count);
                            let chart = new Chart(this.$refs.canvas, {
                                type: 'bar',
                                drawBorder: false,
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Hits',
                                        data: hitCounts,
                                        backgroundColor: '#0284c7',
                                        borderWidth: 0
                                    }]
                                },
                                options: {
                                    // responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: {
                                            display: false
                                        },
                                    },
                                    scales: {
                                        x: {
                                            grid: {
                                                display: false,
                                                drawBorder: false
                                            },
                                            title: {
                                                display: true,
                                                text: 'Endpoints'
                                            }
                                        },
                                        y: {
                                            grace: '10%',
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Hits'
                                            }
                                        },
                                    },
                                }
                            });

                            Livewire.on('chart-update-topendpoints', (chartdata) => {
                                //console.log(chartdata)
                                chart.data.labels = chartdata.map(endpoint => endpoint
                                    .route_name || 'Undefined');
                                chart.data.datasets[0].data = chartdata.map(endpoint =>
                                    endpoint.hit_count);
                                chart.update();
                            });
                        }
                    }));
                });
            </script>
        @endpush
    </x-section-centered-wide>
</div>
