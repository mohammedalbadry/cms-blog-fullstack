@if ($paginator->hasPages())
<div class="flex-wr-s-c m-rl--7 p-t-15">
    @if($paginator->lastPage() < 6)
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <a href="{{ $paginator->url($i) }}" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 {{ ($paginator->currentPage() == $i) ? 'pagi-active' : '' }}">{{ $i }}</a>
        @endfor
    @else
        @if($paginator->currentPage() < 3)
            @for ($i = 1; $i <= $paginator->currentPage() + 3; $i++)
                <a href="{{ $paginator->url($i) }}" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 {{ ($paginator->currentPage() == $i) ? 'pagi-active' : '' }}">{{ $i }}</a>
            @endfor
        @else
            @for ($i = $paginator->currentPage() - 3 ; $i <= $paginator->currentPage() + 3; $i++)
                <a href="{{ $paginator->url($i) }}" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 {{ ($paginator->currentPage() == $i) ? 'pagi-active' : '' }}">{{ $i }}</a>
                @break($paginator->lastPage() == $i)
            @endfor
        @endif
    @endif
</div>
@endif

