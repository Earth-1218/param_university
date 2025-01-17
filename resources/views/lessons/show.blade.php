@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-grey">
            Lesson Information
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="30%">ID</th>
                        <td width="70%">{{ $lesson->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $lesson->name }}</td>
                    </tr>
                    <tr>
                        <th>Subject Name</th>
                        <td>{{ $lesson->subject->name }}</td>
                    </tr>
                    <tr>
                        <th>Course Name</th>
                        <td>{{ $lesson->subject->course->name }}</td>
                    </tr>
                    <tr>
                        <th>Headline</th>
                        <td>{{ $lesson->headline }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $lesson->description }}</td>
                    </tr>
                    <tr>
                        <th>Notes</th>
                        <td>{{ $lesson->notes }}</td>
                    </tr>
                    <tr>
                        <th>Downloadable PDF</th>
                        <td><a class="btn btn-success" href="{{ $lesson->downloadable_pdf }}" />Download Lesson</a></td>
                    </tr>
                    <tr>
                        <th>Created Date</th>
                        <td>{{ $lesson->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('lessons.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection
