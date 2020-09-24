@if ($paginator->hasPages())
<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item {{ $paginator->onFirstpage() ? "disabled" : "" }}">
            <a class="page-link" href="#" wire:click="previousPage" tabindex="-1">Previous</a>
        </li>
        @foreach ($elements as $element)
            <li class="page-item"><a class="page-link" href="#">1</a></li>
        @endforeach
        <li class="page-item {{ !$paginator->hasMorePages() ? "disabled" : "" }}">
            <a class="page-link" href="#" wire:click="nextPage">Next</a>
        </li>
    </ul>
</nav>
@endif
