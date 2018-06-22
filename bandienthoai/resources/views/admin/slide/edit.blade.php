@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Edit slide</h1>
        </div>
        <!--End Page Header -->
    </div>
    <div class="row">
        {!! Form::open(['url' => 'admin/slide/'.$slide->id, 'method' => 'patch', 'files' => true]) !!}
        <div class="col-lg-6">
            <div class="form-group">
                <label>Select a image: </label>{!! Form::file('slide') !!}
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Save">
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection