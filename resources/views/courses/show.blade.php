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
                        <th width="30%">ID</th>
                        <td width="70%">{{ $course->id }}</td>
                    </tr>
                    <tr>
                        <th>Course Name</th>
                        <td>{{ $course->name }}</td>
                    </tr>
                    <tr>
                        <th>Created Date</th>
                        <td>{{ $course->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('courses.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection
