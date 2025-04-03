<div>
    <x-slot name="title">Meeting</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('meetingMinutes') }}">
                    Go Back
                </x-text-link>
            </x-slot>
            <x-slot:title>
                Meeting Details
            </x-slot>
            <x-slot name="action">
                <div class="flex space-x-2">
                    @if(! $meeting->minutes)
                    <x-button tag="a" href="#" x-data="{}" with-icon icon="add"
                        x-on:click.prevent="$dispatch('show-modal', 'minutes-form')" x-cloak>Meeting Minutes
                    </x-button>
                    @endif
                </div>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8"> --}}
            <x-card>
                <x-description-list size="xs">

                    <x-description-list.item>
                        <x-slot name="title">Title</x-slot>
                        <x-slot name="description">
                            {{ $meeting->meeting_name }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Meeting Type</x-slot>
                        <x-slot name="description">
                            <x-badge variant="success">{{ $meeting->type }}</x-badge>
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Date & Time</x-slot>
                        <x-slot name="description">
                            @dateWithTime($meeting->meeting_date)
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">
                            Description
                        </x-slot>
                        <x-slot name="description">
                            {{ $meeting->description }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">User Group</x-slot>
                        <x-slot name="description">
                            {{ $meeting->user_group }}
                        </x-slot>
                    </x-description-list.item>
                    
                    <x-description-list.item>
                        <x-slot name="title">Name of Vertical/Training</x-slot>
                        <x-slot name="description">
                            {{ $meeting->vertical_name }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Venue / Link</x-slot>
                        <x-slot name="description">{{ $meeting->venue ?? $meeting->link }} </x-slot>
                    </x-description-list.item>

                    @if($meeting->minute_url)
                    <x-description-list.item>
                        <x-slot name="title">Minute Document</x-slot>
                        <x-slot name="description">
                            @date($meeting->minute_date)
                            <p>
                                <x-button tag="a" target="_blank" href="{{ $meeting->minute_url }}" color="white"
                                    with-icon icon="download">Download</x-button>
                            </p>
                        </x-slot>
                    </x-description-list.item>
                    @endif

                    <x-description-list.item>
                        <x-slot name="title">Created By</x-slot>
                        <x-slot name="description">
                            {{ $meeting->createdBy?->name }}
                        </x-slot>
                    </x-description-list.item>

                </x-description-list>
            </x-card>
            {{--
        </div> --}}
    </x-section-centered>

    <x-modal-simple max-width="md" name="minutes-form" form-action="minuteUpdate">
        <x-slot name="title">Meeting Minute</x-slot>

        <div class="col-span-2">
            <x-filepond hint="Maximum file size: 2 MB. Allowed file type: PDF" accept-files="application/pdf"
                label="Upload Minutes Document" name="minutes" wire:model.defer="minutes" />
        </div>

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="minuteUpdate">Save</x-button>
        </x-slot>
    </x-modal-simple>

</div>