<div>
    <x-slot name="title">{{ $grievance->reference_no }}</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('grievances') }}">Go Back</x-text-link>
    </x-slot>

    @if ($grievance->status != 'resolved')
        <x-slot name="action">
            <x-button color="red" tag="a" href="#" x-data
                x-on:click.prevent="Livewire.emit('addIssueCloseSlideover', '{{ $grievance->id }}')" x-cloak>Close Issue
            </x-button>
        </x-slot>
    @endif

    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if ($grievance->scheme)
            @if (is_null($grievance->scheme?->work_status))
                <x-alert :close="false" class="mb-2">Note that this scheme is not updated, Please update the status
                    click
                    here: <x-link variant="danger" href="{{ route('schemes.show', $grievance->scheme?->id) }}">
                        {{ $grievance->scheme?->name }}</x-link> .</x-alert>
            @endif
        @endif
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <x-card>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-4">
                        <x-badge class="mb-2" variant="{{ $grievance->priority_color }}">
                            {{ $grievance->priority }}</x-badge>


                        <x-heading size="xl" class="mb-4">{{ $grievance->reference_no }}</x-heading>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-medium">Division Name
                                </p>
                                <p class="text-slate-900 text-sm">{{ $grievance->division?->name }}</p>
                            </div>

                            <div>
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-medium">Scheme IMIS
                                </p>
                                <p class="text-slate-900 text-sm font-bold">
                                    {{ $grievance->scheme?->imis_id ?? 'NA' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-medium">Scheme Status</p>
                                <p class="text-slate-900 text-sm capitalize font-bold">
                                    {{ $grievance->scheme?->work_status ?? 'NA' }}</p>
                            </div>

                            <div>
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-medium">Status</p>
                                <p class="text-slate-900 text-sm capitalize font-bold">{{ $grievance->status }}</p>
                            </div>
                            
                            <div>
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-medium">Channel</p>
                                <p class="text-slate-900 text-sm capitalize font-bold">{{ $grievance->platform }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>

            <div class="bg-white rounded-md shadow">
                <div class="px-4 py-2 border-b border-gray-200">
                    <div class="grid grid-cols-1">
                        <div>
                            <x-heading size="lg">Scheme Details</x-heading>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="divide-y divide-gray-100">
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Scheme Name:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $grievance->scheme?->name ?? 'NA' }}
                            </p>
                        </div>
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">District Name:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $grievance->district?->name ?? 'NA' }}
                            </p>
                        </div>
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Block:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $grievance->block?->name ?? 'NA' }}
                            </p>
                        </div>
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Panchayat:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $grievance->panchayat?->panchayat_name ?? 'NA' }}
                            </p>
                        </div>
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Village:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $grievance->village?->village_name ?? 'NA' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-md shadow">
                <div class="px-4 py-2 border-b border-gray-200">
                    <div class="grid grid-cols-1">
                        <div>
                            <x-heading size="lg">Beneficiary / Citizen Details</x-heading>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="divide-y divide-gray-100">
                        @if ($grievance->beneficiary)
                            <div class="py-2 px-2 grid grid-cols-2">
                                <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Beneficiary
                                    Name:</div>
                                <p class="text-slate-900 text-sm">
                                    {{ $grievance->beneficiary?->beneficiary_name ?? 'NA' }}
                                </p>
                            </div>
                            <div class="py-2 px-2 grid grid-cols-2">
                                <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Beneficiary
                                    Phone Number:</div>
                                <p class="text-slate-900 text-sm">
                                    {{ $grievance->beneficiary_phone ?? 'NA' }}
                                </p>
                            </div>
                        @endif
                        @if ($grievance->citizen_name)
                            <div class="py-2 px-2 grid grid-cols-2">
                                <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Citizen Name:
                                </div>
                                <p class="text-slate-900 text-sm">
                                    {{ $grievance->citizen_name ?? 'NA' }}
                                </p>
                            </div>
                        @endif
                        @if ($grievance->citizen_phone)
                            <div class="py-2 px-2 grid grid-cols-2">
                                <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Phone Number:
                                </div>
                                <p class="text-slate-900 text-sm">
                                    {{ $grievance->citizen_phone ?? 'NA' }}
                                </p>
                            </div>
                        @endif
                        {{-- <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Priority:</div>
                            <p class="text-slate-900 text-sm capitalize font-bold">
                                {{ $grievance->priority ?? 'NA' }}
                            </p>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-md shadow">
                <div class="px-4 py-2 border-b border-gray-200">
                    <div class="grid grid-cols-2">
                        <div>
                            <x-heading size="lg">Issue Details</x-heading>
                        </div>
                        @if (!$grievance->issue)
                            <div class="text-right">
                                <x-button color="white" tag="a" href="#" x-data class="w-30 text-blue-500"
                                    x-on:click.prevent="$dispatch('show-modal', 'save')" x-cloak>
                                    Update Reason
                                </x-button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-4">
                    <div class="divide-y divide-gray-100">
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Category:</div>
                            <p class="text-slate-900 text-sm">
                                {{ $grievance->category?->name ?? 'NA' }}
                            </p>
                        </div>

                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Sub-Category:</div>
                            <p class="text-slate-900 text-sm">
                                {{ $grievance->subCategory?->name ?? 'NA' }}
                            </p>
                        </div>

                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Issue:</div>
                            <p class="text-slate-900 text-sm">
                                {{ $grievance->issue?->issue ?? 'NA' }}
                            </p>
                        </div>

                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Description:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $grievance->description ?? 'NA' }}
                            </p>
                        </div>

                        @if ($grievance->platform === 'whatsapp')
                            <div class="mt-3">
                                <x-lightbox>
                                    <x-lightbox.item image-url="{{ $grievance->attachment }}" target="_blank">
                                        <img
                                            loading="lazy"
                                            class="h-24 mx-auto object-fit"
                                            src="{{ $grievance->attachment }}"
                                        />
                                    </x-lightbox.item>
                                </x-lightbox>
                            </div>
                        @endif

                        @if ($grievance->images->isNotEmpty())
                            <x-lightbox>
                                <div class="mt-4 grid grid-cols-4 gap-6">
                                    @foreach ($grievance->images as $image)
                                        <div class="rounded-lg bg-slate-100 overflow-hidden text-center">
                                            <x-lightbox.item image-url="{{ $image->image_url }}">
                                                <img src="{{ $image->image_url }}" alt="image" loading="lazy"
                                                    class="h-24 mx-auto object-fit">
                                            </x-lightbox.item>
                                        </div>
                                    @endforeach
                                </div>
                            </x-lightbox>
                        @endif
                    </div>
                </div>
            </div>

            {{-- <div class="bg-white rounded-md shadow">
                <div class="px-4 py-2 border-b border-gray-200">
                    <div class="grid grid-cols-2">
                        <div>
                            <x-heading size="lg">Escalation Matrix</x-heading>
                        </div>
                    </div>
                </div>
                <div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Level</x-table.thead>
                                <x-table.thead>Role</x-table.thead>
                                <x-table.thead>Days</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grievance->escalation_matrix as $escalationMatrix)
                                <tr>
                                    <x-table.tdata>
                                        {{ $escalationMatrix['level'] }}
                                    </x-table.tdata>
                                    <x-table.tdata class="capitalize">
                                        {{ $escalationMatrix['role'] ?? 'NA' }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $escalationMatrix['days'] ?? 'NA' }}
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
            </div> --}}

            <x-modal-simple max-width="lg" form-action="update" name="save">
                <x-slot name="title">Update Reason Details</x-slot>

                <x-select label="Reason" name="issueId" wire:model.defer="issueId">
                    <option value="">--Select a reason--</option>
                    @foreach ($this->issues as $issueKey => $issueValue)
                        <option value="{{ $issueKey }}">{{ __($issueValue) }}</option>
                    @endforeach
                </x-select>

                <x-slot name="footer">
                    <x-button color="black" type="submit" wire:target="update" with-spinner>Save</x-button>
                </x-slot>
            </x-modal-simple>
        </div>

        {{-- @if ($grievance->issue) --}}

        <div class="mt-3 mb-6">
            <livewire:assign-grievance-tasks.index :grievance='$grievance->id' />
        </div>

        <x-card class="mt-3">
            <livewire:comments.show :grievance='$grievance->id' />
        </x-card>


        @if ($grievance->status != 'resolved')
            <div class="mt-6">
                <livewire:comments.create :grievance='$grievance->id' />
            </div>
        @endif

        {{-- @endif --}}

    </x-section-centered>

    <livewire:grievances.close-issue />

</div>
