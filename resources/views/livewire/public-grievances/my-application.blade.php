<div>
    <div class="bg-cover bg-no-repeat min-h-screen pb-10"
        style="background-image: url('{{ url('img/background-grievance.svg') }}')">

        <x-section-centered class="pt-6 pb-12">

            <div class="px-14">

                <div class="mb-4">
                    <!-- Logo -->
                    <a href="#" aria-label="Home" class="flex items-center shrink-0">
                        <img class="h-16 md:h-20 object-contain" src="{{ url('img/jjm-logo.png') }}" alt="jjm-Logo"
                            loading="lazy">
                        <div class="font-bold md:text-3xl text-sky-500">
                            Jal Jeevan Mission
                        </div>
                    </a>
                    <!-- ./Logo -->
                </div>

                <div class="text-right my-2">
                    <x-text-link href="{{ route('grievance.download', $grievance) }}" color="indigo" class="mt-1 font-bold" target="_blank"><x-icon-download
                        class="w-5 h-5 pr-1" />Download</x-text-link>
                </div>

                {{-- <x-card class="mt-8">
                    <div class="px-4 sm:px-6 py-12 md:py-16">
                        <h2 class="text-3xl mb-3 tracking-tight font-semibold text-gray-900 text-center">
                            Reference Number: {{ $ref }}
                        </h2>
                        <span></span>
                    </div>
                </x-card> --}}

                <x-section-container-styled heading="Ref No: {{ $ref }}">
                    <div class="text-white font-medium text-medium text-justify">
                        Dear {{ $citizen_name }}, your grievance in the PGRS portal has been registered successfully
                        with reference
                        no <span class="font-bold underline">{{ $ref }}</span> and shall be resolved within
                        {{ $resolvedDays }} days. Please click the link below to
                        track the status of
                        your application. <a href="{{ route('publicGrievance.status', ['ref_number' => $ref]) }}"
                            class="inline-block hover:underline">{{ $url }}</a>
                    </div>
                </x-section-container-styled>

            </div>
        </x-section-centered>
    </div>
</div>
