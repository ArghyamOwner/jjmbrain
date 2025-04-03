<x-logo-cloud />
<footer class="relative">
    <div class="bg-great-blue-800">
      <div class="py-10 md:py-12 max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="mb-10">
          <div class="grid grid-cols-2 md:grid-cols-5 gap-x-8 gap-y-10">
            <div class="col-span-2 text-white">
              <div class="font-semibold mb-4">
                {{ $tenantName ?? config('app.name') }}
              </div>
              <div class="text-sm text-great-blue-100">
                <div class="mb-2">{{ $siteSettings['address'] ?? '' }}</div>
                {{ $siteSettings['working_hours'] ?? '' }}
              </div>
            </div>

            <div>
              <h3 class="font-2 uppercase tracking-wider text-sm text-gray-200 mb-4 uppercase font-semibold">Support</h3>

              <div class="leading-relaxed">
                <div><a
                    href="mailto:{{ $siteSettings['contact_email'] ?? '' }}"
                    class="hover:underline text-great-blue-100 text-sm hover:text-great-blue-300 transition ease-in-out duration-300">{{ $siteSettings['contact_email'] ?? '' }}</a>
                </div>
                <div><a
                    href="tel:{{ $siteSettings['contact_phone'] ?? '' }}"
                    class="hover:underline text-great-blue-100 text-sm hover:text-great-blue-300 transition ease-in-out duration-300">
                    {{ $siteSettings['contact_phone'] ?? '' }}</a></div>
              </div>
            </div>

            <div>
              <h3 class="font-2 uppercase tracking-wider text-sm text-gray-200 mb-4 uppercase font-semibold">Quick
                Links</h3>

              <div class="text-gray-700 font-2 leading-relaxed">
                @isset ($tenantId)
                  <div><a href="{{ route('tenant.grievances') }}"
                      class="hover:underline text-great-blue-100 text-sm hover:text-great-blue-300 transition ease-in-out duration-300">Grievance Redressal</a>
                  </div>
                  <div><a href="{{ route('tenant.grievances.track')}}"
                    class="hover:underline text-great-blue-100 text-sm hover:text-great-blue-300 transition ease-in-out duration-300">Track Grievance</a>
                  </div>
                @endisset
                <div><a href="/privacy-policy"
                    class="hover:underline text-great-blue-100 text-sm hover:text-great-blue-300 transition ease-in-out duration-300">Privacy
                    Policy</a></div>
                <div><a href="{{ isset($tenantId) ? route('tenant.login') : '#' }}"
                    class="hover:underline text-great-blue-100 text-sm hover:text-great-blue-300 transition ease-in-out duration-300">Login</a>
                </div>
              </div>
            </div>

            <div>
              <h3 class="font-2 uppercase tracking-wider text-sm text-gray-200 mb-4 uppercase font-semibold">Social</h3>

              @isset($siteSettings['social_links'])
              <div class="flex flex-wrap space-x-2">
                @foreach($siteSettings['social_links'] as $socialLinkKey => $socialLinkValue)
                  <a href="{{ $socialLinkValue }}" target="_blank" class="inline-block group">
                    @if ($socialLinkKey === 'Twitter')
                      <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 fill-current text-great-blue-100 text-sm hover:text-great-blue-300" viewBox="0 0 24 24">
                        <path
                          d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z">
                        </path>
                      </svg>
                    @endif

                    @if ($socialLinkKey === 'Facebook')
                      <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 fill-current text-great-blue-100 text-sm hover:text-great-blue-300" viewBox="0 0 24 24">
                        <path
                          d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.772-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z">
                        </path>
                      </svg>
                    @endif

                    @if ($socialLinkKey === 'Instagram')
                      <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 fill-current text-great-blue-100 text-sm hover:text-great-blue-300" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none"></rect>
                        <circle cx="128" cy="128" r="32"></circle>
                        <path
                          d="M172,28H84A56,56,0,0,0,28,84v88a56,56,0,0,0,56,56h88a56,56,0,0,0,56-56V84A56,56,0,0,0,172,28ZM128,176a48,48,0,1,1,48-48A48,48,0,0,1,128,176Zm52-88a12,12,0,1,1,12-12A12,12,0,0,1,180,88Z">
                        </path>
                      </svg>
                    @endif
                  </a>
                @endforeach
              </div>
              @endisset
            </div>
          </div>
        </div>

        <div class="py-10 border-t border-great-blue-800/50">
          <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <p class="text-great-blue-100 text-sm">Powered by Sumato. Copyrights &copy; 2022. All rights reserved.</p>
            <p>
                <a
                  x-data
                  href="#0"
                  x-on:click.prevent="window.scrollTo({top: 0, behavior: 'smooth'})"
                  aria-label="Back to top"
                  class="flex items-center text-sm text-great-blue-200 hover:underline space-x-1">
                   <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-great-blue-200" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><line x1="128" y1="216" x2="128" y2="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><polyline points="56 112 128 40 200 112" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline></svg><span>Back to top</span>
                </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- ./Footer -->
