@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card mt-3">
        <div class="card-header bg-grey">
            {{ isset($course) ? 'Edit Course Information' : 'Add Course Information' }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($course) ? route('courses.update', $course->id) : route('courses.store') }}">
                @csrf
                @if(isset($course))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category ID</label>
                    <input type="text"value="0" readonly class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" value="{{ old('category_id', $course->category_id ?? '') }}" placeholder="Enter category ID" required>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Course Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $course->name ?? '') }}" placeholder="Enter course name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tenure" class="form-label">Tenure</label>
                    <input type="text" class="form-control @error('tenure') is-invalid @enderror" id="tenure" name="tenure" value="{{ old('tenure', $course->tenure ?? '') }}" placeholder="Enter tenure" required>
                    @error('tenure')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="text" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" value="{{ old('semester', $course->semester ?? '') }}" placeholder="Enter semester" required>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fees" class="form-label">Fees</label>
                    <input type="text" class="form-control @error('fees') is-invalid @enderror" id="fees" name="fees" value="{{ old('fees', $course->fees ?? '') }}" placeholder="Enter fees" required>
                    @error('fees')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('courses.index') }}" class="btn btn-primary">Back to List</a>
                    <button type="submit" class="btn btn-success">{{ isset($course) ? 'Update Course' : 'Add Course' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
