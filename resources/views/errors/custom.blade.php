<x-guest-layout>
	<x-slot name="title">@yield('title')</x-slot>

	<div class="flex min-h-screen bg-white items-center">
		<div class="w-full md:flex md:max-w-2xl m-8 md:mx-auto justify-center">
			<div>
				<div class="text-indigo-600 text-5xl md:text-6xl font-bold">
					@yield('code', __('Oh no'))
				</div>
			</div>
		 
			<div class="flex-shrink-0 w-16 md:w-0.5 h-0.5 md:h-16 bg-gray-200 my-6 md:my-0 md:mx-6"></div>

			<div>
				<p class="text-gray-500 text-2xl md:text-3xl font-light mb-3 leading-normal">
					@yield('message')
				</p>

				@isset($tenantHost)
				<a class="py-2 px-1 font-medium text-indigo-600 inline-flex items-center" href="{{ 'http://' .$tenantHost }}">
						{{ __('Go back home') }}<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 24 24"><g fill="none"><path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
				</a>
				@else
				<a class="py-2 px-1 font-medium text-indigo-600 inline-flex items-center" href="{{ config('app.url') }}">
					{{ __('Go back home') }}<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 24 24"><g fill="none"><path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
				</a>
				@endisset
			</div>
		</div>
	</div>
</x-guest-layout>