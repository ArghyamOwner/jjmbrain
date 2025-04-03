<div>
    <div>
        <x-button type="button" x-data="" x-on:click.prevent="$dispatch('show-modal', 'verification-modal')" x-cloak>
            Verify Activity
        </x-button>
    </div>
    <x-modal-simple name="verification-modal" form-action="verify">
        <x-slot name="title">Activity Verification</x-slot>

        Are You Sure you want to verify the Activity ?

        <x-slot name="footer" class="text-right">
            <x-button with-spinner wire:target="verify">Verify</x-button>
        </x-slot>
    </x-modal-simple>
</div>