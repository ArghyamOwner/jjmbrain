<div>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title> IOT </x-slot>
             <x-slot name="action">
                <x-button tag="a" 
                    href="{{ route('iot.graph.dashboard', ['deviceId' => $this->deviceid, 'schemeId' => $this->schemeid]) }}"
                    with-icon icon="refresh" with-spinner>
                Open Graph Dashboard
                </x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot> 
    <div x-data="{ chartOpen: false }">
        <x-section-centered>
            {{-- {{ $i }} --}}
            {{-- @if ($this->isShowGraph) 
       <div class="mb-2">
        <x-button class="truncate" tag="a" color="white" with-icon icon="lamp-charge"  
        href="{{ route('schemes.iot.charts', ['deviceId'=>  $this->deviceid, 'type'=> 't']  ) }}"
        >Show Graph</x-button>
       </div>
        @endif --}}
            <x-card overflow-hidden>
                <x-slot:header class="border-b">
                    <div class="flex space-x-2 items-center">
                        <div>Grid Status:</div>
                        <div>
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                fill="{{ $isLessThan == 1 ? '#18e028' : '#ff0000' }}" 
                                viewBox="0 0 256 256">
                                <path
                                    d="M176,232a8,8,0,0,1-8,8H88a8,8,0,0,1,0-16h80A8,8,0,0,1,176,232Zm40-128a87.55,87.55,0,0,1-33.64,69.21A16.24,16.24,0,0,0,176,186v6a16,16,0,0,1-16,16H96a16,16,0,0,1-16-16v-6a16,16,0,0,0-6.23-12.66A87.59,87.59,0,0,1,40,104.49C39.74,56.83,78.26,17.14,125.88,16A88,88,0,0,1,216,104Zm-32.11-9.34a57.6,57.6,0,0,0-46.56-46.55,8,8,0,0,0-2.66,15.78c16.57,2.79,30.63,16.85,33.44,33.45A8,8,0,0,0,176,104a9,9,0,0,0,1.35-.11A8,8,0,0,0,183.89,94.66Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </x-slot>
                <div wire:poll.10000ms="getIot">
                    @if ($response)
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 1623.543 990.931">
                                <defs>
                                    <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1"
                                        gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#f7af82" />
                                        <stop offset="1" stop-color="#d95a0d" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-2" x1="0.5" x2="0.5" y2="1"
                                        gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#843707" />
                                        <stop offset="1" stop-color="#dd9c75" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-3" x1="0.5" x2="0.5" y2="1"
                                        gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#f7af82" />
                                        <stop offset="1" stop-color="#10a1b4" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-4" x1="0.5" y1="1" x2="0.5"
                                        gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#1f99e6" />
                                        <stop offset="1" stop-color="#26c1fa" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-5" x1="0.5" y1="1" x2="0.5"
                                        gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#9bdbff" />
                                        <stop offset="1" stop-color="#026eed" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-6" x1="0.5" y1="0.932" x2="0.5"
                                        gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#badaff" />
                                        <stop offset="1" stop-color="#1349c3" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-7" x1="0.5" x2="0.5" y2="1"
                                        gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#96d7ff" />
                                        <stop offset="1" stop-color="#0d65de" />
                                    </linearGradient>
                                    <clipPath id="clip">
                                        <use xlink:href="#fill" />
                                    </clipPath>
                                    <clipPath id="clip-2">
                                        <use xlink:href="#fill-2" />
                                    </clipPath>
                                </defs>
                                <g id="Group_1" data-name="Group 1" transform="translate(-132.793 -196.774)">
                                    <g id="land-grass" transform="translate(-15.297)">
                                        <rect id="land" width="1623.543" height="67.552"
                                            transform="translate(148.09 828.394)" fill="url(#linear-gradient)" />
                                        <path id="grass-svgrepo-com"
                                            d="M18,214.46l6.222-71.377c1.152,23.249.7,50.08,6.086,63.874a349.435,349.435,0,0,0,1.808-53.794c2.606,15.487,6.084,30.607,6.755,46.909,1.266-12.084,2.168-24.092,5.443-36.6-.13,14.083-2.937,26.982,2.17,34.019,2.47-11.02,4.962-22.014,5.385-35.619,3.641,13.364,3.139,29.341,4.27,44.291,1.441-14.7,2.615-55.7,8.029-68.735-.532,27-.661,48.378,4.689,59.242,5.288-8.355,5.745-24.723,5.867-40.255a180.489,180.489,0,0,1,6.48,47.168c1.476-15.545,3.2-31.089,7.427-46.633-.984,19.073-.22,33.906,3.342,41.947,2.355-12,4.365-24,4.984-36,3.153,17.883,2.225,34.477,2.859,51.565Z"
                                            transform="translate(1274.969 614.853)" fill="#01c620" />
                                        <path id="grass-svgrepo-com-2" data-name="grass-svgrepo-com"
                                            d="M18,214.46l6.222-71.377c1.152,23.249.7,50.08,6.086,63.874a349.435,349.435,0,0,0,1.808-53.794c2.606,15.487,6.084,30.607,6.755,46.909,1.266-12.084,2.168-24.092,5.443-36.6-.13,14.083-2.937,26.982,2.17,34.019,2.47-11.02,4.962-22.014,5.385-35.619,3.641,13.364,3.139,29.341,4.27,44.291,1.441-14.7,2.615-55.7,8.029-68.735-.532,27-.661,48.378,4.689,59.242,5.288-8.355,5.745-24.723,5.867-40.255a180.489,180.489,0,0,1,6.48,47.168c1.476-15.545,3.2-31.089,7.427-46.633-.984,19.073-.22,33.906,3.342,41.947,2.355-12,4.365-24,4.984-36,3.153,17.883,2.225,34.477,2.859,51.565Z"
                                            transform="translate(1356.602 614.589)" fill="#01c620" />
                                        <path id="grass-svgrepo-com-3" data-name="grass-svgrepo-com"
                                            d="M18,214.46l6.222-71.377c1.152,23.249.7,50.08,6.086,63.874a349.435,349.435,0,0,0,1.808-53.794c2.606,15.487,6.084,30.607,6.755,46.909,1.266-12.084,2.168-24.092,5.443-36.6-.13,14.083-2.937,26.982,2.17,34.019,2.47-11.02,4.962-22.014,5.385-35.619,3.641,13.364,3.139,29.341,4.27,44.291,1.441-14.7,2.615-55.7,8.029-68.735-.532,27-.661,48.378,4.689,59.242,5.288-8.355,5.745-24.723,5.867-40.255a180.489,180.489,0,0,1,6.48,47.168c1.476-15.545,3.2-31.089,7.427-46.633-.984,19.073-.22,33.906,3.342,41.947,2.355-12,4.365-24,4.984-36,3.153,17.883,2.225,34.477,2.859,51.565Z"
                                            transform="translate(1438.354 614.853)" fill="#01c620" />
                                        <path id="grass-svgrepo-com-4" data-name="grass-svgrepo-com"
                                            d="M18,214.46l7.3-71.377c1.351,23.249.821,50.08,7.142,63.874a298.119,298.119,0,0,0,2.121-53.794c3.058,15.487,7.139,30.607,7.928,46.909,1.485-12.084,2.544-24.092,6.387-36.6-.153,14.083-3.447,26.982,2.546,34.019,2.9-11.02,5.823-22.014,6.319-35.619,4.272,13.364,3.684,29.341,5.011,44.291,1.691-14.7,3.069-55.7,9.422-68.735-.625,27-.776,48.378,5.5,59.242,6.206-8.355,6.742-24.723,6.885-40.255a155.736,155.736,0,0,1,7.6,47.168c1.733-15.545,3.749-31.089,8.715-46.633-1.155,19.073-.258,33.906,3.922,41.947,2.764-12,5.123-24,5.849-36,3.7,17.883,2.611,34.477,3.356,51.565Z"
                                            transform="translate(633.982 613.934)" fill="#01c620" />
                                        <path id="grass-svgrepo-com-5" data-name="grass-svgrepo-com"
                                            d="M18,214.46l6.222-71.377c1.152,23.249.7,50.08,6.086,63.874a349.435,349.435,0,0,0,1.808-53.794c2.606,15.487,6.084,30.607,6.755,46.909,1.266-12.084,2.168-24.092,5.443-36.6-.13,14.083-2.937,26.982,2.17,34.019,2.47-11.02,4.962-22.014,5.385-35.619,3.641,13.364,3.139,29.341,4.27,44.291,1.441-14.7,2.615-55.7,8.029-68.735-.532,27-.661,48.378,4.689,59.242,5.288-8.355,5.745-24.723,5.867-40.255a180.489,180.489,0,0,1,6.48,47.168c1.476-15.545,3.2-31.089,7.427-46.633-.984,19.073-.22,33.906,3.342,41.947,2.355-12,4.365-24,4.984-36,3.153,17.883,2.225,34.477,2.859,51.565Z"
                                            transform="translate(130.09 613.278)" fill="#01c620" />
                                        <rect id="land-2" data-name="land" width="347.543" height="88.207"
                                            transform="translate(513.45 895.946)" fill="url(#linear-gradient-2)" />
                                        <rect id="land-3" data-name="land" width="347.543" height="203.552"
                                            transform="translate(513.45 984.153)" fill="url(#linear-gradient-3)" />
                                    </g>
                                    <a href="#iotCharts"  wire:click.="viewSelectedType('electrical_parameters')" x-on:click="chartOpen = true">
                                        <g id="transformer" transform="translate(882.035 449.168)">
                                            <path id="Path_608" data-name="Path 608" d="M0,0H138.465V16.738H0Z"
                                                transform="translate(0 114.076)" fill="#bfbcbc" />
                                            <rect id="Rectangle_1430" data-name="Rectangle 1430" width="120.303"
                                                height="63.668" transform="translate(8.903 51.832)" fill="#e8e8e8" />
                                            <g id="Path_607" data-name="Path 607" transform="translate(97.273)"
                                                fill="#1d9ffc">
                                                <path
                                                    d="M 18.94256210327148 44.93913269042969 L 1.000002980232239 44.93913269042969 L 1.000002980232239 1.000004410743713 L 18.94256210327148 1.000004410743713 L 18.94256210327148 44.93913269042969 Z"
                                                    stroke="none" />
                                                <path
                                                    d="M 2.000003814697266 1.999996185302734 L 2.000003814697266 43.93912506103516 L 17.94256210327148 43.93912506103516 L 17.94256210327148 1.999996185302734 L 2.000003814697266 1.999996185302734 M 3.814697265625e-06 -3.814697265625e-06 L 19.94256210327148 -3.814697265625e-06 L 19.94256210327148 45.93912506103516 L 3.814697265625e-06 45.93912506103516 L 3.814697265625e-06 -3.814697265625e-06 Z"
                                                    stroke="none" fill="#1da0ff" />
                                            </g>
                                            <g id="Rectangle_1433" data-name="Rectangle 1433"
                                                transform="translate(22.447)" fill="#f51011" stroke="#f51010"
                                                stroke-width="2">
                                                <rect width="19.943" height="45.939" stroke="none" />
                                                <rect x="1" y="1" width="17.943" height="43.939" fill="none" />
                                            </g>
                                            <g id="Rectangle_1434" data-name="Rectangle 1434"
                                                transform="translate(59.261)" fill="#ffe634" stroke="#ffe634"
                                                stroke-width="2">
                                                <rect width="19.943" height="45.939" stroke="none" />
                                                <rect x="1" y="1" width="17.943" height="43.939" fill="none" />
                                            </g>
                                            <g id="Rectangle_1755" data-name="Rectangle 1755"
                                                transform="translate(41.965 61.832)" fill="#ffe626" stroke="#190404"
                                                stroke-width="1">
                                                <rect width="55" height="42" rx="3" stroke="none" />
                                                <rect x="0.5" y="0.5" width="54" height="41" rx="2.5"
                                                    fill="none" />
                                            </g>
                                            <rect id="Rectangle_1431" data-name="Rectangle 1431" width="138.465"
                                                height="16.738" transform="translate(0 37.813)" fill="#bfbcbc" />
                                            <line id="Line_337" data-name="Line 337" x2="304.46"
                                                transform="translate(-293.995 77.332)" fill="none" stroke="#00eafd"
                                                stroke-width="15" />
                                            <text id="_s_V" data-name="{{ $s }} V"
                                                transform="translate(36.687 -3.168) rotate(-90)" fill="#eb3a23"
                                                font-size="20" font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{ $s }} V</tspan>
                                            </text>
                                            <text id="_t_V" data-name="{{ $t }} V"
                                                transform="translate(74.204 -4.668) rotate(-90)" fill="#ffe634"
                                                font-size="20" font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{ $t }} V</tspan>
                                            </text>
                                            <text id="_u_V" data-name="{{ $u }} V"
                                                transform="translate(112.215 -2.668) rotate(-90)" fill="#06a0f2"
                                                font-size="20" font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{ $u }} V</tspan>
                                            </text>
                                            <text id="_3_" data-name="3 " transform="translate(49.965 88.832)"
                                                fill="#020a0f" font-size="20" font-family="Roboto-Bold, Roboto"
                                                font-weight="700">
                                                <tspan x="0" y="0">3 </tspan>
                                            </text>
                                            <text id="_" data-name="~" transform="translate(64.965 93.832)"
                                                fill="#020a0f" font-size="40" font-family="Roboto-Bold, Roboto"
                                                font-weight="700">
                                                <tspan x="0" y="0">~</tspan>
                                            </text>
                                        </g>
                                    </a>
                                    <g id="treatment-pant" transform="translate(731.193 640.312)">
                                        <g id="Path_609" data-name="Path 609" transform="translate(0)" fill="#c7c7c7">
                                            <path
                                                d="M 186.0711822509766 187.6063690185547 L 1.000012040138245 187.6063690185547 L 1.000012040138245 0.9999940395355225 L 105.0022048950195 0.9999940395355225 L 105.0022048950195 87.00615692138672 L 105.0022048950195 88.00615692138672 L 106.0022048950195 88.00615692138672 L 166.8210601806641 88.00615692138672 L 167.8210601806641 88.00615692138672 L 167.8210601806641 87.00615692138672 L 167.8210601806641 0.9999940395355225 L 186.0711822509766 0.9999940395355225 L 186.0711822509766 187.6063690185547 Z"
                                                stroke="none" />
                                            <path
                                                d="M 2.000015258789062 1.999984741210938 L 2.000015258789062 186.6063537597656 L 185.0711517333984 186.6063537597656 L 185.0711517333984 1.999984741210938 L 168.8210296630859 1.999984741210938 L 168.8210296630859 89.00615692138672 L 104.0022048950195 89.00615692138672 L 104.0022048950195 1.999984741210938 L 2.000015258789062 1.999984741210938 M 1.52587890625e-05 -1.52587890625e-05 L 106.0022048950195 -1.52587890625e-05 L 106.0022048950195 87.00615692138672 L 166.8210296630859 87.00615692138672 L 166.8210296630859 -1.52587890625e-05 L 187.0711517333984 -1.52587890625e-05 L 187.0711517333984 188.6063537597656 L 1.52587890625e-05 188.6063537597656 L 1.52587890625e-05 -1.52587890625e-05 Z"
                                                stroke="none" fill="#4a4444" />
                                        </g>
                                        <text id="Treatment_Plant_" data-name="Treatment Plant "
                                            transform="translate(18.807 174.688)" fill="#0b0f12" font-size="20"
                                            font-family="Roboto-Bold, Roboto" font-weight="700">
                                            <tspan x="0" y="0">Treatment Plant </tspan>
                                        </text>
                                        <g id="BackWash-On" transform="translate(-38.729 24)">
                                            @if ($m)
                                                <path id="Icon_awesome-exclamation-triangle"
                                                    data-name="Icon awesome-exclamation-triangle"
                                                    d="M43.287,32.111a3.507,3.507,0,0,1-3.16,5.253H3.652a3.507,3.507,0,0,1-3.16-5.253L18.73,1.75a3.728,3.728,0,0,1,6.32,0Zm-21.4-6.277a3.36,3.36,0,1,0,3.5,3.357A3.429,3.429,0,0,0,21.89,25.834ZM18.57,13.767l.564,9.925a.9.9,0,0,0,.911.828h3.69a.9.9,0,0,0,.911-.828l.564-9.925a.892.892,0,0,0-.911-.923H19.481a.892.892,0,0,0-.911.923Z"
                                                    transform="translate(71.646 22.057)"
                                                    fill="#ff0202" />
                                            @else
                                                <path id="Icon_feather-check-circle"
                                                    data-name="Icon feather-check-circle"
                                                    d="M43.5,21.944V24A19.5,19.5,0,1,1,31.938,5.8M43.5,7.5,24,27.015,18,21.015"
                                                    transform="translate(71.646 21.057)"
                                                    fill="none"
                                                    stroke="#01c620"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="3"/>
                                            @endif
                                            <text id="Backwash_Required_"
                                                data-name="Backwash Required  "
                                                transform="translate(93.536 76.688)" fill="#26761f" font-size="15"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="-36.178" y="0">Backwash </tspan>
                                                <tspan x="-34.014" y="20" xml:space="preserve">@if(!$m)Not @endif Required </tspan>
                                            </text>
                                        </g>
                                        <path id="Path_610" data-name="Path 610" d="M1.519,0H61.778V21.5H1.519Z"
                                            transform="translate(104.807 65.393)" fill="#ffb467" />
                                        <path id="Path_611" data-name="Path 611" d="M1.519,0H61.778V50.116H1.519Z"
                                            transform="translate(104.807 15.779)" fill="url(#linear-gradient-4)" />
                                    </g>
                                    <g id="ESR" transform="translate(1304.714 251.999)">
                                        <g id="Rectangle_1418" data-name="Rectangle 1418" transform="translate(0 18.084)"
                                            fill="#fff" stroke="#707070" stroke-width="2">
                                            <rect width="184.433" height="189.478" stroke="none" />
                                            <rect x="1" y="1" width="182.433" height="187.478" fill="none" />
                                        </g>
                                        <path id="Path_477" data-name="Path 477"
                                            d="M-2694,473.381V834.172l173.021-360.791V834.172Z"
                                            transform="translate(2699.606 -273.245)" fill="none" stroke="#000"
                                            stroke-linejoin="round" stroke-width="5" />
                                        <path id="Path_478" data-name="Path 478"
                                            d="M-2606.788,454.82-2695.1,569.283h172.875Z"
                                            transform="translate(2700.09 -247.326)" fill="none" stroke="#140202"
                                            stroke-linejoin="round" stroke-width="5" />
                                        <text id="ESR_w_" data-name="ESR {{ $w }}%"
                                            transform="translate(4.286 -13.225)" fill="#020a0f" font-size="40"
                                            font-family="Roboto-Bold, Roboto" font-weight="700">
                                            <tspan x="0" y="0">ESR {{ $w }}%</tspan>
                                        </text>
                                        <rect  id="ESR-water-level" width="180" height="{{(184*$w)/100}}"
                                            transform="translate(182.286 205.001) rotate(180)"
                                            fill="url(#linear-gradient-5)" />
                                    </g>
                                    <g id="control_room" data-name="control room" transform="translate(164.328 280.443)">
                                        <g id="Rectangle_1739" data-name="Rectangle 1739"
                                            transform="translate(62.868 153.92)" fill="#fff" stroke="#707070"
                                            stroke-width="1">
                                            <rect width="359.869" height="394.555" stroke="none" />
                                            <rect x="0.5" y="0.5" width="358.869" height="393.555" fill="none" />
                                        </g>
                                        <path id="Polygon_5" data-name="Polygon 5" d="M242.8,0l242.8,141.27H0Z"
                                            transform="translate(0 43)" fill="#115ca8" />
                                        <text id="Control_Room_" data-name="Control Room  "
                                            transform="translate(86.671 216.086)" fill="#0b0f12" font-size="19"
                                            font-family="Roboto-Bold, Roboto" font-weight="700">
                                            <tspan x="0" y="0" xml:space="preserve">Control Room </tspan>
                                        </text>
                                        <g id="Rectangle_1759" data-name="Rectangle 1759"
                                            transform="translate(249.672 196.557)" fill="#fff" stroke="#707070"
                                            stroke-width="1">
                                            <rect width="142" height="25" stroke="none" />
                                            <rect x="0.5" y="0.5" width="141" height="24" fill="none" />
                                        </g>
                                        <text id="Auto_Manual_" data-name="Auto / Manual "
                                            transform="translate(255.672 216.557)" fill="#ff6334" font-size="20"
                                            font-family="Roboto-Bold, Roboto" font-weight="700">
                                            <tspan x="0" y="0">
                                                @if ($c == 1)
                                                Auto
                                                @else
                                               Manual 
                                                @endif
                                            </tspan>
                                        </text>
                                    </g>
                                    <g id="chlorine-sensor" transform="translate(420.139 660.907)">
                                        <rect id="clorine-disply" width="147.416" height="156.088" fill="#d1fffb" />
                                        <g id="clorine" transform="translate(-0.697 19.839)">
                                            <text id="Chlorine_" data-name="Chlorine " transform="translate(5.675 9)"
                                                fill="#030803" font-size="9" font-family="Roboto-Bold, Roboto"
                                                font-weight="700">
                                                <tspan x="0" y="0">Chlorine </tspan>
                                            </text>
                                            <text id="_ah_ppm_" data-name="{{ $ah }} ppm "
                                                transform="translate(0.698 35.338)" fill="#26761f" font-size="20"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{ $ah }} ppm </tspan>
                                            </text>
                                        </g>
                                        <g id="chlorine-low" transform="translate(5.164 77.039)">
                                            <text id="Chlorine_Tank_Low_" data-name="Chlorine Tank Low "
                                                transform="translate(0.142 56.138)" fill="#ff0707" font-size="15"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">Chlorine Tank 
                                                   @if ($ak == 0)
                                                       Low
                                                    @elseif ($ak == 1)
                                                       Medium
                                                       @else
                                                       High
                                                   @endif
                                                </tspan>
                                            </text>
                                            @if ($ak == 1)
                                            <path id="Icon_feather-check-circle"
                                            data-name="Icon feather-check-circle"
                                            d="M43.5,21.944V24A19.5,19.5,0,1,1,31.938,5.8M43.5,7.5,24,27.015,18,21.015"
                                            transform="translate(8.062 0)"
                                            fill="none"
                                            stroke="#01c620"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="3"/>
                                            @else
                                            <path id="clorine-low-2" data-name="clorine-low"
                                                d="M36.24,28.053a3.062,3.062,0,0,1-2.646,4.59H3.058a3.062,3.062,0,0,1-2.646-4.59L15.681,1.529a3.053,3.053,0,0,1,5.291,0ZM18.326,22.569A2.933,2.933,0,1,0,21.253,25.5,2.93,2.93,0,0,0,18.326,22.569ZM15.547,12.028l.472,8.671a.764.764,0,0,0,.762.723h3.089a.764.764,0,0,0,.762-.723l.472-8.671a.764.764,0,0,0-.762-.807H16.31A.764.764,0,0,0,15.547,12.028Z"
                                                transform="translate(8.062 0)" 
                                                    fill="#01c620"
                                                />
                                                @endif
                                        </g>
                                        <g id="ph" transform="translate(56.84 -0.161)">
                                            <text id="pH-2" data-name="pH" transform="translate(0 24.88)"
                                                fill="#030803" font-size="10" font-family="Roboto-Bold, Roboto"
                                                font-weight="700">
                                                <tspan x="0" y="0">pH</tspan>
                                            </text>
                                            <text id="_ai_" data-name="{{$ai}}"
                                                transform="translate(22.32 32)" fill="#26761f" font-size="31"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{$ai}}</tspan>
                                            </text>
                                        </g>
                                    </g>
                                    <g id="RTU" transform="translate(253.211 661.991)">
                                        <rect id="rtu-display" width="153.92" height="153.92" transform="translate(0 0)"
                                            fill="#fff290" />
                                        <g id="Rectangle_1735" data-name="Rectangle 1735"
                                            transform="translate(23.125 110.595)" fill="#fff" stroke="#0b0101"
                                            stroke-width="1">
                                            <rect width="105.163" height="27.448" rx="3" stroke="none" />
                                            <rect x="0.5" y="0.5" width="104.163" height="26.448" rx="2.5"
                                                fill="none" />
                                        </g>
                                        <g id="Rectangle_1736" data-name="Rectangle 1736"
                                            transform="translate(128.288 117.942)" fill="#050202" stroke="#0b0101"
                                            stroke-width="2">
                                          @if ($ab == 1)
                                          <rect width="3.392" height="{{(184*$w)/100}}" height="13.569" stroke="none" />
                                          @endif
                                            <rect x="1" y="1" width="1.392" height="11.569" fill="none" />
                                        </g>
                                        <text id="Time_Remaining_" data-name="Time Remaining"
                                                transform="translate(60.622 105.204)" fill="#000000" font-size="18"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{ $d  }} hrs</tspan>
                                        </text>
                                        <g id="Rectangle_1737" data-name="Rectangle 1737"
                                            transform="translate(24.622 112.204)" fill="#66db1c" stroke="#66db2d"
                                            stroke-width="1">
                                            <rect  class="ani" width="{{(102*$e)/100}}" height="24.229" rx="2" stroke="none" />
                                        </g>
                                        @if ($isLessThan == 0)
                                        <g id="No-signal" transform="translate(16.281 25.214)">
                                            <text id="No_signal_" data-name="No signal "
                                                transform="translate(44.421 9.8)" fill="#ff0812" font-size="9"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">No signal </tspan>
                                            </text>
                                            <path id="Path_592" data-name="Path 592" d="M1.5,1.5,22.921,22.921"
                                                transform="translate(-1.5 -1.5)" fill="none" stroke="#f81212"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_593" data-name="Path 593"
                                                d="M25.08,16.59a10.652,10.652,0,0,1,2.22,1.451"
                                                transform="translate(-9.774 -6.795)" fill="none" stroke="#f81212"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_594" data-name="Path 594"
                                                d="M7.5,17.567a10.652,10.652,0,0,1,5.034-2.327"
                                                transform="translate(-3.605 -6.321)" fill="none" stroke="#f81212"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_595" data-name="Path 595"
                                                d="M16.065,7.548a15.579,15.579,0,0,1,11.558,3.846"
                                                transform="translate(-6.611 -3.604)" fill="none" stroke="#f81212"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_596" data-name="Path 596"
                                                d="M2.13,11.984a15.491,15.491,0,0,1,4.576-2.8"
                                                transform="translate(-1.721 -4.195)" fill="none" stroke="#f81212"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_597" data-name="Path 597"
                                                d="M12.795,23.581a5.842,5.842,0,0,1,6.767,0"
                                                transform="translate(-5.463 -8.869)" fill="none" stroke="#f81212"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_598" data-name="Path 598" d="M18,30h0"
                                                transform="translate(-7.29 -11.5)" fill="none" stroke="#f81212"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                        </g>
                                        @else
                                        <g id="connected" transform="translate(17.099 56.365)">
                                            <text id="Connected_" data-name="Connected " transform="translate(43.603 9)"
                                                fill="#04d004" font-size="9" font-family="Roboto-Bold, Roboto"
                                                font-weight="700">
                                                <tspan x="0" y="0">Connected </tspan>
                                            </text>
                                            <path id="Path_599" data-name="Path 599"
                                                d="M7.5,17.484a10.71,10.71,0,0,1,13.709,0"
                                                transform="translate(-4.014 -6.231)" fill="none" stroke="#00b237"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_600" data-name="Path 600"
                                                d="M2.13,11.4a15.579,15.579,0,0,1,20.6,0" transform="translate(-2.13 -3.6)"
                                                fill="none" stroke="#00b237" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_601" data-name="Path 601"
                                                d="M12.795,23.581a5.842,5.842,0,0,1,6.767,0"
                                                transform="translate(-5.872 -8.862)" fill="none" stroke="#00b237"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_602" data-name="Path 602" d="M18,30h0"
                                                transform="translate(-7.698 -11.493)" fill="none" stroke="#00b237"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                        </g>
                                        @endif
                                        <text id="_34_" data-name="34%" transform="translate(53.789 132.009)"
                                            fill="#170907" font-size="20" font-family="Roboto-Bold, Roboto"
                                            font-weight="700">
                                            <tspan x="0" y="0">{{ $e }}%</tspan>
                                        </text>
                                    </g>
                                    <g id="energy-disply" transform="translate(246.708 514.574)">
                                        <rect id="Rectangle_1743" data-name="Rectangle 1743" width="160.424"
                                            height="39.022" transform="translate(0 43.358)" fill="#dff" />
                                        <rect id="Rectangle_1744" data-name="Rectangle 1744" width="156.088"
                                            height="39.022" transform="translate(164.759 43.358)" fill="#dff" />
                                        <rect id="Rectangle_1745" data-name="Rectangle 1745" width="160.424"
                                            height="39.022" transform="translate(0 86.715)" fill="#dff" />
                                        <rect id="Rectangle_1746" data-name="Rectangle 1746" width="156.088"
                                            height="39.022" transform="translate(164.759 86.715)" fill="#dff" />
                                        <rect id="Rectangle_1740" data-name="Rectangle 1740" width="320.847"
                                            height="39.022" fill="#dff" />
                                        <text id="Energy_Meter_" data-name="Energy Meter "
                                            transform="translate(13.007 22.672)" fill="#030803" font-size="13"
                                            font-family="Roboto-Bold, Roboto" font-weight="700">
                                            <tspan x="0" y="0">Energy Meter </tspan>
                                        </text>
                                        <g id="energy-meter" transform="translate(6.504 6.504)">
                                            <text id="Kwh_q_kWh" data-name="Kwh    {{ $q }} kWh"
                                                transform="translate(171.263 15)" fill="#1e36eb" font-size="14"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0" xml:space="preserve">Kwh {{ $q }}
                                                </tspan>
                                            </text>
                                            <text id="Amp_" data-name="Amp " transform="translate(0 57.358)"
                                                fill="#1e36eb" font-size="13" font-family="Roboto-Bold, Roboto"
                                                font-weight="700">
                                                <tspan x="0" y="0">Amp </tspan>
                                            </text>
                                            <text id="_r_" data-name="{{ $r }}"
                                                transform="translate(75.876 58.358)" fill="#020412" font-size="14"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{$r}}</tspan>
                                            </text>
                                            <text id="KwH" transform="translate(0 99.548)" fill="#1e36eb"
                                                font-size="14" font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">Load</tspan>
                                            </text>
                                            <text id="_p_" data-name="{{ $p }}"
                                                transform="translate(80.212 99.548)" fill="#020412" font-size="14"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{ $p }}</tspan>
                                            </text>
                                            <text id="_3p_Volt" data-name="3p Volt"
                                                transform="translate(164.759 99.548)" fill="#1e36eb" font-size="14"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">3p Volt</tspan>
                                            </text>
                                            <text id="_v_" data-name="{{ $v }}"
                                                transform="translate(255.811 99.548)" fill="#020412" font-size="14"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{ $v }}</tspan>
                                            </text>
                                            <text id="PF_" data-name="PF " transform="translate(164.759 58.358)"
                                                fill="#1e36eb" font-size="14" font-family="Roboto-Bold, Roboto"
                                                font-weight="700">
                                                <tspan x="0" y="0">PF </tspan>
                                            </text>
                                            <text id="_o_" data-name="{{ $o }}"
                                                transform="translate(258.311 58.358)" fill="#020412" font-size="14"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{ $o }}</tspan>
                                            </text>
                                        </g>
                                    </g>
                                    <g id="flow-meter" transform="translate(-49 -21.77)">
                                        <g id="total-flow" transform="translate(1655.4 759.284)">
                                            <g id="flow-meter-2" data-name="flow-meter"
                                                transform="translate(64 -14.989)">
                                                <path id="Path_604" data-name="Path 604"
                                                    d="M93.286,25.2c-8.015,0-14.536,5.847-14.536,13.034a12,12,0,0,0,2.317,7.05A14.264,14.264,0,0,0,87.053,50a1.391,1.391,0,0,0,1.215-.062,1.114,1.114,0,0,0,.594-.952,4.452,4.452,0,0,1,8.848,0,1.113,1.113,0,0,0,.592.955A1.392,1.392,0,0,0,99.519,50a14.261,14.261,0,0,0,5.987-4.718,12,12,0,0,0,2.317-7.05C107.823,31.047,101.3,25.2,93.286,25.2Zm10.1,18.854a11.53,11.53,0,0,1-3.445,3.134,7.211,7.211,0,0,0-13.3,0,11.534,11.534,0,0,1-3.45-3.137,9.907,9.907,0,0,1-1.911-5.819c0-5.554,4.715-10.14,10.744-10.708v3.341H94.55V27.526c6.029.568,10.744,5.154,10.744,10.708A9.906,9.906,0,0,1,103.383,44.054Z"
                                                    transform="translate(-69.902 -12.569)" />
                                                <rect id="Rectangle_1747" data-name="Rectangle 1747" width="2.528"
                                                    height="2.267" transform="translate(18.329 22.436)" />
                                                <rect id="Rectangle_1748" data-name="Rectangle 1748" width="2.528"
                                                    height="2.267" transform="translate(22.121 22.436)" />
                                                <rect id="Rectangle_1749" data-name="Rectangle 1749" width="2.528"
                                                    height="2.267" transform="translate(25.912 22.436)" />
                                                <rect id="Rectangle_1750" data-name="Rectangle 1750" width="12.64"
                                                    height="2.267" transform="translate(15.8 26.799)" />
                                                <path id="Path_605" data-name="Path 605"
                                                    d="M141.128,144.9a2.28,2.28,0,1,0,2.528,2.267A2.411,2.411,0,0,0,141.128,144.9Z"
                                                    transform="translate(-117.744 -108.008)" />
                                                <path id="Path_606" data-name="Path 606"
                                                    d="M78.891,13.042H76.576a19.423,19.423,0,0,0-6.639-9.084,19.876,19.876,0,0,0-23.8,0,19.415,19.415,0,0,0-6.639,9.084H37.178a2.509,2.509,0,0,0-2.528,2.484v7.452a2.509,2.509,0,0,0,2.528,2.484H39.5a19.219,19.219,0,0,0,5.162,7.853,19.655,19.655,0,0,0,8.32,4.539v6.239a1.253,1.253,0,0,0,1.264,1.242h.632V59.619H57.4V45.335h1.264V59.619h2.528V45.335h.632a1.253,1.253,0,0,0,1.264-1.242V37.854a19.656,19.656,0,0,0,8.32-4.539,19.229,19.229,0,0,0,5.164-7.853h2.317a2.509,2.509,0,0,0,2.528-2.484V15.526A2.509,2.509,0,0,0,78.891,13.042ZM38.812,22.978H37.178V15.526h1.635a18.924,18.924,0,0,0,0,7.452Zm21.75,19.873H55.506V41.609h3.16V39.125h-3.16v-.782a19.945,19.945,0,0,0,5.056,0v4.508Zm13.877-19A16.718,16.718,0,0,1,69.683,31.5a17.119,17.119,0,0,1-8.111,4.159,17.6,17.6,0,0,1-7.069,0,17.122,17.122,0,0,1-8.117-4.16,16.722,16.722,0,0,1-4.759-7.657,16.382,16.382,0,0,1,0-9.2,16.876,16.876,0,0,1,6.04-8.719,17.314,17.314,0,0,1,20.728,0,16.887,16.887,0,0,1,6.044,8.728,16.409,16.409,0,0,1,0,9.2Zm4.451-.878H77.256a18.914,18.914,0,0,0,0-7.452h1.635Z"
                                                    transform="translate(-34.65 8.098)" />
                                            </g>
                                            <rect id="Rectangle_1752" data-name="Rectangle 1752" width="98.478"
                                                height="85.163" transform="translate(34.659 -100.062)" fill="#f2f4e2" />
                                            <text id="Water_supplied" data-name="Water supplied"
                                                transform="translate(85.6 -76.514)" fill="#097231" font-size="17"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="-24.537" y="0">Water </tspan>
                                                <tspan x="-32.589" y="23">supplied</tspan>
                                            </text>
                                            <text id="_x_" data-name="{{ $g }}"
                                                transform="translate(61.6 -25.514)" fill="#011408" font-size="20"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{ $g }} kl</tspan>
                                            </text>
                                        </g>
                                        <g id="flow-data" transform="translate(1713.074 814.188)">
                                            <g id="Rectangle_1753" data-name="Rectangle 1753"
                                                transform="translate(-11.503)" fill="#fff" stroke="#707070"
                                                stroke-width="1">
                                                <rect width="82.398" height="43.735" stroke="none" />
                                                <rect x="0.5" y="0.5" width="81.398" height="42.735" fill="none" />
                                            </g>
                                            <text id="Flow_rate_" data-name="Flow rate "
                                                transform="translate(4.997 12.582)" fill="#097231" font-size="10"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">Flow rate </tspan>
                                            </text>
                                            <text id="_h_" data-name="{{ $h }}"
                                                transform="translate(2.497 34.582)" fill="#011007" font-size="20"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">{{ $h }} m3/h</tspan>
                                            </text>
                                        </g>
                                    </g>
                                    <g id="motor-fault-up" transform="translate(17.963 -26.838)">
                                        @if ($af == 1)
                                        <rect id="Rectangle_1754" data-name="Rectangle 1754" width="84.573"
                                        height="75.349" transform="translate(1157.192 711.14)" fill="#fff041" />
                                    <path 
                                   class="
                                    @if ($af == 1)
                                    blinking
                                    @endif
                                    "
                                    id="motor-error"
                                        d="M30.516,22.377a2.445,2.445,0,0,1-2.228,3.661H2.575A2.445,2.445,0,0,1,.347,22.377L13.2,1.22a2.644,2.644,0,0,1,4.456,0ZM15.432,18A2.342,2.342,0,1,0,17.9,20.342,2.4,2.4,0,0,0,15.432,18Zm-2.34-8.409.4,6.916a.629.629,0,0,0,.642.577h2.6a.629.629,0,0,0,.642-.577l.4-6.916a.625.625,0,0,0-.642-.644h-3.4a.625.625,0,0,0-.642.644Z"
                                        transform="translate(1185.624 721.34)" fill="#ff0202" />
                                        @endif
                                        <text id="Motor_fault_" data-name="Motor fault "
                                            transform="translate(1166.439 767.874)" fill="#ff340f" font-size="13"
                                            font-family="Roboto-Bold, Roboto" font-weight="700">
                                                @if ($af == 1)
                                            <tspan class="blinking" x="0" y="0">Motor fault </tspan>
                                                @endif
                                            <tspan x="0" y="16"> Motor {{ $l }}</tspan>
                                        </text>
                                    </g>
                                    @if ($ad == 1)
                                    <text id="Surface_Pump_" data-name="Surface Pump"
                                        transform="translate(1140.439 780.874)" fill="#000000" font-size="18"
                                        font-family="Roboto-Bold, Roboto" font-weight="700"> 
                                        <tspan x="0" y="12">{{ $ae }} amp</tspan>
                                    </text>
                                    @endif
                                    <g id="UGR" transform="translate(971.141 734.196)">
                                        <g id="Rectangle_1413" data-name="Rectangle 1413" transform="translate(0 22.162)"
                                            fill="#fff" stroke="#707070" stroke-width="2">
                                            <rect width="144.959"  height="139.588" stroke="none" />
                                            <rect x="1" y="1" width="142.959" height="137.588" fill="none" />
                                        </g>
                                        <text id="UGR_x_" data-name="UGR {{ $x }}% "
                                            transform="translate(18.859 8.804)" fill="#0b0f12" font-size="25"
                                            font-family="Roboto-Bold, Roboto" font-weight="700">
                                            <tspan x="0" y="0">UGR {{ $x }}% </tspan>
                                        </text>
                                        <g id="Rectangle_1758" data-name="Rectangle 1758"
                                            transform="translate(142.859 161.804) rotate(180)" stroke="#92c3f7"
                                            stroke-width="1" fill="url(#linear-gradient-6)">
                                            <rect  width="141" height="{{(138*$x)/100}}" stroke="none" />
                                        </g>
                                    </g>
                                    <g id="DTW" transform="translate(553.369 825.504)">
                                        <rect id="well" width="53.988" height="407.724"
                                            transform="translate(46.559 -53)" fill="#d3d3d3" />
                                        <g id="ug-sensor" transform="translate(166.963)">
                                            <rect id="Rectangle_1756" data-name="Rectangle 1756" width="205"
                                                height="74" transform="translate(145.168 97.074)" fill="#adf0fc" />
                                            <text id="_n_" data-name="{{ $n }}"
                                                transform="translate(240.168 157.074)" fill="#030057" font-size="30"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="-36.812" y="0">{{ $n }} m</tspan>
                                            </text>
                                            <text id="Ground_water_level" data-name="Ground water level"
                                                transform="translate(248.168 121.074)" fill="#030057" font-size="17"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="-71.395" y="0">Ground water level</tspan>
                                            </text>
                                        </g>
                                        @if ($ab == 1)
                                        <g id="sub-fault" transform="translate(-43 -13)">
                                            <rect id="Rectangle_1757" data-name="Rectangle 1757" width="228"
                                                height="74" transform="translate(-267.832 103.074)" fill="#fff041" />
                                            <path id="Icon_awesome-exclamation-triangle-2"
                                                data-name="Icon awesome-exclamation-triangle"
                                                d="M43.287,32.111a3.507,3.507,0,0,1-3.16,5.253H3.652a3.507,3.507,0,0,1-3.16-5.253L18.73,1.75a3.728,3.728,0,0,1,6.32,0Zm-21.4-6.277a3.36,3.36,0,1,0,3.5,3.357A3.429,3.429,0,0,0,21.89,25.834ZM18.57,13.767l.564,9.925a.9.9,0,0,0,.911.828h3.69a.9.9,0,0,0,.911-.828l.564-9.925a.892.892,0,0,0-.911-.923H19.481a.892.892,0,0,0-.911.923Z"
                                                transform="translate(-245.993 115.392)" fill="#ff0202" />
                                            <text id="Motor_fault_2" data-name="Motor fault "
                                                transform="translate(-120.832 151.074)" fill="#030057" font-size="27"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="-70.875" y="0">Motor fault </tspan>
                                            </text>
                                        </g>
                                        @endif
                                    <rect id="water-level" width="43.988" height="{{(400*$n)/100}}" transform="translate(95.547 351.724) rotate(180)" fill="url(#linear-gradient-7)"/> 
                                        <g id="Sub-pump">
                                            <g id="water-level-2" data-name="water-level" class="
                                            @if ($z == 1)
                                                blinking
                                            @endif
                                            "
                                                transform="translate(60.559 179)" fill="#eaeaea" stroke="#000"
                                                stroke-width="1">
                                                <rect width="25.988" height="111.724" stroke="none" />
                                                <rect x="0.5" y="0.5" width="24.988" height="110.724" fill="none" />
                                            </g>
                                            <g id="water-level-3" data-name="water-level"
                                                transform="translate(60.559 288.724)" fill="#d16e19" stroke="#000"
                                                stroke-width="1">
                                                <rect width="25.988" height="34.724" stroke="none" />
                                                <rect x="0.5" y="0.5" width="24.988" height="33.724" fill="none" />
                                            </g>
                                            <g id="water-level-4" data-name="water-level"
                                                transform="translate(60.559 329.435) rotate(-90)" fill="#d16e19"
                                                stroke="#000" stroke-width="1">
                                                <rect width="6.988" height="25.988" stroke="none" />
                                                <rect x="0.5" y="0.5" width="5.988" height="24.988" fill="none" />
                                            </g>
                                            <g id="Ellipse_1" data-name="Ellipse 1" transform="translate(64.631 294.201)"
                                                fill="#fff" stroke="#050101" stroke-width="1">
                                                <circle cx="2.5" cy="2.5" r="2.5" stroke="none" />
                                                <circle cx="2.5" cy="2.5" r="2" fill="none" />
                                            </g>
                                            <g id="Ellipse_2" data-name="Ellipse 2" transform="translate(77.631 294.201)"
                                                fill="#fff" stroke="#050101" stroke-width="1">
                                                <circle cx="2.5" cy="2.5" r="2.5" stroke="none" />
                                                <circle cx="2.5" cy="2.5" r="2" fill="none" />
                                            </g>
                                            <g id="Ellipse_3" data-name="Ellipse 3" transform="translate(71.631 299.201)"
                                                fill="#fff" stroke="#050101" stroke-width="1">
                                                <circle cx="2.5" cy="2.5" r="2.5" stroke="none" />
                                                <circle cx="2.5" cy="2.5" r="2" fill="none" />
                                            </g>
                                            <g id="Ellipse_4" data-name="Ellipse 4" transform="translate(64.631 304.201)"
                                                fill="#fff" stroke="#050101" stroke-width="1">
                                                <circle cx="2.5" cy="2.5" r="2.5" stroke="none" />
                                                <circle cx="2.5" cy="2.5" r="2" fill="none" />
                                            </g>
                                            <g id="Ellipse_5" data-name="Ellipse 5" transform="translate(77.631 304.201)"
                                                fill="#fff" stroke="#050101" stroke-width="1">
                                                <circle cx="2.5" cy="2.5" r="2.5" stroke="none" />
                                                <circle cx="2.5" cy="2.5" r="2" fill="none" />
                                            </g>
                                            <g id="Ellipse_6" data-name="Ellipse 6" transform="translate(71.631 310.201)"
                                                fill="#fff" stroke="#050101" stroke-width="1">
                                                <circle cx="2.5" cy="2.5" r="2.5" stroke="none" />
                                                <circle cx="2.5" cy="2.5" r="2" fill="none" />
                                            </g>
                                            <text id="Motor_fault_2" data-name="Motor fault "
                                            transform="translate(160.832 300.074)" fill="#030057" font-size="20"
                                            font-family="Roboto-Bold, Roboto" font-weight="600">
                                            <tspan x="-50.875" y="0">
                                                Submersible Pump  @if ($z == 1)
                                                    On
                                                    @else
                                                    Off
                                                @endif
                                            </tspan>
                                        </text>
                                        </g>
                                    </g>
                                    <g id="pipe-line">
                                        <path id="sub-tp" d="M-1356.49,630.3h-109.458l-.547,307.491"
                                            transform="translate(2093.949 74.474)" fill="none" stroke="#0394fb"
                                            stroke-width="10" />
                                        <path id="tp-ugr" d="M12110.66-10228.813h56.284"
                                            transform="translate(-11194.518 11011.39)" fill="none" stroke="#0394fb"
                                            stroke-width="10" />
                                        <path id="ugr-esr-line" d="M0-846.694H151.639v-477.96H196.8"
                                            transform="translate(1116.147 1659.232)" fill="none" stroke="#0394fb"
                                            stroke-width="5" />
                                        <path id="delevery-pipe" d="M14284.732-11251.022h23.619v344.293l244.381-2.034"
                                            transform="translate(-12796.553 11697.527)" fill="none"
                                            stroke="#0695fb" stroke-width="5" />
                                    </g>
                                   
                                    <a href="#iotCharts"  wire:click.="viewSelectedType('surface_pumps')" x-on:click="chartOpen = true"
                                    class=" " 
                                    >
                                        <g id="Motor" transform="translate(1239.477 772.504) rotate(90)">
                                            <g id="Rectangle_1435" data-name="Rectangle 1435"
                                                transform="translate(0 17.264)" fill="none"  @if ($ad == 0)
                                                stroke="#ff0202"
                                                @else
                                                stroke="#01c620"
                                            @endif
                                                stroke-width="10">
                                                <rect width="25.896" height="23.258" rx="10"
                                                    stroke="none" />
                                                <rect x="5" y="5" width="15.896" height="13.258" rx="5"
                                                    fill="none" />
                                            </g>
                                            <line id="Line_331" data-name="Line 331" x1="0.302" y2="21.276"
                                                transform="translate(4.841 18.161)" fill="none"  @if ($ad == 0)
                                                stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="10" />
                                            <line id="Line_332" data-name="Line 332" x2="19.617" y2="0.075"
                                                transform="translate(5.142 21.405)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="2" />
                                            <line id="Line_333" data-name="Line 333" x2="19.617" y2="0.075"
                                                transform="translate(5.142 24.725)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="2" />
                                            <line id="Line_334" data-name="Line 334" x2="19.617" y2="0.075"
                                                transform="translate(5.013 28.044)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="2" />
                                            <line id="Line_335" data-name="Line 335" x2="19.617" y2="0.075"
                                                transform="translate(5.142 31.968)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="10" />
                                            <line id="Line_336" data-name="Line 336" x2="19.617" y2="0.075"
                                                transform="translate(5.142 35.891)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="2" />
                                            <g id="Rectangle_1436" data-name="Rectangle 1436"
                                                transform="translate(33.089 12.468)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="10">
                                                <rect width="13.188" height="31.41" rx="2" stroke="none" />
                                                <rect x="5" y="5" width="3.188" height="21.41" rx="1.594"
                                                    fill="none" />
                                            </g>
                                            <g id="Rectangle_1437" data-name="Rectangle 1437"
                                                transform="translate(24.697 21.58)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="10">
                                                <rect id="fill" width="5.994" height="14.386" rx="2.997"
                                                    stroke="none" />
                                                <path
                                                    d="M0,5h5.9943647384643555M5,0v14.386475563049316M5.9943647384643555,9.386475563049316h-5.9943647384643555M0.9943647384643555,14.386475563049316v-14.386475563049316"
                                                    fill="none" clip-path="url(#clip)" />
                                            </g>
                                            <g id="Rectangle_1439" data-name="Rectangle 1439"
                                                transform="translate(35.007 42.92)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="4">
                                                <rect width="8.872" height="6.953" rx="2" stroke="none" />
                                                <rect x="2" y="2" width="4.872" height="2.953" fill="none" />
                                            </g>
                                            <g id="Rectangle_1443" data-name="Rectangle 1443"
                                                transform="translate(33.089 0)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="4">
                                                <rect width="13.188" height="6.953" rx="2" stroke="none" />
                                                <rect x="2" y="2" width="9.188" height="2.953" fill="none" />
                                            </g>
                                            <g id="Rectangle_1442" data-name="Rectangle 1442"
                                                transform="translate(35.007 6.234)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="4">
                                                <rect width="8.872" height="6.714" rx="2" stroke="none" />
                                                <rect x="2" y="2" width="4.872" height="2.714" fill="none" />
                                            </g>
                                            <g id="Rectangle_1444" data-name="Rectangle 1444"
                                                transform="translate(29.492 15.825)" fill="none"  @if ($ad == 0)
                                    stroke="#ff0202"
                                                    @else
                                                    stroke="#01c620"
                                            @endif
                                                stroke-width="7">
                                                <rect id="fill-2" width="4.556" height="26.135" rx="2.278"
                                                    stroke="none" />
                                                <path
                                                    d="M0,3.5h4.555717468261719M3.5,0v26.13543128967285M4.555717468261719,22.63543128967285h-4.555717468261719M1.0557174682617188,26.13543128967285v-26.13543128967285"
                                                    fill="none" clip-path="url(#clip-2)" />
                                            </g>
                                        </g>
                                    </a>
                                    <a href="#iotCharts"  wire:click.="viewSelectedType('bulk_flow_meter_reading')" x-on:click="chartOpen = true">
                                        <g id="Valve-opration" transform="translate(-38.719 -35.195)">
                                            <g id="Rectangle_1751" data-name="Rectangle 1751"
                                                transform="translate(1555.217 722.572)" fill="#fff"
                                                @if ($i == 0)
                                                stroke="#ff0202"
                                                @else
                                                stroke="#01c620"
                                            @endif stroke-width="1">
                                                <rect width="113.862" height="42.742" stroke="none" />
                                                <rect x="0.5" y="0.5" width="112.862" height="41.742"
                                                    fill="none" />
                                            </g>
                                            <text id="Valve_Open_" data-name="Valve {{ 'Open' }}"
                                                transform="translate(1557.719 748.195)" fill="#097231" font-size="16"
                                                font-family="Roboto-Bold, Roboto" font-weight="700">
                                                <tspan x="0" y="0">Valve 
                                                    @if ($i == 1)
                                                    Open
                                                    @else
                                                    Close
                                                    @endif
                                                </tspan>
                                            </text>
                                            <path id="valve"
                                                d="M57.084,30.944H54.229v-1.6a.885.885,0,0,0-.951-.8H47.57a.885.885,0,0,0-.951.8v1.6H43.764V26.938a.885.885,0,0,0-.951-.8h-1.9v-1.6a.885.885,0,0,0-.951-.8H34.25V18.125a.885.885,0,0,0-.951-.8H31.4V11.716h.951v1.6a.885.885,0,0,0,.951.8h6.9c3.014,0,5.467-2.065,5.467-4.6V5.9c0-2.538-2.453-4.6-5.467-4.6h-5A6.179,6.179,0,0,0,31.4,2.581V1.3a.885.885,0,0,0-.951-.8H26.639a.885.885,0,0,0-.951.8v1.28A6.179,6.179,0,0,0,21.882,1.3h-5c-3.014,0-5.467,2.065-5.467,4.6V9.516c0,2.538,2.453,4.6,5.467,4.6h6.9a.885.885,0,0,0,.951-.8v-1.6h.951v5.608h-1.9a.885.885,0,0,0-.951.8v5.608H17.125a.885.885,0,0,0-.951.8v1.6h-1.9a.885.885,0,0,0-.951.8v4.006H10.465v-1.6a.885.885,0,0,0-.951-.8H3.806a.885.885,0,0,0-.951.8v1.6H0V45.365H2.854v1.6a.885.885,0,0,0,.951.8H9.514a.885.885,0,0,0,.951-.8v-1.6H46.618v1.6a.885.885,0,0,0,.951.8h5.708a.885.885,0,0,0,.951-.8v-1.6h2.854ZM29.493,2.1V3.583c-.032.007-.064.018-.1.025-.087.018-.173.034-.26.046a4.231,4.231,0,0,1-.579.049h-.031a4.231,4.231,0,0,1-.579-.049c-.087-.013-.173-.028-.26-.046-.033-.006-.065-.018-.1-.025V2.1Zm-1.9,9.614h1.9v5.608h-1.9ZM15.222,27.739H41.861v3.2H15.222ZM8.563,46.166H4.757V30.143H8.563Zm43.764,0H48.521V30.143h3.806V46.166Z"
                                                transform="translate(1567.79 785.061)" 
                                                @if ($i == 0)
                                                fill="#ff0202"
                                                @else
                                                fill="#01c620"
                                            @endif />
                                        </g>
                                    </a>
                                    <g id="JJM-logo" transform="translate(376 352.217)">
                                        <path id="Icon_ionic-md-water" data-name="Icon ionic-md-water"
                                            d="M58.894,29.179c-4.116-5.674-3.241-4.8-7.119-11.56A92.636,92.636,0,0,1,45.163,2.25a84.979,84.979,0,0,1-6.877,16.258c-4.188,7.135-6.607,10.671-6.607,10.671S19.981,41.413,17.21,53.021C15.4,60.6,15.394,68.337,22.383,77.1a27.506,27.506,0,0,0,7.509,6.3,27.409,27.409,0,0,0,15.271,4.132c8.641,0,16.506-3.5,23.077-10.431,5.094-5.368,6.806-12.044,5.939-20.63S63.01,34.853,58.894,29.179Z"
                                            transform="translate(-16.193 -2.25)" fill="#1495d2" />
                                        <g id="Group_1167" data-name="Group 1167" transform="translate(0 32.999)">
                                            <path id="Path_147" data-name="Path 147"
                                                d="M-17645.961-6091.241l11.865-.071v1.083h3.223v-1.012l6.658-.071,3.668,1.083a11.188,11.188,0,0,0,2.787.4,6.65,6.65,0,0,0,2.945-.4c1.879-.506,2.775-1.216,4.564-1.622a4.167,4.167,0,0,1,2.592,0,3.5,3.5,0,0,1,2.236,1.622,13.721,13.721,0,0,1,.482,3.869h8.846v-4.883a7.714,7.714,0,0,0-1.533-3.342,12.5,12.5,0,0,0-3.289-3.018,15.227,15.227,0,0,0-5.764-1.7c-1.068-.159-2.357.131-3.57-.537-.312-.17-.391-.765-1.369-.833.008-.277,0-1.062,0-1.062h.795v-4.091l-1.982-.094V-6107h-1.674v-2.846l.682-.417v-1.172a22.437,22.437,0,0,0,5.93.766c2.211-.213,2.68-1.244,2.857-1.957a2.231,2.231,0,0,0-1.127-2.335,4.937,4.937,0,0,0-2.836-.481l-5.965.706v-.49h-4.594v.49s-4.443-.379-6.545-.706-3.566,1.1-3.363,2.816,1.566,2.051,3.363,2.106a52.124,52.124,0,0,0,5.555-.915v1.172l.531.568v2.447h-1.719v.979h-1.6v4.5h.547v1.189h-.605v.788h-7.4v-.841H-17634v.841l-10.338-.055s-.572,1.783-1.029,3.97a36.737,36.737,0,0,0-.594,4.8"
                                                transform="translate(17645.961 6115.485)" fill="#fff" />
                                            <g id="Group_1166" data-name="Group 1166"
                                                transform="translate(41.277 29.393)">
                                                <rect id="Rectangle_1049" data-name="Rectangle 1049" width="1.347"
                                                    height="2.693" rx="0.673" fill="#fff" />
                                                <rect id="Rectangle_1050" data-name="Rectangle 1050" width="1.347"
                                                    height="7.182" rx="0.673" transform="translate(0 3.142)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1051" data-name="Rectangle 1051" width="1.347"
                                                    height="4.04" rx="0.673" transform="translate(1.795)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1052" data-name="Rectangle 1052" width="1.347"
                                                    height="8.977" rx="0.673" transform="translate(1.795 5.835)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1053" data-name="Rectangle 1053" width="1.347"
                                                    height="6.284" rx="0.673" transform="translate(4.04)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1054" data-name="Rectangle 1054" width="1.347"
                                                    height="6.284" rx="0.673" transform="translate(7.631 4.937)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1055" data-name="Rectangle 1055" width="1.347"
                                                    height="4.04" transform="translate(5.835)" fill="#fff" />
                                                <rect id="Rectangle_1056" data-name="Rectangle 1056" width="1.347"
                                                    height="4.04" rx="0.673" transform="translate(7.631)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1057" data-name="Rectangle 1057" width="1.347"
                                                    height="4.04" rx="0.673" transform="translate(5.835)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1058" data-name="Rectangle 1058" width="1.347"
                                                    height="4.04" rx="0.673" transform="translate(5.835 4.937)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1059" data-name="Rectangle 1059" width="1.347"
                                                    height="4.04" rx="0.673" transform="translate(4.04 7.182)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1060" data-name="Rectangle 1060" width="1.347"
                                                    height="4.937" rx="0.673" transform="translate(0 12.119)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1061" data-name="Rectangle 1061" width="1.347"
                                                    height="6.284" rx="0.673" transform="translate(4.04 12.119)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1062" data-name="Rectangle 1062" width="1.347"
                                                    height="2.693" rx="0.673" transform="translate(5.835 10.324)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1063" data-name="Rectangle 1063" width="1.347"
                                                    height="2.693" rx="0.673" transform="translate(5.835 13.914)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1064" data-name="Rectangle 1064" width="1.347"
                                                    height="2.693" rx="0.673" transform="translate(7.631 12.568)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1065" data-name="Rectangle 1065" width="1.347"
                                                    height="3.142" rx="0.673" transform="translate(0 17.505)"
                                                    fill="#fff" />
                                                <rect id="Rectangle_1066" data-name="Rectangle 1066" width="1.347"
                                                    height="3.142" rx="0.673" transform="translate(2.244 16.159)"
                                                    fill="#fff" />
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    @else
                        <p>No response found.</p>
                    @endif
                </div>
            </x-card>
            </x-app-layout> 
            <div id="iotCharts" >
              <div  x-show="chartOpen">
                <livewire:schemes.iot-charts :deviceId="$deviceid" :type="$selectedType" wire:key="schemes-iot-charts-{{ $selectedType }}"/>
              </div>
            </div>
            {{-- Click Items --}}
            <x-section-centered class="mt-8">
                @if (!$isExpired)
                    <x-card no-padding overflow-hidden>
                        @if ($commands->isNotEmpty() || ($commands->isEmpty() && $search))
                            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                                {{-- <div class="md:col-span-5">
                          <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                              placeholder="Search Commands" />
                      </div> --}}
                                <div class="md:col-span-1">
                                    <x-button type="button" with-icon icon="add" x-data=""
                                        wire:target="$dispatch('show-modal','command-input-model')"
                                        x-on:click.prevent="$dispatch('show-modal','command-input-model')" x-cloak>Add
                                        New Command</x-button>
                                </div>
                            </div>
                        @endif
                        @if ($commands->isNotEmpty())
                            <div>
                                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                                    <thead>
                                        <tr>
                                            <x-table.thead>Description</x-table.thead>
                                            <x-table.thead>Type</x-table.thead>
                                            <x-table.thead>Action</x-table.thead>
                                            <x-table.thead>Removed</x-table.thead>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($commands as $command)
                                            <tr><x-table.tdata>{{ $command->description }}</x-table.tdata>
                                                <x-table.tdata>
                                                    {{ $command->type }}
                                                </x-table.tdata>
                                                <x-table.tdata>
                                                    <x-button wire:click="sendCommand('{{ $command->command }}')"
                                                        wire:target="sendCommand('{{ $command->command }}')"
                                                        with-spinner>
                                                        Send Command
                                                    </x-button>
                                                </x-table.tdata>
                                                <x-table.tdata>
                                                    <x-button tag="a" href="#"
                                                        x-data="" x-cloak
                                                        x-on:click="$wire.emitTo(
                        'schemes.iot-device-removed',
                        'showDeleteModal',
                        '{{ $command->id }}',
                        'Confirm Deletion',
                        'Are you sure you want to remove this Device Command from this IOT Device?',
                        '{{ $command->id }}'
                    )"
                                                        with-icon icon="trash" color="white"
                                                        class="text-red-600">Remove Device Command</x-button>
                                                </x-table.tdata>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </x-table.table>
                            </div>
                        @else
                            <x-card-empty variant="">
                                <p class="text-center text-slate-500 mb-3 text-sm">No Command Info found.</p>
                                {{-- <x-button wire:click="sendCommandManual('valve')"
                                          wire:target="sendCommandManual('valve')" with-spinner>
                                          Turn  ff
                                      </x-button>  --}}
                                <x-button wire:target="$dispatch('show-modal','command-input-model')" type="button"
                                    with-icon icon="add" x-data=""
                                    x-on:click.prevent="$dispatch('show-modal','command-input-model')" x-cloak>Add New
                                    Command</x-button>
                            </x-card-empty>
                        @endif
                    </x-card>
                    @if ($commands->hasPages())
                        <div class="mt-5">{{ $commands->links() }}</div>
                    @endif
                @else
                    <x-card overflow-hidden class="flex justify-center justify-items-center w-full">
                        <x-button type="button" with-icon icon="refresh" x-data=""
                            wire:click="restartapi()" x-cloak>Continue To Refresh</x-button>
                    </x-card>
                @endif
                <div class="mt-8">
                    <x-card no-padding overflow-hidden>
                        <div class="text-sm">
                            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                                <thead>
                                    <tr>
                                        <x-table.thead>Title</x-table.thead>
                                        <x-table.thead>Action</x-table.thead>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- $response['activity']['delivery_valve'] --}}
                                    <tr>
                                        <x-table.tdata>Submersible Pump</x-table.tdata>
                                        <x-table.tdata>
                                            <x-button wire:click="sendCommandManual('motor')"
                                                wire:target="sendCommandManual('motor')" with-spinner>
                                                Turn
                                                {{ Str::lower($ad) == '1' ? 'OFF' : 'ON' }}
                                            </x-button>
                                        </x-table.tdata>
                                    </tr>
                                    <tr>
                                        <x-table.tdata>Surface Pump</x-table.tdata>
                                        {{-- motor 1 surface pump --}}
                                        <x-table.tdata>
                                            <x-button wire:click="sendCommandManual('motor1')"
                                                wire:target="sendCommandManual('motor1')" with-spinner>
                                                Turn
                                                {{ Str::lower($z) == '1' ? 'OFF' : 'ON' }}
                                            </x-button>
                                        </x-table.tdata>
                                    </tr>
                                    <tr>
                                        <x-table.tdata>Delivery Valve</x-table.tdata>
                                        <x-table.tdata>
                                            <x-button wire:click="sendCommandManual('valve')"
                                                wire:target="sendCommandManual('valve')" with-spinner>
                                                Turn
                                                {{ Str::lower($i) == '1' ? 'OFF' : 'ON' }}
                                            </x-button>
                                        </x-table.tdata>
                                    </tr>
                                </tbody>
                            </x-table.table>
                        </div>
                    </x-card>
                </div>
            </x-section-centered>
    </div>
    <div x-data="{ open: @entangle('isExpired').defer }" @show-dialog.window="open = true" @keydown.escape.window="open = false" x-cloak>
        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-lg flex flex-col items-center w-full max-w-md mx-4">
                <h2 class="mb-8 text-center">The IOT device session ends after 1 minutes.</h2>
                <x-button @click="open = false" type="button" with-icon icon="refresh"
                    wire:click="restartapi()" x-cloak>
                    Continue To Refresh
                </x-button>
            </div>
        </div>
    </div> 
    {{-- <x-button type="button" with-icon icon="refresh" wire:click.="viewSelectedType('electrical_parameters')">
        Click To Show in buttom
    </x-button>
    <x-button type="button" with-icon icon="refresh" wire:click.="viewSelectedType('valve_operation')">
        Click To Show in buttom 2
    </x-button> --}} 
    <livewire:schemes.iot-device-removed id="removedID" />
    <x-modal-simple name="command-input-model" form-action="save">
        <x-slot name="title">IOT Device Command</x-slot>
        <x-input label="Command" name="command" wire:model.defer="command" />
        <x-input label="Command Type (ON/OFF)" name="commandtype" wire:model.defer="commandtype" />
        <x-input label="Description" name="description" wire:model.defer="description" />
        <x-slot name="footer" class="text-right">
            <x-button wire:target="save">Save</x-button>
        </x-slot>
    </x-modal-simple>
    @push('styles')
        <style>
            .ani {
                animation: move 2s linear;
            }

            @keyframes move {
                from {
                    width: 0%;
                }

                to {
                    width: calc({{ (102 * ($e ?? 0)) / 100 }})%;
                }
            }
        @keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .blinking {
            animation: blink 1.5s infinite; 
        }
        </style>
    @endpush
</div>
