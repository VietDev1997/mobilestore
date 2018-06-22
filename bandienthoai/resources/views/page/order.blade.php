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
                        <li class="active">Đặt hàng</li>
                    </ul>
                    <h3> Đặt hàng</h3>
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>{{ Session::get('success') }}</strong>
                        </div>
                    @endif
                    <div class="well">

                        <form class="form-horizontal" action="{{ url('order') }}" method="post">
                            {{ csrf_field() }}
                            <h4>Thông tin giao hàng</h4><br>
                            @if(isset($errors))
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-block alert-error fade in">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $error }}</strong>
                                    </div>
                                @endforeach
                            @endif
                            <div class="control-group">
                                <label class="control-label" for="inputLnam">Họ và tên người nhận <sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" id="inputLnam" placeholder="Họ và tên" name="name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Giới tính <sup>*</sup></label>
                                <div class="controls">
                                    <select class="span1" name="gender">
                                        <option value="">-</option>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input_email">Email <sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" id="input_email" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword1">Địa chỉ nhận hàng <sup>*</sup></label>
                                <div class="controls">
                                    <textarea id="aditionalInfo" cols="26" rows="3" placeholder="Địa chỉ nhận hàng"
                                              name="address"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword1">Ghi chú <sup></sup></label>
                                <div class="controls">
                                    <textarea id="aditionalInfo" cols="26" rows="3"
                                              placeholder="Bạn có yêu cầu gì có thể ghi rõ ở đây"
                                              name="note"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword1">Số điện thoại <sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" id="inputPassword1" placeholder="Số điện thoại" name="phone">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputPassword1" style="width: 165px">Phương thức thanh
                                    toán <sup>*</sup></label>
                                <div class="controls">
                                    <input type="radio" name="payment" checked value="Thanh toán khi nhận hàng"> Thanh
                                    toán khi nhận hàng

                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    @if(ShoppingCart::countRows() > 0)
                                        <input class="btn btn-large btn-success" type="submit" value="Đặt hàng"/>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(ShoppingCart::all() as $item)
                            <tr>
                                <td><a href="{{ route('product_details', $item->id) }}"><img width="60" src="uploads/product/thumbnail/{{ $item->thumbnail }}" alt="Error displaying pictures"/></a></td>
                                <td>{{ $item->name }}<br/>Màu : {{ $item->color }}</td>
                                <td>{{ number_format($item->price) }} vnđ</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ number_format($item->total) }} vnđ</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" style="text-align:right"><strong>Tổng tất cả số tiền: </strong></td>
                            <td class="label label-important" style="display:block">
                                <strong> {{ number_format(ShoppingCart::totalPrice()) }} VNĐ </strong></td>
                        </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('home_page') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Tiếp tục
                        mua hàng </a>
                </div>
            </div>
        </div>
    </div>
@endsection