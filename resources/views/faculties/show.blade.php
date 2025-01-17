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
                    <tr>
                        <th width="30%">ID</th>
                        <td width="70%">{{ $faculty->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $faculty->name }}</td>
                    </tr>
                    <tr>
                        <th>Course Name</th>
                        <td>{{ $faculty->course_name }}</td>
                    </tr>
                    <tr>
                        <th>Subject Name</th>
                        <td>{{ $faculty->subject_name }}</td>
                    </tr>
                    <tr>
                        <th>Mobile No</th>
                        <td>{{ $faculty->mobile_no }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $faculty->email }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $faculty->gender }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ \Carbon\Carbon::parse($faculty->dob)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Marital Status</th>
                        <td>{{ $faculty->merital_status }}</td>
                    </tr>
                    <tr>
                        <th>Designation</th>
                        <td>{{ $faculty->designation }}</td>
                    </tr>
                    <tr>
                        <th>About</th>
                        <td>{{ $faculty->about }}</td>
                    </tr>
                    <tr>
                        <th>Joining Date</th>
                        <td>{{ $faculty->joining_date }}</td>
                    </tr>
                    <tr>
                        <th>Departure Date</th>
                        <td>{{ $faculty->departure_date }}</td>
                    </tr>
                    <tr>
                        <th>Experience</th>
                        <td>{{ $faculty->experience }}</td>
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
