<div class="btn-group" role="group" aria-label="Student Actions">
    <!-- Show Button -->
    <a title="View"  href="{{ route('subjects.show', $subject->id) }}" class="btn btn-success btn-sm">
        <i class="fas fa-eye"></i> 
    </a>

    <!-- Edit Button -->
    <a title="Edit"  href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary btn-sm ml-2">
        <i class="fas fa-edit"></i> 
    </a>

    <!-- Delete Button -->
    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button title="Delete" type="submit" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to delete this subject?')">
            <i class="fas fa-trash"></i> 
        </button>
    </form>
</div>
