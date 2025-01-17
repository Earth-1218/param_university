@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between">
                            <p>lectures</p>
                            <a href="{{ route('lectures.add') }}" class="btn btn-primary">{{ __('Add Lecture') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.perpage')
                            @include('common.search')
                        </div>

                        <div class="table-responsive">
                            <table id="lectures-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Lesson Name</th>
                                        <th>Faculty Name</th>
                                        <th>Course Name</th>
                                        <th>Subject Name</th>
                                        <th>Duration</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="loader-row" style="display: none;">
                                        <td colspan="4" class="text-center">
                                            <div id="loader" style="text-align: center;">
                                                <p>Loading...</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Lesson Name</th>
                                        <th>Faculty Name</th>
                                        <th>Course Name</th>
                                        <th>Subject Name</th>
                                        <th>Duration</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.entries', ['records' => $lectures])
                            @include('common.pagination', ['records' => $lectures])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
    @endpush
    @push('scripts')
        @php
            $options = [
                'records_prefix' => 'lectures',
                'columns' => [
                    ['data' => 'id', 'name' => 'id'],
                    ['data' => 'lesson_name', 'name' => 'lesson_name'],
                    ['data' => 'faculty_name', 'name' => 'faculty_name'],
                    ['data' => 'course_name', 'name' => 'course_name'],
                    ['data' => 'subject_name', 'name' => 'subject_name'],
                    ['data' => 'duration', 'name' => 'duration'],
                    ['data' => 'comments', 'name' => 'comments'],
                    ['data' => 'status', 'name' => 'status'],
                    ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false]
                ]
            ];
        @endphp
        @include('common.datatable', $options);
    @endpush
@endsection
