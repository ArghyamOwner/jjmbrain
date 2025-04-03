<div>
    <x-slot name="title">Create Activity-Detail</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('activityDetails') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create a new Activity Detail
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-select label="Activity" name="activity_id" wire:model="activity_id">
                    <option value="">--Select a Activity--</option>
                    @foreach ($this->activities as $activityKey => $activityValue)
                        <option value="{{ $activityKey }}">{{ $activityValue }}</option>
                    @endforeach
                </x-select>

                <x-input type="date" label="Date" name="date" wire:model.defer="date" />
            </div>

            <x-section-border />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">

                @if ($this->phaseStatus)
                    <x-select label="Phase" name="phase" wire:model.defer="phase">
                        <option value="">--Select an option--</option>
                        @foreach ($phases as $phaseKey => $phaseValue)
                            <option value="{{ $phaseKey }}">{{ $phaseValue }}</option>
                        @endforeach
                    </x-select>
                @endif

                @if ($this->district_idStatus)
                    <x-select label="District" name="district_id" wire:model="district_id">
                        <option value="">--Select a District--</option>
                        @foreach ($this->districts as $districtKey => $districtValue)
                            <option value="{{ $districtKey }}">{{ $districtValue }}</option>
                        @endforeach
                    </x-select>
                @endif

                @if ($this->block_idStatus)
                    <x-select label="Block" name="block_id" wire:model="block_id">
                        <option value="">--Select a Block--</option>
                        @foreach ($this->blocks as $blockKey => $blockValue)
                            <option value="{{ $blockKey }}">{{ $blockValue }}</option>
                        @endforeach
                    </x-select>
                @endif

                @if ($this->panchayat_idStatus)
                    <x-select label="Gaon-Panchayat" name="panchayat_id" wire:model="panchayat_id">
                        <option value="">--Select a Gaon-Panchayat--</option>
                        @foreach ($this->gps as $gpKey => $gpValue)
                            <option value="{{ $gpKey }}">{{ $gpValue }}</option>
                        @endforeach
                    </x-select>
                @endif

                @if ($this->village_idStatus)
                    <x-select label="Village" name="village_id" wire:model="village_id">
                        <option value="">--Select a Village--</option>
                        @foreach ($this->villages as $villageKey => $villageValue)
                            <option value="{{ $villageKey }}">{{ $villageValue }}</option>
                        @endforeach
                    </x-select>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">

                @if ($this->venueStatus)
                    <x-input label="Venue" name="venue" wire:model.defer="venue" />
                @endif

                @if ($this->minutesStatus)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file type: PDF"
                            accept-files="application/pdf" label="Upload Minutes Document" name="minutes"
                            wire:model.defer="minutes" />
                    </div>
                @endif

                @if ($this->resolutionStatus)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file type: PDF"
                            accept-files="application/pdf" label="Upload Resolution Document" name="resolution"
                            wire:model.defer="resolution" />
                    </div>
                @endif

                @if ($this->attendanceStatus)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file types: JPG, PNG"
                            label="Upload Attendance Photo" name="attendance" wire:model.defer="attendance" />
                    </div>
                @endif

                @if ($this->photo1Status)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file types: JPG, PNG"
                            label="Upload Photo-1" name="photo1" wire:model.defer="photo1" />
                    </div>
                @endif

                @if ($this->photo2Status)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file types: JPG, PNG"
                            label="Upload Photo-2" name="photo2" wire:model.defer="photo2" />
                    </div>
                @endif

                @if ($this->topicsStatus)
                    <x-input label="Topics" name="topics" wire:model.defer="topics" />
                @endif

                @if ($this->committee_photoStatus)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file types: JPG, PNG"
                            label="Upload Committee Photo" name="committee_photo"
                            wire:model.defer="committee_photo" />
                    </div>
                @endif

                @if ($this->membersStatus)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file types: JPG, PNG"
                            label="Upload Members Photo" name="members" wire:model.defer="members" />
                    </div>
                @endif

                @if ($this->locations_visitedStatus)
                    <x-input label="Locations Visited" name="locations_visited"
                        wire:model.defer="locations_visited" />
                @endif

                @if ($this->messageStatus)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file types: JPG, PNG"
                            label="Upload Message Photo" name="message" wire:model.defer="message" />
                    </div>
                @endif

                @if ($this->categoryStatus)
                    <x-select label="Category" name="category" wire:model="category">
                        <option value="">--Select a Category--</option>
                        @foreach ($categories as $catKey => $catValue)
                            <option value="{{ $catKey }}">{{ $catValue }}</option>
                        @endforeach
                    </x-select>
                @endif

                @if($this->praStatus)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file type: PDF"
                            accept-files="application/pdf" label="Upload PRA Document" name="pra"
                            wire:model.defer="pra" />
                    </div>
                @endif

                @if ($this->summaryStatus)
                    <div class="col-span-2">
                        <x-textarea-simple optional label="Summary" name="summary" wire:model.defer="summary" />
                    </div>
                @endif

                @if ($this->vapStatus)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file type: PDF"
                            accept-files="application/pdf" label="Upload VAP Document" name="vap"
                            wire:model.defer="vap" />
                    </div>
                @endif

                @if ($this->key_pointsStatus)
                    <div class="col-span-2">
                        <x-textarea-simple optional label="Key Points" name="key_points"
                            wire:model.defer="key_points" />
                    </div>
                @endif

                @if ($this->letterStatus)
                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file type: PDF"
                            accept-files="application/pdf" label="Upload Letter PDF" name="letter"
                            wire:model.defer="letter" />
                    </div>
                @endif

                @if ($this->is_registeredStatus)
                    <x-select label="Is Registered ?" name="is_registered" wire:model="is_registered">
                        <option value="">--Select an Option--</option>
                        @foreach ($appliedOptions as $optKey => $optValue)
                            <option value="{{ $optKey }}">{{ $optValue }}</option>
                        @endforeach
                    </x-select>

                    <x-input label="Registration Number" name="registration_no"
                        wire:model.defer="registration_no" />
                @endif

                @if ($this->is_acc_openedStatus)
                    <x-select label="Is Account Opened ?" name="is_acc_opened" wire:model="is_acc_opened">
                        <option value="">--Select an Option--</option>
                        @foreach ($appliedOptions as $optKey => $optValue)
                            <option value="{{ $optKey }}">{{ $optValue }}</option>
                        @endforeach
                    </x-select>

                    <x-input label="Account Number" name="account_no" wire:model.defer="account_no" />

                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file type: PDF"
                            accept-files="application/pdf" label="Upload Bank Passbook" name="bank_passbook"
                            wire:model.defer="bank_passbook" />
                    </div>
                @endif

                @if ($this->is_gp_approvedStatus)
                    <x-select label="Is Approved by GP ?" name="is_gp_approved" wire:model="is_gp_approved">
                        <option value="">--Select an Option--</option>
                        @foreach ($appliedOptions as $optKey => $optValue)
                            <option value="{{ $optKey }}">{{ $optValue }}</option>
                        @endforeach
                    </x-select>

                    <div class="col-span-2">
                        <x-filepond hint="Maximum file size: 2 MB. Allowed file type: PDF"
                            accept-files="application/pdf" label="If Approved, Upload a Copy"
                            name="gp_approved_copy" wire:model.defer="gp_approved_copy" />
                    </div>
                @endif
            </div>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,document">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
