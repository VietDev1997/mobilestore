@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Edit "{{ $product->name }}" Product</h1>
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
        {!! Form::model($product, ['url' => 'admin/product/'.$product->id, 'method' => 'patch', 'files' => true]) !!}
        <div class="col-lg-6">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h4 class="page-header">Information</h4>
                </div>
                <!--End Page Header -->
            </div>
            <div class="form-group">
                <label>Thể
                    loại: </label>{!! Form::select('category_id', $category, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Name: </label>{!! Form::text('name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('name', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Price: </label>{!! Form::text('price', null, ['class' => 'form-control']) !!}
                {!! $errors->first('price', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Discount: </label>{!! Form::text('discount', null, ['class' => 'form-control', 'placeholder' => 'default 0%']) !!}
            </div>
            <div class="form-group">
                <label>Thumbnail (size: 400 x 460) (select a image): </label>
                <div class="form-group"><img src="{{ asset('uploads/product/thumbnail/'.$product->thumbnail) }}"
                                             width="100"
                                             height="100">
                </div>
                {!! Form::file('thumbnail') !!}
            </div>

            <div class="form-group">
                <div><label>Images (can select multiple images):</label></div>
                <div class="form-group">
                    @foreach($product->image as $item)
                        <img src="{{ asset('uploads/product/images/'.$item->name) }}"
                             width="100"
                             height="100">
                    @endforeach
                </div>
                {!! Form::file('images[]' , ['multiple']) !!}
            </div>
            <div class="form-group">
                <label>Description: </label>{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5']) !!}
            </div>
            <div class="form-group">
                <label>Detailed
                    description: </label>{!! Form::textarea('detailed_description', null, ['class' => 'form-control', 'rows' => '5']) !!}
            </div>
            <div class="form-group">
                <label>Status: </label>{!! Form::select('status', [1 => '1', 0 => '0'], null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Save">
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
                <label>Screen: </label>{!! Form::text('screen', $product->config->screen, ['class' => 'form-control']) !!}
                {!! $errors->first('screen', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Operating
                    system: </label>{!! Form::text('operating_system', $product->config->operating_system, ['class' => 'form-control']) !!}
                {!! $errors->first('operating_system', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Front
                    camera: </label>{!! Form::text('front_camera', $product->config->front_camera, ['class' => 'form-control']) !!}
                {!! $errors->first('front_camera', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>Rear
                    camera: </label>{!! Form::text('rear_camera', $product->config->rear_camera, ['class' => 'form-control']) !!}
                {!! $errors->first('rear_camera', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    :message
                </div>') !!}
            </div>
            <div class="form-group">
                <label>CPU: </label>{!! Form::text('cpu', $product->config->cpu, ['class' => 'form-control']) !!}
                {!! $errors->first('cpu', '<div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   :message
               </div>') !!}
            </div>
            <div class="form-group">
                <label>RAM: </label>{!! Form::text('ram', $product->config->ram, ['class' => 'form-control']) !!}
                {!! $errors->first('ram', '<div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   :message
               </div>') !!}
            </div>
            <div class="form-group">
                <label>Internal
                    memory: </label>{!! Form::text('internal_memory', $product->config->internal_memory, ['class' => 'form-control']) !!}
                {!! $errors->first('internal_memory', '<div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   :message
               </div>') !!}
            </div>
            <div class="form-group">
                <label>SIM: </label>{!! Form::text('sim', $product->config->sim, ['class' => 'form-control']) !!}
                {!! $errors->first('sim', '<div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   :message
               </div>') !!}
            </div>
            <div class="form-group">
                <label>Battery
                    capacity: </label>{!! Form::text('battery_capacity', $product->config->battery_capacity, ['class' => 'form-control']) !!}
                {!! $errors->first('battery_capacity', '<div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   :message
               </div>') !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection