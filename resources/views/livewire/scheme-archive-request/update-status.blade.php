<div>
    <x-card-form form-action="updateStatus">
        <x-slot name="title">Update Status</x-slot>
        <x-slot name="description">Add the necessary details.</x-slot>

        {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6"> --}}
            <x-select label="Status" name="status" wire:model.defer="status">
                <option value="">--Select Status--</option>
                <option value="approved">Approve</option>
                <option value="rejected">Reject</option>
            </x-select>

            <x-textarea-simple label="Please explain the reason for archive of the scheme within 200 words" name="comment" wire:model.defer="comment" />

        {{-- </div> --}}

        <x-slot name="footer" class="text-right">
            <div class="mr-4">
                <x-inline-toastr on="saved">Saved.</x-inline-toastr>
            </div>

            <x-button with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-card-form>
</div>