@props([
	'id' => md5(Str::random(10)),
	'legendAlign' => 'left',
	'type' => 'pie',
	'labels' => [],
	'data' => [],
	'bgColors' => []
])

@php
	$legendAlignClass = [
		'left' => 'justify-start',
		'center' => 'justify-center',
		'right' => 'justify-end',
	][$legendAlign];

	$backgroundColors = array_unique(array_merge($bgColors, [
		"#ffa600",
		"#2f4b7c",
		"#EC368D",
		"#000000",
		"#51E5FF",
		"#440381",
		"#003f5c",
		"#ff7c43",
		"#665191",
		"#a05195",
		"#FFE66D",
		"#d45087",
	]));
@endphp

<div>
	<div class="relative">
		<canvas id="chart-{{ $id }}"></canvas>
	</div>

	<div id="legend-container-{{ $id }}" class="mt-6 flex {{ $legendAlignClass }}"></div>
</div>

@once
	@push('scripts')
		<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.0/dist/chart.min.js"></script>
	@endpush
@endonce

@push('scripts')
<script>
	document.addEventListener('livewire:load', function () {
		const getOrCreateLegendList = (chart, id) => {
			const legendContainer = document.getElementById(id);
			let listContainer = legendContainer.querySelector('ul');

			if (!listContainer) {
				listContainer = document.createElement('ul');
				listContainer.style.display = 'flex';
				listContainer.style.flexDirection = 'row';
				listContainer.style.margin = 0;
				listContainer.style.padding = 0;

				legendContainer.appendChild(listContainer);
			}

			return listContainer;
		};

		const htmlLegendPlugin = {
			id: 'htmlLegend',
			afterUpdate(chart, args, options) {
				const ul = getOrCreateLegendList(chart, options.containerID);
				ul.style.flexWrap = 'wrap';

				// Remove old legend items
				while (ul.firstChild) {
					ul.firstChild.remove();
				}

				// Reuse the built-in legendItems generator
				const items = chart.options.plugins.legend.labels.generateLabels(chart);

				items.forEach(item => {
					const li = document.createElement('li');
					li.style.alignItems = 'center';
					li.style.cursor = 'pointer';
					li.style.display = 'flex';
					li.style.flexDirection = 'row';
					li.style.marginLeft = '18px';

					li.onclick = () => {
						const {type} = chart.config;
						if (type === 'pie' || type === 'doughnut') {
						// Pie and doughnut charts only have a single dataset and visibility is per item
						chart.toggleDataVisibility(item.index);
						} else {
						chart.setDatasetVisibility(item.datasetIndex, !chart.isDatasetVisible(item.datasetIndex));
						}
						chart.update();
					};

					// Color box
					const boxSpan = document.createElement('span');
					boxSpan.style.background = item.fillStyle;
					boxSpan.style.borderColor = item.strokeStyle;
					boxSpan.style.borderWidth = item.lineWidth + 'px';
					boxSpan.style.display = 'inline-block';
					boxSpan.style.height = '15px';
					boxSpan.style.marginRight = '10px';
					boxSpan.style.width = '15px';

					// boxSpan.style.borderRadius = '50%';
					boxSpan.style.borderRadius = '6px';

					// Text
					const textContainer = document.createElement('p');
					textContainer.style.color = item.fontColor;
					textContainer.style.margin = 0;
					textContainer.style.padding = 0;
					textContainer.style.fontSize = '14px';
					textContainer.style.textDecoration = item.hidden ? 'line-through' : '';

					const text = document.createTextNode(item.text);
					textContainer.appendChild(text);

					li.appendChild(boxSpan);
					li.appendChild(textContainer);
					ul.appendChild(li);
				});
			}
		};

		const ctx = document.getElementById('chart-{{ $id }}').getContext('2d');
		new Chart(ctx, {
			type: '{{ $type }}',
			data: {
				labels: @json($labels),
				datasets: [
					{
						data: @json($data),
						backgroundColor: @json($backgroundColors),
						borderWidth: 1
					}
				]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					htmlLegend: {
						// ID of the container to put the legend in
						containerID: 'legend-container-{{ $id }}',
					},
					title: {
						display: false
					},
					legend: {
						display: false
					}
				}
			},
			plugins: [htmlLegendPlugin]
		});

	})
</script>
@endpush
