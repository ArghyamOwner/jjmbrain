<x-app-layout title="Documentation">
	<x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
				Documentation
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
	 
		{{-- <x-weather latitude="25.5788" longitude="91.8933" /> --}}
	 
		<div class="relative grid grid-cols-1 md:grid-cols-4 bg-white rounded-lg shadow-sm border overflow-hidden min-h-screen"> 
			<div class="absolute right-0 top-0 h-72 w-72 w-full rounded-full bg-gradient-90 from-indigo-300 blur-md opacity-20"></div>
        	<div class="absolute left-0 top-20 h-96 w-96 w-full rounded-full bg-gradient-90 from-indigo-300 blur-md opacity-20"></div>

			<div class="relative border-r py-6 px-4">
				<div class="flex flex-wrap md:flex-nowrap md:flex-col space-y-2 space-x-2 md:space-x-0">
					<a href="/docs/home" class="flex items-center px-3 py-1.5 md:py-2 rounded-full md:rounded-xl hover:text-indigo-600 {{ request()->is('docs/home') ? 'text-indigo-600 bg-slate-50 shadow-sm border' : 'text-slate-500' }}"><x-icon-home class="w-5 h-5 mr-3" />Home</a>
					<a href="/docs/account" class="flex items-center px-3 py-1.5 md:py-2 rounded-full md:rounded-xl hover:text-indigo-600 {{ request()->is('docs/account') ? 'text-indigo-600 bg-slate-50 shadow-sm border' : 'text-slate-500' }}"><x-icon-user class="w-5 h-5 mr-3" />Account</a>
					{{-- <a href="/docs/page" class="flex items-center px-3 py-1.5 md:py-2 rounded-full md:rounded-xl hover:text-indigo-600 {{ request()->is('docs/page') ? 'text-indigo-600 bg-slate-50 shadow-sm border' : 'text-slate-500' }}"><x-icon-file class="w-5 h-5 mr-3" />Page</a>
					<a href="/docs/news" class="flex items-center px-3 py-1.5 md:py-2 rounded-full md:rounded-xl hover:text-indigo-600 {{ request()->is('docs/news') ? 'text-indigo-600 bg-slate-50 shadow-sm border' : 'text-slate-500' }}"><x-icon-file class="w-5 h-5 mr-3" />News</a>
					<a href="/docs/menu" class="flex items-center px-3 py-1.5 md:py-2 rounded-full md:rounded-xl hover:text-indigo-600 {{ request()->is('docs/menu') ? 'text-indigo-600 bg-slate-50 shadow-sm border' : 'text-slate-500' }}"><x-icon-list class="w-5 h-5 mr-3" />Menu</a>
					<a href="/docs/site-settings" class="flex items-center px-3 py-1.5 md:py-2 rounded-full md:rounded-xl hover:text-indigo-600 {{ request()->is('docs/site-settings') ? 'text-indigo-600 bg-slate-50 shadow-sm border' : 'text-slate-500' }}"><x-icon-setting class="w-5 h-5 mr-3" />Site Settings</a>
					<a href="/docs/widgets" class="flex items-center px-3 py-1.5 md:py-2 rounded-full md:rounded-xl hover:text-indigo-600 {{ request()->is('docs/widgets') ? 'text-indigo-600 bg-slate-50 shadow-sm border' : 'text-slate-500' }}"><x-icon-layer class="w-5 h-5 mr-3" />Widgets</a>
					<a href="/docs/support" class="flex items-center px-3 py-1.5 md:py-2 rounded-full md:rounded-xl hover:text-indigo-600 {{ request()->is('docs/support') ? 'text-indigo-600 bg-slate-50 shadow-sm border' : 'text-slate-500' }}"><x-icon-lifebuoy class="w-5 h-5 mr-3" />Support</a> --}}
				</div>
			</div>
			<div class="md:col-span-3">
				<div class="max-w-none pt-6 pb-12 px-8 md:px-10 prose prose-a:text-indigo-600 prose-img:rounded-md prose-p:text-slate-600">
					{!! $content !!}
				</div>
			</div>
		</div>
    </x-section-centered>
</x-app-layout>
 
          
 