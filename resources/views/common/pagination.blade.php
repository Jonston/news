@php
    /**
     * @var \Illuminate\Pagination\LengthAwarePaginator $paginator
     */
@endphp
<nav>
    <ul class="pagination">
        <li class="page-item @if($paginator->onFirstPage()) disabled @endif">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a>
        </li>
        @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            <li class="page-item @if($page == $paginator->currentPage()) active @endif">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach
        <li class="page-item @if($paginator->onLastPage()) disabled @endif">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
