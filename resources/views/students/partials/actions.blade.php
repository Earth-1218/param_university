<div class="btn-group" role="group" aria-label="Student Actions">
    <!-- Show Button -->
    <a title="View" href="{{ route('students.show', $student->id) }}" class="btn btn-success btn-sm">
        <i class="fas fa-eye"></i>
    </a>

    <!-- Edit Button -->
    <a title="Edit" href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm ml-2">
        <i class="fas fa-edit"></i>
    </a>

    <!-- Delete Button -->
    <form  action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button title="Delete" type="submit" class="btn btn-danger btn-sm ml-2"
            onclick="event.preventDefault(); $('#confirm').modal('show');">
            <i class="fas fa-trash"></i>
        </button>
    </form>
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirmLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="$('#confirm').modal('hide');">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete">Delete</button>
                    <button type="button" class="btn btn-secondary" onclick="$('#confirm').modal('hide');" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('button[name="remove_levels"]').on('click', function(e) {
        var $form = $(this).closest('form');
        e.preventDefault();
        $('#confirm').modal({
                backdrop: 'static',
                keyboard: false
            })
            .on('click', '#delete', function(e) {
                $form.trigger('submit');
            });
        $("#cancel").on('click', function(e) {
            e.preventDefault();
            $('#confirm').modal.model('hide');
        });
    });
</script>
