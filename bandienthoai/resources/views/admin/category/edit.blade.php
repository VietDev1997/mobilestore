@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Edit "{{ $category->name }}" category</h1>
        </div>
        <!--End Page Header -->
    </div>
    <div class="row">
        <div class="col-lg-3">
            {!! Form::model($category, ['url' => 'admin/category/'.$category->id, 'method' => 'patch']) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Name: </label><input class="form-control" type="text" name="name" value="{{ $category->name }}">
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Save">
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection