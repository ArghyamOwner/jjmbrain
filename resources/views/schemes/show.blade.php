<x-app-layout title="{{ $scheme->name }}">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes') }}">Go Back</x-text-link>
            </x-slot>
            <x-slot name="action">
                <div class="flex space-x-2">
                    @if ($showArchiveButton)
                        <x-button color="red" with-icon icon="wallet" x-data="{ tooltip: 'Archive Scheme' }" x-cloak
                            x-on:click.prevent="window.Livewire.emitTo(
                                'schemes.archive-scheme',
                                'showDeleteModal',
                                '{{ $scheme->id }}',
                                'Confirm Archive',
                                'Once Archived the data will not be seen in the scheme listing. Are you sure you want to archive the Scheme?',
                                '{{ $scheme->name }}',
                                'Yes, Archive'
                            )">Archive
                            Scheme
                        </x-button>
                    @endif
                    @if ($showArchiveRequestButton)
                        <livewire:scheme-archive-request.create :scheme="$scheme->id" />
                    @endif
                </div>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    @push('scripts-footer')
        <script src="https://cdn.jsdelivr.net/npm/html-to-image@1.9.0/dist/html-to-image.js"></script>
    @endpush
    <x-section-centered>
        @if (!$showSchemeVerification)
            <livewire:schemes.verification-modal :scheme="$scheme->id" />
        @endif
        @if ($showHandOverVerification)
            <livewire:schemes.panchayat-verification-modal :scheme="$scheme" />
        @endif
        <div class="mx-auto bg-white rounded-xl shadow mb-4 relative overflow-hidden">
            <div class="flex">
                <div class="flex-1 p-5">
                    <div class="w-full bg-grey-400 h-2.5 relative" x-data="{ tooltip: '{{ $handedOverToolTip }}', percentage: {{ $handedOverPercentage }}, showTooltip: false }" x-cloak>
                        <div class="h-2.5 rounded-full w-full bg-slate-200 relative">
                            <div
                              class="h-full rounded-full absolute top-0 left-0"
                              @mouseover="showTooltip = true"
                              @mouseleave="showTooltip = false"
                              style="background: 
                                @if ($handedOverColor == 'green') 
                                  linear-gradient(to right, #28a745, #4caf50, #66bb6a);
                                @elseif ($handedOverColor == 'orange')
                                  linear-gradient(to right, #66bb6a, #4caf50, #ff7043);
                                @elseif ($handedOverColor == 'red')
                                  linear-gradient(to right, #66bb6a, #ff7043, #ef5350);
                                @else
                                  linear-gradient(to right, #e0e0e0, #bdbdbd, #9e9e9e); 
                                @endif
                              "
                              :style="{ width: percentage + '%' }">
                            </div>
                          </div>
                          
                        <div class="absolute top-full mt-2 text-sm bg-gray-700 text-white rounded px-2 py-1 shadow"
                            x-show="showTooltip" x-transition :style="{ left: `calc(${percentage}% - 2rem)` }">
                            {{ $handedOverToolTip }}
                            <div
                                class="absolute top-[-6px] left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-6 border-l-transparent border-r-6 border-r-transparent border-b-6 border-b-gray-700">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center mb-2 divide-x space-x-3 my-4">
                        <div class="flex items-center justify-between mb-2 space-x-2">
                            <div class="flex items-center space-x-2">
                                @if ($scheme->verified_by)
                                    <x-badge variant="success">Verified</x-badge>
                                    <span class="text-gray-400">|</span>
                                    <p>By
                                        {{ $scheme->verifiedBy->name . ' (' . $scheme->verified_on->diffForHumans() . ')' }}
                                    </p>
                                @else
                                    <x-badge variant="warning">Not Verified</x-badge>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <x-stars :count="$schemeRating">
                            {{ $schemeRating }}
                        </x-stars>
                        <span class="w-1 h-1 mx-1.5 bg-gray-800 rounded-full dark:bg-gray-400"></span>
                        <a href="#"
                            class="text-sm font-medium text-gray-900 underline hover:no-underline">{{ $review }}
                            reviews</a>
                    </div>
                    <div class="flex items-center mb-2 space-x-5 my-2">
                        <div>
                            <span class="uppercase text-slate-500 text-sm">IMIS ID:</span>
                            <span class="uppercase text-slate-700 font-semibold text-sm">{{ $scheme->imis_id }}</span>
                        </div>
                        <div>
                            <span class="uppercase text-slate-500 text-sm">SMT ID:</span>
                            <span
                                class="uppercase text-slate-700 font-semibold text-sm">{{ $scheme->old_scheme_id }}</span>
                        </div>
                    </div>
                    <h2 class="text-2xl font-semibold mb-1">{{ $scheme->name }}</h2>
                    <p class="text-slate-600">{{ $scheme->division?->name }}</p>
                    @if ($scheme->parentScheme)
                        <div class="col-span-2 mt-1 flex items-center">
                            <p class="text-slate-400 text-xs uppercase tracking-wider font-medium">Parent Scheme:
                            </p>
                            <p class="text-slate-700 text-sm">
                                @if ($scheme->parentScheme)
                                    <x-text-link
                                        href="{{ route('schemes.show', [$scheme->parent_id, 'tab' => 'details']) }}">
                                        {{ $scheme->parentScheme?->name . ' ( IMIS-ID :' . ($scheme->parentScheme?->imis_id ?? '-') . ' )' }}
                                    </x-text-link>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    @endif
                    <div class="space-y-2 ">
                        @if ($scheme->work_status)
                            <x-badge-new class="mb-2" variant="{{ $scheme->work_status->color() }}">
                                {{ $scheme->work_status }} </x-badge-new>
                        @endif
                        <x-badge-new class="mb-2" variant="info"> {{ $villageCount }} </x-badge-new>
                        @if ($scheme->scheme_nature)
                            <x-badge-new class="mb-2" variant="{{ $scheme->scheme_nature->color() }}">
                                {{ $scheme->scheme_nature }} </x-badge-new>
                        @endif
                        @if ($scheme->schemeDailyFlowmeter?->status)
                            <x-badge-new class="mb-2" variant="meter">
                                Bulk flow meter {{ $scheme->schemeDailyFlowmeter?->status }}
                            </x-badge-new>
                        @endif
                        @if ($scheme->schemeQrReports->isNotEmpty())
                            <x-badge-new variant="success">QR Code Installed</x-badge-new>
                        @else
                            <x-badge-new variant="danger">QR Code Not Installed</x-badge-new>
                        @endif
                    </div>
                </div>
                <div class="flex items-center justify-end">
                    <div class="grid pr-8 justify-items-center">
                        @if ($dlpDaysLeft || $dlpDaysLeft == 0)
                            <x-badge variant="success" class="mb-2">DLP days left: {{ $dlpDaysLeft }}</x-badge>
                        @endif
                        {!! $schemeQrcodeLarge !!}
                        <x-badge class="mt-2">Total scan done: {{ $scheme->qrscan_count }}</x-badge>
                    </div>
                </div>
                <div
                    class="
                @if ($scheme->energy_type == 'Electric') bg-blue-500
                @elseif ($scheme->energy_type == 'Solar')
                bg-yellow-500
                @else
                bg-green-500 @endif
                  w-40 flex items-center justify-center">
                    @if ($scheme->energy_type == 'Electric')
                        <div>
                            <x-icon-electric />
                            <div class="text-white p-2 text-center">Electric Power</div>
                        </div>
                    @elseif ($scheme->energy_type == 'Solar')
                        <div>
                            <x-icon-solar-power class="text-white" />
                            <div class="text-white p-2 text-center">Solar Power</div>
                        </div>
                    @else
                        <div>
                            <x-icon-gravity class="fill-white " />
                            <div class="text-white p-2 text-center">Gravity</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4  min-h-0">
            @unless (auth()->user()->isAsrlmBlock())
                @if (auth()->user()->isDc())
                    <x-card>
                        <x-heading size="md" class="mb-2">Quick Actions</x-heading>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            <x-button class="truncate" tag="a" href="#" x-data=""
                                x-on:click.prevent="$dispatch('downloadqrcode')" color="white" with-icon icon="download">
                                Scheme QrCode</x-button>
                            <x-button class="truncate" tag="a"
                                href="{{ route('schemes.inspections', $scheme->id) }}" color="white" with-icon
                                icon="search">Inspections</x-button>
                            <x-button class="truncate" tag="a"
                                href="{{ route('schemes.updateConsumer', $scheme->id) }}" color="white" with-icon
                                icon="lamp-charge">APDCL No</x-button>
                            @if ($scheme->consumer_no)
                                <x-button class="truncate" tag="a" href="#" color="white" with-icon
                                    icon="lamp-charge" x-data
                                    x-on:click.prevent="Livewire.emit('consumerDetailsSlideover', '{{ $scheme->consumer_no }}')"
                                    x-cloak>APDCL Bill</x-button>
                            @endif
                            <x-button class="truncate" tag="a" href="{{ route('networkMap', $scheme->id) }}"
                                color="white" with-icon icon="marker">Composite Map</x-button>
                            <x-button class="truncate" tag="a" href="{{ route('schemes.aa', $scheme->id) }}"
                                color="white" with-icon icon="file">AA Details</x-button>
                            <x-button class="truncate" tag="a"
                                href="{{ route('schemes.binarydata', $scheme->id) }}" color="white" with-icon
                                icon="file">Itemwise Progress</x-button>
                            <x-button class="truncate" tag="a" href="{{ route('canalShowMap', $scheme->id) }}"
                                color="white" with-icon icon="marker">Pipe Tracking</x-button>
                        </div>
                    </x-card>
                @else
                    <x-card>
                        <x-heading size="md" class="mb-2">Quick Actions</x-heading>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">

                            {{-- <x-button class="truncate" tag="a"
                            href="{{ route('schemes.qrcodeDownload', $scheme->id) }}" color="white" with-icon
                            icon="download">Scheme QrCode</x-button> --}}

                            <x-button class="truncate" tag="a" href="#" x-data=""
                                x-on:click.prevent="$dispatch('downloadqrcode')" color="white" with-icon
                                icon="download">
                                Scheme QrCode</x-button>

                            @if ($quickActionsDoNotShowToPanchayatUser)
                                <x-button class="truncate" tag="a"
                                    href="{{ route('schemes.edit', $scheme->id) }}" color="white" with-icon
                                    icon="edit">Edit Scheme</x-button>

                                {{-- <x-button class="truncate" tag="a" href="{{ route('schemes.assetCreate', $scheme->id) }}"
                                color="white" with-icon icon="add">Add Assets</x-button> --}}

                                {{-- <x-button class="truncate" tag="a" href="#" color="white" with-icon icon="info-circle"
                                x-data
                                x-on:click.prevent="Livewire.emit('updateSchemeStatusSlideover', '{{ $scheme->id }}')"
                                x-cloak>Update Status</x-button> --}}

                                <x-button class="truncate" tag="a"
                                    href="{{ route('schemes.updateStatus', $scheme->id) }}" color="white" with-icon
                                    icon="info-circle">Update Status</x-button>

                                <x-button class="truncate" tag="a"
                                    href="{{ route('schemes.beneficiaryCreate', $scheme->id) }}" color="white" with-icon
                                    icon="add">Add Beneficiary</x-button>
                            @endif

                            <x-button class="truncate" tag="a"
                                href="{{ route('schemes.inspections', $scheme->id) }}" color="white" with-icon
                                icon="search">Inspections</x-button>

                            {{-- <x-button tag="a" href="#" color="white" with-icon icon="trash" class="!text-red-600" x-data=""
                            x-cloak x-on:click.prevent="$wire.emitTo(
                            'schemes.delete',
                            'showDeleteModal',
                            '{{ $scheme->id }}',
                            'Confirm Deletion',
                            'Are you sure you want to remove this scheme?'
                        )">Delete Scheme</x-button> --}}

                            {{-- <x-button class="truncate" tag="a" href="#" color="white" with-icon icon="lamp-charge"
                            x-data x-on:click.prevent="Livewire.emit('updateConsumerNoSlideover', '{{ $scheme->id }}')"
                            x-cloak>APDCL No</x-button> --}}

                            @if ($quickActionsDoNotShowToPanchayatUser)
                                <x-button class="truncate" tag="a"
                                    href="{{ route('schemes.updateConsumer', $scheme->id) }}" color="white" with-icon
                                    icon="lamp-charge">APDCL No</x-button>
                            @endif

                            @if ($scheme->consumer_no)
                                <x-button class="truncate" tag="a" href="#" color="white" with-icon
                                    icon="lamp-charge" x-data
                                    x-on:click.prevent="Livewire.emit('consumerDetailsSlideover', '{{ $scheme->consumer_no }}')"
                                    x-cloak>Consumer Details</x-button>
                            @endif

                            @if ($quickActionsDoNotShowToPanchayatUser)
                                <x-button class="truncate" tag="a" href="{{ route('networkMap', $scheme->id) }}"
                                    color="white" with-icon icon="marker">Composite Map</x-button>

                                <x-button class="truncate" tag="a" href="{{ route('schemes.aa', $scheme->id) }}"
                                    color="white" with-icon icon="file">AA Details</x-button>

                                <x-button class="truncate" tag="a"
                                    href="{{ route('schemes.binarydata', $scheme->id) }}" color="white" with-icon
                                    icon="file">Itemwise Progress</x-button>
                            @endif

                            <x-button class="truncate" tag="a" href="{{ route('canalShowMap', $scheme->id) }}"
                                color="white" with-icon icon="marker">Pipe Tracking</x-button>

                            @if ($showSchemeVerification && $scheme->work_status?->value === 'handed-over')
                                @unless (auth()->user()->isPanchayatCommissioner())
                                    <x-button class="truncate" tag="a"
                                        href="{{ route('panchayatPayment.store', $scheme->id) }}" color="white" with-icon
                                        icon="add">O&M Payment</x-button>
                                @endunless
                            @endif
                            {{-- @if ($scheme->consumer_no)
                        <x-button class="truncate" tag="a" href="#" color="white" with-icon icon="lamp-charge" x-data
                            x-on:click.prevent="Livewire.emit('consumerDetailsSlideover', '{{ $scheme->consumer_no }}')"
                            x-cloak>Consumer Details</x-button>
                        @endif --}}
                            {{-- @if ($showIotDetailsButton && $iotDevice)
                                <x-button class="truncate" color="white" tag="a"
                                    href="{{ route('schemes.iot', ['deviceid' => $iotDevice->mqtt_device_id, 'schemeid' => $iotDevice->scheme_id]) }}"
                                    with-icon icon="iot-connection">IOT</x-button>
                            @endif --}}
                            @if ($showFetchSmtWorkorderDetailsButton)
                                <x-button color="indigo" class="truncate" tag="a"
                                    href="{{ route('fetch.smtWorkorder', $scheme->id) }}" with-icon icon="refresh">Fetch
                                    Workorder</x-button>
                            @endif
                        </div>
                    </x-card>
                @endif
            @endunless
            <x-card>
                <livewire:schemes.flow-meter-card :scheme="$scheme" />
            </x-card>
        </div>
        <div class="absolute overflow-hidden w-full h-full" style="left: -9999px; z-index: -1"
            x-on:downloadqrcode.window="generateImage()" x-data="{
                generateImage() {
                    htmlToImage.toPng(document.getElementById('schemeQrcodeImage'))
                        .then(function(dataUrl) {
                            const link = document.createElement('a')
                            const qrcodeName = '{{ $scheme->imis_id }}-{{ Str::slug($scheme->name) }}'
                            link.download = `${qrcodeName}.png`
                            link.href = dataUrl
                            link.click()
                        })
                        .catch(function(error) {
                            console.error('oops, something went wrong!', error);
                        });
                }
            }" x-cloak>

            <div id="schemeQrcodeImage" class="text-center relative" {{--
                style="background-color: #043b63; width: 500px; height: 700px" --}}
                style="width: 580px; height: 800px">
                <img style="width: 100%; height: 800px" src="{{ url('img/jal-kosh-template.png') }}" alt=""
                    class="h-20 mx-auto mb-2">

                <div class="my-6 text-center flex justify-center absolute inset-x-0 top-[312px]">
                    {!! $schemeQrcodeLarge !!}
                </div>

                <div class="absolute inset-x-0 bottom-24 w-full z-10">
                    <h2 class="font-bold text-2xl" style="color: #32aef0">{{ $scheme->name }}</h2>
                    <p class="text-sm font-semibold">{{ $scheme->imis_id ?? '' }}</p>
                    <p class="text-lg font-semibold">{{ $scheme->village_names ?? '-' }}</p>
                    <p class="text-lg font-semibold">{{ $scheme->panchayat_names ?? '-' }}</p>
                    <p class="text-lg mb-4 font-semibold">{{ $scheme->division?->name ?? '-' }},
                        {{ $scheme->district?->name ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- <div class="flex justify-between items-center">
            <div class="flex-1">
                <x-badge class="mb-2" variant="{{ $scheme->scheme_status->color() }}">{{ $scheme->scheme_status }}
                </x-badge>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <x-button color="white" href="{{ route('schemes.edit', $scheme->id) }}" tag="a"
                        class="px-2 py-1.5">Edit Scheme</x-button>

                    <x-dropdown width="40">
                        <x-slot name="trigger">
                            <x-button color="white" class="px-2 py-1.5">Quick links
                                <x-icon-chevron-down class="w-4 h-4 -mr-1" />
                            </x-button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link href="#" class="hover:bg-indigo-100 hover:text-indigo-600">Add Assets
                            </x-dropdown-link>
                            <x-dropdown-link href="#" class="hover:bg-indigo-100 hover:text-indigo-600">Activities
                            </x-dropdown-link>
                            <x-dropdown-link href="#" class="hover:bg-indigo-100 hover:text-indigo-600">Images
                            </x-dropdown-link>
                            <x-dropdown-link href="#" class="hover:bg-indigo-100 hover:text-indigo-600">Videos
                            </x-dropdown-link>
                            <x-dropdown-link href="#" class="hover:bg-indigo-100 hover:text-indigo-600">Map
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('schemes.qrcodeDownload', $scheme->id) }}"
                                class="hover:bg-indigo-100 hover:text-indigo-600">Download QrCode</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <x-dropdown>
                        <x-slot name="trigger">
                            <x-button color="white" class="px-2 py-1.5">More options
                                <x-icon-chevron-down class="w-4 h-4 -mr-1" />
                            </x-button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link href="#" class="hover:bg-indigo-100 hover:text-indigo-600">Add SO User
                            </x-dropdown-link>
                            <x-dropdown-link href="#" class="hover:bg-indigo-100 hover:text-indigo-600">Edit Scheme
                            </x-dropdown-link>
                            <x-dropdown-link href="#" class="hover:bg-indigo-100 hover:text-indigo-600">Update
                                Status</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>

        <x-heading size="xl" class="mb-4">{{ $scheme->name }}</x-heading>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-slate-400 text-xs uppercase tracking-wider font-medium">Scheme Type</p>
                <p class="text-slate-700 text-sm">{{ $scheme->scheme_type }}</p>
            </div>

            <div>
                <p class="text-slate-400 text-xs uppercase tracking-wider font-medium">Scheme UIN</p>
                <p class="text-slate-700 text-sm">{{ $scheme->scheme_uin }}</p>
            </div>
        </div> --}}

        <div class="mb-6">
            <x-tab-menu>
                <x-tab-menu.item :is-active="request()->segment(3) === 'details'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'details']) }}">
                    Overview
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'images'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'images']) }}">
                    Images
                </x-tab-menu.item>
                {{-- <x-tab-menu.item :is-active="request()->segment(3) === 'videos'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'videos']) }}">
                    Videos
                </x-tab-menu.item> --}}
                <x-tab-menu.item :is-active="request()->segment(3) === 'assets'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'assets']) }}">
                    Assets
                </x-tab-menu.item>
                {{-- <x-tab-menu.item :is-active="request()->segment(3) === 'map'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'map']) }}">
                    Map
                </x-tab-menu.item> --}}
                @unless (auth()->user()->isPanchayat())
                    <x-tab-menu.item :is-active="request()->segment(3) === 'so-user'" tag="a"
                        href="{{ route('schemes.show', [$scheme->id, 'tab' => 'so-user']) }}">
                        SO User
                    </x-tab-menu.item>
                @endunless
                <x-tab-menu.item :is-active="request()->segment(3) === 'jalmitra-user'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'jalmitra-user']) }}">
                    Jal Mitra User
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'activity'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'activity']) }}">
                    Activity
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'workorders'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'workorders']) }}">
                    Workorders
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'beneficiary'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'beneficiary']) }}">
                    Beneficiary
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'wuc'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'wuc']) }}">
                    WUC(s)
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'lithologs'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'lithologs']) }}">
                    Lithologs
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'pipe-network'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'pipe-network']) }}">
                    Pipe-Network
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'archive-requests'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'archive-requests']) }}">
                    Archive Requests
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'flood-info-scheme'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'flood-info-scheme']) }}">
                    Flood Info
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'flow-meter-index'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'flow-meter-index']) }}">
                    BFM Readings
                </x-tab-menu.item>
                <x-tab-menu.item :is-active="request()->segment(3) === 'esr-complaints'" tag="a"
                    href="{{ route('schemes.show', [$scheme->id, 'tab' => 'esr-complaints']) }}">
                    ESR Compliance
                </x-tab-menu.item>
            </x-tab-menu>
        </div>
        @include($tabViewName)
    </x-section-centered>
</x-app-layout>

<livewire:schemes.update-status />
{{-- <livewire:schemes.update-consumer-number /> --}}
<livewire:schemes.get-consumer-details />
<livewire:schemes.archive-scheme />
