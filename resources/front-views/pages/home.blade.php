<x-front-layout title="Home">

    <div class="md:max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4">
        <!-- Carousel -->
        <div class="swiper-container w-full rounded-lg overflow-hidden shadow" x-ref="swiperContainer" x-data="{
                swiper: null
            }" x-init="
                swiper = new Swiper($refs.swiperContainer, {
                    // Optional parameters
                    direction: 'horizontal',
                    loop: true,
                    autoplay: {
                        delay: 7000
                    },
    
                    // swiper-slider-not-working-unless-page-is-resized
                    observer: true, 
                    observeParents: true,
    
                    // If we need pagination
                    pagination: {
                        el: '.swiper-pagination'
                    },
    
                    // Navigation arrows
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
    
                    // And if we need scrollbar
                    scrollbar: {
                        el: '.swiper-scrollbar',
                    },
                })
            " x-cloak>
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="relative h-60 md:h-96 bg-gray-50">
                <img src="./img/sliders/0.jpg" alt="" class="w-full h-full object-fit" />
              </div>
            </div>
            <div class="swiper-slide">
              <div class="relative h-60 md:h-96 bg-gray-50">
                <img src="./img/sliders/1.png" alt="" class="w-full h-full object-fit object-top" />
              </div>
            </div>
            <div class="swiper-slide">
              <div class="relative h-60 md:h-96 bg-gray-50">
                <img src="./img/sliders/3.jpeg" alt="" class="w-full h-full object-fit" />
              </div>
            </div>
    
            <!-- 
              <div class="bg-center relative swiper-slide bg-cover shadow-lg" style="background-image: url('./img/sliders/0.jpeg')">
                <div class="container mx-auto px-6 md:px-20 py-6 h-96"></div>
              </div> -->
          </div>
    
          <div class="hidden md:flex">
            <div class="swiper-button-prev w-16 h-16 text-xs" style="color: rgba(255, 255, 255, 0.5)"></div>
            <div class="swiper-button-next w-16 h-16 text-xs" style="color: rgba(255, 255, 255, 0.5)"></div>
          </div>
    
          <div class="swiper-pagination"></div>
        </div>
        <!-- ./Carousel -->
    </div>

    <div class="md:max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-sky-800 md:flex items-center rounded-xl relative overflow-hidden p-10 md:py-24">
          <div class="relative z-10 md:max-w-3xl">
            <h2 class="font-bold text-sky-50 text-3xl mb-3 tracking-tight">Apply for services online.</h2>
            <p class="text-sky-200 md:text-lg">Citizens can now apply for online services at any time. Citizens can pay
              taxes, book services, and apply for permits online from anywhere in the world.</p>
          </div>
      
          <div class="md:text-center flex-1 relative z-10">
            <a href="services.html"
            class="mt-5 w-full md:w-auto inline-flex items-center justify-center font-medium transition duration-150 ease-in-out bg-gray-900 text-white px-4 py-2.5 hover:bg-gray-800 rounded-md truncate">Get started<span class="inline-block ml-2 -rotate-45"><x-icon-arrow-right class="w-5 h-5" /></span></a>
          </div>
      
          <div class="absolute inset-0 w-full h-full grid grid-cols-12" 
            x-data="{
              multiplesOfFour(number) {
                //return (number % 4) === 0;
                return [4, 10, 14, 29, 32, 47, 51, 80, 100].includes(number);
              }
            }"
            x-cloak
          >
            <template x-for="i in 600">
              <div class="h-16 border border-sky-500/10" :class="{ 'border-sky-200/20' : multiplesOfFour(i), 'border-l-0 border-b-0' : !multiplesOfFour(i) }"></div>
            </template>
          </div>
        </div>
      </div>


  <!-- Services Section -->
  <div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
        <a href="#0"
          class="rounded px-4 py-6 md:px-10 relative overflow-hidden bg-cyan-100 flex justify-between items-center ease-out duration-300 hover:-translate-y-2">
          <div class="pr-4">
            <h3 class="mb-1.5 font-semibold text-gray-800 text-lg tracking-tight">Virtual Civic Center (Online Services)
            </h3>
            <p class="text-gray-600">Our ULB now has online service windows for your convenience. You can now request
              services at any time.</p>
            <p class="underline mt-2 text-sky-700 inline-flex items-center">Learn more<svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-5 h-5 -rotate-45" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
            </p>
          </div>
          <div class="shrink-0">
            <img src="./img/services/online.jpg" class="w-36 h-36 object-cover rounded-full drop-shadow-sm">
          </div>
        </a>

        <a href="#0"
          class="rounded px-4 py-6 md:px-10 relative overflow-hidden bg-green-100 flex justify-between items-center ease-out duration-300 hover:-translate-y-2">
          <div class="pr-4">
            <h3 class="mb-1.5 font-semibold text-gray-800 text-lg tracking-tight">Complaint Registration and Status
              Check</h3>
            <p class="text-gray-600">Citizens can easily register their complaints. For tracking purposes, a Complaint
              Ticket is provided.</p>
            <p class="underline mt-2 text-sky-700 inline-flex items-center">Learn more<svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-5 h-5 -rotate-45" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
            </p>
          </div>
          <div class="shrink-0">
            <img src="./img/services/status.jpg" class="w-36 h-36 object-cover rounded-full drop-shadow-sm">
          </div>
        </a>

        <a href="#0"
          class="rounded px-4 py-6 md:px-10 relative overflow-hidden bg-gray-100 flex justify-between items-center ease-out duration-300 hover:-translate-y-2">
          <div class="pr-4">
            <h3 class="mb-1.5 font-semibold text-gray-800 text-lg tracking-tight">Right To Information</h3>
            <p class="text-gray-600">The RTI section includes contact information for the Public Information Officer,
              Assistant Public Information Officer, Proactive Disclosures, application forms, and other important
              information.</p>
            <p class="underline mt-2 text-sky-700 inline-flex items-center">Learn more<svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-5 h-5 -rotate-45" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
            </p>
          </div>
          <div class="shrink-0">
            <img src="./img/services/rti.jpg" class="w-36 h-36 object-cover rounded-full drop-shadow-sm">
          </div>
        </a>

        <a href="#0"
          class="rounded px-4 py-6 md:px-10 relative overflow-hidden bg-gray-100 flex justify-between items-center ease-out duration-300 hover:-translate-y-2">
          <div class="pr-4">
            <h3 class="mb-1.5 font-semibold text-gray-800 text-lg tracking-tight">Form Downloads</h3>
            <p class="text-gray-600">Forms for various applications are listed here. The most recent forms can be found
              here.</p>
            <p class="underline mt-2 text-sky-700 inline-flex items-center">Learn more<svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-5 h-5 -rotate-45" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
            </p>
          </div>
          <div class="shrink-0">
            <img src="./img/services/forms.jpg" class="w-36 h-36 object-cover rounded-full drop-shadow-sm">
          </div>
        </a>

        <a href="#0"
          class="rounded px-4 py-6 md:px-10 relative overflow-hidden bg-gray-100 flex justify-between items-center ease-out duration-300 hover:-translate-y-2">
          <div class="pr-4">
            <h3 class="mb-1.5 font-semibold text-gray-800 text-lg tracking-tight">Elected members</h3>
            <p class="text-gray-600">View the most recent and previous ULB elected members.</p>
            <p class="underline mt-2 text-sky-700 inline-flex items-center">Learn more<svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-5 h-5 -rotate-45" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
            </p>
          </div>
          <div class="shrink-0">
            <img src="./img/services/vote.jpg" class="w-36 h-36 object-cover rounded-full drop-shadow-sm">
          </div>
        </a>

        <a href="#0"
          class="rounded px-4 py-6 md:px-10 relative overflow-hidden bg-gray-100 flex justify-between items-center ease-out duration-300 hover:-translate-y-2">
          <div class="pr-4">
            <h3 class="mb-1.5 font-semibold text-gray-800 text-lg tracking-tight">Municipal area map</h3>
            <p class="text-gray-600">View and download the map of the municipal area. This enables citizens to obtain
              useful information about Town Planning, Development Permission, and other topics.</p>
            <p class="underline mt-2 text-sky-700 inline-flex items-center">Learn more<svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-5 h-5 -rotate-45" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
            </p>
          </div>
          <div class="shrink-0">
            <img src="./img/services/map.png" class="w-36 h-36 object-cover rounded-full drop-shadow-sm border">
          </div>
        </a>

        <a href="#0"
          class="rounded px-4 py-6 md:px-10 relative overflow-hidden bg-gray-100 flex justify-between items-center ease-out duration-300 hover:-translate-y-2">
          <div class="pr-4">
            <h3 class="mb-1.5 font-semibold text-gray-800 text-lg tracking-tight">Budget, Expenditure and Revenue</h3>
            <p class="text-gray-600">View information about budget allocation, expenditure, and revenue collection.</p>
            <p class="underline mt-2 text-sky-700 inline-flex items-center">Learn more<svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-5 h-5 -rotate-45" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
            </p>
          </div>
          <div class="shrink-0">
            <img src="./img/services/tax.jpg" class="w-36 h-36 object-cover rounded-full drop-shadow-sm">
          </div>
        </a>

        <a href="#0"
          class="rounded px-4 py-6 md:px-10 relative overflow-hidden bg-gray-100 flex justify-between items-center ease-out duration-300 hover:-translate-y-2">
          <div class="pr-4">
            <h3 class="mb-1.5 font-semibold text-gray-800 text-lg tracking-tight">Facility Map</h3>
            <p class="text-gray-600">View various facilities and points of interest in the city, such as public toilets,
              bus stops, and halls, on a map.</p>
            <p class="underline mt-2 text-sky-700 inline-flex items-center">Learn more<svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-5 h-5 -rotate-45" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
            </p>
          </div>
          <div class="shrink-0">
            <img src="./img/services/map.jpg" class="w-36 h-36 object-cover rounded-full drop-shadow-sm">
          </div>
        </a>
      </div>
    </div>
  </div>
  <!-- ./Services Section -->

    {{-- <div class='bg-indigo-800 relative py-24 md:py-36 w-full px-4 flex items-center justify-center overflow-hidden'>
        <div class='animate-[ripple_15s_infinite] absolute rounded-full bg-white shadow w-[800px] h-[800px] left-0 right-0 mx-auto -bottom-[400px] opacity-5'></div>
        <div class='animate-[ripple_15s_infinite] absolute rounded-full bg-white shadow w-[600px] h-[600px] left-0 right-0 mx-auto -bottom-[300px] opacity-10'></div>
        <div class='animate-[ripple_15s_infinite] absolute rounded-full bg-white shadow w-[400px] h-[400px] left-0 right-0 mx-auto -bottom-[200px] opacity-20'></div>
        <div class='animate-[ripple_15s_infinite] absolute rounded-full bg-white shadow w-[200px] h-[200px] left-0 right-0 mx-auto -bottom-[100px] opacity-30'></div>

        <div>
            <div class="max-w-2xl mx-auto relative">
                <x-heading size="5xl" color="text-gray-100" class="mb-4 font-bold">UDD Websites</x-heading>
            </div>
        </div>
    </div> --}}
  
    {{-- <div class="py-16 md:py-24 border-t border-slate-200">
        <div class="md:max-w-4xl md:mx-auto px-4 sm:px-6 lg:px-8">
            <x-heading class="text-center mb-4" size="3xl">Frequently asked questions</x-heading>
            <p class="text-center text-gray-600 mb-16">If you can't find what you're looking for, email our support team at <a href="#" class="text-indigo-600 hover:underline">dhtenders@gmail.com</a>.</p>
 
            <div class="grid grid-cols-1 md:grid-cols-1 gap-8 md:gap-10">
                <div>
                    <h4 class="font-semibold text-gray-800 text-lg leading-5">Do I need to register before I can obtain the tender documents?</h4>
                    <p class="text-gray-600 mt-2">Yes, To obtain the tender document you have to login in to the portal with your basic details. In some cases where there is a need for tender document fee, bidder need to pay the tender fee online to download the document. 
                    </p>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-800 text-lg">Do I need to pay for bidding?</h4>
                    <p class="text-gray-600 mt-2">Depending on the tender EMD needs to be paid by the bidder. EMD can be submitted both online and offline.</p>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-800 text-lg">Do I need to have a GST number to participate in the bid?</h4>
                    <p class="text-gray-600 mt-2">You will be notified when the bid will open via SMS and Email notification. </p>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-800 text-lg">Do you have to renew every year?</h4>
                    <p class="text-gray-600 mt-2">No, you have to register once in the portal for bidding. But you need to keep updating your profile time to time.</p>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-800 text-lg">Do I get to see old bidding history and documents?</h4>
                    <p class="text-gray-600 mt-2">Yes, you can login into your profile and view your past details in the portal.</p>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="bg-indigo-900 py-24">
        <div class="w-full md:max-w-xl md:mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-center mb-4 text-4xl font-bold tracking-tight text-slate-100 relative">Get started today</h2>
            
            <div class="mt-10 text-center">
                <a href="#" class="font-medium transition duration-150 ease-in-out bg-white text-indigo-700 hover:text-white px-10 py-2.5 hover:bg-indigo-500 rounded-md truncate">Sign up now</a>
            </div>
        </div>
    </div> --}}
 
@once
    @push('styles')
        {{-- <style>
            .snap-slider {
                scrollbar-width: none;
            }
            .snap-slider::-webkit-scrollbar {
                display: none;
            }
        </style> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@6.4.11/swiper-bundle.min.css">
    @endpush
 
    @push('scripts-bottom')
        <script src="https://cdn.jsdelivr.net/npm/swiper@6.4.11/swiper-bundle.min.js"></script>
    @endpush
@endonce
</x-front-layout>
