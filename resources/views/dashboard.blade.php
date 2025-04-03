<x-app-layout title="Home">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                {{ Str::greet(auth()->user()->name) }}!
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <x-card overflow-hidden card-classes="mb-8">
                    <div class="w-full h-36 text-slate-100/50 inset-x-0 -ml-px -mt-px top-0 absolute"
                        style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(to right, currentColor 1px, transparent 1px); background-size: 40px 40px;">
                    </div>
                    {{-- <div class="w-full h-36 inset-x-0 top-0 absolute bg-gradient-to-tl from-white"></div> --}}
                    <div class="md:flex">
                        <div class="flex-1">
                            <x-media class="relative overflow-hidden">
                                <x-slot name="mediaObject">
                                    <div class="h-24 w-24 rounded-lg bg-gray-100 ring-4 ring-white relative">
                                        <img src="{{ $user->photo_url }}" alt="user photo"
                                            class="object-fit w-auto h-24 rounded-lg">
                                    </div>
                                </x-slot>
                                <x-slot name="mediaBody">
                                    <div class="flex flex-col md:flex-row md:items-center relative">
                                        <div class="flex-1">
                                            <x-heading size="lg" class="mb-1">{{ $user->name }}</x-heading>
                                            <p>Role: {{ Str::title($user->role) }}</p>
                                            <p>{{ $user->email }} / {{ $user->phone }}</p>
                                            <p class="text-xs text-gray-500">
                                                Last login: @date($user->last_online_at)
                                            </p>
                                        </div>
                                        <div class="mt-4 md:mt-0 md:pr-2">
                                            {{-- <x-button class="leading-4" color="white"
                                                href="{{ route('profile.settings') }}" tag="a">
                                                <x-icon-setting class="w-4 h-4 mr-1 -ml-1" />Settings
                                            </x-button> --}}
                                        </div>
                                    </div>
                                </x-slot>
                            </x-media>
                        </div>
                        <div class="hidden md:block">
                            <img class="h-28" src="brain-image.png" alt="JJM Brain">
                        </div>
                    </div>
                </x-card>

                <div class="mb-6">
                    <livewire:notices.latest-five />
                </div>

                <div class="mb-6 text-justify italic">
                    <x-alert variant="error" :close="false">
                        To all EEs: Please prioritize updating the Scheme's Sub-division, along with any
                        additional details you deem necessary. Your pending updates on Sub-divisions can be viewed on
                        the Division Dashboard for monitoring purposes.
                    </x-alert>
                </div>

                @unless ((auth()->user()->role == 'dpmu') || (auth()->user()->role == 'panchayat') ||
                (auth()->user()->role == 'asrlm-block') || auth()->user()->isIsaCoordinator() ||
                auth()->user()->isLabTechnicalOfficer() || auth()->user()->isLabNodalOfficer() ||
                auth()->user()->isLabHo() || auth()->user()->isIecSpecialist() || auth()->user()->isCeoZp() ||
                auth()->user()->isBlockUser() || auth()->user()->isPanchayatCommissioner() || auth()->user()->isIotVendor() || 
                auth()->user()->isLabAdmin())

                {{-- Removed for Optimization --}}
                <livewire:schemes-latest-activities />

                @endunless

                @if(auth()->user()->isPanchayat() || auth()->user()->isCeoZp() || auth()->user()->isPanchayatCommissioner())
                <div class="mb-5">
                    <livewire:schemes.stats />
                </div>
                @endif
            </div>
            <div>
                {{-- <div class="mb-6 h-52 w-full relative rounded-md overflow-hidden">
                    <a href="https://help.jjmbrain.in/" target="_blank">
                        <img src="{{ url('img/help-jjmbrain.jpeg') }}" alt="user photo" class="object-fit w-full h-52 ">
                    </a>
                </div> --}}

                <a class="relative bg-gray-900 block p-6 border border-gray-100 rounded-lg mx-auto mb-6 h-52 w-full" href="https://help.jjmbrain.in/" target="_blank">
                    <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600"></span>
                    <div class="my-4">
                        <h2 class="text-white text-2xl font-bold pb-2">JJM Help</h2>
                        <p class="text-gray-300 py-1">Do you have any doubts on how to operate JJMBrain ?</p>
                    </div>
                    <div class="flex justify-end">
                        <button class="px-2 py-1 text-white border border-gray-200 font-semibold rounded hover:bg-gray-800">Get Help</button>
                    </div>
                </a>


                <div class="mb-6">
                    <livewire:news.latest-five-feeds />
                </div>

                <livewire:meetings.calendar />

                <div class="mt-6">
                    <iframe
                        src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fassamjaljeevanmission%2F&tabs=timeline&width=360&height=1150&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                        width="100%" height="1150" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
            </div>
        </div>

    </x-section-centered>
</x-app-layout>