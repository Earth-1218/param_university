@php $recordPrefix = 'faculties'; $id = $faculty->id; @endphp
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
   <button
    title="Delete"
    type="button"
    class="btn btn-danger btn-sm ml-2"
    data-toggle="modal"
    data-target="#confirm"
    data-id="{{ $id }}"
    onclick="event.preventDefault();
             const modal = $('#confirm');
             modal.modal('show');
             modal.find('input[name=id]').val('{{ $id }}');
             modal.find('form').prop('action', '{{ route($recordPrefix . '.destroy', $id) }}');
            ">
    <i class="fas fa-trash"></i>
</button>


    <!-- Include Delete Confirmation Modal -->
    @include('common.delete-confirmation', [
        'route' => route($recordPrefix . '.destroy', $id)
    ])
</div>
