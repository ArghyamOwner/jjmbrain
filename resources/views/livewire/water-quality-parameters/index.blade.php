<div>
    <x-slot name="title">Water Quality Parameters</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Water Quality Parameters
            </x-slot>

            <x-slot:action>
                <x-button with-icon icon="add" type="button" x-data="" x-on:click="$dispatch('show-modal', 'addWaterParametersForm')">Add Parameters</x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if($waterparameters->isNotEmpty() || ($waterparameters->isEmpty() && $search))
                <div class="px-4 py-3 border-b">
                    <x-input-search 
                        no-margin 
                        name="search" 
                        wire:model.debounce.500ms="search" 
                        placeholder="Search..." 
                    />
                </div>
            @endif

            @if($waterparameters->isNotEmpty())
                <x-table.table :table-condensed="true" :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Parameter Name</x-table.thead>
                            <x-table.thead>Test Cycle</x-table.thead>
                            <x-table.thead>Value Parameter</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($waterparameters as $waterparameter)
                            <tr>
                                <x-table.tdata>
                                    {{ $waterparameter->parameter_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $waterparameter->parameter_cycle }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $waterparameter->safe_limit_max }} {{ $waterparameter->parameter_unit }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-button-icon-delete
                                        x-on:click.prevent="$wire.emitTo(
                                            'water-quality-parameters.delete',
                                            'showDeleteModal',
                                            '{{ $waterparameter->id }}',
                                            'Confirm Deletion',
                                            'Are you sure you want to remove this parameter?',
                                            '{{ $waterparameter->parameter_name }}'
                                        )"
                                    />
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else 
                <x-card-empty class="shadow-none rounded-none" />
            @endif
        </x-card>

        @if ($waterparameters->hasPages())
            <div class="mt-5">{{ $waterparameters->links() }}</div>
        @endif
       
        <x-modal-simple name="addWaterParametersForm" form-action="save">
            <x-slot:title>Add Water Quality Parameters</x-slot>

            <x-input label="Parameter Name" name="parameterName" wire:model.defer="parameterName" placeholder="eg. Turbidity" />
            <x-input label="Parameter Cycle" name="parameterCycle" wire:model.defer="parameterCycle" optional />
            <x-input label="Parameter Unit" name="parameterUnit" wire:model.defer="parameterUnit" optional />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-input label="Safe Limit Min" name="safeLimitMin" wire:model.defer="safeLimitMin" optional />
                <x-input label="Safe Limit Max" name="safeLimitMax" wire:model.defer="safeLimitMax" optional />
            </div>

            <x-slot:footer>
                <x-button with-spinner wire:target="save">Add Parameters</x-button>
            </x-slot>
        </x-modal-simple>

        <livewire:water-quality-parameters.delete />
         
    </x-section-centered>
</div>
