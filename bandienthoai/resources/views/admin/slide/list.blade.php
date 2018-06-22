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
                    <a href="{{ url('admin/slide/create') }}">Create new slide</a>
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
                                <th>Image</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/slide/'.$item->name) }}" width="500">
                                    </td>

                                    <td>
                                        <a class="btn btn-info" href="{{ url('admin/slide/'.$item->id.'/edit') }}">Edit</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['method' => 'delete', 'url' => 'admin/slide/'.$item->id]) !!}
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>{{ $list->links() }}</div>
                    </div>
                </div>
            </div>
            <!-- End  Kitchen Sink -->
        </div>
    </div>
@endsection