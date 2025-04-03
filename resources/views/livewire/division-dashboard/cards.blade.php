<div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6" wire:init="getStats">
        <div class="md:col-span-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @if(count($stats))
                @foreach($stats as $stat)
                <x-text-link href="{{ $stat['link'] }}">
                    <x-card-stats>
                        @if($stat['icon'])
                        <x-slot name="iconRight"><img class='h-12' src="{{ $stat['icon'] }}"></x-slot>
                        @endif
                        <x-slot name="title">{{ $stat['title'] }}</x-slot>
                        <p class="mt-2 text-xl font-medium text-slate-800">{{ $stat['value'] }}</p>
                    </x-card-stats>
                </x-text-link>

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
        {{-- <div class="flex flex-col min-h-full">
            <x-card card-classes="flex-1">

            </x-card>
        </div> --}}
    </div>
</div>