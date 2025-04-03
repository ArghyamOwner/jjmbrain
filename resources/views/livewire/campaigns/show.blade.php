<div>
    <x-slot name="title">Campaigns Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('campaigns') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Campaign Details
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card card-classes="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-4">
                    <div class="md:col-span-3">
                        <x-heading size="xl" class="mb-2">{{ $name }}</x-heading>
                        <div class="text-sm grid grid-cols-1 md:grid-cols-3 gap-y-1.5 gap-x-6">
                            <div class="text-slate-500">
                                Status: <strong class="text-slate-700">{!! $statusName !!}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="border-t pt-2 mt-4 md:border-t-0 md:mt-0">
                        <div class="flex space-x-1 md:justify-end">
                            <x-button-icon-edit href="{{ route('campaigns.edit', $campaignId) }}" />
                            <x-button-icon-delete href="#" x-data="{}"
                                x-on:click="$wire.emitTo(
                                'campaigns.delete',
                                'showDeleteModal',
                                '{{ $campaignId }}',
                                'Are you sure you want to delete this campaign and all of its associated questions?',
                                'This action cannot be undone and all data related to this campaign will be permanently removed. Please confirm that you wish to proceed with the deletion.'
                            )"
                                x-cloak />
                        </div>
                    </div>
                </div>
            </x-card>

            <livewire:questions.index :campaign-id="$campaignId" :number-of-questions="$noOfQuestions" />

            <livewire:campaigns.delete />
            <div class="mt-4">
                <livewire:campaigns.result :campaign-id="$campaignId" />
            </div>
        </x-section-centered>
</div>
