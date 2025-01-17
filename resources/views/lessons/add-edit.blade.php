@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-grey">
            {{ isset($lesson) ? 'Edit Lesson Information' : 'Add Lesson Information' }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($lesson) ? route('lessons.update', $lesson->id) : route('lessons.store') }}" enctype="multipart/form-data">
                @csrf
                @if(isset($lesson))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="subject_id" class="form-label">Subject ID</label>
                    <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                        <option value="" disabled {{ old('subject_id', $lesson->subject_id ?? '') == '' ? 'selected' : '' }}>Select subject</option>
                        @foreach(App\Models\Subject::all() as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $lesson->subject_id ?? '') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $lesson->name ?? '') }}" placeholder="Enter name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="headline" class="form-label">Headline</label>
                    <input type="text" class="form-control @error('headline') is-invalid @enderror" id="headline" name="headline" value="{{ old('headline', $lesson->headline ?? '') }}" placeholder="Enter headline" required>
                    @error('headline')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter description" required>{{ old('description', $lesson->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3" placeholder="Enter notes" required>{{ old('notes', $lesson->notes ?? '') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="downloadable_pdf" class="form-label">Downloadable PDF</label>
                    <input type="file" class="form-control @error('downloadable_pdf') is-invalid @enderror" id="downloadable_pdf" name="downloadable_pdf" required>
                    @error('downloadable_pdf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('lessons.index') }}" class="btn btn-primary">Back to List</a>
                    <button type="submit" class="btn btn-success">{{ isset($lesson) ? 'Update Lesson' : 'Add Lesson' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
