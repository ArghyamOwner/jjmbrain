@props(['on' => ''])

<div
	x-data="{ shown: false, timeout: null }"
	x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  })"
	x-show.transition.opacity.out.duration.1500ms="shown"
    style="display: none;"
    {{ $attributes->merge(['class' => 'font-medium text-green-600']) }}
	x-cloak>
	<div class="flex items-center">
		<svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-5 w-5 shrink-0" viewBox="0 0 24 24"><g fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
		<div>
			{{ $slot ?? 'Saved.' }}
		</div>
	</div>
</div>