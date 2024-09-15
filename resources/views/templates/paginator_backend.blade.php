@if ($paginator->hasPages())
<nav class="dataTable-pagination">
    <ul class="dataTable-pagination-list">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="pager disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">‹</a></li>
        @else
            <li class="pager"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">‹</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="pager disabled"></li><a class="page-link" href="#" tabindex="-1" aria-disabled="true">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pager active" aria-current="page"><a class="page-link" href="#">{{ $page }}</a></li>
                    @else
                        <li class="pager"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pager"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">›</a></li>
        @else
            <li class="pager disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">›</a></li>
        @endif
    </ul>
</nav>
@endif
