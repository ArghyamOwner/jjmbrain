@props([
	'duration' => '60s'
])

<div {{ $attributes->class([
	'px-4 py-5 bg-sky-800 overflow-hidden relative h-12'
])->merge() }}>
	 
	@isset($before)
		{{ $before }}
	@endisset

	<div class="ticker flex items-center box-content w-full absolute inset-0" style="padding-left: 100%">
		{{ $slot }}
	</div>
</div>


@push('styles')
<style>
.ticker__list {
	animation: ticker {{ $duration }} linear infinite;
}
.ticker:hover .ticker__list {
	animation-play-state: paused;
}
@-moz-keyframes ticker {
	0% {
		transform: translate3d(0, 0, 0);
		visibility: visible;
	}
	100% {
	  transform: translate3d(-100%, 0, 0);
	}
  }
  @-webkit-keyframes ticker {
	0% {
		transform: translate3d(0, 0, 0);
		visibility: visible;
	}
	100% {
	  transform: translate3d(-100%, 0, 0);
	}
  }
  @-o-keyframes ticker {
	0% {
		transform: translate3d(0, 0, 0);
		visibility: visible;
	}
	100% {
	  transform: translate3d(-100%, 0, 0);
	}
  }
  @keyframes ticker {
	0% {
		transform: translate3d(0, 0, 0);
		visibility: visible;
	}
	100% {
	  transform: translate3d(-100%, 0, 0);
	}
}
</style>
@endpush