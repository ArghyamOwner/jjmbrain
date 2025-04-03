<x-app-layout title="Jal-Mitra Dashboard">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Jal-Mitra Dashboard
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <livewire:jal-mitra.cards />
        <livewire:jal-mitra.district-summary />
        <livewire:jal-mitra.division-summary />
        <livewire:jal-mitra.charts />
    </x-section-centered>
</x-app-layout>