<x-app-layout title="District Details">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                {{ $district->name }} Dashboard
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <livewire:district-dashboard.map :district="$district->id" />
        <livewire:district-dashboard.cards :district="$district->id" />
    </x-section-centered>
</x-app-layout>