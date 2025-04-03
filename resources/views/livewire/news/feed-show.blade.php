<div>
    <x-slot name="title">{{ $news->title }}</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('news.feeds') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Recent News
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="lg:max-w-6xl">
            <div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-x-6 gap-y-6">
                <div class="md:col-span-2">

                    <div class="space-y-6">
                        @if ($news)
                            
                            <x-card class="flex">
                                <div class="shrink-0 mr-4 overflow-hidden" x-data="{
                                                userId: '{{ $news->user->id }}',
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
                                            }"
                                    x-init="popperInstance = Popper.createPopper($refs.popoverTrigger, $refs.popover, {})"
                                    x-cloak x-on:click.outside="closePopover()">

                                    <div class="w-10 h-10 rounded-full bg-slate-100"
                                        x-on:mouseenter.prevent="await getData()" x-on:mouseleave="closePopover()"
                                        x-on:focus="await getData()" x-ref="popoverTrigger">
                                        <img src="{{ $news->user->photo_url }}" alt="{{ $news->user->name }}"
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
                                        <x-heading size="md" class="text-indigo-600">{{ Str::headline($news->user->name) }}
                                        </x-heading>
                                        <p class="text-slate-500 text-sm leading-none">{{ $news->news_created_since }}</p>
                                    </div>

                                    <x-heading size="lg">{{ $news->title }}</x-heading>

                                    @if($news->image)
                                        <div class="mt-3">
                                            <x-lightbox>
                                                <x-lightbox.item
                                                    image-url="{{ $news->newsimage_big_url ?? $news->newsimage_url  }}">
                                                    <img loading="lazy" class="object-fit rounded-md max-w-full"
                                                        src="{{ $news->newsimage_big_url ?? $news->newsimage_url  }}" />
                                                </x-lightbox.item>
                                            </x-lightbox>
                                        </div>
                                    @endif

                                    <div class="text-slate-700 mt-3 prose prose-indigo">
                                        {!! $news->description !!}
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <livewire:news.feed-like :news-id="$news->id" wire:key="like-{{ $news->id }}" />
                                        <x-social-media-share url="{{ route('news.feedsShow', $news->slug) }}" class="flex space-x-2 items-center" />
                                    </div>

                                </div>
                            </x-card>
                            
                        @else
                            <x-card>
                                No news feed available right now :(
                            </x-card>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </x-section-centered>

    @push('styles')
    <style>
        iframe {
            max-width: 100%;
            width: 100%;
            aspect-ratio: 16/9;
        }
    </style>
    @endpush

    @push('scripts-footer')
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    @endpush
</div>