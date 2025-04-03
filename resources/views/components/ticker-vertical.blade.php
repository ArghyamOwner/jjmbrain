@props([
	'speed' => 50,
	'delay' => 2000
])

<div
	x-data="{
		start: null,
		counter: 0,
		count: 0,
		speed: {{ $speed }},
		delay: {{ $delay }},
		list: $refs.verticalTicker,
		firstChild: $refs.verticalTicker.firstElementChild,
		items: $refs.verticalTicker.getElementsByTagName('div'),

		get totalItems() {
			return this.items.length;
		},

		slide() {
			let height = this.firstChild.scrollHeight;
			this.list.style.top = (this.list.offsetTop - 1) + 'px';

			this.count++;

			if (this.count == height) {
				this.list.append(this.firstChild)
				this.list.style.top = (this.list.offsetTop + height) + 'px';
				this.firstChild = this.list.firstElementChild;
				this.count = 0;
			}
		},

		mouseoverEvent() {
			clearInterval(this.counter)
			clearTimeout(this.start)
		},

		mouseoutEvent() {
			this.counter = setInterval(() => {
				this.slide()
			}, this.speed)
		}
	}"
	x-init=" 
		$nextTick(() => {
			start = setTimeout(() => {
				counter = setInterval(function() {
					slide()
				}, speed)
			}, delay)
		})
	"
	x-cloak
	class="relative w-full h-full overflow-hidden -top-1px"
>
	<div class="relative w-full h-full"
		x-on:mouseover="mouseoverEvent()"
		x-on:mouseout="mouseoutEvent()"
	>
		<div x-ref="verticalTicker" {{ $attributes->class(['absolute w-full h-full m-0 p-0'])->merge() }}>
			{{ $slot }}
		</div>
	</div>
</div>