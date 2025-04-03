<div>
    <x-slot name="title">Create Sub-Administrator</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('users') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create Sub-Administrator
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Sub-Administrator Details</x-slot>
                <x-slot name="description">Add the necessary details of a sub-administrator.</x-slot>

                <x-select label="School" name="school" wire:model.defer="school">
                    <option value="">--Select School--</option>
                    @foreach($this->schools as $schoolKey => $schoolName)
                        <option value="{{ $schoolKey }}">{{ $schoolName }}</option>
                    @endforeach
                </x-select>

                <x-input label="Name" name="name" wire:model.defer="name" />
                <x-input label="Email" type="email" name="email" wire:model.defer="email" />
        
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input-number 
                        maxlength="10" 
                        minlength="10" 
                        input-mode="numeric" 
                        label="Phone"
                        name="phone" 
                        wire:model.defer="phone" 
                        placeholder="eg. 7896XXXXXX" 
                    />
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input type="password" label="Password" name="password" wire:model.defer="password" />
                    <x-input type="password" label="Confirm Password" name="password_confirmation" wire:model.defer="password_confirmation" />
                </div>
            </x-card-form>

            @if(auth()->user()->isAdministrator())    
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,photo">Save</x-button>
            </x-slot>
            @endif
        </x-card>
    </x-section-centered>
</div>