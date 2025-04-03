@props([
	'xmodel' => null
])

<div
	class="relative"
	x-data="{
		amount: '{{ $xmodel }}',

		amountInINR() {
			let amountInInr = parseFloat(this.amount.split(',').join(''));
			let ext = '';

			const INR_THOUSAND = 1000;
			const INR_LAKH = 100 * INR_THOUSAND;
			const INR_CRORE = 100 * INR_LAKH;

			const formatter = new Intl.NumberFormat('en', { minimumFractionDigits: 0, maximumFractionDigits: 2 });

			if (amountInInr > INR_CRORE) {
				INR = amountInInr / INR_CRORE;
				ext = INR == 1 ? 'crore' : 'crores';
				return '&#8377;' + formatter.format(amountInInr / INR_CRORE, 2) + ' ' + ext;
			} else if (amountInInr > INR_LAKH) {
				return amountInInr / INR_LAKH;
				ext = INR == 1 ? 'lakh' : 'lakhs';
				return '&#8377;' + formatter.format(amountInInr / INR_LAKH, 2) + ' ' + ext;
			} else if (amountInInr > INR_THOUSAND) {
				return amountInInr / INR_THOUSAND;
				ext = INR == 1 ? 'lakh' : 'K';
				return '&#8377;' + formatter.format(amountInInr / INR_THOUSAND, 2) + ' ' + ext;
			} else {
				return '';
				//return '&#8377;' + formatter.format(amountInInr, 2);
			}
		}
	}"
	x-cloak
>
	{{ $slot }}
	<div class="absolute bg-red-100 top-16">
		<span x-text="amountInINR"></span>
	</div>
</div>

