@php
	$currentSort = request('sort', 'id');
	$currentDirection = request('direction', 'desc');
	$newDirection = ($currentSort === $field && $currentDirection === 'asc') ? 'desc' : 'asc';
	$url = route($route, array_merge(request()->except('page'), [
		'sort' => $field,
		'direction' => $newDirection
	]));
@endphp

<a href="{{ $url }}" class="inline-flex items-center gap-1 hover:text-[#134686] transition">
	{{ $label }}
	@if($currentSort === $field)
		<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $currentDirection === 'asc' ? 'M19 14l-7 7m0 0l-7-7m7 7V3' : 'M5 10l7-7m0 0l7 7m-7-7v18' }}"/>
		</svg>
	@endif
</a>