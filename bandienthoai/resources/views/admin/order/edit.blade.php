@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Edit "{{ $order->name }}" order</h1>
        </div>
        <!--End Page Header -->
    </div>
    @if(isset($errors))
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="col-lg-6">
            {!! Form::model($order, ['url' => 'admin/order/'.$order->id, 'method' => 'patch']) !!}
            <div class="form-group">
                <label>User  id: </label>{!! Form::text('user_id', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Name: </label>{!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Gender: </label>{!! Form::text('gender', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Address: </label>{!! Form::text('address', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Phone: </label>{!! Form::text('phone', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Email: </label>{!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Total: </label>{!! Form::text('total', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Payment: </label>{!! Form::text('payment', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Status: </label>{!! Form::select('status', [1 => '1', 0 => '0'], null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Save">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection