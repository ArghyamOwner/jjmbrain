<div>
    <x-slot name="title">APDCL - Application Status</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="/">Home</x-text-link>
    </x-slot>

    <x-slot:title>
        APDCL - Application Status
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card overflow-hidden form-action="getDetail">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <x-select label="Sub-Division" name="subDiv" wire:model.defer="subDiv">
                        <option value="">--Select Sub-Division--</option>
                        @foreach($this->subDivisions as $subDivId => $subDivName)
                        <option value="{{ $subDivId }}">{{ $subDivName }}</option>
                        @endforeach
                    </x-select>

                    <x-input placeholder="Eg- 100009353" label="Application Number"  name="applNo" wire:model.defer="applNo" />

                </div>

                <x-slot name="footer" class="text-right">
                    <x-button with-spinner wire:target="getDetail">Get Details</x-button>
                </x-slot>
            </x-card>

            @if($show)

            <x-card cardClasses="mt-5">
                <div class="mb-6">

                    <x-description-list size="xs">
                        <x-slot name="heading">Application Status Details</x-slot>
                        @if($data['status'] == 'success')

                        <x-description-list.item>
                            <x-slot name="title">Application Number</x-slot>
                            <x-slot name="description"> {{ $data['applNo'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Scheme</x-slot>
                            <x-slot name="description">{{ $data['scheme'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Status</x-slot>
                            <x-slot name="description">{{ $data['applStatus'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Comment</x-slot>
                            <x-slot name="description">{{ $data['comment'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Applicant Name</x-slot>
                            <x-slot name="description">{{ $data['applicantName'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Paid Amount</x-slot>
                            <x-slot name="description">{{$data['paidAmount'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Consumer Number</x-slot>
                            <x-slot name="description">{{ $data['consNo'] ?? '-' }}</x-slot>
                        </x-description-list.item>
                        @else
                        <x-description-list.item>
                            <x-slot name="title">Application Number</x-slot>
                            <x-slot name="description"> {{ $data['applNo'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Status</x-slot>
                            <x-slot name="description">{{ $data['status'] ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Comment</x-slot>
                            <x-slot name="description">{{ $data['comment'] ?? '-' }}</x-slot>
                        </x-description-list.item>
                        @endif
                    </x-description-list>
                </div>
            </x-card>
            @endif

        </x-section-centered>
</div>