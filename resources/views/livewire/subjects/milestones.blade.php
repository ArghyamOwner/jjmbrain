<div>
    <x-card no-padding overflow-hidden>
        <x-slot name="header" class="border-b">
            <x-heading size="lg">Milestones</x-heading>
            <x-slot name="subheading">
                <p class="text-slate-500 text-sm">All milestones associated with a subject.</p>
            </x-slot>

            <x-slot name="action">
                @if($milestones->isNotEmpty())
                    <x-button color="white" class="text-indigo-600" tag="a" href="#" with-icon icon="add" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'milestone-create-form')" x-cloak>New milestone</x-button>
                @endif
            </x-slot>
        </x-slot>
            
        @if($milestones->isNotEmpty())
            <x-table.table :rounded="false">
                <thead>
                    <tr>
                        <x-table.thead>Name</x-table.thead>
                        {{-- <x-table.thead>Status</x-table.thead> --}}
                        <x-table.thead>Actions</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach($milestones as $milestone)
                        <tr>
                            <x-table.tdata>
                                {{ $milestone->milestone_title }}
                            </x-table.tdata>
                            {{-- <x-table.tdata>
                                {{ $milestone->status }}
                            </x-table.tdata> --}}
                            <x-table.tdata>
                                <div class="flex">
                                    <x-button-icon-edit 
                                        href="#" 
                                        x-on:click.prevent="livewire.emitTo('subjects.edit-milestone','showEditMilestoneSlideover', '{{ $milestone->id }}')" 
                                    />
                                </div>
                            </x-table.tdata>
                        </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        @else
            <div class="px-10 py-16 text-center">
                <p class="text-slate-400 text-sm mb-3">No milestones found yet.</p>

                <x-button tag="a" href="#" with-icon icon="add" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'milestone-create-form')" x-cloak>Add a milestone</x-button>
            </div>
        @endif
    </x-card>
     
    <livewire:subjects.edit-milestone />

    <x-modal-simple max-width="md" name="milestone-create-form" form-action="saveMilestone">
        <x-slot name="title">Create new milestone</x-slot>

        <x-input label="Milestone Title" name="milestoneTitle" wire:model.defer="milestoneTitle" />
         
        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="saveMilestone">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>
