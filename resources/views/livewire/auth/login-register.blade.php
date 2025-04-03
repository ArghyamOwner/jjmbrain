<div>
    @if ($successMessage)  
        <x-alert variant="success" class="mb-4">{{ $successMessage }}</x-alert>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <x-card form-action="register">
            <x-heading size="2xl" class="mb-4">Register</x-heading>
            <x-input 
                label="Full Name"
                name="name"
                wire:model.defer="name"
                placeholder="eg. John Wick"
            />

            <x-select label="Designation" name="designation" wire:model.defer="designation">
                <option value="">Select a designation</option>
                @foreach($this->designations as $designationLabel)
                    <option value="{{ $designationLabel->value }}">{{ $designationLabel->name }}</option>
                @endforeach
            </x-select>

            <x-select label="Department" name="department" wire:model.defer="department">
                <option value="">Select a department</option>
                @foreach($this->departments as $departmentValue => $departmentLabel)
                    <option value="{{ $departmentValue }}">{{ $departmentLabel }}</option>
                @endforeach
            </x-select>
    
            <x-input-number 
                maxlength="10"
                minlength="10"
                label="Phone Number"
                name="phone"
                wire:model.defer="phone"
                placeholder="eg. 98000XXXXX"
            />
    
            <x-button type="submit" with-spinner wire:target="register">Register</x-button>
        </x-card>

        <x-card>
            <x-heading size="2xl" class="mb-4">Login</x-heading>
            
            @if ($otpSent)
                <x-input-number 
                    maxlength="6"
                    minlength="6"
                    label="Enter your OTP"
                    name="otpCode"
                    wire:model.defer="otpCode"
                />

                <div x-data="{ showResendOtpLink: false }" x-init="() => setTimeout(() => {
                    showResendOtpLink = true
                }, 5000)" x-cloak class="mb-4">
                    <x-text-link class="mb-2" href="#" x-data="{}" x-on:click.prevent="$wire.resendOtp">Resend OTP</x-text-link>
                </div>

                <x-button type="button" with-spinner wire:target="login" wire:click="login">Submit OTP</x-button>
            @else
                <x-input-number 
                    maxlength="10"
                    minlength="10"
                    label="Phone Number"
                    name="otpPhone"
                    wire:model.defer="otpPhone"
                    placeholder="eg. 98000XXXXX"
                />
                <x-button type="button" with-spinner wire:target="requestOtp" wire:click="requestOtp">Request OTP</x-button>
            @endif

            @if ($otpStatusMessage)  
                <x-alert variant="success" class="mt-5">{{ $otpStatusMessage }}</x-alert>
            @endif
        </x-card>

    </div>
</div>
