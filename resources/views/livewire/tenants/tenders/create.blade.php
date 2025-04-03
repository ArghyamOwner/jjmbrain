<div>
    <x-slot name="title">New Tender</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('tenant.tenders.all') }}">Back to tenders</x-text-link>
            </x-slot>

            <x-slot:title>
                New Tender
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card-form form-action="save">
            <x-slot name="title">Create New Tender</x-slot>
            <x-slot name="description">Add a new tender</x-slot>

            <x-textarea
                rows="3"
                label="Tender Name" 
                name="name"
                wire:model.defer="name" 
            />

            <x-input
                label="Tender Number" 
                name="tender_no"
                wire:model.defer="tender_no" 
            />
 
            <x-flatpicker
                label="Tender Due Date" 
                name="due_date"
                wire:model="due_date" 
                :options="[
                    'defaultDate' => null
                ]"
            />
        

            <x-flatpicker
                label="Tender Date" 
                name="publish_date"
                wire:model="publish_date" 
                :options="[
                    'defaultDate' => null
                ]"
            />
            
            <x-slot name="footer">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>

                <x-button
                    color="black"
                    with-spinner
                    wire:target="save"
                >Save Tender</x-button>
            </x-slot>
        </x-card-form>
       
    </x-section-centered>
</div>





