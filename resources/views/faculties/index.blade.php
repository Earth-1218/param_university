@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between">
                            <p>Faculties</p>
                            <a href="{{ route('faculties.add') }}" class="btn btn-primary">{{ __('Add Faculty') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.perpage')
                            @include('common.search')
                        </div>

                        <div class="table-responsive">
                            <table id="faculties-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>id</td>
                                        <th>name</td>
                                        <th>course_name</td>
                                        <th>subject_name</td>
                                        <th>mobile_no</td>
                                        <th>gender</td>
                                        <th>joining_date</td>
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
                                        <th>id</td>
                                        <th>name</td>
                                        <th>course_name</td>
                                        <th>subject_name</td>
                                        <th>mobile_no</td>
                                        <th>gender</td>
                                        <th>joining_date</td>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.entries', ['records' => $faculties])
                            @include('common.pagination', ['records' => $faculties])
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
                'records_prefix' => 'faculties',
                'columns' => [
                    ['data' => 'id', 'name' => 'id'],
                    ['data' => 'name', 'name' => 'name'],
                    ['data' => 'course_name', 'name' => 'course_name'],
                    ['data' => 'subject_name', 'name' => 'subject_name'],
                    ['data' => 'mobile_no', 'name' => 'mobile_no'],
                    ['data' => 'gender', 'name' => 'gender'],
                    ['data' => 'joining_date', 'name' => 'joining_date'],
                    ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
                ],
            ];
        @endphp
        @include('common.datatable', $options);
    @endpush
@endsection
