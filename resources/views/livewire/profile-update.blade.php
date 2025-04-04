<div>
    <x-card-form form-action="updateProfile">
        <x-slot name="title">Profile Information</x-slot>
        <x-slot name="description">
            Update your account's profile information and email address. <br>
            Role: {{ Str::headline($role) }}
        </x-slot>

        <div class="mb-5">
            <x-label for="profile" class="mb-1">Profile Image</x-label>

            <div>
                @if (is_null($profileImageUrl))
                    <x-file-attachment
                        wire:model="profileImage"
                        :file="$profileImage"
                        accept="image/jpg,image/jpeg,image/png"
                        mode="profile"
                    />
               
                    <x-text-hint class="my-1">250 x 250 | JPEG or PNG</x-text-hint>
                    <x-input-error for="profileImage"></x-input-error>
                @endif
            </div>

            <div>
                @if($profileImageUrl)
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <x-image class="w-20 rounded-full overflow-hidden" :rounded="false" image="{{ $profileImageUrl }}" image-aspect-ratio="1:1" />
                        </div>
                        
                        <x-inline-confirm x-on:click="$wire.removeImage()" />
                    </div>
                @endif
            </div>
        </div>
        
        <div class="md:w-2/3">
            <x-input
                label="Name" 
                name="name"
                wire:model.defer="name" 
                readonly
                disabled
            />
            
            <x-input
                label="Email" 
                name="email"
                value="{{ auth()->user()->email }}"
                readonly
                disabled
                hint="Please contact admin for email update."
            />

            <x-input-number
                type="tel"
                label="Phone" 
                name="phone"
                wire:model.defer="phone"
                readonly
                disabled
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

            <x-input 
                type="date" 
                label="Date Of Birth" 
                name="dob" 
                wire:model.defer="dob" 
            />
        </div>
 
        <x-slot name="footer">
            <div class="mr-4">
                <x-inline-toastr on="saved">Saved.</x-inline-toastr>
            </div>

            <x-button
                color="black"
                with-spinner
                wire:target="updateProfile"
            >Save</x-button>
        </x-slot>
    </x-card-form>
</div>
