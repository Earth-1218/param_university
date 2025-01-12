@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-12">
                <div class="card mt-3" >
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <p>Students</p>
                            <a href="{{ route('students.add') }}" class="btn btn-primary">{{ __('Add Student') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.perpage')
                            @include('common.search')
                        </div>
                        <div class="table-responsive">
                            <table id="students-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Enrollment No</th>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Joining Date</th>
                                        <th>Departure Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="records-table">
                                </tbody>
                                <tbody style="width:100%; display:none;" class="records-loader">
                                    <tr>
                                        <td colspan="8">
                                            <div class="text-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Enrollment No</th>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Joining Date</th>
                                        <th>Departure Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                            @include('common.entries', ['records' => $students])
                            @include('common.pagination', ['records' => $students])
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
                'records_prefix' => 'students',
                'columns' => [
                    ['data' => 'enrollment_no', 'name' => 'enrollment_no'],
                    ['data' => 'name', 'name' => 'name'],
                    ['data' => 'mobile_no', 'name' => 'mobile_no'],
                    ['data' => 'email', 'name' => 'email'],
                    ['data' => 'gender', 'name' => 'gender'],
                    ['data' => 'joining_date', 'name' => 'joining_date'],
                    ['data' => 'departure_date', 'name' => 'departure_date'],
                    ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
                ],
            ];
        @endphp
        @include('common.datatable', $options);
    @endpush
@endsection
