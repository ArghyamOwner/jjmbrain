@if($services)
<div class="bg-slate-800/[0.95] relative overflow-hidden bg-cover bg-center bg-blend-multiply"
	style="background-image: url('{{ url('img/online-services.jpg') }}')"
>
	<x-section-centered class="py-16 relative z-10">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 md:items-center">
			<div>
				<x-heading size="4xl" class="mb-1.5 font-medium font-serif text-sky-500">Explore Online Services</x-heading>
				<p class="text-sky-100">List of various online services provided by government for citizens.</p>
				<p class="text-sky-100 mt-6 mb-1">For any help contact us:</p>
				<div class="text-sky-100">
					{{ $siteSettings['contact_phone'] ?? '' }} <br>
					{{ $siteSettings['contact_email'] ?? '' }}
				</div>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-1.5">
				@foreach($services as $service)
				<div>
					<a href="{{ $service->link ?? '#' }}" class="rounded-lg shadow-sm hover:shadow bg-white/[.8] bg-gradient-to-tr flex flex-1 h-full hover:text-sky-500 transition-all items-center space-x-2 justify-between text-lg border block py-2 px-4">{{ $service->title }}
						<svg class="w-5 h-5 text-sky-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>						
					</a>
				</div>
				@endforeach
			</div>
		</div>	
	</x-section-centered>
</div>
@endif