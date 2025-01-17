@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-grey">
                Subject Information
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $subject->name }}</td>
                        </tr>
                        <tr>
                            <th>Course Name</th>
                            <td>{{ $subject->course->name }}</td>
                        </tr>
                        <tr>
                            <th>Total Lessons</th>
                            <td>{{ $subject->lessons ? count($subject->lessons) : 0 }} lessons</td>
                        </tr>
                        @if (isset($subject->lessons) && count($subject->lessons) > 0)
                            <tr>
                                <th>Lessons List</th>
                                <td>
                                    <ul>
                                        @foreach ($subject->lessons as $lesson)
                                            <li><a href="{{ route('lessons.show', $lesson->id )}}"/>{{ $lesson->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('lessons.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
