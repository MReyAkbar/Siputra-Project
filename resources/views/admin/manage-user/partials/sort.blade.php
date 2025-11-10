@php
    $currentSort = request('sort', 'id');
    $currentDir = request('direction', 'desc');
    $dir = ($currentSort === $field && $currentDir === 'asc') ? 'desc' : 'asc';
    $qs = array_merge(request()->except('page'), ['sort' => $field, 'direction' => $dir]);
    $url = url()->current() . '?' . http_build_query($qs);
@endphp
<a href="{{ $url }}" class="inline-flex items-center gap-1">
  {{ $label }}
  @if($currentSort === $field)
    @if($currentDir === 'asc')
      <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12l5-5 5 5H5z"/></svg>
    @else
      <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5 5 5-5H5z"/></svg>
    @endif
  @endif
</a>
