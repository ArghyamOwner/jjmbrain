<x-app-layout title="Home">
	<x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
				Videos
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
		<x-card overflow-hidden>
			<div class="plyr__video-embed" id="player">
				<iframe
				  src="https://www.youtube.com/embed/fxBLTMmZWcc?iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
				  allowfullscreen
				  allowtransparency
				  allow="autoplay"
				></iframe>
			</div>
		</x-card>
    </x-section-centered>

	@push('styles')
	<link rel="stylesheet" href="https://cdn.plyr.io/3.7.3/plyr.css" />
	@endpush

	@push('scripts-footer')
	<script src="https://cdn.plyr.io/3.7.3/plyr.js"></script>
	@endpush
</x-app-layout>

  