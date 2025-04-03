<x-guest-layout>
    <div class="absolute right-0" id="google_translate_element"></div>
    <div class="px-4 py-4" style="background-color: #0f4497;">
        <div class="flex justify-center">
            <div class="shrink-0 mr-3">
                <img src="{{ url('img/jjm-logo.png') }}" alt="jjm-logo" loading="lazy" class="object-fit h-16">
            </div>
            <div class="text-left">
                <div class="text-2xl font-bold text-white">Jal Jeevan Mission</div>
                <div class="text-xl font-medium text-white">PHED Assam</div>
            </div>
        </div>
    </div>
    <button x-data="{}" x-on:click="$dispatch('show-rating')" x-cloak type="button"
        class="bg-yellow-500 hover:bg-yellow-600 text-white pl-2 pr-5 py-1 rounded-r-full absolute top-[100px] left-0 z-30 flex items-center shadow">
        <svg class="w-6 h-6 text-yellow-100 shrink-0 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 22 20">
            <path
                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
        </svg><span class="text-xs">
            <span class="block leading-none">Are you satisfied</span>
            <span class="block leading-none">with the Scheme ?</span>
        </span>
    </button>

    <div class="px-4 py-8" style="background-color: #056fd2;">
        <div>
            <img src="{{ url('img/emblem.png') }}" alt="emblem" loading="lazy" class="object-fit h-32 mx-auto block">
            <div class="uppercase text-md tracking-wider text-center font-medium text-white">GOVERNMENT OF ASSAM</div>
        </div>

        <div class="text-3xl font-bold text-white text-center my-2">
            {{ $scheme->name }}
        </div>

        <div class="text-lg font-medium text-white text-center mb-2">
            {{ $scheme->villages?->pluck('village_name')->join(', ') }}, {{ $scheme->district?->name }}
        </div>

        <div class="text-lg font-medium text-white text-center">
            Public Health Engineering Department <br>
            {{ $scheme->division?->name }} Division
        </div>
    </div>

    @if($scheme->operating_status?->value === 'partially-operative')
    <div class="mt-2 bg-yellow-500 text-sm text-black p-4" role="alert">
        <span id="hs-solid-color-warning-label" class="font-bold mr-2">Partially Functional :</span> ALERT ! This scheme
        is partially functional.
    </div>
    @elseif ($scheme->operating_status?->value === 'operative')
    <div class="mt-2 bg-teal-500 text-sm text-white p-4" role="alert">
        <span id="hs-solid-color-success-label" class="font-bold mr-2">Functional</span> This Scheme is fully functional.
    </div>
    @elseif ($scheme->operating_status?->value === 'non-operative')
    <div class="mt-2 bg-red-500 text-sm text-white p-4" role="alert">
        <span id="hs-solid-color-danger-label" class="font-bold mr-2">Non-Functional</span> ALERT ! This scheme is Not
        Functional.
    </div>
    @endif

    <x-section-centered class="py-4">
        {{-- <div class="my-4">
            <div style="position: relative;
            padding-bottom: 56.25%;">
                <iframe style="position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;" src="https://www.youtube.com/embed/Nbcd8if4tM8" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        </div> --}}

        <div class="py-10 -mt-5">
            <div class="relative w-full flex gap-6 snap-x snap-mandatory overflow-x-auto">

                @foreach ($jalkoshLinks as $jalkoshLink)
                @if ($jalkoshLink->link_type === 'video')
                <div class="snap-center shrink-0">
                    <div class="shrink-0 w-[400px] rounded-lg bg-white overflow-hidden">
                        <iframe width="400" height="300" src="{{ $jalkoshLink->external_link }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
                @else
                <div class="snap-center shrink-0">
                    <div class="shrink-0 rounded-lg bg-white overflow-hidden" style="height: 300px; width: 400px">
                        <img src="{{ $jalkoshLink->attachment_url }}" alt="" class="object-fit" height="300"
                            width="400" />
                    </div>
                </div>
                @endif
                @endforeach

                {{-- <div class="snap-center shrink-0">
                    <div class="shrink-0 w-[400px] rounded-lg bg-white overflow-hidden">
                        <iframe width="400" height="300" src="https://www.youtube.com/embed/Nbcd8if4tM8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="snap-center shrink-0">
                    <div class="shrink-0 w-[400px] rounded-lg bg-white overflow-hidden">
                        <iframe width="400" height="300" src="https://www.youtube.com/embed/MCPjR8KWt3s"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="snap-center shrink-0">
                    <div class="shrink-0 w-[400px] rounded-lg bg-white overflow-hidden">
                        <iframe width="400" height="300" src="https://www.youtube.com/embed/4QHTPAs-IH0"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div> --}}

                <div class="snap-center shrink-0">
                    <div class="shrink-0 w-4 sm:w-48"></div>
                </div>
            </div>
        </div>

        {{-- <div class="bg-red-100 overflow-hidden">
            <div class="snap-x mx-auto snap-mandatory h-screen flex w-96 overflow-scroll">
                <div
                    class="snap-start bg-amber-200 w-96 flex-shrink-0 h-screen flex items-center justify-center text-8xl">
                    1</div>
                <div
                    class="snap-start bg-teal-200 w-96 flex-shrink-0  h-screen flex items-center justify-center text-8xl">
                    2</div>
                <div
                    class="snap-start bg-cyan-200 w-96 flex-shrink-0 h-screen flex items-center justify-center text-8xl">
                    3</div>
                <div
                    class="snap-start bg-fuchsia-200 w-96 flex-shrink-0 h-screen flex items-center justify-center text-8xl">
                    4</div>
            </div>
        </div> --}}

        {{-- {{ $textToRead }} --}}

        <div class="mb-3 grid grid-cols-1 md:grid-cols-2">
            <x-card no-padding card-classes="p-2">
                <x-description-list>
                    <x-description-list.item>
                        <x-slot name="title">Latest Water Supplied</x-slot>
                        <x-slot name="description">{{ $latestSupply }}</x-slot>
                    </x-description-list.item>
                    <x-description-list.item>
                        <x-slot name="title">Cumulative Water Supplied</x-slot>
                        <x-slot name="description">{{ $cumulativeFmrValue }}</x-slot>
                    </x-description-list.item>
                </x-description-list>
            </x-card>

        </div>

        <div x-on:redirect-to-seven.window="tab = 'seven'; location.reload()" x-data="{
                tab: window.location.hash ? window.location.hash.substring(1) : 'one',

                isSpeaking: false,
                speechSynthesis: null,
                textToRead: '{{ $textToRead }}',
           
                speakHindi() {
                    if ('speechSynthesis' in window) {
                        let msg = new SpeechSynthesisUtterance();
                        msg.text = this.textToRead;
                        msg.lang = 'hi-IN';
                        
                        // Set the rate (speed) to medium (0.8 is default, higher values are faster)
                        msg.rate = 0.8;

                        let speech = speechSynthesis;
                        speech.cancel(); // Stop any ongoing speech synthesis
                        speech.speak(msg);

                        this.isSpeaking = true;
                        this.speechSynthesis = speech;

                        msg.onend = function(event) {
                            this.isSpeaking = false;
                            this.speechSynthesis = null;
                        }.bind(this);
                    } else {
                        console.error('Speech synthesis not supported');
                    }
                },
                stopSpeech() {
                    if (this.speechSynthesis) {
                      this.speechSynthesis.cancel();
                      this.isSpeaking = false;
                      this.speechSynthesis = null;
                    }
                }
            }" x-cloak>

            <div class="flex p-1 space-x-1 w-full overflow-x-auto bg-slate-100 rounded-lg divide-x-2">
                <div class="flex-1">
                    <a href="#one" x-on:click="tab = 'one'"
                        class="flex items-center justify-center rounded-lg flex-1 font-medium px-5 py-2 text-xs text-slate-700 transition-colors duration-200 sm:text-sm hover:bg-blue-600 hover:text-white"
                        :class="{ 'bg-blue-600 border-b text-white': tab === 'one' }">
                        Basic Details
                    </a>
                </div>
                <div class="flex-1">
                    <a href="#two" x-on:click="tab = 'two'"
                        class="flex items-center justify-center rounded-lg flex-1 font-medium px-5 py-2 text-xs text-slate-700 transition-colors duration-200 sm:text-sm hover:bg-blue-600 hover:text-white"
                        :class="{ 'bg-blue-600 border-b text-white': tab === 'two' }">
                        Scheme Details
                    </a>
                </div>
                <div class="flex-1">
                    <a href="#three" x-on:click="tab = 'three'"
                        class="flex items-center justify-center rounded-lg flex-1 font-medium px-5 py-2 text-xs text-slate-700 transition-colors duration-200 sm:text-sm hover:bg-blue-600 hover:text-white"
                        :class="{ 'bg-blue-600 border-b text-white': tab === 'three' }">
                        Field Functionary
                    </a>
                </div>
                <div class="flex-1">
                    <a href="#four" x-on:click="tab = 'four'"
                        class="flex items-center justify-center rounded-lg flex-1 font-medium px-5 py-2 text-xs text-slate-700 transition-colors duration-200 sm:text-sm hover:bg-blue-600 hover:text-white"
                        :class="{ 'bg-blue-600 border-b text-white': tab === 'four' }">
                        Water Quality
                    </a>
                </div>
                <div class="flex-1">
                    <a href="#five" x-on:click="tab = 'five'"
                        class="flex items-center justify-center rounded-lg flex-1 font-medium px-5 py-2 text-xs text-slate-700 transition-colors duration-200 sm:text-sm hover:bg-blue-600 hover:text-white"
                        :class="{ 'bg-blue-600 border-b text-white': tab === 'five' }">
                        Scheme Component
                    </a>
                </div>
                {{-- <div class="flex-1">
                    <a href="#six" x-on:click="tab = 'six'"
                        class="flex items-center justify-center rounded-lg flex-1 px-5 py-2 text-xs font-medium text-slate-700 transition-colors duration-200 sm:text-sm hover:bg-blue-600 hover:text-white"
                        :class="{ 'bg-blue-600 border-b text-white': tab === 'six' }">
                        Scheme Layout
                    </a>
                </div> --}}
                <div class="flex-1">
                    <a href="#seven" x-on:click="tab = 'seven'"
                        class="flex items-center justify-center rounded-lg flex-1 font-medium px-5 py-2 text-xs text-red-500 transition-colors duration-200 sm:text-sm hover:bg-black hover:text-white"
                        :class="{ 'bg-black border-b text-white': tab === 'seven' }">
                        Scheme Evaluation
                    </a>
                </div>
                <div class="flex-1">
                    <a href="#eight" x-on:click="tab = 'eight'"
                        class="flex items-center justify-center rounded-lg flex-1 font-medium px-5 py-2 text-xs text-slate-700 transition-colors duration-200 sm:text-sm hover:bg-blue-600 hover:text-white"
                        :class="{ 'bg-blue-600 border-b text-white': tab === 'eight' }">
                        Map
                    </a>
                </div>
            </div>

            <div class="py-6">
                <div x-show="tab === 'one'">
                    {{-- Text to Speech --}}
                    <div x-show="!isSpeaking">
                        <x-button type="button" class="mb-4 py-3 px-6" x-on:click="speakHindi">
                            <svg class="w-5 h-5 inline mr-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                fill="#fbbf24" viewBox="0 0 256 256">
                                <path
                                    d="M240,128a15.74,15.74,0,0,1-7.6,13.51L88.32,229.65a16,16,0,0,1-16.2.3A15.86,15.86,0,0,1,64,216.13V39.87a15.86,15.86,0,0,1,8.12-13.82,16,16,0,0,1,16.2.3L232.4,114.49A15.74,15.74,0,0,1,240,128Z">
                                </path>
                            </svg>
                            <span>Play</span>
                        </x-button>
                    </div>
                    <div x-show="isSpeaking">
                        <x-button type="button" class="mb-4 py-3 px-6" x-on:click="stopSpeech">
                            <svg class="w-5 h-5 inline mr-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                fill="#fbbf24" viewBox="0 0 256 256">
                                <path
                                    d="M216,55.27V200.73A15.29,15.29,0,0,1,200.73,216H55.27A15.29,15.29,0,0,1,40,200.73V55.27A15.29,15.29,0,0,1,55.27,40H200.73A15.29,15.29,0,0,1,216,55.27Z">
                                </path>
                            </svg>
                            <span>Stop</span>
                        </x-button>
                    </div>
                    {{-- Text to Speech --}}

                    <p class="text-slate-500 text-sm mb-2">Basic details of the scheme are enlisted here, for further
                        information please contact concerned officer of division / sub division</p>

                    <x-description-list size="xs" grid="no-break">
                        <x-slot name="heading">About This Scheme</x-slot>

                        <x-description-list.item>
                            <x-slot name="title">Name</x-slot>
                            <x-slot name="description">{{ $scheme->name }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Scheme ID</x-slot>
                            <x-slot name="description">{{ $scheme->imis_id }}</x-slot>
                        </x-description-list.item>

                        {{-- <x-description-list.item>
                            <x-slot name="title">Scheme Type</x-slot>
                            <x-slot name="description">{{ $scheme->scheme_type }}</x-slot>
                        </x-description-list.item> --}}

                        {{-- <x-description-list.item>
                            <x-slot name="title">Scheme Status</x-slot>
                            <x-slot name="description">{{ $scheme->scheme_status }}</x-slot>
                        </x-description-list.item> --}}

                        <x-description-list.item>
                            <x-slot name="title">Division</x-slot>
                            <x-slot name="description">{{ $scheme->division?->name }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">District</x-slot>
                            <x-slot name="description">{{ $scheme->district?->name }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Block
                                <p>
                                    Panchayat
                                </p>
                            </x-slot>
                            <x-slot name="description">
                                {{ $scheme->block_names ?? '-' }}
                                <p>
                                    {{ $scheme->panchayats?->pluck('panchayat_name')->join(', ') }}
                                </p>
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Village
                                <p>
                                    Habitation
                                </p>
                            </x-slot>
                            <x-slot name="description">
                                {{ $scheme->villages?->pluck('village_name')->join(', ') ?? '-' }}
                                <p>
                                    {{ $scheme->habitations?->pluck('habitation_name')->join(', ') ?? '-' }}
                                </p>
                            </x-slot>
                        </x-description-list.item>
                    </x-description-list>
                </div>

                <div x-show="tab === 'two'">
                    <p class="text-slate-500 text-sm mb-2">Implementing Agency details of the scheme are enlisted here
                    </p>

                    <x-description-list size="xs" grid="no-break">
                        <x-slot name="heading">About Scheme</x-slot>

                        <x-description-list.item>
                            <x-slot name="title">Approved On</x-slot>
                            <x-slot name="description">{{ $scheme->approved_on }} | ({{ $scheme->slssc_year }})
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">No. of FHTC</x-slot>
                            <x-slot name="description">
                                {{ $scheme->achieved_fhtc ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Total Cost</x-slot>
                            <x-slot name="description">{{ $scheme->total_cost ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">State Share</x-slot>
                            <x-slot name="description">{{ $scheme->state_share ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Central Share</x-slot>
                            <x-slot name="description">{{ $scheme->central_share ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Handed Over On</x-slot>
                            <x-slot name="description">{{ $scheme->handover_date ?? '-' }}</x-slot>
                        </x-description-list.item>
                    </x-description-list>

                    @if ($scheme->workorders->isNotEmpty())
                    <div class="mt-5">
                        <x-description-list size="xs">
                            <x-slot name="heading">About Implementing Agency</x-slot>
                            @foreach ($scheme->workorders as $workorder)
                            <x-description-list size="xs">
                                <x-description-list.item>
                                    <x-slot name="title">Name of Agency</x-slot>
                                    <x-slot name="description">{{ $workorder?->contractor?->name ?? '-' }}
                                    </x-slot>
                                </x-description-list.item>
                                <x-description-list.item>
                                    <x-slot name="title">Work Order Date</x-slot>
                                    <x-slot name="description">{{ $workorder?->formal_workorder_date ?? '-' }}
                                    </x-slot>
                                </x-description-list.item>
                            </x-description-list>
                            @endforeach
                        </x-description-list>
                    </div>
                    @endif
                </div>

                <div x-show="tab === 'three'">
                    <p class="text-slate-500 text-sm mb-2">Jal Mitra & WUC Users details of the scheme are enlisted
                        here
                    </p>

                    <x-description-list size="xs" grid="no-break">
                        <x-slot name="heading">About Jal Mitra</x-slot>
                        <x-description-list.item>
                            <x-slot name="title">Name</x-slot>
                            <x-slot name="description">{{ $scheme?->user?->name }}</x-slot>
                        </x-description-list.item>
                        <x-description-list.item>
                            <x-slot name="title">Phone</x-slot>
                            <x-slot name="description">{{ $scheme?->user?->phone }}</x-slot>
                        </x-description-list.item>
                    </x-description-list>

                    @if ($scheme->wucs->isNotEmpty())
                    <div class="mt-5">
                        <x-description-list size="xs" grid="no-break">
                            <x-slot name="heading">About WUC</x-slot>

                            @foreach ($scheme->wucs as $wuc)
                            <div class="mt-5">
                                <x-description-list size="xs">
                                    <x-description-list.item>
                                        <x-slot name="title">WUC Name</x-slot>
                                        <x-slot name="description">{{ $wuc->name ?? '-' }}
                                        </x-slot>
                                    </x-description-list.item>
                                    <x-description-list.item>
                                        <x-slot name="title">President Name</x-slot>
                                        <x-slot name="description">{{ $wuc->president_name ?? '-' }}
                                        </x-slot>
                                    </x-description-list.item>
                                    <x-description-list.item>
                                        <x-slot name="title">Secretary Name</x-slot>
                                        <x-slot name="description">{{ $wuc->secretary_name ?? '-' }}
                                        </x-slot>
                                    </x-description-list.item>

                                </x-description-list>
                            </div>
                            @endforeach
                        </x-description-list>
                    </div>
                    @endif

                    @if ($scheme->users->isNotEmpty())
                    <div class="mt-5">
                        <x-description-list size="xs" grid="no-break">
                            <x-slot name="heading">About Section Officer </x-slot>

                            @foreach ($scheme->users as $user)
                            <div class="mt-5">
                                <x-description-list size="xs">
                                    <x-description-list.item>
                                        <x-slot name="title">Name</x-slot>
                                        <x-slot name="description">{{ $user->name ?? '-' }}
                                        </x-slot>
                                    </x-description-list.item>
                                    <x-description-list.item>
                                        <x-slot name="title">Phone</x-slot>
                                        <x-slot name="description">{{ $user->phone ?? '-' }}
                                        </x-slot>
                                    </x-description-list.item>
                                </x-description-list>
                            </div>
                            @endforeach
                        </x-description-list>
                    </div>
                    @endif
                </div>

                <div x-show="tab === 'four'">
                    <p class="text-slate-500 text-sm mb-2">Water Quality details of the scheme are enlisted here.</p>

                    <x-description-list size="xs" grid="no-break">
                        <x-slot name="heading">About Water Quality</x-slot>

                        <x-description-list.item>
                            <x-slot name="title">Date of Testing</x-slot>
                            <x-slot name="description">N/A</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">PH</x-slot>
                            <x-slot name="description">N/A</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">TDS</x-slot>
                            <x-slot name="description">N/A</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Iron</x-slot>
                            <x-slot name="description">N/A</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Arsenic/Flouride</x-slot>
                            <x-slot name="description">N/A</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Residual Chlorine</x-slot>
                            <x-slot name="description">N/A</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Bacteriological Test</x-slot>
                            <x-slot name="description">N/A</x-slot>
                        </x-description-list.item>

                    </x-description-list>
                </div>

                <div x-show="tab === 'five'">
                    <p class="text-slate-500 text-sm mb-2">Component details of the scheme are enlisted here.</p>

                    <x-description-list size="xs" grid="no-break">
                        <x-slot name="heading">About Scheme Components</x-slot>

                        @if ($scheme->assets->isNotEmpty())
                        @foreach ($scheme->assets as $asset)
                        <div class="mt-5">
                            <x-description-list.item>
                                <x-slot name="title">Component Name</x-slot>
                                <x-slot name="description">{{ $asset->item_name }}</x-slot>
                            </x-description-list.item>

                            <x-description-list.item>
                                <x-slot name="title">Specification</x-slot>
                                <x-slot name="description">{{ $asset->specification }}</x-slot>
                            </x-description-list.item>
                        </div>
                        @endforeach
                        @else
                        <x-card-empty />
                        @endif

                    </x-description-list>
                </div>
                
                <div x-show="tab === 'six'">
                    <p class="text-slate-500 text-sm mb-2">Please click on button to view map.</p>
                    <x-button class="bg-green-600 py-3 text-lg" target="_blank" tag="a"
                        href="{{ route('schemes.map') }}">Map</x-button>
                </div>

                <div x-show="tab === 'seven'">
                    @auth
                    <div class="flex items-center bg-slate-100 rounded-lg p-4 mb-8">
                        <div class="h-12 w-12 rounded-full shrink-0 overflow-hidden">
                            <img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}"
                                class="h-12 w-12 rounded-full object-cover" loading="lazy" />
                        </div>
                        <div class="flex-1 px-4 overflow-hidden">
                            <div class="font-semibold truncate text-slate-800">{{ auth()->user()->name }}
                                ({{ Str::mask(auth()->user()->phone, '*', -8, 6) }})</div>
                            <div class="text-sm text-slate-500 truncate leading-tight">Role:
                                {{ Str::headline(auth()->user()->role) }}</div>
                        </div>

                        <div>
                            <livewire:auth.logout :scheme-id="$scheme->id" />
                        </div>
                    </div>

                    <div class="rounded-lg overflow-hidden ring-1 ring-slate-200 shadow bg-white p-2">
                        <div class="px-4 py-6 bg-blue-800 rounded-md">
                            <div class="text-xs uppercase tracking-wider text-center text-slate-300/75 font-semibold">
                                You are about to review</div>
                            <x-heading size="2xl" class="text-center text-white">{{ $scheme->name }}</x-heading>

                            {{-- <x-button class="w-full bg-green-600 hover:bg-green-700 py-3">Start Review</x-button>
                            --}}
                        </div>

                        @if ($reviewSections->isNotEmpty())
                        <div class="text-xs text-center my-4 uppercase tracking-wider font-bold text-slate-400">
                            Please
                            select a section for Review</div>
                        <div class="divide-y">
                            @foreach ($reviewSections as $reviewSection)
                            <div class="py-1">
                                {{-- @if ($reviewSection->user_id === auth()->id())
                                <div class="flex px-4 py-2 rounded-lg hover:bg-slate-100 items-center">
                                    <div class="flex-1 pr-3 truncate block">
                                        <x-heading class="truncate block" size="md">{{ $reviewSection->title }}
                                        </x-heading>
                                        <div class="text-slate-500 text-xs">Total Questions: {{
                                            $reviewSection->review_questions_count }}</div>
                                    </div>
                                    <div class="shrink-0">
                                        <x-icon-check-circle class="w-8 h-8 text-green-600" />
                                    </div>
                                </div>
                                @else --}}
                                <a href="{{ route('schemesReviewsectionQuestions', [
                                                'scheme' => $scheme->id,
                                                'reviewsection' => $reviewSection->id,
                                            ]) }}" class="flex px-4 py-2 rounded-lg hover:bg-slate-100 items-center">
                                    <div class="flex-1 pr-3 truncate block">
                                        <x-heading class="truncate block" size="md">{{ $reviewSection->title }}
                                        </x-heading>
                                        <div class="text-slate-500 text-xs">Total Questions:
                                            {{ $reviewSection->review_questions_count }}</div>
                                    </div>
                                    <div class="shrink-0">
                                        <x-icon-chevron-right class="w-6 h-6 text-slate-400" />
                                    </div>
                                </a>
                                {{-- @endif --}}
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @else
                    <p class="text-slate-500 text-sm mb-2">You need to login to evaluate a scheme.</p>
                    <livewire:auth.login-register :scheme-id="$scheme->id" />
                    @endauth
                </div>


                <div x-show="tab === 'eight'">
                    <p class="text-slate-500 text-sm mb-2">Scheme Network Map</p>

                    <x-card no-padding overflow-hidden>
                        <div class="relative" wire:ignore>
                            <div id="map" class="w-full overflow-hidden" style="height: 65vh;"></div>
                        </div>
                    </x-card>
                </div>
            </div>
        </div>


        @if (!blank($scheme->work_status) && $scheme->work_status->value === 'handed-over')
        <div class="border rounded-lg bg-slate-800 p-10 my-6">
            <p class="text-2xl text-white mb-4 text-center font-semibold">Submit your grievance through:</p>
            <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0">

                <x-button class="bg-green-600 hover:bg-green-700 py-3 text-lg w-full" target="_blank" tag="a"
                    href="http://wa.me/917086041396?text={{ $scheme->imis_id }}|{{ urlencode($scheme->name) }}">
                    Option 1 :
                    <svg class="fill-current text-white mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                        </path>
                    </svg>Whatsapp
                </x-button>

                <x-button class="bg-yellow-600 hover:bg-yellow-700 py-3 text-lg w-full" tag="a"
                    href="tel:+917099098444">
                    Option 2 :
                    <svg class="fill-current text-white mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M17.707 12.293a.999.999 0 0 0-1.414 0l-1.594 1.594c-.739-.22-2.118-.72-2.992-1.594s-1.374-2.253-1.594-2.992l1.594-1.594a.999.999 0 0 0 0-1.414l-4-4a.999.999 0 0 0-1.414 0L3.581 5.005c-.38.38-.594.902-.586 1.435.023 1.424.4 6.37 4.298 10.268s8.844 4.274 10.269 4.298h.028c.528 0 1.027-.208 1.405-.586l2.712-2.712a.999.999 0 0 0 0-1.414l-4-4.001zm-.127 6.712c-1.248-.021-5.518-.356-8.873-3.712-3.366-3.366-3.692-7.651-3.712-8.874L7 4.414 9.586 7 8.293 8.293a1 1 0 0 0-.272.912c.024.115.611 2.842 2.271 4.502s4.387 2.247 4.502 2.271a.991.991 0 0 0 .912-.271L17 14.414 19.586 17l-2.006 2.005z">
                        </path>
                    </svg>Phone
                </x-button>

                <x-button color="red" class="py-3 text-lg w-full" tag="a" href="{{ route('grievance.apply', [
                            'sid' => $scheme->id,
                        ]) }}">
                    Option 3 :
                    <svg class="fill-current text-white mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M20 2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h3v3.766L13.277 18H20c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm0 14h-7.277L9 18.234V16H4V4h16v12z">
                        </path>
                        <circle cx="15" cy="10" r="2"></circle>
                        <circle cx="9" cy="10" r="2"></circle>
                    </svg>
                    Online
                </x-button>
            </div>
        </div>
        @endif

        <div class="border rounded-lg bg-gray-200 p-10 my-6 text-center">
            You can follow us on:
            <div class="flex space-x-10 justify-center">
                <a class="w-20 h-20" href="https://www.facebook.com/assamjaljeevanmission/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: #1877f2;">
                        <path
                            d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.772-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z">
                        </path>
                    </svg>
                </a>

                <a class="w-20 h-20" href="https://www.instagram.com/jaljeevanmissionassam/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: #405de6;">
                        <path
                            d="M20.947 8.305a6.53 6.53 0 0 0-.419-2.216 4.61 4.61 0 0 0-2.633-2.633 6.606 6.606 0 0 0-2.186-.42c-.962-.043-1.267-.055-3.709-.055s-2.755 0-3.71.055a6.606 6.606 0 0 0-2.185.42 4.607 4.607 0 0 0-2.633 2.633 6.554 6.554 0 0 0-.419 2.185c-.043.963-.056 1.268-.056 3.71s0 2.754.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.043 1.268.056 3.71.056s2.755 0 3.71-.056a6.59 6.59 0 0 0 2.186-.419 4.615 4.615 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.187.043-.962.056-1.267.056-3.71-.002-2.442-.002-2.752-.058-3.709zm-8.953 8.297c-2.554 0-4.623-2.069-4.623-4.623s2.069-4.623 4.623-4.623a4.623 4.623 0 0 1 0 9.246zm4.807-8.339a1.077 1.077 0 0 1-1.078-1.078 1.077 1.077 0 1 1 2.155 0c0 .596-.482 1.078-1.077 1.078z">
                        </path>
                        <circle cx="11.994" cy="11.979" r="3.003"></circle>
                    </svg>
                </a>

                <a class="w-20 h-20" href="https://twitter.com/JJM_Assam" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: #1da1f2;">
                        <path
                            d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </x-section-centered>

    <livewire:scheme-ratings :scheme-id="$scheme->id" />
    @push('scripts')
    <script type="text/javascript">
        function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: "en,hi,as,bn,",
                    // layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');
            }
    </script>

    <script type="text/javascript"
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    @endpush

    @push('styles')
		<!-- Load Leaflet from CDN -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
			integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
			crossorigin="" />

		<!-- Leaflet Mapbox CSS file for Fullscreen option on map-->
		<link rel='stylesheet'
			href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' />

		<!-- Leaflet Ruler CSS file to measure distance between points on map-->
		<link rel="stylesheet"
			href="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.css"
			integrity="sha384-P9DABSdtEY/XDbEInD3q+PlL+BjqPCXGcF8EkhtKSfSTr/dS5PBKa9+/PMkW2xsY" crossorigin="anonymous">

		<!-- Laeflet Measure Path CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-measure-path@1.5.0/leaflet-measure-path.css">

		@endpush

		@push('scripts-footer')
		<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
			integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
			crossorigin=""></script>

		<!-- Load Esri Leaflet from CDN -->
		<script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>
		<script src="https://unpkg.com/esri-leaflet-vector@4.1.0/dist/esri-leaflet-vector.js"></script>

		<!-- Leaflet-measure-path -->
		<script src="https://cdn.jsdelivr.net/npm/leaflet-measure-path@1.5.0/leaflet-measure-path.min.js" defer>
		</script>

		<!-- Leaflet Mapbox js file for Fullscreen option on map-->
		<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'>
		</script>
		<script src="https://unpkg.com/turf/turf.min.js"></script>
		<script>
			document.addEventListener('livewire:load', function () {
                let map = null;
                let beneficiary = @json($locations);
                let canal = @json($canalTracks);
            
                // Init map
                map = L.map('map').setView([{{ $latitude }},{{ $longitude }}], 8);

                // Add a zoom control to the toolbar container
                map.zoomControl.setPosition('bottomright'); // Zoom control

                let osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png';
                let osmAttribution = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

                // Add ESRI Map Layer
                const apiKey = "AAPKebb4404d33324a7cb37d3cfba41264d23f8bxdtdYcnp2Qz5TIai2tELmtX1AZK1nl6CS_5gnTNkQ9Y80WAr9wHf0CpSPWYJ";
                const basemapEnum = "arcgis/imagery";
                
                L.esri.Vector.vectorBasemapLayer(basemapEnum, {
                    apiKey: apiKey
                }).addTo(map);
            
                if (beneficiary != undefined ) {
                    let beneficiaryLayer = L.geoJSON(beneficiary, {
                        onEachFeature: function (feature, layer) {
                            layer.bindPopup(bindPopupData(feature));
                        }
                    }).addTo(map);
                }

    

                // Fullscreen option on map
                map.addControl(new L.Control.Fullscreen({
                        position: 'bottomright',
                }))

                if (canal != undefined ) {
                    let canalLayer = L.geoJSON(canal, {
                        type:"Polyline",
                        style:function(feature){

                            var lineWidth = scaleValue(feature.properties.size, 0, 700, 0, 10)

                            // console.log(lineWidth);

                        return {
                            color : feature.properties.color,
                            weight : lineWidth
                        };
                    },
                onEachFeature: function (feature, layer) {
                                    
                    // Calculate the length of each LineString
                    var coordinates = feature.geometry.coordinates;
                    var totalLength = 0;

                    for (var i = 0; i < coordinates.length - 1; i++) {
                        var latlng1 = L.latLng(coordinates[i][1], coordinates[i][0]);
                        var latlng2 = L.latLng(coordinates[i + 1][1], coordinates[i + 1][0]);

                        // Calculate the distance between consecutive points and add to the total length
                        totalLength += latlng1.distanceTo(latlng2);
                    }

                    // Display the total length on the console (you can use it as needed)
                    var roundLength = (totalLength / 1000).toFixed(2);

                    // console.log('Length: ', roundLength , 'Km');

                    layer.bindPopup(bindCanalPopupData(feature, roundLength));

                    // Get the center of the polyline
                    var bounds = layer.getBounds();
                    var center = bounds.getCenter();

                    // Create a custom div icon with the rounded total length
                    var labelIcon = L.divIcon({
                        className: 'line-label text-white',
                        html: roundLength + ' km'
                    });

                    // Add a marker with the custom div icon to show the label
                    L.marker(center, { icon: labelIcon }).addTo(map);
                }
            }).addTo(map);
            map.fitBounds(canalLayer.getBounds());
        }

		var customIcon = L.icon({
                iconUrl: "{{ url('img/icons/marker-red.png') }}",
                iconSize: [25, 40], // size of the icon
            });

		L.marker([{{ $latitude }},{{ $longitude }}], {icon: customIcon}).addTo(map);

		function scaleValue(value, minValue, maxValue, minScale, maxScale) {
            return ((value - minValue) / (maxValue - minValue)) * (maxScale - minScale) + minScale;
        }

        // Popup Content
        function bindCanalPopupData(feature, roundLength) {
            return `
                Length: <strong>${roundLength}</strong> Km<br>
                Size: <strong>${feature.properties.size}</strong> mm<br>
                Type: <strong>${feature.properties.type}</strong><br>
                Quality: <strong>${feature.properties.quality}</strong><br>
            `;
        }

        // Popup Content
        function bindPopupData(feature) {
            return `
                    Name: <strong>${feature.properties.beneficiary_name}</strong><br>
                    Phone: <strong>${feature.properties.phone}</strong><br>
                    Address: <strong>${feature.properties.address}</strong><br>
                `;
            }
        })
		</script>
		@endpush
</x-guest-layout>