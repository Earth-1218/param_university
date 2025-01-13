@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-grey">
            {{ isset($managementstaff) ? 'Edit Staff Information' : 'Add Staff Information' }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($managementstaff) ? route('management-staff.update', $managementstaff->id) : route('management-staff.store') }}">
                @csrf
                @if(isset($managementstaff))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $managementstaff->name ?? '') }}" placeholder="Enter name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mobile_no" class="form-label">Mobile No</label>
                    <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $managementstaff->mobile_no ?? '') }}" placeholder="Enter mobile number" required>
                    @error('mobile_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $managementstaff->email ?? '') }}" placeholder="Enter email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $managementstaff->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $managementstaff->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $managementstaff->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', $managementstaff->dob ?? '') }}" placeholder="Enter date of birth" required>
                    @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="about" class="form-label">About</label>
                    <textarea class="form-control @error('about') is-invalid @enderror" id="about" name="about" placeholder="Enter about" required>{{ old('about', $managementstaff->about ?? '') }}</textarea>
                    @error('about')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <select class="form-select @error('department') is-invalid @enderror" id="department" name="department" required>
                        <option value="">Select Department</option>
                        <option value="HOD" {{ old('department', $managementstaff->department ?? '') == 'hod' ? 'selected' : '' }}>HOD</option>
                        <option value="Trustie" {{ old('department', $managementstaff->department ?? '') == 'trustie' ? 'selected' : '' }}>Trustie</option>
                        <option value="Peon" {{ old('department', $managementstaff->department ?? '') == 'peon' ? 'selected' : '' }}>Peon</option>
                        <option value="Accountant" {{ old('department', $managementstaff->department ?? '') == 'accountant' ? 'selected' : '' }}>Accountant</option>
                        <option value="Librarien" {{ old('department', $managementstaff->department ?? '') == 'librarien' ? 'selected' : '' }}>Librarien</option>
                        <option value="Security Guard" {{ old('department', $managementstaff->department ?? '') == 'security_guard' ? 'selected' : '' }}>Security Guard</option>
                        <option value="Driver" {{ old('department', $managementstaff->department ?? '') == 'driver' ? 'selected' : '' }}>Driver</option>
                    </select>
                    @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="joining_date" class="form-label">Joining Date</label>
                    <input type="date" class="form-control @error('joining_date') is-invalid @enderror" id="joining_date" name="joining_date" value="{{ old('joining_date', $managementstaff->joining_date ?? '') }}" placeholder="Enter joining date" required>
                    @error('joining_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('management-staff.index') }}" class="btn btn-primary" />Back to Staff</a>
                    <button type="submit" class="btn btn-success">{{ isset($managementstaff) ? 'Update Student' : 'Add Staff' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
