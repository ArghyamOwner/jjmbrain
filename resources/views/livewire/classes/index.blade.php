<div>
    <x-slot name="title">All Classes</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Classes
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="#" with-icon icon="add">New Class</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-card no-padding overflow-hidden>
            @if($classes->isNotEmpty())
                <x-table.table :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Class</x-table.thead> 
                            <x-table.thead>Subjects</x-table.thead>
                            <x-table.thead>Actions</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $class)
                            <tr>
                                <x-table.tdata>
                                    {{ $class->class_grade }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{-- @json($class->subjects) --}}
                                    {{ $class->subjects->pluck('subject_name_formatted')->join(', ') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-edit 
                                            href="{{ route('classes.edit', $class->id) }}" 
                                        />
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
    </x-section-centered>
</div>