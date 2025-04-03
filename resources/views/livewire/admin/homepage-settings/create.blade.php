<div>
    <x-slot name="title">Homepage Settings</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Homepage Settings
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered class="min-h-screen">
        <x-card form-action="save">
            <x-card-form class="shadow-none" no-padding>
                <x-slot name="title">Home Page Layouts Structure</x-slot>
                <x-slot name="description">
                    Customize the layout of the home page by ordering different components.
                </x-slot>
    
                <x-component-listbox
                    multiple
                    label="Layout Components" 
                    name="layout"
                    wire:model="layout"
                    :options="$this->globalComponents"
                >
                    <x-slot name="custom">
                        <template x-if="Object.keys(options).length > 0">
                            <div class="px-4 py-2 hover:bg-slate-100 rounded-lg hover:text-indigo-600">
                                <div class="text-slate-700 font-medium" x-text="option.label"></div>
                                <div class="text-sm text-slate-500" x-text="option?.description"></div>
                            </div>
                        </template>
                    </x-slot>
                </x-component-listbox>
            </x-card-form>
            
            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>
    
                <x-button
                    color="black"
                    with-spinner
                    wire:target="save"
                >Save layout</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
