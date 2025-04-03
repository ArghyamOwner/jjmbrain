<div>
    <x-slot name="title">Services</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Services
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-datatable
            table-striped
            :columns="$columns"
            :data="$services"
        />
    </x-section-centered>

    <livewire:tenants.services.service-edit-modal />

    {{-- <livewire:delete-modal /> --}}
</div>