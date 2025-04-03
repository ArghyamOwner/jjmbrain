<div>
    <x-button tag="a" class="w-full" href="#" with-icon icon="add" x-data="{}"
        x-on:click.prevent="$dispatch('show-modal', 'assign-workorder-form')" x-cloak>
        Assign Workorder(s)
    </x-button>

    <x-modal-simple max-width="2xl" name="assign-workorder-form" form-action="assignWorkorder">
        <x-slot name="title">Assign Workorder(s) to PG</x-slot>

        <div class="mb-20">

            <x-virtual-select 
                label="Select Workorder(s)" 
                name="workorder_ids" 
                wire:model="workorder_ids" 
                :options="[
                    'options' => $this->workorders,
                    'multiple' => true,
                    'showValueAsTags' => true,
                    ]" />
        </div>

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="assignWorkorder">Assign</x-button>
        </x-slot>
    </x-modal-simple>
</div>