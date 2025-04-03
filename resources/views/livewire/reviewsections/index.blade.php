<div>
    <x-slot name="title">Review Sections</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Review Sections
            </x-slot>
            <x-slot name="action">
                <x-button type="button" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'review-section-create')" with-icon icon="add">
                    New Review Section
                </x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if ($reviewsections->isNotEmpty())
                <x-table.table :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Title</x-table.thead>
                            <x-table.thead class="text-center">Total Questions</x-table.thead>
                            {{-- <x-table.thead class="text-center">Total Marks</x-table.thead> --}}
                            <x-table.thead>Actions</x-table.thead>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($reviewsections as $reviewsection)
                            <tr>
                                <x-table.tdata>
                                    {{ $reviewsection->title }}
                                    {{-- <x-text-link href="{{ route('reviewsections.show', $reviewsection->id) }}">{{ $reviewsection->title }}</x-text-link> --}}
                                </x-table.tdata>
                                <x-table.tdata class="text-center">
                                    {{ $reviewsection->review_questions_count }}
                                </x-table.tdata>
                                {{-- <x-table.tdata class="text-center">
                                    {{ number_format($reviewsection->points, 0) }}
                                </x-table.tdata> --}}
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                         <x-button-icon-edit
                                            href="{{ route('reviewsections.show', $reviewsection->id) }}"
                                         />

                                        {{-- <x-button-icon-delete
                                            x-on:click.prevent="$wire.emitTo(
                                                'issues.delete',
                                                'showDeleteModal',
                                                '{{ $issue->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this issue?',
                                                '{{ $issue->issue }}'
                                            )" 
                                        /> --}}

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
        {{-- @if ($reviewsections->hasPages())
            <div class="mt-5">{{ $reviewsections->links() }}</div>
        @endif --}}
    </x-section-centered>

    <x-modal-simple name="review-section-create" form-action="save">
        <x-slot:title>
            Add a review section
        </x-slot>

        <x-input label="Review Section Title" name="title" wire:model.defer="title" />

        <x-slot:footer>
            <x-button type="submit" wire:target="save" with-spinner>Add Review Section</x-button>
        </x-slot>
    </x-modal-simple>
</div>