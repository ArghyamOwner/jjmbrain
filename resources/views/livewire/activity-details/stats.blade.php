<div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6" wire:init="getStats">
        <div class="md:col-span-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @if(count($stats))
                @foreach($stats as $statName => $statValue)
                <x-card-stats>
                    <x-slot name="title">{{ $statName }}</x-slot>
                    <p class="mt-2 text-xl font-medium text-slate-800">{{ $statValue }}</p>
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
                <div class="bg-white shadow-sm border rounded-md h-24 p-5">
                    <div class="h-4 w-1/2 bg-slate-200 rounded-md mb-3"></div>
                    <div class="h-4 bg-slate-100 rounded-md"></div>
                </div>
                <div class="bg-white shadow-sm border rounded-md h-24 p-5">
                    <div class="h-4 w-1/2 bg-slate-200 rounded-md mb-3"></div>
                    <div class="h-4 bg-slate-100 rounded-md"></div>
                </div>
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
</div>