@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between">
                            <p>Categories</p>
                            <a href="{{ route('categories.add') }}" class="btn btn-primary">{{ __('Add Category') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.perpage')
                            @include('common.search')
                        </div>

                        <div class="table-responsive">
                            <table id="categories-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Created Date</th>
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
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.entries', ['records' => $categories])
                            @include('common.pagination', ['records' => $categories])
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
                'records_prefix' => 'categories',
                'columns' => [
                    ['data' => 'id', 'name' => 'id'],
                    ['data' => 'name', 'name' => 'name'],
                    ['data' => 'created_at', 'name' => 'created_at'],
                    ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
                ],
            ];
        @endphp
        @include('common.datatable', $options);
    @endpush
@endsection
