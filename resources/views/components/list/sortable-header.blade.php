@props(['field', 'label'])

@php
    $sortOrder = session($sessionKey.'sort_order') == 'asc' ? 'desc' : 'asc';
    $isActive = session($sessionKey.'sort_by') == $field;
    $activeClass = $isActive ? 'active' : '';
    $currentSortOrder = session($sessionKey.'sort_order');
@endphp

<th class="{{ $activeClass }}">
    <a href="{{ route($routePrefix.'index', array_merge(session($ctrl), ['sort_by' => $field, 'sort_order' => $sortOrder])) }}">
        {{ $label }}
        @if ($isActive)
            @if ($currentSortOrder == 'asc')
                <i class="fas fa-arrow-down"></i>
            @else
                <i class="fas fa-arrow-up"></i>
            @endif
        @endif
    </a>
</th>
