<div>
    <x-slot name="title">Create Jal Shala</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jalshalas.index') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create Jal Shala
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- <x-select label="Type" name="type" wire:model.defer="type">
                    <option value="">--Select a type--</option>
                    @foreach ($this->jalshalaTypes as $typeObject)
                        <option value="{{ $typeObject->value }}">{{ $typeObject->name }}</option>
                    @endforeach
                </x-select> --}}

                <x-select label="District" name="district" wire:model="district">
                    <option value="">--Select a district--</option>
                    @foreach ($this->districts as $districtKey => $districtName)
                        <option value="{{ $districtKey }}">{{ $districtName }}</option>
                    @endforeach
                </x-select>

                {{-- <x-select label="Development Block" name="block" wire:model="block">
                        <option value="">--Select a block--</option>
                        @foreach ($blocks as $blockKey => $blockName)
                            <option value="{{ $blockKey }}">{{ $blockName }}</option>
                        @endforeach
                    </x-select> --}}

                {{-- <x-select label="Education Block" name="education_block_id" wire:model="education_block_id">
                    <option value="">--Select an Education block--</option>
                    @foreach ($educationBlocks as $eduBlockKey => $eduBlockName)
                        <option value="{{ $eduBlockKey }}">{{ $eduBlockName }}</option>
                    @endforeach
                </x-select> --}}


                <x-input label="Jal shala ID (Unique ID)" name="jalshala_uin" class="uppercase"
                    wire:model.defer="jalshala_uin" />

                <x-virtual-select hint="You can select more than one Education Block for the Jal Shala"
                    label="Education Block" name="education_block_id" wire:model.defer="education_block_id"
                    :options="[
                        'options' => $educationBlocksArray,
                        'multiple' => true,
                        'showValueAsTags' => true,
                        'placeholder' => 'Select Education Blocks',
                        'searchPlaceholderText' => 'Search Education Blocks...',
                    ]" />

            </div>

            {{-- <x-virtual-select 
                    hint="You can select more than one PWSS for the Jal Shala" label="Scheme"
                    name="scheme" 
                    wire:model.defer="scheme" 
                    :options="[
                        'options' => $schemesArray,
                        'multiple' => true,
                        'showValueAsTags' => true,
                        'placeholder' => 'Select schemes',
                        'searchPlaceholderText' => 'Search schemes...',
                    ]" 
                /> --}}

            {{-- <x-virtual-select-remote hint="You can select more than one PWSS for the Jal Shala" label="Scheme"
                    name="scheme" wire:model.defer="scheme" :options="[
                        'multiple' => true,
                        'showValueAsTags' => true,
                        'placeholder' => 'Select schemes',
                        'searchPlaceholderText' => 'Search schemes...',
                    ]" 
                /> --}}

            <div class="mb-5">
                <x-label class="mb-1" for="school">Schemes</x-label>
                <x-text-hint class="mb-1">You can select more than one PWSS for the Jal Shala.</x-text-hint>
                <x-input-error for="jalshalaSchemes" class="mb-1" />

                @if ($jalshalaSchemes)
                    <div class="my-3">
                        <x-table.table :with-shadow="false" table-bordered>
                            <thead>
                                <tr>
                                    <x-table.thead>Scheme Name</x-table.thead>
                                    <x-table.thead>Action</x-table.thead>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($jalshalaSchemes as $jalshalaScheme)
                                    <tr>
                                        <x-table.tdata>
                                            {{ $jalshalaScheme['scheme_name'] }}
                                        </x-table.tdata>
                                        <x-table.tdata>
                                            <x-button-icon-delete
                                                x-on:click.prevent="$wire.deleteScheme('{{ $jalshalaScheme['id'] }}')" />
                                        </x-table.tdata>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-table.table>
                    </div>
                @endif

                <x-button color="white" class="py-2 text-indigo-600 mt-2" with-icon icon="add" type="button"
                    x-data x-on:click="$dispatch('show-modal', 'add-scheme-modal')" x-cloak>Add Scheme</x-button>
            </div>

            <div class="mb-5">
                <x-label class="mb-1" for="school">Schools</x-label>
                <x-text-hint class="mb-1">You can add more than one school for the Jal Shala, keeping in mind that
                    school premise is within walkable distance from the above selected scheme.</x-text-hint>
                <x-input-error for="jalshalaSchools" class="mb-1" />

                @if ($jalshalaSchools)
                    <div class="my-3">
                        <x-table.table :with-shadow="false" table-bordered>
                            <thead>
                                <tr>
                                    <x-table.thead>School Name</x-table.thead>
                                    <x-table.thead>Teacher Name</x-table.thead>
                                    <x-table.thead>Phone Number</x-table.thead>
                                    <x-table.thead>Action</x-table.thead>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($jalshalaSchools as $jalshalaSchool)
                                    <tr>
                                        <x-table.tdata>
                                            {{ $jalshalaSchool['school_name'] }}
                                        </x-table.tdata>
                                        <x-table.tdata class="capitalize text-sm">
                                            {{ $jalshalaSchool['teacher_name'] }}
                                        </x-table.tdata>
                                        <x-table.tdata>
                                            {{ $jalshalaSchool['phone_number'] }}
                                        </x-table.tdata>
                                        <x-table.tdata>
                                            <x-button-icon-delete
                                                x-on:click.prevent="$wire.deleteSchool('{{ $jalshalaSchool['id'] }}')" />
                                        </x-table.tdata>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-table.table>
                    </div>
                @endif

                <x-button color="white" class="py-2 text-indigo-600 mt-2" with-icon icon="add" type="button"
                    x-data x-on:click="$dispatch('show-modal', 'add-school-modal')" x-cloak>Add School</x-button>
            </div>

            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>

                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>

        <x-modal-simple name="add-school-modal" form-action="addSchool">
            <x-slot:title>Add School for the Jal Shala</x-slot>

            <x-select label="Education Block" name="educationBlock" wire:model="educationBlock">
                <option value="">--Select a block--</option>
                @foreach ($educationBlocks as $blockKey => $blockName)
                    <option value="{{ $blockKey }}">{{ $blockName }}</option>
                @endforeach
            </x-select>

            <x-virtual-select label="School" name="schoolId" wire:model="schoolId" :options="[
                'options' => $this->schools,
            ]" custom-label />


            {{-- <x-input 
                label="School Name"
                name="school_name"
                wire:model.defer="school_name"
            />     --}}

            <x-input label="Teacher Name" name="teacher_name" wire:model.defer="teacher_name" />

            <x-input-number label="Mobile Number" name="phone_number" wire:model.defer="phone_number" />

            <x-slot:footer>
                <x-button with-spinner wire:target="addSchool">Save</x-button>
            </x-slot>
        </x-modal-simple>

        <x-modal-simple name="add-scheme-modal" form-action="addScheme">
            <x-slot:title>Add Scheme for the Jal Shala</x-slot>

            <div class="mb-8">
                <x-select label="Development Block" name="block" wire:model="block">
                    <option value="">--Select a block--</option>
                    @foreach ($blocks as $blockKey => $blockName)
                        <option value="{{ $blockKey }}">{{ $blockName }}</option>
                    @endforeach
                </x-select>

                <x-virtual-select hint="You can select more than one PWSS for the Jal Shala" label="Scheme"
                    name="scheme" wire:model.defer="scheme" :options="[
                        'options' => $schemesArray,
                        //  'multiple' => true,
                        'showValueAsTags' => true,
                        'placeholder' => 'Select schemes',
                        'searchPlaceholderText' => 'Search schemes...',
                    ]" />
            </div>
            <x-slot:footer>
                <x-button with-spinner wire:target="addScheme">Save</x-button>
            </x-slot>
        </x-modal-simple>
    </x-section-centered>
</div>
