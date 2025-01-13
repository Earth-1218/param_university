@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-grey">
            Student Information
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $student->name }}</td>
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
                        <th>Department</th>
                        <td>{{ $student->department }}</td>
                    </tr>
                    <tr>
                        <th>Joining Date</th>
                        <td>{{ $student->joining_date }}</td>
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
