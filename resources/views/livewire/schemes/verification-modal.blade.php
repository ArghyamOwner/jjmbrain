<div>
    @if (!$scheme->verified_by)
    <div class="mb-4">
        <x-alert variant="error" :close="false">
            @if($showModalButton)
            Please double-check every piece of scheme information, including the IMIS ID, scheme name, villages, block
            names, division names, etc., before clicking "Verified."
            <p>
                ⚠️ Please be aware that certain data, such as the Scheme Block, can be updated via the SMT portal, and
                that
                other data, such as the Scheme's LAC, can be modified using JJM Brain.
            </p>
            <p>
                ⚠️ It is necessary to verify the Scheme Workorder data and workorder number before clicking the
                verification
                button.
            </p>
            <br />
            <x-button type="button" x-data="" x-on:click.prevent="$dispatch('show-modal', 'verification-modal')"
                x-cloak>
                Verify Scheme
            </x-button>
            @else
            Scheme data is not updated for Verification Process. To ensure the validity of a scheme, the following data
            must be updated:
            <p>
            <ul style="list-style-type:disc;">
                <li>At least one work order should be attached to the scheme.</li>
                <li>The IMIS ID and STM ID should not match; it's advisable to validate against the IMIS database.</li>
                <li>All location data including Village, Panchayat, Block, and Local Administrative Council (LAC) data
                    should be included.</li>
                <li>Financial year and SLSSC data are mandatory additions.</li>
                <li>All these changes are recommended to be updated by using EE Login of the respective Division.</li>
            </ul>
            </p>
            @endif
        </x-alert>
    </div>
    @endif

    <x-modal-simple name="verification-modal" form-action="verify">
        <x-slot name="title">Scheme Verification</x-slot>
        Are You Sure you want to verify the Scheme ?
        <x-slot name="footer" class="text-right">
            <x-button with-spinner wire:target="verify">Verify</x-button>
        </x-slot>
    </x-modal-simple>
</div>