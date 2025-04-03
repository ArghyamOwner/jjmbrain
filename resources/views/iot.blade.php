<x-app-layout title="IOT Home">
	<x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
				IOT
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
		
		<x-card>
			<x-slot:header class="border-b">
				<div class="flex space-x-2 items-center">
					<div>Device Status:</div>
					<div>
						<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="{{ $response['system_data']['device active status'] == 1 ? '#18e028' : '#ff0000' }}" viewBox="0 0 256 256"><path d="M176,232a8,8,0,0,1-8,8H88a8,8,0,0,1,0-16h80A8,8,0,0,1,176,232Zm40-128a87.55,87.55,0,0,1-33.64,69.21A16.24,16.24,0,0,0,176,186v6a16,16,0,0,1-16,16H96a16,16,0,0,1-16-16v-6a16,16,0,0,0-6.23-12.66A87.59,87.59,0,0,1,40,104.49C39.74,56.83,78.26,17.14,125.88,16A88,88,0,0,1,216,104Zm-32.11-9.34a57.6,57.6,0,0,0-46.56-46.55,8,8,0,0,0-2.66,15.78c16.57,2.79,30.63,16.85,33.44,33.45A8,8,0,0,0,176,104a9,9,0,0,0,1.35-.11A8,8,0,0,0,183.89,94.66Z"></path></svg>
					</div>
				</div>
			</x-slot>

		@if ($response)
			<svg class="max-w-full h-[600px]" xmlns="http://www.w3.org/2000/svg" width="4104.356" height="2125.751" viewBox="0 0 4104.356 2125.751">
				<g id="Group_1499" data-name="Group 1499" transform="translate(-169 -66.749)">
				<g id="Group_1497" data-name="Group 1497" transform="translate(61 -19)">
					<g id="Group_1498" data-name="Group 1498">
					<path id="Path_480" data-name="Path 480" d="M-1779.22-140V20.445h-372.765V471.4" transform="translate(4051.769 792.446)" fill="none" stroke="#140101" stroke-width="15"/>
					<path id="Path_482" data-name="Path 482" d="M-1779.22-140V20.445h-372.765V471.4" transform="translate(4487.69 794.342)" fill="none" stroke="#f03131" stroke-width="15"/>
					<path id="Path_467" data-name="Path 467" d="M-2672.962-224.508h586.936" transform="translate(3500.284 514.689)" fill="none" stroke="#ce1d1d" stroke-width="20"/>
					<path id="Path_468" data-name="Path 468" d="M-2672.962-224.508h586.936" transform="translate(3500.982 698.076)" fill="none" stroke="#0ad4f8" stroke-width="20"/>
					<path id="Path_469" data-name="Path 469" d="M-2672.962-224.508h586.936" transform="translate(3500.982 606.383)" fill="none" stroke="#f0d508" stroke-width="20"/>
					<g id="Rectangle_1407" data-name="Rectangle 1407" transform="translate(1493.927 153.392)" fill="#fff" stroke="#707070" stroke-width="5" opacity="0.2">
						<rect width="296.125" height="120.254" stroke="none"/>
						<rect x="2.5" y="2.5" width="291.125" height="115.254" fill="none"/>
					</g>
					<g id="Rectangle_1408" data-name="Rectangle 1408" transform="translate(1493.927 308.219)" fill="#fff" stroke="#707070" stroke-width="5" opacity="0.2">
						<rect width="296.125" height="120.254" stroke="none"/>
						<rect x="2.5" y="2.5" width="291.125" height="115.254" fill="none"/>
					</g>
					<g id="Rectangle_1409" data-name="Rectangle 1409" transform="translate(1493.927 463.046)" fill="#fff" stroke="#707070" stroke-width="5" opacity="0.2">
						<rect width="296.125" height="120.254" stroke="none"/>
						<rect x="2.5" y="2.5" width="291.125" height="115.254" fill="none"/>
					</g>
			
					<!--ELECTRICITY VOLTAGE --> 
					<text id="_76_v_" data-name="76 v " transform="translate(1545.035 548.581)" fill="#0b0f12" font-size="58" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">{{ $response['power_data']['y phase voltage'] }} V</tspan></text>
					<text id="_75_v_" data-name="75 v " transform="translate(1545.035 238.392)" fill="#0b0f12" font-size="58" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">{{ $response['power_data']['b phase voltage '] }} V</tspan></text>
					<text id="_77_v_" data-name="77 v " transform="translate(1545.035 393.754)" fill="#0b0f12" font-size="58" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">{{ $response['power_data']['r phase voltage'] }} V</tspan></text>
					<!--END ELECTRICITY VOLTAGE --> 
			
					<g id="Rectangle_1410" data-name="Rectangle 1410" transform="translate(2116.241 85.749)" fill="#fff" stroke="#707070" stroke-width="10">
						<rect width="778.644" height="566.697" stroke="none"/>
						<rect x="5" y="5" width="768.644" height="556.697" fill="none"/>
					</g>
					<path id="Path_470" data-name="Path 470" d="M-2672.962-224.508h214.309" transform="translate(4520.887 498.906)" fill="none" stroke="#ce1d1d" stroke-width="20"/>
					<path id="Path_471" data-name="Path 471" d="M-2672.962-224.508h214.309" transform="translate(4520.887 698.076)" fill="none" stroke="#0ad4f8" stroke-width="20"/>
					<path id="Path_472" data-name="Path 472" d="M-2672.962-224.508h214.309" transform="translate(4520.887 606.383)" fill="none" stroke="#f8c331" stroke-width="20"/>
					<text id="Control_Panal_" data-name="Control Panal " transform="translate(2307.145 556.097)" fill="#0b0f12" font-size="66" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">Control Panel </tspan></text>
					<text id="_" data-name="`" transform="translate(2720.518 882.789)" fill="#0b0f12" font-size="65" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">`</tspan></text>
					<path id="Path_473" data-name="Path 473" d="M-2672.962-224.508h595.745V164.907h276.258" transform="translate(5613.695 592.854)" fill="none" stroke="#010d10" stroke-width="20"/>
					<path id="Path_474" data-name="Path 474" d="M-626.642,65.857h284.395V586.082H-666.706V800.946" transform="translate(4542.104 644.998)" fill="none" stroke="#0394ff" stroke-width="25"/>
					<g id="Rectangle_1411" data-name="Rectangle 1411" transform="translate(3103.827 1446.122)" fill="#fff" stroke="#707070" stroke-width="10">
						<rect width="940.987" height="614.798" stroke="none"/>
						<rect x="5" y="5" width="930.987" height="604.798" fill="none"/>
					</g>
					
					<text id="Treatment_Plant_" data-name="Treatment Plant" transform="translate(3276.692 1991.1)" fill="#0b0f12" font-size="78" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">Treatment Plant </tspan></text>
					
					<!--TREARMENT PLANT  COLOUR GRREN AND RED #18e028--> 
					<g id="Treatment_Plant_data" data-name="Rectangle 1412" transform="translate(3200.03 1494.224)" fill="{{ $response['system_data']['backwash indication status'] == 1 ? '#ff0000' : '#18e028' }}" stroke="#10fd75" stroke-width="1">
						<rect width="750.084" height="150.317" stroke="none"/>
						<rect x="0.5" y="0.5" width="749.084" height="149.317" fill="none"/>
					</g>
					<!--TREARMENT PLANT END-->  
			
					<g id="Rectangle_1413" data-name="Rectangle 1413" transform="translate(1847.173 1446.122)" fill="#fff" stroke="#707070" stroke-width="10">
						<rect width="828.249" height="631.333" stroke="none"/>
						<rect x="5" y="5" width="818.249" height="621.333" fill="none"/>
					</g>
					<path id="Path_475" data-name="Path 475" d="M-1034,954.534h-178.882V630.3h-257.287" transform="translate(4137.823 929.012)" fill="none" stroke="#0394fb" stroke-width="20"/>
			
					<!--UGR STATUS HIGHT FILL COLOR BLUE #18c0fd --> 
						@if ($response['system_data']['ugr tank status'] == 4)
							<g id="UGR_full" data-name="Rectangle 1417" transform="translate(1920.829 1482.198)" fill="#ffffff" stroke="#707070" stroke-width="5">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="2.5" y="2.5" width="675.938" height="100.222" fill="none"/>
							</g>
							<g id="UGR_high" data-name="Rectangle 1415" transform="translate(1920.829 1606.962)" fill="#ffffff" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
							<g id="UGR_meduim" data-name="Rectangle 1416" transform="translate(1920.829 1731.725)" fill="#ffffff" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
							<g id="UGR_low" data-name="Rectangle 1414" transform="translate(1920.829 1856.489)" fill="#ffffff" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
						@endif

						@if ($response['system_data']['ugr tank status'] == 3)
							<g id="UGR_full" data-name="Rectangle 1417" transform="translate(1920.829 1482.198)" fill="#ffffff" stroke="#707070" stroke-width="5">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="2.5" y="2.5" width="675.938" height="100.222" fill="none"/>
							</g>
							<g id="UGR_high" data-name="Rectangle 1415" transform="translate(1920.829 1606.962)" fill="#18c0fd" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
							
							<g id="UGR_meduim" data-name="Rectangle 1416" transform="translate(1920.829 1731.725)" fill="#18c0fd" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
							<g id="UGR_low" data-name="Rectangle 1414" transform="translate(1920.829 1856.489)" fill="#18c0fd" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
						@endif

						@if ($response['system_data']['ugr tank status'] == 2)
							<g id="UGR_full" data-name="Rectangle 1417" transform="translate(1920.829 1482.198)" fill="#ffffff" stroke="#707070" stroke-width="5">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="2.5" y="2.5" width="675.938" height="100.222" fill="none"/>
							</g>
							<g id="UGR_high" data-name="Rectangle 1415" transform="translate(1920.829 1606.962)" fill="#ffffff" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
							
							<g id="UGR_meduim" data-name="Rectangle 1416" transform="translate(1920.829 1731.725)" fill="#18c0fd" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
							<g id="UGR_low" data-name="Rectangle 1414" transform="translate(1920.829 1856.489)" fill="#18c0fd" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
						@endif

						@if ($response['system_data']['ugr tank status'] == 1)
							<g id="UGR_full" data-name="Rectangle 1417" transform="translate(1920.829 1482.198)" fill="#18c0fd" stroke="#707070" stroke-width="5">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="2.5" y="2.5" width="675.938" height="100.222" fill="none"/>
							</g>
							<g id="UGR_high" data-name="Rectangle 1415" transform="translate(1920.829 1606.962)" fill="#18c0fd" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
							
							<g id="UGR_meduim" data-name="Rectangle 1416" transform="translate(1920.829 1731.725)" fill="#18c0fd" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
							<g id="UGR_low" data-name="Rectangle 1414" transform="translate(1920.829 1856.489)" fill="#18c0fd" stroke="#707070" stroke-width="1">
								<rect width="680.938" height="105.222" stroke="none"/>
								<rect x="0.5" y="0.5" width="679.938" height="104.222" fill="none"/>
							</g>
						@endif


					<!--UGR STATUS HIGH END --> 
			
			
			
					<text id="UGR_" data-name="UGR " transform="translate(2173.362 2043.711)" fill="#0b0f12" font-size="78" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">UGR </tspan></text>
					<path id="Path_490" data-name="Path 490" d="M0,234.429V42.032H-760.33" transform="translate(2071.898 932.788)" fill="none" stroke="#0394fb" stroke-width="20"/>
					<g id="Rectangle_1418" data-name="Rectangle 1418" transform="translate(812.989 787.731)" fill="#fff" stroke="#707070" stroke-width="5">
						<rect width="494.544" height="508.073" stroke="none"/>
						<rect x="2.5" y="2.5" width="489.544" height="503.073" fill="none"/>
					</g>
					<path id="Path_477" data-name="Path 477" d="M-2694,473.381v895.478l463.943-895.478v895.478Z" transform="translate(3522.021 835.141)" fill="none" stroke="#a57373" stroke-linejoin="round" stroke-width="15"/>
					<path id="Path_478" data-name="Path 478" d="M-2454.794,470.3-2695.1,754.045h463.553Z" transform="translate(3521.467 848.501)" fill="none" stroke="#a57373" stroke-linejoin="round" stroke-width="15"/>
					
			
					<!--ESR WATER VALUE  FILL COLOUR BLUE --> 
						@if ($response['system_data']['esr tank status'] == 1)
						<g id="ESR_LOW" data-name="Rectangle 1419" transform="translate(840.046 1160.519)" fill="#18c0fd" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_med" data-name="Rectangle 1420" transform="translate(840.046 1041.768)" fill="#18c0fd" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_high" data-name="Rectangle 1421" transform="translate(840.046 923.017)" fill="#18c0fd" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_full" data-name="Rectangle 1422" transform="translate(840.046 804.267)" fill="#18c0fd" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						@endif

						@if ($response['system_data']['esr tank status'] == 2)
						<g id="ESR_LOW" data-name="Rectangle 1419" transform="translate(840.046 1160.519)" fill="#ffffff" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_med" data-name="Rectangle 1420" transform="translate(840.046 1041.768)" fill="#ffffff" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_high" data-name="Rectangle 1421" transform="translate(840.046 923.017)" fill="#18c0fd" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_full" data-name="Rectangle 1422" transform="translate(840.046 804.267)" fill="#18c0fd" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						@endif

						@if ($response['system_data']['esr tank status'] == 3)
						<g id="ESR_LOW" data-name="Rectangle 1419" transform="translate(840.046 1160.519)" fill="#ffffff" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_med" data-name="Rectangle 1420" transform="translate(840.046 1041.768)" fill="#18c0fd" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_high" data-name="Rectangle 1421" transform="translate(840.046 923.017)" fill="#18c0fd" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_full" data-name="Rectangle 1422" transform="translate(840.046 804.267)" fill="#18c0fd" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						@endif

						@if ($response['system_data']['esr tank status'] == 4)
						<g id="ESR_LOW" data-name="Rectangle 1419" transform="translate(840.046 1160.519)" fill="#ffffff" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_med" data-name="Rectangle 1420" transform="translate(840.046 1041.768)" fill="#ffffff" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_high" data-name="Rectangle 1421" transform="translate(840.046 923.017)" fill="#ffffff" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						<g id="ESR_full" data-name="Rectangle 1422" transform="translate(840.046 804.267)" fill="#ffffff" stroke="#707070" stroke-width="1">
							<rect width="440.43" height="105.222" stroke="none"/>
							<rect x="0.5" y="0.5" width="439.43" height="104.222" fill="none"/>
						</g>
						@endif
						
						<!-- END ESR WATER VALUE -->
			
					<path id="Path_479" data-name="Path 479" d="M-2471.248,400h-321.159v858.782h-374.16" transform="translate(3284.238 813.13)" fill="none" stroke="#0394fb" stroke-width="15"/>
					<g id="Rectangle_1424" data-name="Rectangle 1424" transform="translate(1711.887 1041.768)" fill="#fff" stroke="#707070" stroke-width="3">
						<rect width="312.66" height="136.789" stroke="none"/>
						<rect x="1.5" y="1.5" width="309.66" height="133.789" fill="none"/>
					</g>
			
					<!-- MOTOR 1 SUPPLY TODAY  -->
					<text id="_19:00_min" data-name="19:00 min" transform="translate(1748.422 1150.424)" fill="#18d811" font-size="64" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">{{ $response['surfacePumpToday_runTime'][0]['elapsed_time'] ?? '00:00:00' }}</tspan></text>
					<!-- END MOTOR 1 SUPPLY TODAY -->
			
					
			
			
					<g id="Rectangle_1425" data-name="Rectangle 1425" transform="translate(2122.254 1041.768)" fill="#fff" stroke="#707070" stroke-width="3">
						<rect width="312.66" height="136.789" stroke="none"/>
						<rect x="1.5" y="1.5" width="309.66" height="133.789" fill="none"/>
					</g>
			
					<text id="Today_Run_" data-name="Today Run" transform="translate(2195.783 1085.787)" fill="#0b0f12" font-size="33" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">Today Run </tspan></text>
					<text id="Today_Run_2" data-name="Today Run " transform="translate(1778.422 1085.303)" fill="#0b0f12" font-size="33" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">Today Run </tspan></text>
			
			
			
			
			<!-- MOTOR 2 SUPPLY TODAY  -->
					<text id="_10:00_min" data-name="10:00 min" transform="translate(2227.54 1145.914)" fill="#18d811" font-size="64" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">N/A</tspan></text>
			<!-- MOTOR 2 SUPPLY TODAY  -->
			
			
			
			
					<g id="Rectangle_1426" data-name="Rectangle 1426" transform="translate(108 1883.546)" fill="#fff" stroke="#707070" stroke-width="3">
						<rect width="312.66" height="136.789" stroke="none"/>
						<rect x="1.5" y="1.5" width="309.66" height="133.789" fill="none"/>
					</g>
			
			
			
			
					<!-- WATER SUPPLIED AMOUNT TODAY -->
					<text id="_23575_L" data-name="23575 L" transform="translate(200.286 1992.202)" fill="#18d811" font-size="46" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">{{ $response['flow_data']['today water supply'] }} L</tspan></text>
					<!-- END WATER SUPPLIED AMOUNT TODAY -->
			
			
			
			
			
			
					<text id="Today_supplied_" data-name="Today supplied " transform="translate(150.286 1935.081)" fill="#0b0f12" font-size="33" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">Today Supplied</tspan></text>
					<g id="Rectangle_1427" data-name="Rectangle 1427" transform="translate(3718.625 463.046)" fill="#fff" stroke="#707070" stroke-width="3">
						<rect width="312.66" height="136.789" stroke="none"/>
						<rect x="1.5" y="1.5" width="309.66" height="133.789" fill="none"/>
					</g>
			
			
			
			
			
					<!-- MOTOR SUBMERSIBLE SUPPLY TODAY  -->
			
					<text id="_10:00_min-2" data-name="10:00 min" transform="translate(3784.645 567.192)" fill="#18d811" font-size="48" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">{{ $response['submersePumpToday_runTime'][0]['elapsed_time'] }}</tspan></text>
			
					<!--  END MOTOR SUBMERSIBLE SUPPLY TODAY -->
			
			
			
			
					<text id="Today_Run_3" data-name="Today Run " transform="translate(3784.645 514.581)" fill="#0b0f12" font-size="33" font-family="Roboto-Bold, Roboto" font-weight="700"><tspan x="0" y="0">Today Run </tspan></text>
			
				<!--  MOTOR OVERCURRENT -->
			
					<path id="Icon_awesome-exclamation-triangle" data-name="Icon awesome-exclamation-triangle" d="M140.385,105.519c4.55,7.672-1.161,17.263-10.249,17.263H11.845c-9.1,0-14.79-9.606-10.249-17.263L60.743,5.752a12.006,12.006,0,0,1,20.5,0ZM70.992,84.893A11.035,11.035,0,1,0,82.331,95.924,11.188,11.188,0,0,0,70.992,84.893ZM60.226,45.241l1.829,32.614a2.924,2.924,0,0,0,2.954,2.721H76.975a2.924,2.924,0,0,0,2.954-2.721l1.829-32.614A2.914,2.914,0,0,0,78.8,42.207H63.18a2.913,2.913,0,0,0-2.953,3.035Z" transform="translate(2551.302 1247.131)" fill="#ff0202"/>
			
				<!--  END MOTOR OVERCURRENT -->
			
			
				<!--  MOTOR DRY RUN  -->
			
					<path id="Icon_awesome-exclamation-circle" data-name="Icon awesome-exclamation-circle" d="M147.28,72.88c0,39.949-32.847,72.318-73.359,72.318S.563,112.829.563,72.88C.563,32.955,33.409.563,73.921.563S147.28,32.955,147.28,72.88ZM73.921,87.461a13.415,13.415,0,1,0,13.607,13.414A13.511,13.511,0,0,0,73.921,87.461ZM61,39.245,63.2,78.9a3.528,3.528,0,0,0,3.544,3.309H81.1A3.528,3.528,0,0,0,84.646,78.9L86.84,39.245a3.522,3.522,0,0,0-3.544-3.69H64.547A3.521,3.521,0,0,0,61,39.245Z" transform="translate(2731.229 1235.642)" fill="#f8dd0b"/>
				<!--  END MOTOR DRY RUN -->
			
				
				<!--ELECTRICITY --> 
			
					<g id="Electicity" data-name="Rectangle 1428" transform="translate(2174.865 157.901)" fill="{{ $response['system_data']['grid supply indicator'] == 1 ? '#18e028' : '#ff0000' }}" stroke="#10fd75" stroke-width="1">
						<rect width="662.9" height="150.317" stroke="none"/>
						<rect x="0.5" y="0.5" width="661.9" height="149.317" fill="none"/>
					</g>
			
				<!--END ELECTRICITY  --> 
			
			
					<g id="Group_1492" data-name="Group 1492" transform="translate(7 0.749)">
						<g id="Group_1491" data-name="Group 1491">
			
						<g id="transformer" data-name="Group 1490">
							<g id="Rectangle_1429" data-name="Rectangle 1429" transform="translate(289 463)" fill="none" stroke="#120101" stroke-linejoin="round" stroke-width="15">
							<rect width="452" height="47" stroke="none"/>
							<rect x="7.5" y="7.5" width="437" height="32" fill="none"/>
							</g>
							<g id="Rectangle_1430" data-name="Rectangle 1430" transform="translate(314 270)" fill="none" stroke="#120101" stroke-width="15">
							<rect width="401" height="197" stroke="none"/>
							<rect x="7.5" y="7.5" width="386" height="182" fill="none"/>
							</g>
							<g id="Rectangle_1431" data-name="Rectangle 1431" transform="translate(289 223)" fill="none" stroke="#120101" stroke-linejoin="round" stroke-width="15">
							<rect width="452" height="47" stroke="none"/>
							<rect x="7.5" y="7.5" width="437" height="32" fill="none"/>
							</g>
							<g id="Polygon_1" data-name="Polygon 1" transform="translate(433 301)" fill="#fff" stroke-linejoin="bevel">
							<path d="M 145.4615020751953 128.5 L 19.53849983215332 128.5 C 17.75821113586426 128.5 16.86350059509277 127.382926940918 16.48860549926758 126.7170562744141 C 16.11373710632324 126.0511856079102 15.62268447875977 124.7068176269531 16.5460262298584 123.1847152709961 L 79.50752258300781 19.39363479614258 C 80.39673614501953 17.92776679992676 81.76407623291016 17.70889854431152 82.5 17.70889854431152 C 83.23589324951172 17.70889854431152 84.60323333740234 17.92776679992676 85.49244689941406 19.39363479614258 L 148.4539794921875 123.1847152709961 C 149.3773193359375 124.7068176269531 148.8862609863281 126.0511856079102 148.5113983154297 126.7170562744141 C 148.1365051269531 127.382926940918 147.2417907714844 128.5 145.4615020751953 128.5 Z" stroke="none"/>
							<path d="M 82.5 28.92121124267578 L 26.64337158203125 121.0000152587891 L 138.3566284179688 121.0000152587891 L 82.5 28.92121124267578 M 82.5 10.20889282226562 C 86.13177490234375 10.20889282226562 89.7635498046875 11.97384643554688 91.90485382080078 15.50376892089844 L 154.8663635253906 119.2948303222656 C 159.3133239746094 126.6255798339844 154.0356140136719 136.0000152587891 145.4615020751953 136.0000152587891 L 19.53846740722656 136.0000152587891 C 10.96438598632812 136.0000152587891 5.686676025390625 126.6255798339844 10.13363647460938 119.2948303222656 L 73.09514617919922 15.50376892089844 C 75.2364501953125 11.97384643554688 78.86822509765625 10.20889282226562 82.5 10.20889282226562 Z" stroke="none" fill="#0d0101"/>
							</g>
							<g id="Rectangle_1432" data-name="Rectangle 1432" transform="translate(614 104)" fill="#fff" stroke="#120101" stroke-width="10">
							<rect width="56" height="129" stroke="none"/>
							<rect x="5" y="5" width="46" height="119" fill="none"/>
							</g>
							<g id="Rectangle_1433" data-name="Rectangle 1433" transform="translate(364 104)" fill="#fff" stroke="#120101" stroke-width="10">
							<rect width="56" height="129" stroke="none"/>
							<rect x="5" y="5" width="46" height="119" fill="none"/>
							</g>
							<g id="Rectangle_1434" data-name="Rectangle 1434" transform="translate(487 104)" fill="#fff" stroke="#120101" stroke-width="10">
							<rect width="56" height="129" stroke="none"/>
							<rect x="5" y="5" width="46" height="119" fill="none"/>
							</g>
							<path id="Path_483" data-name="Path 483" d="M-3568.014,1775.072l-19,31.059,24.6-3.637-18.219,32.039" transform="translate(4084 -1419)" fill="none" stroke="#08f6ff" stroke-width="10"/>
						</g>
			
						</g>
					</g>
			
					<g id="Motor_1" data-name="Group 1493" transform="translate(3819 -2499)">
						<g id="Rectangle_1435" data-name="Rectangle 1435" transform="translate(-1981 3761)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="147" height="133" rx="25" stroke="none"/>
						<rect x="5" y="5" width="137" height="123" rx="20" fill="none"/>
						</g>
						<line id="Line_331" data-name="Line 331" x1="1.724" y2="121.525" transform="translate(-1953.635 3766.641)" fill="none" stroke="#170202" stroke-width="10"/>
						<line id="Line_332" data-name="Line 332" x2="112.045" y2="0.431" transform="translate(-1951.911 3785.172)" fill="none" stroke="#170202" stroke-width="10"/>
						<line id="Line_333" data-name="Line 333" x2="112.045" y2="0.431" transform="translate(-1951.911 3804.133)" fill="none" stroke="#170202" stroke-width="10"/>
						<line id="Line_334" data-name="Line 334" x2="112.045" y2="0.431" transform="translate(-1952.652 3823.094)" fill="none" stroke="#170202" stroke-width="10"/>
						<line id="Line_335" data-name="Line 335" x2="112.045" y2="0.431" transform="translate(-1951.911 3845.503)" fill="none" stroke="#170202" stroke-width="10"/>
						<line id="Line_336" data-name="Line 336" x2="112.045" y2="0.431" transform="translate(-1951.911 3867.912)" fill="none" stroke="#170202" stroke-width="10"/>
						<g id="Rectangle_1436" data-name="Rectangle 1436" transform="translate(-1792 3734)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="75" height="180" rx="14" stroke="none"/>
						<rect x="5" y="5" width="65" height="170" rx="9" fill="none"/>
						</g>
						<g id="Rectangle_1437" data-name="Rectangle 1437" transform="translate(-1840 3786)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="34" height="83" rx="17" stroke="none"/>
						<rect x="5" y="5" width="24" height="73" rx="12" fill="none"/>
						</g>
						<g id="Rectangle_1439" data-name="Rectangle 1439" transform="translate(-1782 3908)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="52" height="40" rx="16" stroke="none"/>
						<rect x="5" y="5" width="42" height="30" rx="11" fill="none"/>
						</g>
						<g id="Rectangle_1443" data-name="Rectangle 1443" transform="translate(-1792 3663)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="75" height="39" rx="16" stroke="none"/>
						<rect x="5" y="5" width="65" height="29" rx="11" fill="none"/>
						</g>
						<g id="Rectangle_1442" data-name="Rectangle 1442" transform="translate(-1782 3699)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="52" height="38" rx="16" stroke="none"/>
						<rect x="5" y="5" width="42" height="28" rx="11" fill="none"/>
						</g>
						<g id="Rectangle_1444" data-name="Rectangle 1444" transform="translate(-1813 3753)" fill="none" stroke="#170202" stroke-width="7">
						<rect width="26" height="150" rx="13" stroke="none"/>
						<rect x="3.5" y="3.5" width="19" height="143" rx="9.5" fill="none"/>
						</g>
					</g>
			
					<g id="Group_1495" data-name="Group 1495" transform="translate(-30.355 662.84)">
						<g id="Rectangle_1445" data-name="Rectangle 1445" transform="translate(3719 125)" fill="#c76223" stroke="#c76223" stroke-width="10">
						<rect width="172" height="108" stroke="none"/>
						<rect x="5" y="5" width="162" height="98" fill="none"/>
						</g>
						<path id="Path_484" data-name="Path 484" d="M-359.73,1703.006s35.665-37.851,74.307-34.276,40.007,41.9,83.634,44.2,54.7-38.463,97.446-38.463,52.714,40.762,87.189,38.463,56.065-38.463,56.065-38.463" transform="translate(4084 -1419)" fill="none" stroke="#17ecfd" stroke-width="15"/>
						<path id="Path_485" data-name="Path 485" d="M-359.73,1703.006s35.665-37.851,74.307-34.276,40.007,41.9,83.634,44.2,54.7-38.463,97.446-38.463,52.714,40.762,87.189,38.463,56.065-38.463,56.065-38.463" transform="translate(4084 -1385)" fill="none" stroke="#707070" stroke-width="1"/>
						<path id="Path_486" data-name="Path 486" d="M-359.73,1703.006s35.665-37.851,74.307-34.276,40.007,41.9,83.634,44.2,54.7-38.463,97.446-38.463,52.714,40.762,87.189,38.463,56.065-38.463,56.065-38.463" transform="translate(4084 -1385)" fill="none" stroke="#17ecfd" stroke-width="15"/>
						<path id="Path_487" data-name="Path 487" d="M-359.73,1703.006s35.665-37.851,74.307-34.276,40.007,41.9,83.634,44.2,54.7-38.463,97.446-38.463,52.714,40.762,87.189,38.463,56.065-38.463,56.065-38.463" transform="translate(4084 -1353.289)" fill="none" stroke="#707070" stroke-width="1"/>
						<path id="Path_488" data-name="Path 488" d="M-359.73,1703.006s35.665-37.851,74.307-34.276,40.007,41.9,83.634,44.2,54.7-38.463,97.446-38.463,52.714,40.762,87.189,38.463,56.065-38.463,56.065-38.463" transform="translate(4084 -1353.289)" fill="none" stroke="#17ecfd" stroke-width="15"/>
						<g id="Path_489" data-name="Path 489" transform="translate(3906.832 0.331)" fill="#fff">
						<path d="M 27.1180477142334 332.1382446289062 L 5.00711727142334 332.1382446289062 L 5.495920658111572 -10.96996307373047 L 27.60685157775879 -10.96996307373047 L 27.1180477142334 332.1382446289062 Z" stroke="none"/>
						<path d="M 10.48875999450684 -5.969970703125 L 10.01424980163574 327.1382446289062 L 22.12520980834961 327.1382446289062 L 22.5997200012207 -5.969970703125 L 10.48875999450684 -5.969970703125 M 0.5029830932617188 -15.969970703125 L 32.61398315429688 -15.969970703125 L 32.11098480224609 337.1382446289062 L -1.52587890625e-05 337.1382446289062 L 0.5029830932617188 -15.969970703125 Z" stroke="none" fill="#240303"/>
						</g>
						<g id="Rectangle_1446" data-name="Rectangle 1446" transform="translate(3951 125)" fill="#c76223" stroke="#c76223" stroke-width="10">
						<rect width="172" height="108" stroke="none"/>
						<rect x="5" y="5" width="162" height="98" fill="none"/>
						</g>
					</g>
					<g id="motor_2" data-name="Group 1496" transform="translate(4214 -2496)">
						<g id="Rectangle_1435-2" data-name="Rectangle 1435" transform="translate(-1981 3761)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="147" height="133" rx="25" stroke="none"/>
						<rect x="5" y="5" width="137" height="123" rx="20" fill="none"/>
						</g>
						<line id="Line_331-2" data-name="Line 331" x1="1.724" y2="121.525" transform="translate(-1953.635 3766.641)" fill="none" stroke="#170202" stroke-width="10"/>
						<line id="Line_332-2" data-name="Line 332" x2="112.045" y2="0.431" transform="translate(-1951.911 3785.172)" fill="none" stroke="#170202" stroke-width="10"/>
						<line id="Line_333-2" data-name="Line 333" x2="112.045" y2="0.431" transform="translate(-1951.911 3804.133)" fill="none" stroke="#170202" stroke-width="10"/>
						<line id="Line_334-2" data-name="Line 334" x2="112.045" y2="0.431" transform="translate(-1952.652 3823.094)" fill="none" stroke="#170202" stroke-width="10"/>
						<line id="Line_335-2" data-name="Line 335" x2="112.045" y2="0.431" transform="translate(-1951.911 3845.503)" fill="none" stroke="#170202" stroke-width="10"/>
						<line id="Line_336-2" data-name="Line 336" x2="112.045" y2="0.431" transform="translate(-1951.911 3867.912)" fill="none" stroke="#170202" stroke-width="10"/>
						<g id="Rectangle_1436-2" data-name="Rectangle 1436" transform="translate(-1792 3734)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="75" height="180" rx="14" stroke="none"/>
						<rect x="5" y="5" width="65" height="170" rx="9" fill="none"/>
						</g>
						<g id="Rectangle_1437-2" data-name="Rectangle 1437" transform="translate(-1840 3786)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="34" height="83" rx="17" stroke="none"/>
						<rect x="5" y="5" width="24" height="73" rx="12" fill="none"/>
						</g>
						<g id="Rectangle_1439-2" data-name="Rectangle 1439" transform="translate(-1782 3908)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="52" height="40" rx="16" stroke="none"/>
						<rect x="5" y="5" width="42" height="30" rx="11" fill="none"/>
						</g>
						<g id="Rectangle_1443-2" data-name="Rectangle 1443" transform="translate(-1792 3663)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="75" height="39" rx="16" stroke="none"/>
						<rect x="5" y="5" width="65" height="29" rx="11" fill="none"/>
						</g>
						<g id="Rectangle_1442-2" data-name="Rectangle 1442" transform="translate(-1782 3699)" fill="none" stroke="#170202" stroke-width="10">
						<rect width="52" height="38" rx="16" stroke="none"/>
						<rect x="5" y="5" width="42" height="28" rx="11" fill="none"/>
						</g>
						<g id="Rectangle_1444-2" data-name="Rectangle 1444" transform="translate(-1813 3753)" fill="none" stroke="#170202" stroke-width="7">
						<rect width="26" height="150" rx="13" stroke="none"/>
						<rect x="3.5" y="3.5" width="19" height="143" rx="9.5" fill="none"/>
						</g>
					</g>
					<path id="Path_476" data-name="Path 476" d="M-1388.275,521.04v-307.5h-324.939" transform="translate(3850.473 672.585)" fill="none" stroke="#0394fb" stroke-width="20"/>
					</g>
				</g>
				</g>
			</svg>

			@else
				<p>No response found.</p>
			@endif

		</x-card>

	</x-section-centered>
</x-app-layout>
  