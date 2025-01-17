@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-grey">
            Student Information
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr >
                        <th width="30%">ID</th>
                        <td width="70%">{{ $student->id }}</td>
                    </tr>
                    <tr>
                        <th>Enrollment No</th>
                        <td>{{ $student->enrollment_no }}</td>
                    </tr>
                    <tr>
                        <th>Course ID</th>
                        <td>{{ $student->course_id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <th>Father's Name</th>
                        <td>{{ $student->father_name }}</td>
                    </tr>
                    <tr>
                        <th>Mother's Name</th>
                        <td>{{ $student->mother_name }}</td>
                    </tr>
                    <tr>
                        <th>Aadhaar No</th>
                        <td>{{ $student->aadhaar_no }}</td>
                    </tr>
                    <tr>
                        <th>Mobile No</th>
                        <td>{{ $student->mobile_no }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $student->email }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $student->gender }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ \Carbon\Carbon::parse($student->dob)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>About</th>
                        <td>{{ $student->about }}</td>
                    </tr>
                    <tr>
                        <th>Marital Status</th>
                        <td>{{ $student->merital_status }}</td>
                    </tr>
                    <tr>
                        <th>Joining Date</th>
                        <td>{{ $student->joining_date }}</td>
                    </tr>
                    <tr>
                        <th>Departure Date</th>
                        <td>{{ $student->departure_date }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('students.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection
