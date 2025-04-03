<div>
    <x-slot name="title">All Holidays</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('dashboard') }}">Go back to dashboard</x-text-link>
            </x-slot>

            <x-slot:title>
                Holidays in {{ date('Y') }}
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div>
            @forelse($holidays as $month => $events)
                <div class="mb-1 text-lg font-medium text-slate-700">{{ $month }}</div>
                <div class="space-y-2 mb-6">
                    @forelse($events as $event)
                        @if($event['type'] === 'Restricted Holiday')
                            <x-alertbox variant="warning" class="text-sm !pt-1 !pb-1.5 !pl-6">
                                <div class="flex items-center flex-wrap">
                                    <div class="shrink-0 border rounded-lg w-10 mr-4">
                                        <div class="font-bold text-center text-slate-800 text-md border-b px-1">{{ $event['dateOnly'] }}</div>
                                        <div class="p-0.5 text-center text-xs text-slate-500 uppercase tracking-wide">{{ $event['monthShort'] }}</div>
                                    </div>
                                    <div class="flex-1 w-full">
                                        <div class="text-xs text-slate-600">{{ Str::title($event['type']) }}</div>
                                        <div class="font-medium">{{ $event['name'] }}</div>
                                    </div>
                                </div>
                            </x-alertbox>
                        @else
                            <x-alertbox variant="error" class="text-sm !pt-1 !pb-1.5 !pl-6">
                                <div class="flex items-center flex-wrap">
                                    <div class="shrink-0 border rounded-lg w-10 mr-4">
                                        <div class="font-bold text-center text-slate-800 text-md border-b px-1">{{ $event['dateOnly'] }}</div>
                                        <div class="p-0.5 text-center text-xs text-slate-500 uppercase tracking-wide">{{ $event['monthShort'] }}</div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-600">{{ Str::title($event['type']) }}</div>
                                        <div class="font-medium">{{ $event['name'] }}</div>
                                    </div>
                                </div>
                            </x-alertbox>
                        @endif
                    @empty
                        <x-card-empty />
                    @endforelse
                </div>
            @empty
            @endforelse
        </div>
    </x-section-centered>
</div>
