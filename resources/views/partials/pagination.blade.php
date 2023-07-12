@if (!$datosPaginados->isEmpty())
<nav class="row mt-3">
    <div class="col-12 col-md-4 text-center text-md-start mb-3">
        @include('partials.info')
    </div>
    <div class="col-12 col-md-8 text-end">
        <ul class="pagination justify-content-center justify-content-md-end">
            <li class="page-item{{ $datosPaginados->previousPageUrl() ? '' : ' disabled' }}">
                <a class="page-link" href="{{ $datosPaginados->previousPageUrl() }}{{ !empty(request()->query()) ? '&'.http_build_query(request()->except('page')) : '' }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            @if($datosPaginados->currentPage() > 3)
                <li class="page-item">
                    <a class="page-link" href="{{ $datosPaginados->url(1) }}{{ !empty(request()->query()) ? '&'.http_build_query(request()->except('page')) : '' }}">1</a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif

            @foreach ($datosPaginados->getUrlRange(max($datosPaginados->currentPage() - 2, 1), min($datosPaginados->currentPage() + 2, $datosPaginados->lastPage())) as $page => $url)
                <li class="page-item{{ $page === $datosPaginados->currentPage() ? ' active' : '' }}">
                    <a class="page-link" href="{{ $url }}{{ !empty(request()->query()) ? '&'.http_build_query(request()->except('page')) : '' }}">{{ $page }}</a>
                </li>
            @endforeach

            @if($datosPaginados->currentPage() < $datosPaginados->lastPage() - 2)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $datosPaginados->url($datosPaginados->lastPage()) }}{{ !empty(request()->query()) ? '?'.http_build_query(request()->except('page')) : '' }}">{{ $datosPaginados->lastPage() }}</a>
                </li>
            @endif

            <li class="page-item{{ $datosPaginados->hasMorePages() ? '' : ' disabled' }}">
                <a class="page-link" href="{{ $datosPaginados->nextPageUrl() }}{{ !empty(request()->query()) ? '&'.http_build_query(request()->except('page')) : '' }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
@endif