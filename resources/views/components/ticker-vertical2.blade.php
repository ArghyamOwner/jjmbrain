@props([
	'speed' => 1500,
	'delay' => 2000
])

<div
	x-data="{
		items: $refs.items.getElementsByTagName('li'),
		wrapper: $refs.wrapper,
		timer: null,
		count: 0,
		speed: {{ $speed }},
		delay: {{ $delay }},

		get totalItems() {
			return this.items.length;
		},

		slide() {
			this._setElementOffsets();

			this.timer = setInterval(() => {
				this.count++;

				if(this.count == this.totalItems) {
					this.count = 0;
				}
				
				let item = this.items[this.count];
				let top = item.getAttribute('data-top');
				this.wrapper.style.transform = 'translateY(-' + top + 'px)';
			}, this.speed);
		},

		hover() {
			for( var i = 0; i < this.totalItems; ++i ) {
				let item = this.items[i];
				
				item.addEventListener('mouseover', () => {
					clearInterval(this.timer);
					this.timer = null;
				}, false);

				item.addEventListener('mouseout', () => {
					this.slide();
				}, false);
			}	
		},
		
		_setElementOffsets: function() {
			for( var i = 0; i < this.totalItems; ++i ) {
				let item = this.items[i];
				let top = item.offsetTop;

				item.setAttribute('data-top', top );
			}
		}
	}"
	x-init=" 
		$nextTick(() => {
			slide();
			hover();
		})
	"
	x-cloak
>
	<div class="relative w-full h-full overflow-hidden">
		<div x-ref="wrapper" class="relative overflow-hidden w-full h-full vticker-wrapper-inner transition duration-700 ease-in">
			<ul 
				x-ref="items" 
				{{ $attributes->class('vticker-wrapper-items overflow-hidden')->merge() }}
			>
				{{ $slot }}
			</ul>
		</div>
	</div>
</div>