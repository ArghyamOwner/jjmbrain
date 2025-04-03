<x-app-layout title="ISA Activity Dashboard">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                ISA Activity Dashboard
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <livewire:activity-details.stats />
        <livewire:activity-details.district-summary />
    </x-section-centered>
</x-app-layout>