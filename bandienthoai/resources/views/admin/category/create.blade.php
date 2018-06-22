@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Create new category</h1>
        </div>
        <!--End Page Header -->
    </div>
    <div class="row">
        <div class="col-lg-3">
            <form action="{{ url('admin/category') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label>Name: </label><input class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Add">
                </div>
            </form>
        </div>
    </div>
@endsection