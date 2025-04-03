<div>
    <x-slot name="title">Create Issue</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('issues') }}">Go Back</x-text-link>
            </x-slot>
            
            <x-slot:title>
                Create Issue
            </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card overflow-hidden form-action="save">

                <x-textarea-simple label="Title" name="issue" wire:model.defer="issue" />
                
                <div class="grid grid-cols-2 gap-5">
                    <x-select label="Category Type" name="category_id" wire:model="category_id">
                        <option value="">-- Select Category --</option>
                        @foreach ($this->categories as $key => $type)
                            <option value="{{ $key }}">{{ $type }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Sub-Category Type" name="sub_category_id" wire:model.defer="sub_category_id">
                        <option value="">-- Select Sub-Category --</option>
                        @foreach ($this->subCatOptions as $key => $type)
                            <option value="{{ $key }}">{{ $type }}</option>
                        @endforeach
                    </x-select>
                </div>

                <x-slot name="footer" class="text-right">
                    <x-button with-spinner wire:target="save">Save</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>
