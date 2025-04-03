<div>
    <x-card form-action="save">

        <div class="w-1/2">
            <x-virtual-select hint="You can select more than one Lab" label="Assign Labs" name="lab"
                wire:model.defer="lab" :options="[
                    'options' => $this->labArray,
                    'multiple' => true,
                    'showValueAsTags' => true,
                    'placeholder' => 'Select Labs',
                    'searchPlaceholderText' => 'Search Labs...',
                    'selectedValue' => $this->labs
                ]" />
        </div>

        <x-slot name="footer" class="text-right">
            <x-button type="submit" with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-card>
</div>
