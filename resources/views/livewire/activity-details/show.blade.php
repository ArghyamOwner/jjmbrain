<div>
    <x-slot name="title">{{ $detail?->activity?->name }}</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('activityDetails') }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:action>
                @if($showDistrictApproval)
                    <livewire:activity-details.district-approval :activity="$detail" />
                @endif
                <x-button class="truncate" tag="a" href="{{ route('activity.assignIsa', $detail->id) }}"
                    color="indigo" with-icon icon="link">Attached ISA(s)</x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="mb-6">
            <x-card>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-4">
                        <div class="flex items-center justify-between mb-2 space-x-2">
                            <x-badge class="mb-2" variant="warning">{{ $detail->phase_name }}</x-badge>
                            @if($detail->district_user_id)
                            <div class="flex items-center space-x-2">
                                <x-badge variant="success">ISA Approved</x-badge>
                                <span class="text-gray-400">|</span>
                                <p>By {{ $detail->districtUser?->name }} </p>
                                <span class="text-gray-400">|</span>
                                <p>@date($detail->district_approved_date)</p>
                            </div>
                            @else
                                <x-badge variant="danger">Not Approved</x-badge>
                            @endif
                        </div>

                        <x-heading size="xl" class="mb-4">{{ $detail?->activity?->name ?? '-' }}
                            <span class="text-sm ml-2">
                                ( Date : @date($detail->date) )
                            </span>
                        </x-heading>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-medium">District
                                    : <span class="text-slate-900 text-sm font-bold">{{ $detail?->district?->name
                                        }}</span>
                                </p>
                            </div>

                            <div>
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-medium">Block
                                    : <span class="text-slate-900 text-sm font-bold">{{ $detail?->block?->name ??
                                        'NA' }}</span>
                                </p>
                            </div>

                            <div>
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-medium">Panchayat
                                    : <span class="text-slate-900 text-sm font-bold">{{
                                        $detail?->panchayat?->panchayat_name ?? 'NA' }}</span>
                                </p>
                            </div>

                            <div>
                                <p class="text-slate-500 text-xs uppercase tracking-wider font-medium">Village
                                    : <span class="text-slate-900 text-sm capitalize font-bold">{{
                                        $detail?->village?->village_name }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-md shadow">
                <div class="px-4 py-2 border-b border-gray-200">
                    <div class="grid grid-cols-1">
                        <div>
                            <x-heading size="lg">Documents</x-heading>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="divide-y divide-gray-100">
                        @if ($this->minutesStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Minutes
                                Document:</div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->minutes_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->praStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">PRA Document:
                            </div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->pra_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->is_acc_openedStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Bank Passbook :
                            </div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->bank_passbook_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->is_gp_approvedStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">GP Approved
                                Copy :</div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->gp_approved_copy_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->resolutionStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Resolution
                                Document :</div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->resolution_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->attendanceStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Atendance
                                Document :</div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->attendance_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->photo1Status)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Photo 1 :</div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->photo1_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->photo2Status)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Photo 2 :</div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->photo2_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->committee_photoStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Committee Photo
                                :</div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->committee_photo_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->membersStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Members :</div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->members_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->messageStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Messages :
                            </div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->message_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->vapStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">VAP :</div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->vap_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif
                        @if ($this->letterStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Letter :</div>
                            <p class="text-slate-900 text-sm capitalize">
                                <x-text-link target="_blank" href="{{ $detail->letter_url }}">
                                    <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                                </x-text-link>
                            </p>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="bg-white rounded-md shadow">
                <div class="px-4 py-2 border-b border-gray-200">
                    <div class="grid grid-cols-1">
                        <div>
                            <x-heading size="lg">Details</x-heading>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="divide-y divide-gray-100">
                        @if ($this->venueStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Venue :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->venue ?? 'NA' }}
                            </p>
                        </div>
                        @endif
                        @if ($this->topicsStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Topics :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->topics ?? 'NA' }}
                            </p>
                        </div>
                        @endif
                        @if ($this->locations_visitedStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Locations Visited :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->locations_visited ?? 'NA' }}
                            </p>
                        </div>
                        @endif
                        @if ($this->categoryStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Category :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->category_name ?? 'NA' }}
                            </p>
                        </div>
                        @endif
                        @if ($this->summaryStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Summary :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->summary ?? 'NA' }}
                            </p>
                        </div>
                        @endif
                        @if ($this->key_pointsStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Key Points :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->key_points ?? 'NA' }}
                            </p>
                        </div>
                        @endif
                        @if ($this->is_registeredStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Is Registered ? :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->is_registered ?? 'NA' }}
                            </p>
                        </div>
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Registration Numner ? :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->registration_no ?? 'NA' }}
                            </p>
                        </div>
                        @endif
                        @if ($this->is_acc_openedStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Is Acount Opened ? :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->is_acc_opened ?? 'NA' }}
                            </p>
                        </div>
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Account Numner ? :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->account_no ?? 'NA' }}
                            </p>
                        </div>
                        @endif
                        @if ($this->is_gp_approvedStatus)
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">
                                Is Approved By GP ? :</div>
                            <p class="text-slate-900 text-sm">
                                {{ $detail->is_gp_approved ?? 'NA' }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <livewire:activity-details.isas :activity="$detail" />

    </x-section-centered>
</div>