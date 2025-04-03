<div>
    <x-slot name="title">District Map</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                District Map
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered-wide> 
        <x-card>
            <x-heading class="mb-2" size="md">Districtwise Beneficiaries</x-heading>
            <x-svg-district-map :data="$datasets" color="#ff0000" />
        </x-card>
    </x-section-centered-wide>
</div>