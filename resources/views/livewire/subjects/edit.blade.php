<div>
    {{-- <x-slot name="title">Edit Subject</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('subjects') }}">Back to subject</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit Subject
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot> --}}
 
        
    <x-card form-action="save" card-classes="mb-8">
        <x-card-form :with-shadow="false" no-padding>
            <x-slot name="title">Subjects</x-slot>
            <x-slot name="description">Add the subjects that correspond to a school.</x-slot>
            <x-input label="Subject Name" name="subjectName" wire:model.defer="subjectName" />
            <x-input label="Subject Code" name="subjectCode" wire:model.defer="subjectCode" />
        </x-card-form>

        <x-slot name="footer" class="text-right">
            <x-button with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-card>

    {{-- <x-card no-padding overflow-hidden>
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
                        <x-table.thead>Status</x-table.thead>
                        <x-table.thead>Actions</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach($milestones as $milestone)
                        <tr>
                            <x-table.tdata>
                                {{ $milestone->milestone_title }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $milestone->status }}
                            </x-table.tdata>
                            <x-table.tdata>
                                <div class="flex">
                                    <x-button-icon-edit 
                                        href="#" 
                                        x-on:click.prevent="livewire.emitTo('subjects.edit-milestone','showEditMilestoneSlideover', '{{ $milestone->id }}')" 
                                    />

                                    <x-button-icon-delete 
                                        href="#" 
                                            
                                    />
                                </div>
                            </x-table.tdata>
                        </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        @else
            <div class="px-10 py-16 text-center">
                <p class="text-slate-500 text-sm mb-2">No milestones found yet.</p>

                <x-button tag="a" href="#" with-icon icon="add" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'milestone-create-form')" x-cloak>Add a milestone</x-button>
            </div>
        @endif
    </x-card>
     
    <livewire:subjects.edit-milestone />

    <x-modal-simple name="milestone-create-form" form-action="saveMilestone">
        <x-slot name="title">Create new milestone</x-slot>

        <x-input label="Milestone Title" name="milestoneTitle" wire:model.defer="milestoneTitle" />
         
        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="saveMilestone">Save</x-button>
        </x-slot>
    </x-modal-simple> --}}
</div>
