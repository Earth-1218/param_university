   {{-- Custom Pagination --}}
   @if ($records->hasPages())
   <nav aria-label="Page navigation">
       <ul class="pagination justify-content-end">
           {{-- First Page Link --}}
           <li class="page-item {{ $records->onFirstPage() ? 'disabled' : '' }}">
               <a class="page-link" href="{{ $records->url(1) }}">First</a>
           </li>

           {{-- Previous Page Link --}}
           <li class="page-item {{ $records->onFirstPage() ? 'disabled' : '' }}">
               <a class="page-link" href="{{ $records->previousPageUrl() }}" rel="prev">Previous</a>
           </li>

           {{-- Pagination Elements --}}
           @foreach (range(1, $records->lastPage()) as $page)
               @if ($page == $records->currentPage())
                   <li class="page-item active">
                       <span class="page-link">{{ $page }}</span>
                   </li>
               @elseif (
                   $page === 1 ||
                   $page === $records->lastPage() ||
                   ($page >= $records->currentPage() - 2 && $page <= $records->currentPage() + 2)
               )
                   <li class="page-item">
                       <a class="page-link" href="{{ $records->url($page) }}">{{ $page }}</a>
                   </li>
               @elseif ($page === $records->currentPage() - 3 || $page === $records->currentPage() + 3)
                   <li class="page-item disabled">
                       <span class="page-link">...</span>
                   </li>
               @endif
           @endforeach

           {{-- Next Page Link --}}
           <li class="page-item {{ !$records->hasMorePages() ? 'disabled' : '' }}">
               <a class="page-link" href="{{ $records->nextPageUrl() }}" rel="next">Next</a>
           </li>

           {{-- Last Page Link --}}
           <li class="page-item {{ !$records->hasMorePages() ? 'disabled' : '' }}">
               <a class="page-link" href="{{ $records->url($records->lastPage()) }}">Last</a>
           </li>
       </ul>
   </nav>
@endif