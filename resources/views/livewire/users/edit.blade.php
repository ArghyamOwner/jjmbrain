<div>
    <x-slot name="title">Edit User</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                <x-breadcrumb class="text-lg">
                    <x-breadcrumb-item href="{{ route('users') }}">Users</x-breadcrumb-item>
                    <x-breadcrumb-item>{{ $name }}</x-breadcrumb-item>
                </x-breadcrumb>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card-form form-action="update">
            <x-slot name="title">Edit User</x-slot>

            <div class="md:w-2/3">
                <x-input
                    label="Name" 
                    name="name"
                    wire:model.defer="name" 
                />

                <x-select label="Department" name="departmentId" wire:model.defer="departmentId">
                    <option value="">Select a department</option>
                    @foreach ($this->departments as $departmentKey => $departmentValue)
                        <option value="{{ $departmentKey }}">{{ $departmentValue }}</option>
                    @endforeach
                </x-select>
                
                <x-input
                    type="email"
                    label="Email" 
                    name="email"
                    wire:model.defer="email" 
                />
 
                <x-radio-group 
                    label="Select role"
                    name="role"
                    wire:model.defer="role"
                    default-value="{{ $role ?? '' }}"
                    :options="$this->roles"
                />
 
                <x-radio-pill 
                    label="Gender"
                    name="gender"
                    wire:model.defer="gender"
                    class="md:grid-cols-4"
                    default-value="{{ $gender }}"
                    :options="[
                        [
                            'label' => 'Male',
                            'value' => 'male'
                        ],
                        [
                            'label' => 'Female',
                            'value' => 'female'
                        ]
                    ]"
                />

                <x-cleavejs 
                    type="tel"
                    label="Phone" 
                    id="phone" 
                    name="phone" 
                    wire:model.defer="phone"
                    hint="Enter a valid 10 digit mobile number"
                    pattern="[9876]{1}[0-9]{9}"
                    :options="[
                        'blocks' => [10],
                        'numericOnly' => true
                    ]"
                />
            </div>
     
            <x-slot name="footer">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>

                <x-button
                    color="black"
                    with-spinner
                    wire:target="update"
                >Save</x-button>
            </x-slot>
        </x-card-form>
    </x-section-centered>
</div>
