<x-app-layout title="State Dashboard">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                State Dashboard
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        {{-- <livewire:state-dashboard.map /> --}}
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
        <livewire:state-dashboard.charts />
        <livewire:state-dashboard.cards />
    </x-section-centered>
</x-app-layout>