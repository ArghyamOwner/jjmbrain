<x-app-layout title="WUC Dashboard">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                WUC Dashboard
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <livewire:wucs.cards />
        <livewire:wucs.charts />

        {{-- <div class="mt-5 w-full">
            <x-button color="indigo" class="w-full" tag="a" href="{{ route('grievances') }}">View All Grievances
            </x-button>

        </div> --}}
    </x-section-centered>
</x-app-layout>