<div>
    <x-slot name="title">Site Settings</x-slot>
    
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Site Settings
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>
 
    <x-section-centered class="mb-10">
        <x-card form-action="saveSettings">
            <div
                x-data="{ 
                    title: '{{ $metaTitle ?? "" }}',
                    description: '{{ $metaDescription ?? "" }}',
                    url: '{{ url('/') ?? "" }}',
                    limit: 160,
                    counter: 0,
                    get remaining() {
                        this.counter = this.description.length;
                        if (this.counter > this.limit) {
                            this.counter = this.limit;
                        }
                    },
                    get counterStats() {
                        return `${this.counter} / ${this.limit}`;
                    }
                }"
                x-init="() => remaining"
                x-cloak
            >
                <x-card-form class="shadow-none" no-padding>
                    <x-slot name="title">Basic Information</x-slot>
                    <x-slot name="description">Please provide basic contact information such as email address, phone number, and address.</x-slot>

                    <x-label for="logo" class="mb-1">Site Logo</x-label>
                    <x-text-hint class="mb-1">Maximum file size: 1 MB. Allowed file types: JPG, PNG</x-text-hint>
                    <div class="flex space-x-4">
                        <div class="rounded-lg p-2 w-40 border bg-slate-100 overflow-hidden flex items-center justify-center" style="height: 76px">
                            @if ($logoUrl)
                                <img src="{{ $logoUrl }}" alt="logo" loading="lazy" class="object-fit h-16 rounded-lg w-auto" />
                            @else
                                <x-icon-gallery class="w-12 h-12 mt-1.5 mx-auto text-slate-200" />
                            @endif
                        </div>

                        <div class="flex-1">
                            <x-filepond
                                name="logo"
                                wire:model.defer="logo"
                            />
                        </div>
                    </div>

                    <x-input
                        type="email"
                        label="Email Address" 
                        name="email"
                        wire:model.defer="email"
                    />

                    <x-input
                        label="Contact Number" 
                        name="phone"
                        wire:model.defer="phone"
                    />

                    <x-textarea
                        rows="2"
                        label="Address" 
                        name="address"
                        wire:model.defer="address"
                    />

                    <x-input
                        label="Office Hours" 
                        name="officeHours"
                        wire:model.defer="officeHours"
                    />
                </x-card-form>

                <x-section-border />

                <x-card-form class="shadow-none" no-padding>
                    <x-slot name="title">Social Links</x-slot>
                    <x-slot name="description">Please provide social media account information if available.</x-slot>

                    <x-input
                        type="url"
                        label="Facebook" 
                        name="socialLinks.Facebook"
                        wire:model.defer="socialLinks.Facebook"
                    />

                    <x-input
                        type="url"
                        label="Twitter" 
                        name="socialLinks.Twitter"
                        wire:model.defer="socialLinks.Twitter"
                    />

                    <x-input
                        type="url"
                        label="Instagram" 
                        name="socialLinks.Instagram"
                        wire:model.defer="socialLinks.Instagram"
                    />
                </x-card-form>

                <x-section-border />

                <x-card-form class="shadow-none" no-padding>
                    <x-slot name="title">Valuable Metrics</x-slot>
                    <x-slot name="description">Please provide information if available.</x-slot>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <x-input
                            label="Population" 
                            name="metrics.population"
                            wire:model.defer="metrics.population"
                        />

                        <x-input
                            label="Holdings" 
                            name="metrics.holdings"
                            wire:model.defer="metrics.holdings"
                        />
    
                        <x-input
                            label="Households" 
                            name="metrics.households"
                            wire:model.defer="metrics.households"
                        />
    
                        <x-input
                            label="Area" 
                            name="metrics.area"
                            wire:model.defer="metrics.area"
                        />
                    </div>
                </x-card-form>

                <x-section-border />


                <x-card-form class="shadow-none" no-padding>
                    <x-slot name="title">Map Location</x-slot>
                    <x-slot name="description">Please provide the exact coordinates of your office location by entering the latitude and longitude values. You can use any online map service to find your coordinates.</x-slot>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-input
                            label="Latitude" 
                            name="latitude"
                            wire:model.defer="latitude"
                        />
    
                        <x-input
                            label="Longitude" 
                            name="longitude"
                            wire:model.defer="longitude"
                        />
                    </div>
                </x-card-form>

                <x-section-border />

                <x-card-form class="shadow-none" no-padding>
                    <x-slot name="title">SEO Settings</x-slot>
                    <x-slot name="description">
                        SEO (Search Engine Optimization) refers to the process of optimizing a website or online content to improve its visibility and ranking in search engine results pages (SERPs). The goal of SEO is to increase organic traffic to a website by making it more likely to appear at the top of search results.
                        
                        <p class="mt-5 mb-1 text-xs uppercase tracking-wider font-bold text-slate-400">Preview:</p>
                        <div class="rounded-lg border px-4 py-3">
                            <p class="text-lg text-indigo-700" x-text="title || 'Page Name | Site Name'"></p>
                            <p class="text-xs text-green-600" x-html="url"></p>
                            <p class="text-sm" x-text="description || 'Page description or summary to increase organic traffic to a website'"></p>
                        </div>
                    </x-slot>
    
                    <x-input
                        x-model="title"
                        label="Meta Title" 
                        name="metaTitle"
                        wire:model.defer="metaTitle"
                        placeholder="This is the linked title that users see in search results"
                    />
    
                    <div class="relative">
                        <div class="text-xs absolute top-0 mt-1.5 right-0" x-text="counterStats"></div>
                        <x-textarea
                            maxlength="160"
                            x-on:input="remaining"
                            x-model="description"
                            rows="2"
                            label="Meta Description" 
                            name="metaDescription"
                            wire:model.defer="metaDescription"
                            placeholder="This is the description that users see in search results"
                        />
                    </div>
                </x-card-form>
            </div>
    
    
            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>
    
                <x-button
                    color="black"
                    with-spinner
                    wire:target="saveSettings"
                >Save Settings</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
