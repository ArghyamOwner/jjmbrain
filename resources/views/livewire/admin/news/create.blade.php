<div>
    <x-slot name="title">Create News</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('admin.news') }}">Back to news</x-text-link>
            </x-slot>
            <x-slot:title>
                Create News
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">    
                    <x-card>
                        <x-select label="Category" name="category" wire:model.defer="category">
                            <option value="">Select a category</option>
                            @foreach($this->categories as $newsCategory)
                                <option value="{{ $newsCategory->value }}">{{ $newsCategory->name }}</option>
                            @endforeach
                        </x-select>

                        <x-input 
                            label="Title" 
                            name="title" 
                            wire:model.defer="title" 
                            autocomplete="off" 
                            placeholder="eg. I read a book named Do Epic Shit this weekend!" 
                        />

                        <x-textarea-constrained
                            label="Summary"
                            wire:model.defer="summary"
                            name="summary"
                            rows="3"
                            maxlength="200"
                        />
                        
                        <x-quilljs-editor
                            label="Content"
                            class="bg-white rounded-lg"
                            wire:model.defer="content"
                            name="content"
                            height="300px"
                            placeholder-image-for-upload-progress="{{ url('placeholder-image.png') }}"
                            toolbar-type="minimal"
                        />

                        <x-input-tags
                            label="Tags"
                            id="tags"
                            name="tags"
                            placeholder="eg. Technology, Life, Story"
                            wire:model="tags"
                            hint="Enter you tag and hit enter to add one or more tags."
                            autocomplete="off"
                        />
                    </x-card>

                    <x-card card-classes="mt-5">
                        <x-textarea
                            rows="3"
                            optional
                            label="Extra Content"
                            name="extraContent"
                            wire:model.defer="extraContent"
                        />
                    </x-card>
                </div>

                <div>
                    <x-card>
                        <x-heading size="md" class="mb-2">Status</x-heading>
                        <x-radio-group
                            name="role"
                            wire:model.defer="status"
                            default-value="visible"
                            :options="[
                                [
                                    'label' => 'Visible',
                                    'value' => 'visible',
                                    'summary' => 'Will be visible for browsing.'
                                ],
                                [
                                    'label' => 'Hidden',
                                    'value' => 'hidden',
                                    'summary' => 'Will not be visible for browsing.'
                                ]
                            ]"
                        />
                           
                        <x-filepond 
                            optional
                            label="Featured image"
                            wire:model="featuredImage" 
                            name="featuredImage"
                            accept="image/jpg,image/jpeg,image/png"
                            hint="Maximum File Size: 2 MB. File types allowed: JPG, JPEG, PNG."
                        />
                    </x-card>

                    <div class="mt-5 flex space-x-3 items-center">
                        <x-button class="w-2/3" wire:target="save,featuredImage" with-spinner>Save News</x-button>
                        <x-button class="w-1/3" tag="a" href="{{ route('admin.news') }}" color="white">Cancel</x-button>
                    </div>
                </div>
            </div>
        </form>
    </x-section-centered>
</div>
