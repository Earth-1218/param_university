@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-grey">
            {{ isset($subject) ? 'Edit Subject Information' : 'Add Subject Information' }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($subject) ? route('subjects.update', $subject->id) : route('subjects.store') }}">
                @csrf
                @if(isset($subject))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Subject Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $subject->name ?? '') }}" placeholder="Enter Subject name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="course_id" class="form-label">Course</label>
                    <select class="form-control @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                        @foreach(App\Models\Course::all() as $course)
                            <option value="{{ $course->id }}" {{ old('course_id', $subject->course_id ?? '') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                     <div class="mb-3">
                    <label for="semester" class="form-label">semester</label>
                    <input type="number" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" value="{{ old('semester', $subject->semester ?? '') }}" placeholder="Enter semester" required>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('lessons.index') }}" class="btn btn-primary">Back to List</a>
                    <button type="submit" class="btn btn-success">{{ isset($subject) ? 'Update Subject' : 'Add Subject' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
