<div>
    <x-slot name="title">Principal</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Principal
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
     
        @if($principalUser)
            <div class="mb-8 space-y-6">
                <x-card>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                        <div>
                            <div class="w-48 h-48 rounded bg-slate-50 overflow-hidden mr-5">
                                <img src="{{ $principalUser->photo_url }}" alt="teacher-photo" class="rounded w-48 h-48 object-fit">
                            </div>
                        </div>
                        <div class="md:col-span-4">
                            <div class="flex space-x-2 items-center mb-2">
                                <x-heading size="xl">{{ $principalUser->name }}</x-heading>
                                <x-button-icon-edit href="#" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                                <x-description-list size="xs">
                                    <x-description-list.item>
                                        <x-slot name="title">Designation</x-slot>
                                        <x-slot name="description">{{ $principalUser->designation }}</x-slot>
                                    </x-description-list.item>
                                    <x-description-list.item>
                                        <x-slot name="title">Email</x-slot>
                                        <x-slot name="description">{{ $principalUser->email }}</x-slot>
                                    </x-description-list.item>
                                    <x-description-list.item>
                                        <x-slot name="title">Phone</x-slot>
                                        <x-slot name="description">{{ $principalUser->phone }}</x-slot>
                                    </x-description-list.item>
                                    <x-description-list.item>
                                        <x-slot name="title">Gender</x-slot>
                                        <x-slot name="description">{{ $principalUser->gender }}</x-slot>
                                    </x-description-list.item>
                                    <x-description-list.item>
                                        <x-slot name="title">Date of Birth</x-slot>
                                        <x-slot name="description">@date($principalUser->dob)</x-slot>
                                    </x-description-list.item>
                                </x-description-list>
                                <x-description-list size="xs">
                                    <x-description-list.item>
                                        <x-slot name="title">Qualification</x-slot>
                                        <x-slot name="description">{{ $principalUser->qualification }}</x-slot>
                                    </x-description-list.item>
                                    <x-description-list.item>
                                        <x-slot name="title">Employee ID</x-slot>
                                        <x-slot name="description">{{ $principalUser->teacher_or_employee_id }}</x-slot>
                                    </x-description-list.item>
                                    <x-description-list.item>
                                        <x-slot name="title">School Code</x-slot>
                                        <x-slot name="description">{{ $principalUser->school_code }}</x-slot>
                                    </x-description-list.item>
                                    <x-description-list.item>
                                        <x-slot name="title">Employment Type</x-slot>
                                        <x-slot name="description">{{ $principalUser->employment_type }}</x-slot>
                                    </x-description-list.item>
                                </x-description-list>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>
        @else 
            <x-card-empty variant="">
                <p class="text-slate-500 text-center mb-3">No principal user found.</p>
                <x-button tag="a" href="{{ route('principals.create') }}" with-icon icon="add" with-spinner>Add a Principal</x-button>    
            </x-card-empty>
        @endif
        
    </x-section-centered>
</div>