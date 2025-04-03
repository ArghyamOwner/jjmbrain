<div>
    @if (! $successMessage)
	<x-section-container-styled
		heading="Submit your grievance"
		subheading="Please complete the form below for your complaints."
	/>
    @endif
 
	<div class="py-10 bg-slate-50">
        <x-section-centered>
            <div class="max-w-4xl mx-auto pb-16">

                @if ($successMessage)
                    <x-card>
                        <div class="py-5">
                            <svg class="mx-auto w-16 h-16 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                        </div>

                        <div class="mb-3 text-center text-xl text-slate-800">Your request has been successfully registered.</div>
                        <div class="mb-3 text-center px-3 py-4 bg-slate-50 rounded-lg border border-slate-200">
                            <div class="text-xs uppercase tracking-wider mb-1 text-slate-500 font-medium">Grievance Tracking Number</div>
                            <div class="font-mono text-lg text-slate-800">{{ $trackingNumber }}</div>
                        </div>
                        <p class="mb-5 text-center text-slate-600">Please copy/save the grievance tracking number to track your grievance status. <br> To view/track the status of your request/grievance, <x-text-link href="{{ route('tenant.grievances.track') }}">click here</x-text-link>.</p>

                        <x-slot name="footer" class="text-right">
                            <x-button color="white" tag="a" href="{{ route('tenant.grievances') }}">Back to Grievances</x-button>
                        </x-slot>
                    </x-card>
                @else
                    <x-card form-action="save">
                        <div class="md:px-10 md:py-6">
                            <x-honeypot livewire-model="extraFields" />
    
                            <x-heading class="mb-2" size="xl">Grievance Information</x-heading>
                            
                            <x-select
                                label="Service Type"
                                name="serviceType"
                                wire:model.defer="serviceType"
                            >
                                <option value="">Select a service</option>
                                @if ($this->services)
                                @foreach($this->services as $service)
                                    <option value="{{ $service }}">{{ $service }}</option>
                                @endforeach
                                @endif
                            </x-select>
    
                            <x-input
                                label="Title of your grievance"
                                name="title"
                                wire:model.defer="title"
                                placeholder="eg. Correcting Incorrect Information: File a Grievance to Fix Errors in Your Personal Data"
                            />
    
                            <x-textarea
                                rows="3"
                                label="Description of your grievance"
                                name="description"
                                wire:model.defer="description"
                                placeholder="Write your grievances in details..."
                            />
    
                            <x-heading class="mb-2" size="xl">Submitter Information</x-heading>
    
                            <x-input
                                label="Name"
                                name="name"
                                wire:model.defer="name"
                            />
                            
                            <x-input-number
                                class="w-64"
                                label="Phone"
                                name="phone"
                                maxlength="10"
                                minlength="10"
                                input-mode="numeric"
                                wire:model.defer="phone"
                                hint="Phone number is required for communication about your grievance. Please enter a valid number 10 digit number"
                            />
    
                            <x-textarea
                                rows="3"
                                label="Address"
                                name="address"
                                wire:model.defer="address"
                                placeholder="Street / Landmark Name, City, Town, Pin"
                            />
                        </div>

                        <x-slot name="footer" class="text-right">
                            <x-button with-spinner class="py-3">Submit My Grievance</x-button>
                        </x-slot>

                    </x-card>
                @endif
            </div>
        </x-section-centered>
    </div> 
</div>
