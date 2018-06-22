@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Product List</h1>
        </div>
        <!--End Page Header -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!--   Kitchen Sink -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('admin/product/create') }}">Create new product</a>
                </div>
                <div class="col-lg-4">
                    <div class="form-group"></div>
                    <form action="{{ url('admin/product') }}" method="get">
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
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Thumbnail</th>
                                <th>Description</th>
                                <th>Detailed description</th>
                                <th>Status</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->price) }}</td>
                                    <td>{{ $item->discount }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/product/thumbnail/'.$item->thumbnail) }}"
                                             width="100"
                                             height="100">
                                        <p></p>
                                        <b>Images:</b>
                                        @foreach($item->image as $image)
                                            <img src="{{ asset('uploads/product/images/'.$image->name) }}"
                                                 width="100"
                                                 height="100">
                                        @endforeach
                                    </td>
                                    <td>
                                        <b>Mô tả: </b>
                                        {{ $item->description }}
                                        <p></p>
                                        <b>Cấu hình:</b>
                                        <p>- Screen: {{ $item->config->screen }}px</p>
                                        <p>- Operating system: {{ $item->config->operating_system }}</p>
                                        <p>- Front camera: {{ $item->config->front_camera }}</p>
                                        <p>- Rear camera: {{ $item->config->rear_camera }}</p>
                                        <p>- CPU: {{ $item->config->cpu }}</p>
                                        <p>- RAM: {{ $item->config->ram }}</p>
                                        <p>- Internal memory: {{ $item->config->internal_memory }}</p>
                                        <p>- SIM: {{ $item->config->sim }}</p>
                                        <p>- Battery capacity: {{ $item->config->battery_capacity }}</p>
                                    </td>
                                    <td>{{ $item->detailed_description }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ url('admin/product/'.$item->id.'/edit') }}">Edit</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['method' => 'delete', 'url' => 'admin/product/'.$item->id]) !!}
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