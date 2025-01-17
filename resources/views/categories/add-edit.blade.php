@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-grey">
            {{ isset($category) ? 'Edit category Information' : 'Add category Information' }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="Enter category name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to List</a>
                    <button type="submit" class="btn btn-success">{{ isset($category) ? 'Update Category' : 'Add Category' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
