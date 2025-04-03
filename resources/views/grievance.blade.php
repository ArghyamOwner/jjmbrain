<x-guest-layout title="Grievance">
    <div class="bg-slate-50 min-h-screen">
        <x-section-centered class="pt-2 pb-12">
            <!-- Logo -->
            <a href="#" aria-label="Home" class="flex items-center shrink-0">
                <img class="h-16 md:h-20 object-contain ml-3" src="img/jjm-logo.png" alt="jjm-Logo" loading="lazy">
                <div class="font-bold md:text-3xl text-sky-500">
                    Jal Jeevan Mission
                </div>
            </a>
            <!-- ./Logo -->

            <!-- Hero -->
            <div class="hidden md:block relative bg-cover bg-no-repeat bg-top select-none h-80 mt-2"
                style="height:500px; background-image: url('img/grievance-banner-1.png')">
            </div>
            <!-- ./Hero -->
`   
            <!-- About -->
            <div class="px-4 sm:px-6 py-12 md:py-16">
                <h2 class="text-3xl mb-3 tracking-tight font-semibold text-gray-900">
                    About Jal Jeevan Mission
                </h2>
                <div class="w-full lg:max-w-5xl mx-auto">
                    <p class="text-gray-600 mt-2">Jal Jeevan Mission is to assist, empower and facilitate:
                        States/ UTs in planning of participatory rural water supply strategy for ensuring potable
                        drinking
                        water security on long-term basis to every rural household and public institution, viz. GP
                        building,
                        School, Anganwadi centre, Health centre, wellness centres, etc.
                        States/ UTs for creation of water supply infrastructure so that every rural household has
                        Functional
                        Tap Connection (FHTC) by 2024 and water in adequate quantity of prescribed quality is made
                        available
                        on regular basis.
                        States/ UTs to plan for their drinking water security
                        GPs/ rural communities to plan, implement, manage, own, operate and maintain their own
                        in-village
                        water supply systems
                        States/ UTs to develop robust institutions having focus on service delivery and financial
                        sustainability of the sector by promoting utility approach
                        Capacity building of the stakeholders and create awareness in community on significance of water
                        for
                        improvement in quality of life
                        In making provision and mobilization of financial assistance to States/ UTs for implementation
                        of
                        the mission.
                    </p>
                </div>
            </div>
            <!-- ./About -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-8">
                <x-button tag="a" color="blue" class="h-12" href="{{ route('grievance.apply') }}">Submit Grievance</x-button>

                <x-button tag="a" color="cyan" href="{{ route('publicGrievance.status') }}">Track Status</x-button>

                <x-button tag="a" href="tel:+917099098444" color="indigo">Contact us</x-button>
            </div>
        </x-section-centered>
    </div>
</x-guest-layout>
