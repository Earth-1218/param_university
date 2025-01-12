@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between">
                            <p>Add Management Staff</p>
                            <a href="{{ route('management-staff.add') }}"
                                class="btn btn-primary">{{ __('Add Management Staff') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.perpage')
                            @include('common.search')
                        </div>

                        <div class="table-responsive">
                            <table id="management-staff-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Mobile no</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>About</th>
                                        <th>Department</th>
                                        <th>Joining Date</th>
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
                                        <th>Name</th>
                                        <th>Mobile no</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>About</th>
                                        <th>Department</th>
                                        <th>Joining Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.entries', ['records' => $managementstaff])
                            @include('common.pagination', ['records' => $managementstaff])
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
                'records_prefix' => 'management-staff',
                'columns' => [
                    ['data' => 'name', 'name' => 'name'],
                    ['data' => 'mobile_no', 'name' => 'mobile_no'],
                    ['data' => 'email', 'name' => 'email'],
                    ['data' => 'gender', 'name' => 'gender'],
                    ['data' => 'dob', 'name' => 'dob'],
                    ['data' => 'about', 'name' => 'about'],
                    ['data' => 'department', 'name' => 'department'],
                    ['data' => 'joining_date', 'name' => 'joining_date'],
                    ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
                ],
            ];
        @endphp
        @include('common.datatable', $options);
    @endpush
@endsection
