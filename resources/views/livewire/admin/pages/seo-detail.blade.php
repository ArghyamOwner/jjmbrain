<div>
    <x-card form-action="saveSeoDetails">
        <div
            x-data="{ 
                title: '{{ $metaTitle ?? "" }}',
                description: '{{ $metaDescription ?? "" }}',
                url: '{{ $slugUrl ?? "" }}',
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
                    <div class="text-xs absolute top-0 mt-1 right-0" x-text="counterStats"></div>
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
                wire:target="saveSeoDetails"
            >Save Seo Details</x-button>
        </x-slot>
    </x-card>
</div>
