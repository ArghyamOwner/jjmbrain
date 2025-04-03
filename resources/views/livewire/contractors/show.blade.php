<div>
    <x-slot name="title">Campaigns Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('contractors') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Contractor Details
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="grid mb-5">
            <div class="mt-5 mb-5 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-md shadow">
                    <div class="p-4">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <x-heading size="lg">Basic Details of Entity/Firm
                                <span class="text-blue-500 px-4 relative pr-1">Bid ID:
                                    {{ $contractor->bid_no ?? '' }}
                                    @if ($contractor->bid_no)
                                        <span class="absolute pl-1">
                                            <x-copytoclipboard content="{{ $contractor->bid_no }}" />
                                        </span>
                                    @endif
                                </span>
                            </x-heading>
                        </div>

                        <div class="divide-y divide-gray-100">
                            <div class="py-2 px-4 grid grid-cols-3 gap-4">
                                <div class="font-semibold text-gray-500">Entity Name:</div>
                                <span class="col-span-2">
                                    {{ $contractor->entity_name ?? 'NA' }}
                                    @if ($contractor->entity_type)
                                        ({{ Str::headline($contractor->entity_type) }})
                                    @endif
                                </span>
                            </div>
                            <div class="py-2 px-4 grid grid-cols-3 gap-4">
                                <div class="font-semibold text-gray-500">Account Number:</div>
                                <span class="col-span-2">
                                    {{ $contractor->account_number ? Str::mask($contractor->account_number, '*', -7, 3) : 'NA' }}
                                </span>
                            </div>
                            <div class="py-2 px-4 grid grid-cols-3 gap-4">
                                <div class="font-semibold text-gray-500">GST Number:</div>
                                <span class="col-span-2">
                                    {{ $contractor->gst ?? 'NA' }}
                                </span>
                            </div>
                            <div class="py-2 px-4 grid grid-cols-3 gap-4">
                                <div class="font-semibold text-gray-500">Address:</div>
                                <span class="col-span-2">{{ $contractor->address ?? 'NA' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-md shadow">
                    <div class="p-4">
                        <div class="px-4 py-2">
                            <x-media>
                                <x-slot name="mediaObject">
                                    <div class="w-15 h-15 rounded-full relative">
                                        <x-avatar name="{{ $contractor?->user?->name }}" size="50" />
                                    </div>
                                </x-slot>
                                <x-slot name="mediaBody">
                                    <x-heading size="lg">{{ $contractor?->user?->name }}</x-heading>
                                    <p>{{ $contractor->position_in_the_entity ? Str::title($contractor->position_in_the_entity) : 'NA' }}
                                    </p>
                                </x-slot>
                            </x-media>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <div class="py-2 px-4 grid grid-cols-3 gap-4">
                                <div class="font-semibold text-gray-500">Phone:</div>
                                <span
                                    class="col-span-2">{{ $contractor?->user?->phone ?? 'NA' }}
                                </span>
                            </div>
                            <div class="py-2 px-4 grid grid-cols-3 gap-4">
                                <div class="font-semibold text-gray-500">Email Id:</div>
                                <span
                                    class="col-span-2">{{ $contractor?->user?->email ?? 'NA' }}
                                </span>
                            </div>
                            <div class="py-2 px-4 grid grid-cols-3 gap-4">
                                <div class="font-semibold text-gray-500">Class :</div>
                                <span class="col-span-2">
                                    {{ $contractor->contractor_type ?? 'NA' }},
                                </span>
                            </div>
                            <div class="py-2 px-4 grid grid-cols-3 gap-4">
                                <div class="font-semibold text-gray-500">Registered At:</div>
                                <span class="col-span-2">
                                    {{ $contractor->reg_dept ?? 'NA' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <livewire:contractors.workorder :contractor="$contractor->user" />

        @if(auth()->user()->isAdministrator() || auth()->user()->isTechSupport())
        <div class="bg-white rounded-md shadow mt-6">
            <div class="px-4 py-2 border-b border-gray-200">
                <div class="grid grid-cols-2">
                    <div>
                        <x-heading size="lg">Block User</x-heading>
                    </div>
                    <div class="text-right space-x-4">
                        @if($contractor?->user->blocked_at !== null)
                            <x-badge variant="danger">Blocked by {{ ($contractor?->user->blockedBy?->name ?? 'N/A').' ('.($contractor?->user->blocked_at?->diffForHumans() ?? '-').')'}}</x-badge>
                            <x-button color="cyan" tag="a" href="#" with-icon icon="check-circle" x-data="{}"
                                x-on:click.prevent="$dispatch('show-modal', 'unblock-user-form')" x-cloak>Unblock User
                            </x-button>
                        @else
                        <x-button color="red" tag="a" href="#" with-icon icon="xclose" x-data="{}"
                            x-on:click.prevent="$dispatch('show-modal', 'block-user-form')" x-cloak>Block User
                        </x-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </x-section-centered>

    <x-modal-simple max-width="lg" name="block-user-form" form-action="blockUser">
        <x-slot name="title">Block User</x-slot>
        Are you sure you want to Block this user ?
        <x-slot name="footer">
            <x-button color="red" type="submit" with-spinner wire:target="blockUser">Block</x-button>
        </x-slot>
    </x-modal-simple>

    <x-modal-simple max-width="lg" name="unblock-user-form" form-action="unblockUser">
        <x-slot name="title">Unblock User</x-slot>
        Are you sure you want to Unblock this user ?
        <x-slot name="footer">
            <x-button color="cyan" type="submit" with-spinner wire:target="unblockUser">Unblock</x-button>
        </x-slot>
    </x-modal-simple>
</div>
