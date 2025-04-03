<div>
    <x-slot name="title">News</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                News
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('tenant.news.create') }}" with-icon icon="add">Create News</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-input-search wire:model.debounce.500ms="search" placeholder="Search..." class="w-full md:w-1/2 mb-4" />
        
        <x-datatable
            table-striped
            :columns="$columns"
            :data="$allNews"
        />
    </x-section-centered>
</div>
