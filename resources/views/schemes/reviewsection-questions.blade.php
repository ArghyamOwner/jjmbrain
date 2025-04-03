<x-guest-layout>
    <div class="px-4 py-2" style="background-color: #0f4497;">
        <div class="flex items-center">
            <div class="shrink-0 mr-3">
                <img src="{{ url('img/jjm-logo.png') }}" alt="jjm-logo" loading="lazy" class="object-fit h-12">
            </div>
            <div class="text-left">
                <div class="leading-5 text-lg font-bold text-white">Jal Jeevan Mission</div>
                <div class="leading-5 text-sm font-medium text-white">PHED Assam</div>
            </div>
        </div>
    </div>

    <x-section-centered class="py-4">
		<x-heading size="xl" class="mb-4">{{ $reviewSectionTitle }} for Scheme: {{ $schemeName }}</x-heading>
        
        @if ($reviewSectionImage)
            <div class="mb-6">
                <img 
                    src="{{ $reviewSectionImage }}" 
                    alt="{{ $reviewSectionImage }}" 
                    loading="lazy" 
                    class="object-fit rounded-lg"
                >
            </div>
        @endif
		
        <livewire:reviewsections.review-questions 
            :scheme-id="$schemeId" 
            :scheme-name="$schemeName"
            :review-section-title="$reviewSectionTitle"
            :reviewsection-id="$reviewSectionId" 
        />
	</x-section-centered>
</x-guest-layout>
