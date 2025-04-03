<div>
    <x-button type="button" x-data="" color="cyan" class="w-full" with-icon icon="wallet"
        x-on:click.prevent="$dispatch('show-modal', 'archive-request')" x-cloak>
        Request Scheme Archive
    </x-button>

    <x-modal-simple name="archive-request" form-action="request">
        <x-slot name="title">Request to Archive Scheme</x-slot>
        <x-textarea-simple label="Please explain the reason for requesting archive of the scheme within 200 words" name="reason" wire:model.defer="reason" />

        <x-slot name="footer" class="text-right">
            <x-button color="indigo" with-spinner wire:target="request">Request</x-button>
        </x-slot>
    </x-modal-simple>
</div>