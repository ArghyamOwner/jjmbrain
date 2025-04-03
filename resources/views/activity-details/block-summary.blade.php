<x-app-layout title="Block ISA Activity Dashboard">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                {{ $district->name }} Dashboard
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <livewire:activity-details.block-summary :district="$district" />
    </x-section-centered>
</x-app-layout>