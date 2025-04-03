<div>
    <x-slot name="title">All Subjects</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Subjects
            </x-slot>

            <x-slot name="action">
                @can('admin')
                <x-button tag="a" href="#" with-icon icon="add" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'subject-create-form')" x-cloak>New Subject</x-button> 
                @endcan   
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        
        <x-card no-padding overflow-hidden>    
            @if($subjects->isNotEmpty())
                <div class="p-3 border-b grid grid-cols-1 gap-4">
                    <div>
                        <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search subject..." />
                    </div>
                </div>

                <x-table.table :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Class</x-table.thead>
                            <x-table.thead>Subject Name</x-table.thead>
                            <x-table.thead>Subject Code</x-table.thead>
                            <x-table.thead>Actions</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <x-table.tdata>
                                    {{ $subject->class->class_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $subject->subject_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $subject->subject_code }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-edit href="{{ route('subjects.tabs', $subject->id) }}" />
                                    </div>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else 
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        <div class="mt-5">{{ $subjects->links() }}</div>

    </x-section-centered>
        
    <x-modal-simple max-width="md" name="subject-create-form" form-action="save">
        <x-slot name="title">Create new subject</x-slot>

        <x-input label="Subject Name" name="subjectName" wire:model.defer="subjectName" />
        <x-input label="Subject Code" name="subjectCode" wire:model.defer="subjectCode" />

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>