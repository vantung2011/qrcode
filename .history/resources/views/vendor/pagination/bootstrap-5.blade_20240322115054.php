@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @php
                $currentPage = $paginator->currentPage();
                $showDots = $currentPage > 15;
            @endphp

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $indexPage => $url)
                    @if ($indexPage <= 4 || $indexPage == $paginator->lastPage() || ($showDots && $indexPage >= $currentPage - 1 && $indexPage <= $currentPage + 1))
                        @if ($indexPage == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $indexPage }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $indexPage }}</a>
                            </li>
                        @endif
                    @elseif ($indexPage == $currentPage - 2 || $indexPage == $currentPage + 2)
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
s