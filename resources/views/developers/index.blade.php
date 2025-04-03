<x-app-layout title="Developers">

    <x-slot name="topbar">
        <x-navbar-top>
            <x-slot name="title">Developers</x-slot>
        </x-navbar-top>
    </x-slot>

    <x-section-centered>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <x-card-icon tag="a" href="{{ route('developers.components') }}">
                <x-slot name="icon">
                    <x-icon-layer class="w-10 h-10" />
                </x-slot>

                <x-heading size="lg" class="mb-2">Components</x-heading>
                
                Lists of all reusable components for rapid development.
            </x-card-icon>
			
			<x-card-icon tag="a" href="{{ route('developers.api') }}">
                <x-slot name="icon">
                    <x-icon-code class="w-10 h-10" />
                </x-slot>

                <x-heading size="lg" class="mb-2">API's</x-heading>
                
            	Lists of all APIs that are used in the applications.
            </x-card-icon>

            <x-card-icon tag="a" href="{{ route('developers') }}">
                <x-slot name="icon">
                    <x-icon-document class="w-10 h-10" />
                </x-slot>

                <x-heading size="lg" class="mb-2">Documentation</x-heading>
                
            	Working manual/notes of the project for developers.
            </x-card-icon>
        </div>
       
    </x-section-centered>
</x-app-layout>
