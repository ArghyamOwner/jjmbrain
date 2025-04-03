<div>
    <x-card>
        <div class="flex flex-col md:flex-row md:space-x-4 space-y-2">
            <div class="flex-1  grid grid-cols-2">
                <div class="col-span-1 md:col-span-1 px-4 py-2 border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Number of Jal Adda</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $totalJalAdda ?? 'N/A' }}</div>
                </div>

                <div class="col-span-1 md:col-span-1 px-4 py-2">
                    <div class="font-semibold text-gray-500 text-sm truncate">Number of Jaldoot</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $jaldootsParticipatedCount }}</div>
                </div>

                <div class="col-span-1 px-4 py-2 md:col-span-1 border-r border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Pending Jal Adda</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $pendingJalAdda }}</div>
                </div>

                <div class="col-span-1 px-4 py-2 md:col-span-1 border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Completed Jal Adda</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $conpletedJalAdda }}</div>
                </div>
            </div>
        </div>
    </x-card>
</div>
