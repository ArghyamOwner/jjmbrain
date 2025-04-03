<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">School Details</x-slot>

        <div class="py-4 px-5">
            @if($school)
                <x-heading size="xl">{{ $school->name }}</x-heading>
                <p class="text-slate-600 mb-1">{{ $school->district?->name }} / {{ $school->block?->name }}</p>
                <p class="mb-3 text-sm text-slate-500">{{ $school->school_address }}</p>

                <div x-data="{
                    tab: 'schoolDetails'
                }"
                x-cloak> 
                    <div class="flex bg-slate-100 rounded-md p-1 space-x-px mb-4">
                        <button type="button" class="py-1 px-2 flex-1 rounded-md border-b border-transparent" :class="{ 'bg-white border-slate-300' : tab === 'schoolDetails' }" x-on:click="tab = 'schoolDetails'">School Details</button>
                        <button type="button" class="py-1 px-2 flex-1 rounded-md border-b border-transparent" :class="{ 'bg-white border-slate-300' : tab === 'schoolFacilities'}" x-on:click="tab = 'schoolFacilities'">Facilities</button>
                    </div>

                    <div x-show="tab === 'schoolDetails'">
                        <x-description-list>
                            <x-description-list.item size="xs">
                                <x-slot name="title">Website</x-slot>
                                <x-slot name="description">{{ $school->website }}</x-slot>
                            </x-description-list.item>
                            
                            <x-description-list.item size="xs">
                                <x-slot name="title">Email</x-slot>
                                <x-slot name="description">{{ $school->email }}</x-slot>
                            </x-description-list.item>

                            <x-description-list.item size="xs">
                                <x-slot name="title">Phone</x-slot>
                                <x-slot name="description">{{ $school->phone }}</x-slot>
                            </x-description-list.item>

                            <x-description-list.item size="xs">
                                <x-slot name="title">Affiliated Board</x-slot>
                                <x-slot name="description">{{ $school->affiliated_board }}</x-slot>
                            </x-description-list.item>

                            <x-description-list.item size="xs">
                                <x-slot name="title">Operation Type</x-slot>
                                <x-slot name="description">{{ $school->operation_type }}</x-slot>
                            </x-description-list.item>
            
                            <x-description-list.item size="xs">
                                <x-slot name="title">School Geographic Area</x-slot>
                                <x-slot name="description">{{ $school->school_geographic_area }}</x-slot>
                            </x-description-list.item>
            
                            <x-description-list.item size="xs">
                                <x-slot name="title">Management Type</x-slot>
                                <x-slot name="description">{{ $school->management_type }}</x-slot>
                            </x-description-list.item>
            
                            <x-description-list.item size="xs">
                                <x-slot name="title">School Category</x-slot>
                                <x-slot name="description">{{ $school->school_category }}</x-slot>
                            </x-description-list.item>

                            <x-description-list.item size="xs">
                                <x-slot name="title">School UIN Code</x-slot>
                                <x-slot name="description">{{ $school->uin_code }}</x-slot>
                            </x-description-list.item>

                            <x-description-list.item size="xs">
                                <x-slot name="title">Total Land Area (sq. m.)</x-slot>
                                <x-slot name="description">{{ $school->total_land_area }}</x-slot>
                            </x-description-list.item>

                            <x-description-list.item size="xs">
                                <x-slot name="title">Student Capacity</x-slot>
                                <x-slot name="description">{{ $school->student_capacity }}</x-slot>
                            </x-description-list.item>

                            <x-description-list.item size="xs">
                                <x-slot name="title">Total Toilets</x-slot>
                                <x-slot name="description">{{ $school->total_toilets }}</x-slot>
                            </x-description-list.item>

                            <x-description-list.item size="xs">
                                <x-slot name="title">Functional Toilets</x-slot>
                                <x-slot name="description">{{ $school->total_functional_toilets }}</x-slot>
                            </x-description-list.item>
                        </x-description-list>
                    </div>
                
                    <div x-show="tab === 'schoolFacilities'">
                        @if ($this->amenities)
                            <div class="divide-y">
                                @foreach($this->amenities as $amenity)
                                <div class="flex items-center text-sm">
                                    <div class="px-2 py-1 flex-1 border-r">{{ $amenity['name'] }}</div>
                                    <div class="px-2 py-1 w-16">
                                        @if($amenity['available'] == true)
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-auto text-green-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-auto text-red-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </x-slideovers>
</div>
