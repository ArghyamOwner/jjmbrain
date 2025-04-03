<div>
    <x-slot name="title">Edit Beneficiary</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', [$schemeId, 'tab' => 'beneficiary']) }}">Go Back to scheme details</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit Beneficiary
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Edit beneficiary details</x-slot>
                <x-slot name="description"></x-slot>

                <div class="mb-5">
                    <x-label for="beneficiaryPhoto" class="mb-1">Beneficiary Photo</x-label>
                    <x-text-hint class="mb-1">Maximum file size: 2 MB. Allowed file types: JPG, PNG</x-text-hint>
                    <div class="flex space-x-4">
                        <div class="rounded-lg p-2 w-40 border bg-slate-100 overflow-hidden flex items-center justify-center" style="height: 76px">
                            @if ($beneficiaryPhotoUrl)
                                {{-- <img src="{{ $beneficiaryPhotoUrl }}" alt="logo" loading="lazy" class="object-fit h-16 rounded-lg w-auto" /> --}}
                                <x-lightbox>
                                    <x-lightbox.item image-url="{{ $beneficiaryPhotoUrl }}">
                                        <x-card no-padding overflow-hidden>
                                            <div class="bg-slate-50 h-16 w-full">
                                                <img src="{{ $beneficiaryPhotoUrl }}"
                                                    class="object-fit h-16 mx-auto" loading="lazy">
                                            </div>
                                        </x-card>
                                    </x-lightbox.item>
                                </x-lightbox>
                            @else
                                <x-icon-gallery class="w-12 h-12 mt-1.5 mx-auto text-slate-200" />
                            @endif
                        </div>
    
                        <div class="flex-1">
                            <x-filepond
                                name="beneficiaryPhoto"
                                wire:model.defer="beneficiaryPhoto"
                            />
                        </div>
                    </div>
                </div>

                <x-input label="Beneficiary Name" name="name" wire:model.defer="name" />
                
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
                    <x-input label="Voter ID" name="voterId" wire:model.defer="voterId" class="uppercase" />
                    <x-input label="Aadhaar Number" name="aadhaarNumber" wire:model.defer="aadhaarNumber" />
                    <x-input label="FHTC Number" name="fhtcNumber" wire:model.defer="fhtcNumber" />
                    <x-input label="IMIS ID" name="imisId" wire:model.defer="imisId" />
                </div>
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,beneficiaryPhoto">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>