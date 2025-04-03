<x-app-layout title="Litholog Dashboard">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Litholog Dashboard
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <livewire:litholog-dashboard.cards />
        <livewire:litholog-dashboard.charts />
        {{-- <livewire:lithologs.heat-map /> --}}
    </x-section-centered>
</x-app-layout>