<x-guest-layout title="Grievance Reference Number">
    <div class="bg-cover bg-no-repeat min-h-screen pb-10"
        style="background-image: url('{{ url('img/background-grievance.svg') }}')">

        <x-section-centered class="pt-2 pb-12">

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


                {{-- <x-card class="mt-8">
                    <div class="px-4 sm:px-6 py-12 md:py-16">
                        <h2 class="text-3xl mb-3 tracking-tight font-semibold text-gray-900 text-center">
                            Reference Number: {{ $ref }}
                        </h2>
                        <span></span>
                    </div>
                </x-card> --}}

                <x-section-container-styled heading="Ticket No: {{ $ref }}">
                    <div class="text-white font-medium text-medium text-justify">
                        Dear Citizen, your grievance in the PGRS portal has been registered successfully with reference
                        no <span class="underline font-bold">{{ $ref  }}</span>  and shall be resolved within << XX days>>. Please click the link below to
                            track the status of
                            your application <<https: //jjmbrain.in/xxx/trackstatus>>
                    </div>
                </x-section-container-styled>

            </div>
        </x-section-centered>
    </div>
</x-guest-layout>
