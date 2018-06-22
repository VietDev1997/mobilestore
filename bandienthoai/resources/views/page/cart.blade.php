@extends('layouts.page')

@section('content')
    <div id="mainBody">
        <div class="container">
            <div class="row">
                <!-- Sidebar ================================================== -->
            @include('layouts.partials_page.left_nav')
            <!-- Sidebar end=============================================== -->
                <div class="span9">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home_page') }}">Trang chủ</a> <span class="divider">/</span></li>
                        <li class="active"> Giỏ hàng</li>
                    </ul>
                    <h3> Giỏ hàng [
                        <small>{{ ShoppingCart::countRows() }} loại sản phẩm</small>
                        ]<a href="{{ route('home_page') }}" class="btn btn-large pull-right"><i
                                    class="icon-arrow-left"></i>
                            Tiếp tục mua hàng </a></h3>
                    <hr class="soft"/>
                    @if(Session::has('message'))
                        <div class="alert alert-{{ Session::get('flag') }} alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>{{ Session::get('message') }}</strong>
                        </div>
                    @endif
                    @if(!Auth::check())
                        <table class="table table-bordered">
                            <tr>
                                <th> TÔI ĐÃ ĐĂNG KÝ RỒI</th>
                            </tr>
                            <tr>
                                <td>
                                    @if(isset($errors))
                                        @foreach($errors->all() as $error)
                                            <div class="alert alert-block alert-error fade in">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>{{ $error }}</strong>
                                            </div>
                                        @endforeach
                                    @endif
                                    <form class="form-horizontal" action="{{ url('dangnhap') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="control-group">
                                            <label class="control-label" for="inputUsername">Email</label>
                                            <div class="controls">
                                                <input type="text" id="inputUsername" placeholder="Username"
                                                       name="email">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputPassword1">Mật khẩu</label>
                                            <div class="controls">
                                                <input type="password" id="inputPassword1" placeholder="Password"
                                                       name="password">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" class="btn">Đăng nhập</button>
                                                Hoặc <a href="{{ route('dang_ky') }}" class="btn">Đăng ký</a>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <a style="text-decoration:underline">Quên mật khẩu ?</a>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    @else
                        {{--<div class="alert alert-success alert-dismissable">
                            <strong>Bạn đã đăng nhập !</strong>
                        </div>--}}
                        <table class="table table-bordered">
                            <tr>
                                <th> Thông tin cá nhân</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="control-group">
                                        <label class="control-label" for="inputUsername">Họ
                                            tên: {{ Auth::user()->name }}</label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputUsername">Giới
                                            tính: {{ Auth::user()->gender }}</label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label"
                                               for="inputUsername">Email: {{ Auth::user()->email }}</label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label"
                                               for="inputUsername">Địa chỉ: {{ Auth::user()->address }}</label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label"
                                               for="inputUsername">Số điện thoại: {{ Auth::user()->phone }}</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Số lượng/Cập nhật/Xóa</th>
                            <th>Giá gốc</th>
                            <th>Giá đang bán</th>
                            <th>Khuyến mãi</th>
                            <th>Tổng tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(ShoppingCart::all() as $item)
                            <tr>
                                <td><a href="{{ route('product_details', $item->id) }}"><img width="60" src="uploads/product/thumbnail/{{ $item->thumbnail }}" alt="Error displaying pictures"/></a></td>
                                <td>{{ $item->name }}<br/>Màu : {{ $item->color }}</td>
                                <td>
                                    {!! Form::open(['url' => 'updateCart/'.$item->id, 'method' => 'patch']) !!}
                                    <div class="input-append"><input class="span1" style="max-width:34px"
                                                                     placeholder="{{ $item->qty }}"
                                                                     id="appendedInputButtons" size="16" type="text"
                                                                     value="{{ $item->qty }}" name="quantity">

                                        <button class="btn" type="submit">Cập nhật</button>
                                        {!! Form::close() !!}
                                        {!! Form::open(['url' => 'deleteCart/'.$item->id, 'method' => 'delete']) !!}
                                        <button class="btn btn-danger" type="submit"><i
                                                    class="icon-remove icon-white"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </div>

                                </td>
                                <td>{{ number_format($item->giaGoc) }} vnđ</td>
                                <td>{{ number_format($item->price) }} vnđ</td>
                                <td>{{ $item->discount }} %</td>
                                <td>{{ number_format($item->total) }} vnđ</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" style="text-align:right"><strong>Tổng tất cả số tiền: </strong></td>
                            <td class="label label-important" style="display:block">
                                <strong> {{ number_format(ShoppingCart::totalPrice()) }} VNĐ </strong></td>
                        </tr>
                        </tbody>
                    </table>

                    <a href="{{ route('home_page') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Tiếp tục
                        mua hàng </a>
                    @if(ShoppingCart::countRows() > 0)
                        <a href="{{ route('order') }}" class="btn btn-large pull-right">Tiến hành thanh toán <i
                                    class="icon-arrow-right"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection