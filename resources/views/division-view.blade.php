<x-app-layout title="Division Details">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                {{ $division->name }} Dashboard
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <livewire:division-dashboard.map :division="$division->id" />

        <div class="mb-4">
            <x-alert variant="error" :close="false">
                <spna class="text-xs tracking-wide text-justify">
                    <ul class="list-decimal ml-2">
                        <li>KINDLY BE ADVISED THAT THE DATA PROVIDED BELOW UNDERGOES ROUTINE UPDATES AT MIDNIGHT,
                            ENSURING ITS RELEVANCE AND ACCURACY FOR PROFESSIONAL PURPOSES.</li>
                        <li>KINDLY BE ADVISED THAT THE INFORMATION PROVIDED PERTAINS SOLELY TO PARENT SCHEMES.</li>
                    </ul>
                </spna>
            </x-alert>
        </div>

        <livewire:division-dashboard.charts :division="$division->id" />
        <livewire:division-dashboard.cards :division="$division->id" />
        <livewire:division-dashboard.scheme-binary-data-report :division="$division->id" />
        <livewire:division-dashboard.subdivision-schemes :division="$division->id" />

        {{-- <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="md:col-span-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @foreach($divData as $stat)
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
                </div>
            </div>
        </div> --}}
    </x-section-centered>
</x-app-layout>