@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Create new product</h1>
        </div>
        <!--End Page Header -->
    </div>
    {{--    @if(isset($errors))
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif--}}
    <div class="row">
        {!! Form::open(['url' => 'admin/product', 'method' => 'post', 'files' => true]) !!}
        <div class="col-lg-6">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h4 class="page-header">Information</h4>
                </div>
                <!--End Page Header -->
            </div>
            <div class="form-group">
                <label>Category: </label>{!! Form::select('category_id', $category, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Name: </label><input class="form-control" type="text" name="name">
                {!! $errors->first('name', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Price: </label><input class="form-control" type="text" name="price">
                {!! $errors->first('price', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Discount: </label>{!! Form::text('discount', null, ['class' => 'form-control', 'placeholder' => 'default 0%']) !!}
            </div>
            <div class="form-group">
                <label>Thumbnail (size: 400 x 460) (select a image): </label>{!! Form::file('thumbnail') !!}
            </div>
            <div class="form-group">
                <label>Images (can select multiple images): </label>{!! Form::file('images[]' , ['multiple']) !!}
            </div>
            <div class="form-group">
                <label>Description: </label><textarea class="form-control" name="description" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Detailed description: </label><textarea class="form-control" name="detailed_description"
                                                               rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Status: </label>{!! Form::select('status', [1 => '1', 0 => '0'], null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Add">
            </div>
        </div>
        <div class="col-lg-6">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h4 class="page-header">Configurations</h4>
                </div>
                <!--End Page Header -->
            </div>
            <div class="form-group">
                <label>Screen: </label><input class="form-control" type="text" name="screen">
                {!! $errors->first('screen', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Operating system: </label><input class="form-control" type="text" name="operating_system">
                {!! $errors->first('operating_system', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Front camera: </label><input class="form-control" type="text" name="front_camera">
                {!! $errors->first('front_camera', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Rear camera: </label><input class="form-control" type="text" name="rear_camera">
                {!! $errors->first('rear_camera', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>CPU: </label><input class="form-control" type="text" name="cpu">
                {!! $errors->first('cpu', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>RAM: </label><input class="form-control" type="text" name="ram">
                {!! $errors->first('ram', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Internal memory: </label><input class="form-control" type="text" name="internal_memory">
                {!! $errors->first('internal_memory', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>SIM: </label><input class="form-control" type="text" name="sim">
                {!! $errors->first('sim', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Battery capacity: </label><input class="form-control" type="text" name="battery_capacity">
                {!! $errors->first('battery_capacity', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection