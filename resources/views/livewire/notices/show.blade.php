<div>
    <x-slot name="title">All Notices</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('notices') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Notices
            </x-slot>

        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="lg:max-w-6xl">
            <div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-x-6 gap-y-6">
                <div class="md:col-span-2">
                    <div class="space-y-6">
                        <x-card class="flex">
                            <div class="shrink-0 mr-4 overflow-hidden" x-data="{
                                userId: '{{ $notice->user->id }}',
                                userDetails: {},
                                isShown: false,
                                popperInstance: null,
                                async getData() {
                                    this.isShown = true;
                                    this.popperInstance.update();
                                    if (Object.keys(this.userDetails).length > 0) {
                                        return;
                                    }
                                    const result = await $wire.getCurrentUserInfo(this.userId);
                                    this.userDetails = await result;
                                },
                                closePopover() {
                                    this.isShown = false;
                                }
                            }" x-init="popperInstance = Popper.createPopper($refs.popoverTrigger, $refs.popover, {})"
                                x-cloak x-on:click.outside="closePopover()">

                                <div class="w-10 h-10 rounded-full bg-slate-100"
                                    x-on:mouseenter.prevent="await getData()" x-on:mouseleave="closePopover()"
                                    x-on:focus="await getData()" x-ref="popoverTrigger">
                                    <img src="{{ $notice->user->photo_url }}" alt="{{ $notice->user->name }}"
                                        class="w-10 h-10 rounded-full object-fit" loading="lazy">

                                    <div class="shadow-lg rounded-lg bg-white w-64 z-50 border absolute"
                                        x-show="isShown" x-ref="popover"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95">
                                        <div class="p-3 text-sm">
                                            <div x-show="Object.keys(userDetails).length === 0" class="text-center">
                                                <div class="base-spinner w-10 h-10 mx-auto text-indigo-400"></div>
                                                <div>Loading...</div>
                                            </div>

                                            <div x-show="Object.keys(userDetails).length > 0">
                                                <div class="flex">
                                                    <div
                                                        class="w-12 h-12 rounded-full shrink-0 mr-3 bg-slate-100 relative overflow-hidden">
                                                        <img :src="`${userDetails.photo}`" :alt="`${userDetails.name}`"
                                                            class="object-fit rounded-full" loading="lazy"
                                                            x-show="userDetails.hasOwnProperty('name')" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="block text-lg font-bold text-slate-800 truncate"
                                                            x-text="userDetails.name"
                                                            x-show="userDetails.hasOwnProperty('name')"></div>
                                                        <div class="block text-slate-500 leading-none"
                                                            x-text="userDetails.email"
                                                            x-show="userDetails.hasOwnProperty('email')"></div>
                                                    </div>
                                                </div>

                                                <div class="text-slate-600 mt-2" x-text="userDetails.bio"
                                                    x-show="userDetails.hasOwnProperty('bio')"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-1 md:pr-6">
                                <div class="mb-3">
                                    <x-heading size="md"
                                        class="text-indigo-600">{{ Str::headline($notice->user->name) }}</x-heading>
                                    <p class="text-slate-500 text-sm leading-none">{{ $notice->notice_created_since }}
                                    </p>
                                </div>

                                <x-heading size="lg">{{ $notice->title }}</x-heading>


                                <div class="text-slate-700 mt-3 prose prose-indigo">
                                    <x-readmore-content :content="$notice->description" limit="250"
                                        link-class="underline text-indigo-500" />
                                </div>

                                <hr>

                                <div class="mt-4 flex">
                                    For:
                                    <x-heading size="lg"
                                        class="ml-1">{{ Str::headline($notice->role) }}</x-heading>
                                </div>

                                @if($notice->document)
                                <div class="mt-2 text-right">
                                    <x-text-link href="{{ $notice->document_url }}" download target="_blank" class="font-medium">
                                        <x-icon-download class="pr-2" />Download</x-text-link>
                                </div>
                                @endif
                            </div>
                        </x-card>
                    </div>

                </div>
            </div>
        </div>
    </x-section-centered>
</div>
