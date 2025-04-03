<x-app-layout title="Central Lab Management System">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Central Lab Management System
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <livewire:labs.statistics />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 mt-5">
            
            
            <div class="col-span-2">
                <livewire:labs.labs />
            </div>
        </div>

    </x-section-centered>
</x-app-layout>