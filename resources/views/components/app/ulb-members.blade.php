@if ($ulbmembers->isNotEmpty())
<div class="py-10 md:py-16 relative">
	<div class="w-full h-72 text-slate-200/50 inset-x-0 top-0 absolute" style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(to right, currentColor 1px, transparent 1px); background-size: 40px 40px;"></div>
    <div class="w-full h-full inset-x-0 top-0 absolute bg-gradient-to-tl from-white"></div>

	<x-section-centered class="relative z-30">
		<div class="flex flex-wrap flex-col md:flex-row mb-8 md:space-x-6 space-y-4 md:space-y-0">
			<div>
				<x-heading size="4xl" class="mb-1.5 font-medium font-serif text-sky-700">Members</x-heading>
				<p class="text-slate-700">Current elected members of ULB.</p>
			</div>
			<div class="md:w-32">
				<x-button class="py-3" tag="a" href="{{ isset($tenantId) ? route('tenant.members') : '#' }}">View all Members<svg
					xmlns="http://www.w3.org/2000/svg" class="ml-1 w-5 h-5 -rotate-45 shrink-0" width="24" height="24"
					viewBox="0 0 24 24">
					<g fill="none">
						<path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2"
							stroke-linecap="round" stroke-linejoin="round"></path>
					</g>
				</svg></x-button>
			</div>
		</div>

		<div class="grid grid-cols-2 md:grid-cols-5 gap-6 md:gap-10 w-full">
			@foreach($ulbmembers as $ulbmember)
				<div>
					<div class="bg-slate-100 h-56 mb-2 rounded overflow-hidden">
						<img 
							src="{{ $ulbmember->image_url }}" 
							class="h-56 w-full object-cover" 
							loading="lazy" 
						/>
					</div>
					<h3 class="font-semibold text-slate-800">{{ $ulbmember->name }}</h3>
					<p class="text-slate-500 text-sm">{{ $ulbmember->designation }}</p>
					<p class="text-slate-500 text-sm">{{ $ulbmember->phone }}</p>
				</div>
			@endforeach
		</div>
	</x-section-centered>
</div>
@endif