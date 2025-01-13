@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-grey">
            {{ isset($student) ? 'Edit Student Information' : 'Add Student Information' }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}">
                @csrf
                @if(isset($student))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="enrollment_no" class="form-label">Enrollment No</label>
                    <input type="text" class="form-control @error('enrollment_no') is-invalid @enderror" id="enrollment_no" name="enrollment_no" value="{{ old('enrollment_no', $student->enrollment_no ?? '') }}" placeholder="Enter enrollment number" required>
                    @error('enrollment_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="course_id" class="form-label">Course ID</label>
                    <input type="text" class="form-control @error('course_id') is-invalid @enderror" id="course_id" name="course_id" value="{{ old('course_id', $student->course_id ?? '') }}" placeholder="Enter course ID" required>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Student Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $student->name ?? '') }}" placeholder="Enter student name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="father_name" class="form-label">Father's Name</label>
                    <input type="text" class="form-control @error('father_name') is-invalid @enderror" id="father_name" name="father_name" value="{{ old('father_name', $student->father_name ?? '') }}" placeholder="Enter father's name" required>
                    @error('father_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mother_name" class="form-label">Mother's Name</label>
                    <input type="text" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name" name="mother_name" value="{{ old('mother_name', $student->mother_name ?? '') }}" placeholder="Enter mother's name" required>
                    @error('mother_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="aadhaar_no" class="form-label">Aadhaar No</label>
                    <input type="text" class="form-control @error('aadhaar_no') is-invalid @enderror" id="aadhaar_no" name="aadhaar_no" value="{{ old('aadhaar_no', $student->aadhaar_no ?? '') }}" placeholder="Enter Aadhaar number" required>
                    @error('aadhaar_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mobile_no" class="form-label">Mobile No</label>
                    <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $student->mobile_no ?? '') }}" placeholder="Enter mobile number" required>
                    @error('mobile_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $student->email ?? '') }}" placeholder="Enter email address" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                        <option value="" disabled {{ old('gender', $student->gender ?? '') == '' ? 'selected' : '' }}>Select gender</option>
                        <option value="Male" {{ old('gender', $student->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $student->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', $student->dob ?? '') }}" placeholder="Select date of birth" required>
                    @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="about" class="form-label">About</label>
                    <textarea class="form-control @error('about') is-invalid @enderror" id="about" name="about" rows="3" placeholder="Write about the student" required>{{ old('about', $student->about ?? '') }}</textarea>
                    @error('about')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="merital_status" class="form-label">Marital Status</label>
                    <select class="form-select @error('merital_status') is-invalid @enderror" id="merital_status" name="merital_status" required>
                        <option value="" disabled {{ old('merital_status', $student->merital_status ?? '') == '' ? 'selected' : '' }}>Select marital status</option>
                        <option value="unmarried" {{ old('merital_status', $student->merital_status ?? '') == 'unmarried' ? 'selected' : '' }}>Single</option>
                        <option value="married" {{ old('merital_status', $student->merital_status ?? '') == 'married' ? 'selected' : '' }}>Married</option>
                    </select>
                    @error('merital_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="joining_date" class="form-label">Joining Date</label>
                    <input type="date" class="form-control @error('joining_date') is-invalid @enderror" id="joining_date" name="joining_date" value="{{ old('joining_date', isset($student->joining_date) ? \Carbon\Carbon::parse($student->joining_date)->format('Y-m-d') : '') }}" required>
                    @error('joining_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="departure_date" class="form-label">Departure Date</label>
                    <input type="date" class="form-control @error('departure_date') is-invalid @enderror" id="departure_date" name="departure_date" value="{{ old('departure_date', isset($student->departure_date) ? \Carbon\Carbon::parse($student->departure_date)->format('Y-m-d') : '') }}" required>
                    @error('departure_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('students.index') }}" class="btn btn-primary" />Back to Students</a>
                    <button type="submit" class="btn btn-success">{{ isset($student) ? 'Update Student' : 'Add Student' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
