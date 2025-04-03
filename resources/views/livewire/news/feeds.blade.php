<div>
    <x-slot name="title">News Feed</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Recent News
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('news.create') }}" with-icon icon="add">Share News</x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="lg:max-w-6xl">
            <div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-x-6 gap-y-6">
                <div class="xl:order-last" wire:init="userInfo">
                    <x-card no-padding>
                        <div class="h-10 bg-indigo-700 rounded-t-lg"></div>
                        <div class="px-4 md:px-6 -mt-6 pb-6">
                            <x-media>
                                <x-slot name="mediaObject">
                                    <div
                                        class="w-16 h-16 rounded-full ring ring-offset-2 ring-white shrink-0 mr-4 bg-slate-50 relative overflow-hidden border">
                                        <img src="{{ $photo }}" alt="user" class="w-16 h-16 rounded-full object-cover"
                                            loading="lazy" />
                                    </div>
                                </x-slot>
                                <x-slot name="mediaBody">
                                    <x-heading size="xl" class="mt-8 truncate">{{ $name }}</x-heading>
                                    <p class="text-slate-500">{{ $email }}</p>
                                </x-slot>
                            </x-media>
                            <div class="space-y-2 md:space-y-3 mt-2">
                                @if ($bio)
                                <p class="text-slate-500">{{ $bio }}</p>
                                @endif
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-6">
                                <x-button tag="a" href="{{ route('news.create') }}" color="white"
                                    class="py-2 truncate w-full items-center justify-center">
                                    <x-icon-file class="w-5 h-5 text-slate-400 -ml-1 mr-1 shrink-0" />Share a news
                                </x-button>
                                <x-button tag="a" href="{{ route('news') }}" color="white"
                                    class="py-2 truncate w-full items-center justify-center">
                                    <x-icon-edit class="w-5 h-5 text-slate-400 -ml-1 mr-1 shrink-0" />My Posts
                                </x-button>
                            </div>
                        </div>
                    </x-card>
                </div>
                <div class="md:col-span-2">
                    <div class="space-y-6">
                        @if ($feeds->isNotEmpty())
                        @foreach($feeds as $feed)
                        <x-card class="flex">
                            <div class="shrink-0 mr-4 overflow-hidden" x-data="{
                                            userId: '{{ $feed->user->id }}',
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
                                    <img src="{{ $feed->user->photo_url }}" alt="{{ $feed->user->name }}"
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
                                    <x-heading size="md" class="text-indigo-600">{{ Str::headline($feed->user->name) }}
                                    </x-heading>
                                    <p class="text-slate-500 text-sm leading-none">{{ $feed->news_created_since }}</p>
                                </div>

                                <x-heading size="lg">{{ $feed->title }}</x-heading>

                                @if($feed->image)
                                <div class="mt-3">
                                    <x-lightbox>
                                        <x-lightbox.item
                                            image-url="{{ $feed->newsimage_big_url ?? $feed->newsimage_url  }}">
                                            <img loading="lazy" class="object-fit rounded-md max-w-full"
                                                src="{{ $feed->newsimage_big_url ?? $feed->newsimage_url  }}" />
                                        </x-lightbox.item>
                                    </x-lightbox>
                                </div>
                                @endif

                                <div class="text-slate-700 mt-3 prose prose-indigo">
                                    <x-readmore-content :content="$feed->description" limit="250"
                                        link-class="underline text-indigo-500" />
                                </div>

                                <div class="flex justify-between items-center">
                                    <livewire:news.feed-like :news-id="$feed->id" wire:key="like-{{ $feed->id }}" />
                                    <x-social-media-share url="{{ route('news.feedsShow', $feed->slug) }}" class="flex space-x-2 items-center" />
                                </div>
                            </div>
                        </x-card>
                        @endforeach

                            @if($feeds->hasMorePages())
                            <x-button type="button" color="white" wire:click="loadMore" wire:loading.attr="disabled"
                                wire:target="loadMore" wire:loading.class="base-spinner" class="w-full justify-center">Load
                                more</x-button>
                            @endif

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