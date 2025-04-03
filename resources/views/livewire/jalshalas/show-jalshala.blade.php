<div>
    <x-slot name="title">Jal Shala Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jalshalas.index') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Jal Shala Details
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @can('district-jaldoot-cell')
            <div class="text-right mb-4">
                <x-button color="red" href="#" x-data="" x-cloak
                    x-on:click.prevent="$wire.emitTo(
                                                'jalshalas.delete-jalshala',
                                                'showDeleteModal',
                                                '{{ $jalshala->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this jalshala?',
                                                '{{ $jalshala->jalshala_uin }}'
                                            )">Delete
                    Jal Shala</x-button>
            </div>
        @endcan

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <x-card>
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg">Basic Details <x-badge :withdot="false"> {{ $jalshala->type?->name }}</x-badge></x-heading>
                </x-slot>

                <x-slot:action>
                    <x-button tag="a" color="white" href="{{ route('jalshalas.edit', $jalshala->id) }}"
                        class="py-1 text-indigo-600" with-icon icon="edit">Update Jal Shala</x-button>
                </x-slot>

                <x-description-list size="xs" grid="no-break">
                    <x-description-list.item>
                        <x-slot name="title">Jal Shala ID</x-slot>
                        <x-slot name="description">{{ $jalshala->jalshala_uin }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">District</x-slot>
                        <x-slot name="description">{{ $jalshala->district?->name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Block</x-slot>
                        <x-slot name="description">{{ Str::title($jalshala->block?->name) }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Scheme</x-slot>
                        <x-slot name="description">{{ $jalshala->schemes?->pluck('name')->join(', ') }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">School</x-slot>
                        <x-slot
                            name="description">{{ $jalshala->jalshalaSchools?->pluck('school_name')->join(', ') }}</x-slot>
                    </x-description-list.item>
                </x-description-list>
            </x-card>

            <x-card overflow-hidden>
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg">Details of Jal Shala</x-heading>

                    <x-slot:action>
                        <x-button tag="a" color="white" href="{{ route('jalshalas.pre', $jalshala->id) }}"
                            class="py-1 text-indigo-600" with-icon icon="edit">Update Pre Jal Shala Data</x-button>
                    </x-slot>
                </x-slot>
                <x-description-list size="xs" grid="no-break">

                    <x-description-list.item>
                        <x-slot name="title">Jal Shala ID</x-slot>
                        <x-slot name="description">{{ $jalshala->jalshala_uin }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Day 1 Date</x-slot>
                        <x-slot name="description">{{ $jalshala->day_one?->format('d/m/Y h:i A') }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Day 2 Date</x-slot>
                        <x-slot name="description">{{ $jalshala->day_two?->format('d/m/Y h:i A') }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Venue</x-slot>
                        <x-slot name="description">{{ $jalshala->venue ?? 'n/a' }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Trainer 1 Name</x-slot>
                        <x-slot name="description">{{ $jalshala->trainerOne?->trainer_name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Trainer 2 Name</x-slot>
                        <x-slot name="description">{{ $jalshala->trainerTwo?->trainer_name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Created By</x-slot>
                        <x-slot name="description">{{ $jalshala->user?->name }}</x-slot>
                    </x-description-list.item>
                </x-description-list>
            </x-card>
        </div>

        <div class="mb-6">
            <div class="grid grid-cols-2">
                <x-heading class="m-2" size="lg">For District Co-Ordinator</x-heading>

                <div class="text-right">
                    <x-button color="white" class="py-2 text-indigo-600" with-icon icon="add" type="button"
                        tag="a" target="_blank" href="{{ $jalshala->attendance_link }}">Add Jaldoot</x-button>
                </div>
            </div>

            <x-alertbox variant="error" class="my-3">The district coordinator should click the button and add all
                student data in for this particular jalshala.</x-alertbox>


            @if ($jalshalaSchools->isNotEmpty())
                <div class="grid grid-cols-2">
                    <x-heading class="mb-2" size="lg">For Schools</x-heading>

                    {{-- @if ($jalshala->status->value === 'pending') --}}
                        <div class="text-right">
                            <x-button color="white" class="py-2 text-indigo-600" with-icon icon="add"
                                type="button" x-data x-on:click="$dispatch('show-modal', 'add-school-modal')"
                                x-cloak>Add School</x-button>
                        </div>
                    {{-- @endif --}}
                </div>


                <x-alertbox variant="error" class="my-3">Share the enrollment URL with the Nodal Teacher for
                    Joldoot.
                    Please note that the district " JalDoot co-ordinator" may block the link when co-ordinator feels
                    like a sufficient number of enrollment is done from the school.</x-alertbox>

                <div class="text-sm">
                    <x-table.table>
                        <thead>
                            <tr>
                                <x-table.thead>School Name</x-table.thead>
                                <x-table.thead>Enrolled</x-table.thead>
                                <x-table.thead>Nodal Teacher</x-table.thead>
                                <x-table.thead>Link</x-table.thead>
                                <x-table.thead>Actions</x-table.thead>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($jalshalaSchools as $jalshalaSchool)
                                <tr>
                                    <x-table.tdata>
                                        <x-text-link
                                            href="{{ route('jalshalas.schools', $jalshalaSchool->id) }}">{{ $jalshalaSchool->school_name }}</x-text-link>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jalshalaSchool->jaldoots_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jalshalaSchool->teacher_name }}
                                        <p class="text-sm">{{ $jalshalaSchool->phone_number }}</p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <span class="relative pr-4 font-medium">
                                            {{ $jalshalaSchool->form_link }}
                                            <span class="absolute pl-1 pr-4">
                                                <x-copytoclipboard content="{{ $jalshalaSchool->form_link }}" />
                                            </span>
                                        </span>
                                    </x-table.tdata>
                                    <x-table.tdata class="flex flex-1 gap-4">
                                        <x-button class="bg-green-600 hover:bg-green-700 py-3 text-lg w-full"
                                            target="_blank" tag="a"
                                            href="http://wa.me/{{ $jalshalaSchool->phone_number }}?text={{ $jalshalaSchool->form_link }}">
                                            <svg class="fill-current text-white mr-1" xmlns="http://www.w3.org/2000/svg"
                                                width="14" height="14" viewBox="0 0 22 22">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                                                </path>
                                                Whatsapp
                                            </svg>
                                        </x-button>


                                        <x-input-switch wire:click="blockFormLink('{{ $jalshalaSchool->id }}')"
                                            :value="is_null($jalshalaSchool->blocked_at) ? 'true' : 'false'" on-value="true" off-value="false" />

                                        @if ($jalshala->status->value === 'pending')
                                            <x-button-icon-delete href="#" x-data="" x-cloak
                                                x-on:click.prevent="$wire.emitTo(
                                                'jalshalas.delete-school',
                                                'showDeleteModal',
                                                '{{ $jalshalaSchool->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this school?',
                                                '{{ $jalshalaSchool->school_name }}'
                                            )" />
                                        @endif
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>

                <x-heading class="m-2" size="lg">For Trainers</x-heading>

                @if ($jalshala->trainerOne)
                    <x-alertbox variant="error" class="mb-3">Share the link with the trainer before the Jalshala to
                        take
                        attendance during the Jalshala. Please note that Tainer should only take attendance on the first
                        day
                        of Jalshala.</x-alertbox>

                    <div class="text-sm">
                        <x-table.table>
                            <thead>
                                <tr>
                                    <x-table.thead>Trainer</x-table.thead>
                                    <x-table.thead>Link</x-table.thead>
                                    <x-table.thead>WhatsApp</x-table.thead>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <x-table.tdata>
                                        {{ $jalshala->trainerOne?->trainer_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <span class="relative pr-4 font-medium">
                                            {{ $jalshala->attendance_link }}
                                            <span class="absolute pl-1 pr-4">
                                                <x-copytoclipboard content="{{ $jalshala->attendance_link }}" />
                                            </span>
                                        </span>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-button class="bg-green-600 hover:bg-green-700 py-3 text-lg w-full"
                                            target="_blank" tag="a"
                                            href="http://wa.me/{{ $jalshala->trainerOne?->phone_number }}?text={{ $jalshala->attendance_link }}">
                                            <svg class="fill-current text-white mr-1"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                                                </path>
                                            </svg>Whatsapp
                                        </x-button>
                                    </x-table.tdata>
                                </tr>
                                @if ($jalshala->trainerTwo)
                                    <tr>
                                        <x-table.tdata>
                                            {{ $jalshala->trainerTwo?->trainer_name }}
                                        </x-table.tdata>
                                        <x-table.tdata>
                                            <span class="relative pr-4 font-medium">
                                                {{ $jalshala->attendance_link }}
                                                <span class="absolute pl-1 pr-4">
                                                    <x-copytoclipboard content="{{ $jalshala->attendance_link }}" />
                                                </span>
                                            </span>
                                        </x-table.tdata>
                                        <x-table.tdata>
                                            <x-button class="bg-green-600 hover:bg-green-700 py-3 text-lg w-full"
                                                target="_blank" tag="a"
                                                href="http://wa.me/{{ $jalshala->trainerTwo?->phone_number }}?text={{ $jalshala->attendance_link }}">
                                                <svg class="fill-current text-white mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                                                    </path>
                                                </svg>Whatsapp
                                            </x-button>
                                        </x-table.tdata>
                                    </tr>
                                @endif
                            </tbody>
                        </x-table.table>
                    </div>
                @else
                    <x-alertbox variant="error" class="mt-3">To see the Trainer attendence link add jal shala date &
                        trainer details.</x-alertbox>
                @endif


                {{-- <x-card card-classes="mt-2">
                    <div class="flex flex-1">
                        <div>
                            Trainer Link:
                        </div>
                        <div class="ml-2">
                            <a href="{{ route('jalshalaSchoolStudent', $jalshala->id) }}" target="_blank"
                                class="text-blue-500">
                                Students Attendance
                            </a>
                        </div>
                        <div class="ml-2">
                            <x-button class="bg-green-600 hover:bg-green-700 py-3 text-lg w-full" target="_blank"
                                tag="a"
                                href="http://wa.me/917086041396?text={{ route('jalshalaSchoolStudent', $jalshala->id) }}">
                                <svg class="fill-current text-white mr-1" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                                    </path>
                                </svg>Whatsapp
                            </x-button>
                        </div>
                    </div>
                </x-card> --}}
            @else
                <x-card-empty>No schools found.</x-card-empty>
            @endif
        </div>

        <div class="mb-6">

            @if ($jalshala->day_one_image && $jalshala->day_two_image)
                <x-card>
                    <x-lightbox>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-lightbox.item image-url="{{ $jalshala->dayOneImageUrl }}"
                                image-caption="Jal Shala Day One Image">
                                <img src="{{ $jalshala->dayOneImageUrl }}" alt="Jal Shala Day One Image"
                                    loading="lazy" class="object-fit" />
                            </x-lightbox.item>

                            <x-lightbox.item image-url="{{ $jalshala->dayTwoImageUrl }}"
                                image-caption="Jal Shala Day Two Image">
                                <img src="{{ $jalshala->dayTwoImageUrl }}" alt="Jal Shala Day Two Image"
                                    loading="lazy" class="object-fit" />
                            </x-lightbox.item>
                        </div>
                    </x-lightbox>
                </x-card>
            @else
                <x-card-empty>
                    <x-heading class="mb-4">Update data when Jal Shala is completed</x-heading>
                    <x-button tag="a" href="{{ route('jalshalas.post', $jalshalaId) }}">Update Post Jal Shala
                        Data</x-button>
                </x-card-empty>
            @endif

        </div>

        <livewire:jalshalas.map :jalshala="$jalshala->id" />


        <x-modal-simple name="add-school-modal" form-action="addSchool">
            <x-slot:title>Add School for the Jal Shala</x-slot>

            <x-virtual-select label="School" name="schoolId" wire:model="schoolId" :options="[
                'options' => $this->schools,
            ]" custom-label />

            <x-input label="Teacher Name" name="teacher_name" wire:model.defer="teacher_name" />

            <x-input-number label="Mobile Number" name="phone_number" wire:model.defer="phone_number" />

            <x-slot:footer>
                <x-button with-spinner wire:target="addSchool">Save</x-button>
            </x-slot>
        </x-modal-simple>
    </x-section-centered>

    <livewire:jalshalas.delete-school />

    <livewire:jalshalas.delete-jalshala />
</div>
