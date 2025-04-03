<div>
    <x-card form-action="save">
        <x-card-form :with-shadow="false" no-padding>
            <x-slot name="title">Comments</x-slot>
            <x-slot name="description">Please make sure that you have all the correct information for adding a
                details.</x-slot>

                    <x-textarea-simple 
                        label="Write your reply" 
                        name="body" 
                        wire:model.defer="body" 
                    />

                    <x-select label="Status" name="status" wire:model.defer="status">
                        <option value="">--Select--</option>
                        @foreach ($statuses as $statusKey => $statusValue)
                        <option value="{{ $statusKey }}">{{ $statusValue }}</option>
                        @endforeach
                    </x-select>

                    <x-filepond 
                        optional 
                        accept-files="application/pdf, image/png,image/jpeg,image/jpg" 
                        label="Upload document" 
                        name="attachment" 
                        wire:model.defer="attachment" 
                        hint="File : Image / PDF | Max Size : 2 MB"
                    />
        </x-card-form>

        <x-slot name="footer" class="text-right">
            <div class="mr-4">
                <x-inline-toastr on="saved">Saved.</x-inline-toastr>
            </div>

            <x-button type="submit" with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-card>
</div>