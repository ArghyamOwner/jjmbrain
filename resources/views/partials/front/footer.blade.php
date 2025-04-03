<footer class="py-10 md:py-12">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
		<div class="mb-10">
			<div class="grid grid-cols-2 md:grid-cols-5 gap-x-8 gap-y-10">
				<div class="col-span-2">
					<x-application-logo class="text-xl" />
				</div>
	
				<div>
					<h3 class="font-2 uppercase tracking-wider text-sm text-gray-400 mb-4 uppercase font-semibold">Support</h3>
	
					<div class="text-gray-700 font-2 leading-relaxed">
						<div><a href="#" class="hover:underline hover:text-sky-600 transition ease-in-out duration-300">example@gmail.com</a></div>
					</div>
				</div>
	
				{{-- <div>
					<h3 class="font-2 uppercase tracking-wider text-sm text-gray-400 mb-4 uppercase font-semibold">Framework
					</h3>
	
					<div class="text-gray-700 font-2 leading-relaxed">
						<div><a href="#" class="hover:underline hover:text-sky-600 transition ease-in-out duration-300">About</a></div>
						<div><a href="#" class="hover:underline hover:text-sky-600 transition ease-in-out duration-300">Features</a></div>
						<div><a href="#" class="hover:underline hover:text-sky-600 transition ease-in-out duration-300">Changelogs</a></div>
					</div>
				</div> --}}
	
				<div>
					<h3 class="font-2 uppercase tracking-wider text-sm text-gray-400 mb-4 uppercase font-semibold">Quick
						Links</h3>
	
					<div class="text-gray-700 font-2 leading-relaxed">
						<div><a href="#" class="hover:underline hover:text-sky-600 transition ease-in-out duration-300">Link</a></div>
						{{-- <div><a href="{{ route('privacy') }}" class="hover:underline hover:text-sky-600 transition ease-in-out duration-300">Privacy Policy</a></div> --}}
						<div><a href="{{ route('login') }}" class="hover:underline hover:text-sky-600 transition ease-in-out duration-300">Login</a></div>
					</div>
				</div>
	
				<div>
					<h3 class="font-2 uppercase tracking-wider text-sm text-gray-400 mb-4 uppercase font-semibold">Social</h3>
	
					<x-front.social-links 
						twitter="#"
						facebook="#" 
					/>
				</div>
			</div>
		</div>
	
		<div class="py-10 border-t border-gray-100">
			<div class="flex flex-col md:flex-row md:justify-between md:items-center">
				<p class="font-2 text-gray-500">{!! "Copyrights &copy; " . date('Y') . ". All rights reserved." !!}</p>
				<p class="font-2 text-gray-500">Created and maintained by <x-link href="#">Nobody</x-link>.</p>
			</div>
		</div>
	</div>
</footer>