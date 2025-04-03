<div>
    <x-slot name="title">Edit Jal Shala</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jalshalas.index') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Edit Jal Shala
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card form-action="update">
                <x-virtual-select 
                    hint="You can select more than one PWSS for the Jal Shala" label="Scheme"
                    name="scheme" 
                    wire:model.defer="scheme" 
                    :options="[
                        'options' => $schemesArray,
                        'multiple' => true,
                        'showValueAsTags' => true,
                        'placeholder' => 'Select schemes',
                        'searchPlaceholderText' => 'Search schemes...',
                        'selectedValue' => $this->schemes
                    ]" 
                />

                <x-input label="Jal shala ID (Unique ID)" name="jalshala_uin" class="uppercase"
                    wire:model.defer="jalshala_uin" />

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="update">Save</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>
