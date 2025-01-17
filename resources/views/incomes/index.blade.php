@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between">
                            <p>Incomes</p>
                            <a href="{{ route('incomes.add') }}" class="btn btn-primary">{{ __('Add Income') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.perpage')
                            @include('common.search')
                        </div>

                        <div class="table-responsive">
                            <table id="incomes-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>sponsor_id</th>
                                        <th>category</th>
                                        <th>remarks</th>
                                        <th>date</th>
                                        <th>payment_instrument</th>
                                        <th>payment_through</th>
                                        <th>payment_ref_no</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="loader-row" style="display: none;">
                                        <td colspan="4" class="text-center">
                                            <div id="loader" style="text-align: center;">
                                                <p>Loading...</p>
                                            </div>
                                        </th>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>sponsor_id</th> 
                                        <th>category</th>   
                                        <th>remarks</th>    
                                        <th>date</th>   
                                        <th>payment_instrument</th> 
                                        <th>payment_through</th>    
                                        <th>payment_ref_no</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.entries', ['records' => $incomes])
                            @include('common.pagination', ['records' => $incomes])
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
                'records_prefix' => 'incomes',
                'columns' => [
                    ['data' => 'sponsor_id', 'name' => 'sponsor_id'],
                    ['data' => 'category', 'name' => 'category'],
                    ['data' => 'remarks', 'name' => 'remarks'],
                    ['data' => 'date', 'name' => 'date'],
                    ['data' => 'payment_instrument', 'name' => 'payment_instrument'],
                    ['data' => 'payment_through', 'name' => 'payment_through'],
                    ['data' => 'payment_ref_no', 'name' => 'payment_ref_no'],
                    ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
                ],
            ];
        @endphp
        @include('common.datatable', $options);
    @endpush
@endsection
