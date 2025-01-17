@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between">
                            <p>Lessons</p>
                            <a href="{{ route('lessons.add') }}" class="btn btn-primary">{{ __('Add Lesson') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.perpage')
                            @include('common.search')
                        </div>

                        <div class="table-responsive">
                            <table id="lessons-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Subject ID</th>
                                        <th>Name</th>
                                        <th>Headline</th>
                                        <th>Description</th>
                                        <th>Notes</th>
                                        <th>Downloadable PDF</th>
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
                                        <th>Subject ID</th>
                                        <th>Name</th>
                                        <th>Headline</th>
                                        <th>Description</th>
                                        <th>Notes</th>
                                        <th>Downloadable PDF</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.entries', ['records' => $lessons])
                            @include('common.pagination', ['records' => $lessons])
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
                'records_prefix' => 'lessons',
                'columns' => [
                    ['data' => 'subject_id', 'name' => 'subject_id'],
                    ['data' => 'name', 'name' => 'name'],
                    ['data' => 'headline', 'name' => 'headline'],
                    ['data' => 'description', 'name' => 'description'],
                    ['data' => 'notes', 'name' => 'notes'],
                    ['data' => 'downloadable_pdf', 'name' => 'downloadable_pdf'],
                    ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false]
                ],
            ];
        @endphp
        @include('common.datatable', $options);
    @endpush
@endsection
