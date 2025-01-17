@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-grey">
            {{ isset($faculty) ? 'Edit faculty Information' : 'Add faculty Information' }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($faculty) ? route('faculties.update', $faculty->id) : route('faculties.store') }}">
                @csrf
                @if(isset($faculty))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="course_id">Course</label>
                    <select name="course_id" id="course_id" class="form-control">
                        @foreach(App\Models\Course::all() as $course)
                            <option value="{{ $course->id }}" {{ isset($faculty) && $faculty->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject_id">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control">
                        @foreach(App\Models\Subject::all() as $subject)
                            <option value="{{ $subject->id }}" {{ isset($faculty) && $faculty->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control" value="{{ isset($faculty) ? $faculty->dob : '' }}">
                </div>
                <div class="form-group">
                    <label for="joining_date">Joining Date</label>
                    <input type="date" name="joining_date" id="joining_date" class="form-control" value="{{ isset($faculty) ? $faculty->joining_date : '' }}">
                </div>
                <div class="form-group">
                    <label for="departure_date">Departure Date</label>
                    <input type="date" name="departure_date" id="departure_date" class="form-control" value="{{ isset($faculty) ? $faculty->departure_date : '' }}">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="male" {{ isset($faculty) && $faculty->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ isset($faculty) && $faculty->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="merital_status">Marital Status</label>
                    <select name="merital_status" id="merital_status" class="form-control">
                        <option value="married" {{ isset($faculty) && $faculty->merital_status == 'married' ? 'selected' : '' }}>Married</option>
                        <option value="unmarried" {{ isset($faculty) && $faculty->merital_status == 'unmarried' ? 'selected' : '' }}>Unmarried</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('faculties.index')}}" class="btn btn-primary">Back to List</a>
                    <button type="submit" class="btn btn-success">{{ isset($faculty) ? 'Update faculty' : 'Add faculty' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
