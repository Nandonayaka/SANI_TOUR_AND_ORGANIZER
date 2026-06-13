@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-link" style="opacity: 0.5; cursor: not-allowed;">&laquo; Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link" rel="prev">&laquo; Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="pagination-link" style="opacity: 0.5;">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link" rel="next">Next &raquo;</a>
        @else
            <span class="pagination-link" style="opacity: 0.5; cursor: not-allowed;">Next &raquo;</span>
        @endif
    </div>
@endif
