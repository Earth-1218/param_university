@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-grey">
            Category Information
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr >
                        <th width="30%">Id</th>
                        <td width="70%">{{ $category->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>Category Date</th>
                        <td>{{ $category->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection
