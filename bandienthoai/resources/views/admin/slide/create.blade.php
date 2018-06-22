@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Create new slide</h1>
        </div>
        <!--End Page Header -->
    </div>
    <div class="row">
        {!! Form::open(['url' => 'admin/slide', 'method' => 'post', 'files' => true]) !!}
        <div class="col-lg-6">
            <div class="form-group">
                <label>Can select multiple images: </label>{!! Form::file('slides[]' , ['multiple']) !!}
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Add">
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection