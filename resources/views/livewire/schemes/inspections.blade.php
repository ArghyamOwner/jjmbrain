<div>
    <x-slot name="title">Scheme Inspections</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $schemeId) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Scheme Inspections
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if($inspections->isNotEmpty())
            <x-card no-padding overflow-hidden>
                <div class="text-sm">
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Name</x-table.thead>
                                @foreach($inspections->values()->all()[0] as $section)
                                <x-table.thead>{{ $section->reviewSection->title }}</x-table.thead>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inspections as $userName => $reviews)
                            <tr>
                                <x-table.tdata>{{ $userName }}</x-table.tdata>
                                @foreach($reviews as $review)
                                    <x-table.tdata>
                                        {{ $review->section_marks }}
                                        <div>
                                            <x-text-link href="#" 
                                                x-data="{}"
                                                x-cloak
                                                x-on:click.prevent="Livewire.emit('inspectionDetailsSlideover', '{{ $review->id }}')"
                                                class="text-xs">View Details</x-text-link>
                                        </div>
                                </x-table.tdata>
                                @endforeach
                            </tr>    
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
            </x-card>
        @else 
            <x-card-empty class="shadow-none rounded-none" />
        @endif
    </x-section-centered>

    <livewire:schemes.inspection-details />
</div>