<div>
    <x-button tag="a" class="w-full" href="#" color="white" with-icon icon="add" x-data="{}"
        x-on:click.prevent="$dispatch('show-modal', 'assign-isa-form')" x-cloak>
        Assign ISA(s)
    </x-button>

    <x-modal-simple max-width="2xl" name="assign-isa-form" form-action="assignIsa">
        <x-slot name="title">Assign ISA(s) to WUC</x-slot>

        <x-virtual-select 
            label="Select ISA(s)" 
            name="isa_ids" 
            wire:model="isa_ids" 
            :options="[
                'options' => $isaList,
                'multiple' => false,
                'showValueAsTags' => true,
            ]" 
        />

        <br />
        <div class="p-10"></div>

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="assignIsa">Assign</x-button>
        </x-slot>
    </x-modal-simple>
</div>