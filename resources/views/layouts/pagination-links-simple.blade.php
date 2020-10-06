@if ($paginator->hasPages())
<nav>
    <ul class="pagination d-flex">
        <li class="page-item {{ $paginator->onFirstpage() ? "disabled" : "" }}">
            <a class="page-link" href="#" wire:click.prevent="previousPage" tabindex="-1">Previous</a>
        </li>
        <li class="page-item flex-grow-1 text-center pt-2">
            Halaman {{ $paginator->currentPage() }} dari {{ ceil($paginator->total()/$paginator->perPage()) }} halaman
        </li>
        <li class="page-item {{ !$paginator->hasMorePages() ? "disabled" : "" }}">
            <a class="page-link" href="#" wire:click.prevent="nextPage">Next</a>
        </li>
    </ul>
</nav>
@endif
