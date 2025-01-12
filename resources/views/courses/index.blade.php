@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between">
                            <p>Courses</p>
                            <a href="{{ route('courses.add') }}" class="btn btn-primary">{{ __('Add Course') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.perpage')
                            @include('common.search')
                        </div>

                        <div class="table-responsive">
                            <table id="courses-table" class=" table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        {{-- <th>Category ID</th> --}}
                                        <th>Name</th>
                                        <th>Tenure</th>
                                        <th>Semester</th>
                                        <th>Fees</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="records-table">
                                </tbody>
                                <tbody style="width:100%; display:none;" class="records-loader">
                                    <tr>
                                        <td colspan="6">
                                            <div class="records-loader text-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        {{-- <th>Category ID</th> --}}
                                        <th>Name</th>
                                        <th>Tenure</th>
                                        <th>Semester</th>
                                        <th>Fees</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.entries', ['records' => $courses])
                            @include('common.pagination', ['records' => $courses])
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
                'records_prefix' => 'courses',
                'columns' => [
                    ['data' => 'id', 'name' => 'id'],
                    // ['data' => 'category_id', 'name' => 'category_id'],
                    ['data' => 'name', 'name' => 'name'],
                    ['data' => 'tenure', 'name' => 'tenure'],
                    ['data' => 'semester', 'name' => 'semester'],
                    ['data' => 'fees', 'name' => 'fees'],
                    ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
                ],
            ];
        @endphp
        @include('common.datatable', $options);
    @endpush
@endsection
