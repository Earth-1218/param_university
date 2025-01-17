@php
    $recordPrefix = 'students';
    $id = $student->id;
@endphp
<div class="btn-group" role="group" aria-label="{{ $recordPrefix }} Actions">
    <!-- Show Button -->
    <a title="View" href="{{ route($recordPrefix . '.show', $id) }}" class="btn btn-success btn-sm">
        <i class="fas fa-eye"></i>
    </a>

    <!-- Edit Button -->
    <a title="Edit" href="{{ route($recordPrefix . '.edit', $id) }}" class="btn btn-primary btn-sm ml-2">
        <i class="fas fa-edit"></i>
    </a>

    <!-- Delete Button -->
    <button title="Delete" type="button" class="btn btn-danger btn-sm ml-2" href="#confirm"
        data-id="{{ $id }}"
        onclick="event.preventDefault();    
             $('#confirm').modal('show').find('input[name=id]').val('{{ $id }}');
             $('#confirm').find('form')
             .prop('action', '{{ route($recordPrefix . '.destroy', $id) }}')
             .prop('method', 'DELETE')">
        <i class="fas fa-trash"></i>
    </button>

    <!-- Include Delete Confirmation Modal -->
    @include('common.delete-confirmation')
</div>
