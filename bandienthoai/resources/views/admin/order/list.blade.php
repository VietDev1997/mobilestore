@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Order List</h1>
        </div>
        <!--End Page Header -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!--   Kitchen Sink -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('admin/order/create') }}">Create new order</a>
                </div>
                <div class="col-lg-4">
                    <div class="form-group"></div>
                    <form action="{{ url('admin/order') }}" method="get">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..." name="keyword">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <div class="form-group"></div>
                </div>
                <div class="row">
                    <div></div>
                </div>
                <div class="panel-body">

                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>User id</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>OrderDetail</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @foreach($item->orderDetail as $key => $orderDetail)
                                            <b>No.{{ $key + 1 }} </b>
                                            <p>- Name: {{ $orderDetail->product->name }}</p>
                                            <p>- Quantity: {{ $orderDetail->quantity }}</p>
                                            <p>- Price: {{ number_format($orderDetail->price) }}</p>
                                            <p>- Color: {{ $orderDetail->color }}</p>
                                        @endforeach
                                    </td>
                                    <td>{{ number_format($item->total) }}</td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a class="btn btn-info"
                                           href="{{ url('admin/order/'.$item->id.'/edit') }}">Edit</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['method' => 'delete', 'url' => 'admin/order/'.$item->id]) !!}
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>{{ $list->links() }}</div>
                </div>
            </div>
            <!-- End  Kitchen Sink -->
        </div>
    </div>
@endsection