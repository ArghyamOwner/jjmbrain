<div>
    <x-card no-padding card-classes="my-4 p-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
            <div class="col-span-4 flex">
                <img src="{{ url('grievances.png') }}" width="40" class="w-1/1 rounded-l-2xl h-10">
                <div class="p-2 text-left text-xl">
                    <h2 class="mb-2 text-xl font-bold text-tory-blue-500">Call Logs</h2>
                </div>
            </div>
            <x-button class="bg-green-100 h-16 border-green-400 leading-none" color="white" tag="a"
                href="#">
                <div class="flex space-x-3">
                    <div>
                        <span class="font-medium">{{ $allCount ?? 'N/A' }}</span>
                        <div class="flex space-x-1 leading-tight mt-1">
                            <span class="text-sm leading-none">Total Calls</span>
                        </div>
                    </div>
                </div>
            </x-button>
            <x-button class="bg-yellow-100 h-16 border-yellow-300 leading-none" color="white" tag="a"
                href="#">
                <div class="flex space-x-3">
                    <div>
                        <span class="font-medium">{{ $outgoingCount ?? 'N/A' }}</span>
                        <div class="flex space-x-1 leading-tight mt-1">
                            <span class="text-sm leading-none">Outgoing Calls</span>
                        </div>
                    </div>
                </div>
            </x-button>
            <x-button class="bg-indigo-100 h-16 border-indigo-300 leading-none" color="white" tag="a"
                href="#">
                <div class="flex space-x-3">
                    <div>
                        <span class="font-medium">{{ $incomingCount ?? 'N/A' }}</span>
                        <div class="flex space-x-1 leading-tight mt-1">
                            <span class="text-sm leading-none">Incoming Calls</span>
                        </div>
                    </div>
                </div>
            </x-button>
            <x-button class="bg-red-100 h-16 border-red-400 leading-none" color="white" tag="a"
                href="#">
                <div class="flex space-x-3">
                    <div>
                        <span class="font-medium">{{ $missedCount ?? 'N/A' }}</span>
                        <div class="flex space-x-1 leading-tight mt-1">
                            <span class="text-sm leading-none">Missed Calls</span>
                        </div>
                    </div>
                </div>
            </x-button>
        </div>
    </x-card>
</div>
