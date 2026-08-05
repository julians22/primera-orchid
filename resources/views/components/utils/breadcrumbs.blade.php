@props([
	'items' => [],
])

@php
	$lastIndex = count($items) - 1;
@endphp

@if (! empty($items))
	<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'block']) }}>
		<ol class="flex flex-wrap items-center gap-2">
			@foreach ($items as $index => $item)
				@php
					$isActive = $index === $lastIndex;
					$label = $item['label'] ?? '';
					$href = $item['href'] ?? null;
				@endphp

				<li class="flex items-center gap-2">
					@if ($isActive || empty($href))
						<span aria-current="page" class="font-medium text-everglade decoration-2 decoration-everglade underline underline-offset-4">
							{{ $label }}
						</span>
					@else
						<a href="{{ $href }}" class="text-stone-500 hover:text-everglade hover:underline transition-colors duration-200">
							{{ $label }}
						</a>
					@endif

					@if (! $isActive)
						<span aria-hidden="true" class="text-stone-400">/</span>
					@endif
				</li>
			@endforeach
		</ol>
	</nav>
@endif
