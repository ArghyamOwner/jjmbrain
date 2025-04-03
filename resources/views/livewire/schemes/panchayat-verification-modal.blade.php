<div>
    <div class="mb-4 mt-4">
        <x-alert variant="error" :close="false">
            Dear Panchayat User, Please verify, whether the scheme has been successfully handed over 
            to your Panchayat by clicking the verify button.
            <p>
                In case of improper / incomplete Hand-Over please contact the concerned SO.
            </p>
            <br />
            <div class="space-x-2">
                @if($scheme->handover_document_url)
                <x-button 
                    tag="a" target="_blank" 
                    href="{{ $scheme->handover_document_url }}" >
                    Download Handover Document
                </x-button>
                @endif
                <x-button 
                    type="button" 
                    x-data="" 
                    color="indigo"
                    x-on:click.prevent="$dispatch('show-modal', 'panchayat-verification-modal')"
                    x-cloak>
                    Yes, Verify and Handover
                </x-button>
                <x-button 
                    type="button" 
                    x-data="" 
                    color="red"
                    x-on:click.prevent="$dispatch('show-modal', 'rejection-modal')" x-cloak>
                    No, Improper or Incomplete Handover
                </x-button>
            </div>
        </x-alert>
    </div>

    <x-modal-simple name="panchayat-verification-modal" form-action="verify">
        <x-slot name="title">Scheme Handed Over Verification</x-slot>

        Are You Sure you want to verify the Scheme has been successfully Handed-Over ?

        <x-slot name="footer" class="text-right">
            <x-button with-spinner wire:target="verify">Verify</x-button>
        </x-slot>
    </x-modal-simple>

    <x-modal-simple name="rejection-modal" form-action="reject">
        <x-slot name="title">Scheme Verification</x-slot>

        Are You Sure you want to mark Improper or Incomplete Handover of Scheme ?

        <x-slot name="footer" class="text-right">
            <x-button with-spinner wire:target="reject">Mark Incomplete</x-button>
        </x-slot>
    </x-modal-simple>
</div>