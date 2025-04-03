<div> 
	<!-- Carousel -->
	<div class="swiper-container w-full overflow-hidden shadow-sm" x-ref="swiperContainer" x-data="{
		swiper: null
	}" x-init="
		swiper = new Swiper($refs.swiperContainer, {
			// Optional parameters
			direction: 'horizontal',
			loop: true,
			autoplay: {
				delay: 7000
			},

			// swiper-slider-not-working-unless-page-is-resized
			observer: true, 
			observeParents: true,

			// If we need pagination
			pagination: {
				el: '.swiper-pagination'
			},

			// Navigation arrows
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},

			// And if we need scrollbar
			scrollbar: {
				el: '.swiper-scrollbar',
			},
		})
	" x-cloak>
		<div class="swiper-wrapper">
			@if($sliderImages->isNotEmpty())
				@foreach($sliderImages as $sliderImage)
					<div class="swiper-slide">
						<div class="relative h-60 md:h-[420px] bg-slate-50">
							<img src="{{ $sliderImage->image_url }}" alt="" class="w-full h-full object-fit" loading="lazy" />
						</div>
					</div>
				@endforeach
			@else
				<div class="relative h-60 md:h-[420px] bg-slate-50"></div>
			@endif
		</div>

		<div class="hidden md:flex">
			<div class="swiper-button-prev w-16 h-16 text-xs" style="color: rgba(255, 255, 255, 0.5)"></div>
			<div class="swiper-button-next w-16 h-16 text-xs" style="color: rgba(255, 255, 255, 0.5)"></div>
		</div>

		<div class="swiper-pagination"></div>
	</div>
	<!-- ./Carousel -->
 
@once
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@6.4.11/swiper-bundle.min.css">
    @endpush
 
    @push('scripts-bottom')
        <script src="https://cdn.jsdelivr.net/npm/swiper@6.4.11/swiper-bundle.min.js"></script>
    @endpush
@endonce
</div>