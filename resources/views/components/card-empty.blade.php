@props([
	'variant' => 'theme2',
	'icon' => null
])

<div {{ $attributes->class('md:px-10 py-20 rounded-lg bg-white shadow-sm ring-1 ring-slate-200 relative overflow-hidden') }}>

	<div class="w-full h-full text-slate-100/50 inset-x-0 -ml-px -mt-px top-0 absolute" style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(to right, currentColor 1px, transparent 1px); background-size: 20px 20px;"></div>
    <div class="w-full h-full right-0 top-0 absolute bg-gradient-to-tl from-white"></div>

	<div class="text-center flex justify-center flex-col w-full items-center relative">
		@if(isset($icon))
			<div class="bg-indigo-50 w-16 h-16 rounded-full py-2 flex justify-center items-center">
				@svg($icon, ['class' => 'w-8 h-8 stroke-current text-indigo-600'])
			</div>
		@else
			@if (isset($variant) && $variant === 'theme1')
			 	<div class="bg-indigo-100 block w-32 h-32 rounded-full py-2">
			 		<div class="w-32 bg-white p-2 rounded shadow-sm my-2 transform -translate-x-6">
						<div class="h-2 w-2/3 rounded-lg bg-indigo-50"></div>
					</div>	

					<div class="w-32 bg-white p-2 rounded shadow-sm mb-2 transform translate-x-6">
						<div class="h-2 w-4/5 rounded-lg bg-indigo-500"></div>
					</div>	

					<div class="w-32 bg-white p-2 rounded shadow-sm my-2 transform -translate-x-6">
						<div class="h-2 w-2/3 rounded-lg bg-indigo-50"></div>
					</div>	
			 	</div>
		 	@endif

		 	@if (isset($variant) && $variant === 'theme2')
			 	<div class="bg-indigo-100 w-32 h-32 rounded-full flex items-end overflow-hidden">
			 		<div class="w-24 mx-auto bg-white px-2 pb-4 pt-3 rounded shadow-sm -mb-2">
						<div class="h-2 w-2/3 mb-2 rounded-lg bg-indigo-100"></div>
						<div class="h-2 w-full mb-2 rounded-lg bg-indigo-400"></div>
						<div class="h-2 w-2/3 mb-2 rounded-lg bg-indigo-100"></div>
						<div class="h-2 w-3/4 mb-2 rounded-lg bg-indigo-400"></div>
					</div>
			 	</div>
		 	@endif

		 	@if (isset($variant) && $variant === 'theme3')
			 	<div class="relative mb-6">
			 		<div class="w-32 h-32 bg-indigo-100 rounded-full absolute top-0 bottom-0 right-0 left-0 z-10 -mt-6 block"></div>
				 	<div class="bg-white w-32 px-3 py-3 rounded-lg shadow mb-2 transform translate-x-6 relative z-20">
						<div class="h-2 w-2/3 mb-2 rounded-lg bg-indigo-200"></div>
						<div class="h-2 w-full rounded-lg bg-indigo-100"></div>
					</div>

					<div class="bg-white w-32 px-3 py-3 rounded-lg shadow -mt-6 transform -translate-x-6 relative z-20"> 
						<div class="h-2 w-2/3 mb-2 rounded-lg bg-gray-100"></div>
						<div class="h-2 w-full rounded-lg bg-indigo-500"></div>
					</div>
			 	</div>
		 	@endif 
		@endif
		 
		<div class="text-gray-500 mt-4">
			{{ $slot->isEmpty() ? 'No data found.' : $slot }}
		</div>
	</div>	
</div>
