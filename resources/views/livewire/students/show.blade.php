<div>
    <x-slot name="title">Student Details</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('students') }}">Back to students</x-text-link>
            </x-slot>

            <x-slot:title>
                Student Details
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card>
           <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <div>
                    <div class="w-48 h-48 rounded bg-slate-50 overflow-hidden mr-5">
                        <img src="{{ $studentPhoto }}" alt="student-photo" class="rounded w-48 h-48 object-fit">
                    </div>
                </div>
                <div class="md:col-span-4">
                    <div class="flex mb-2">
                        <x-heading>{{ $name }}</x-heading>
                        <div class="ml-3">
                            <x-badge variant="{{ $statusColor }}">{{ $status }}</x-badge>
                        </div>
                    </div>

                    <x-description-list size="sm">
                        <x-description-list.item>
                            <x-slot name="title">Student Code</x-slot>
                            <x-slot name="description">{{ $studentCode }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">School Name</x-slot>
                            <x-slot name="description">{{ $schoolName }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">School Board</x-slot>
                            <x-slot name="description">{{ $schoolBoard }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Grade</x-slot>
                            <x-slot name="description">{{ $grade }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Section</x-slot>
                            <x-slot name="description">{{ $section }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Gender</x-slot>
                            <x-slot name="description">{{ Str::title($gender) }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Date of Birth</x-slot>
                            <x-slot name="description">@date($dob)</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Phone</x-slot>
                            <x-slot name="description">{{ $phone }}</x-slot>
                        </x-description-list.item>
                    </x-description-list>
                </div>
            </div>
        </x-card>
    </x-section-centered>
</div>