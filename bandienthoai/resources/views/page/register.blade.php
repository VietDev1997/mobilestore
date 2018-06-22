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
                        <li class="active">Đăng ký</li>
                    </ul>
                    <h3> Đăng ký</h3>
                    <div class="well">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>{{ Session::get('success') }}</strong>
                            </div>
                        @endif
                        <form class="form-horizontal" action="{{ url('dangky') }}" method="post">
                            {{ csrf_field() }}
                            <h4>Thông tin cá nhân của bạn</h4><br>
                            @if(isset($errors))
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-block alert-error fade in">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $error }}</strong>
                                    </div>
                                @endforeach
                            @endif
                            <div class="control-group">
                                <label class="control-label" for="inputLnam">Họ và tên <sup>*</sup></label>
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
                                <label class="control-label" for="inputPassword1">Mật khẩu <sup>*</sup></label>
                                <div class="controls">
                                    <input type="password" id="inputPassword1" placeholder="Mật khẩu" name="password">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword1">Nhập lại mật khẩu <sup>*</sup></label>
                                <div class="controls">
                                    <input type="password" id="inputPassword1" placeholder="Nhập lại mật khẩu"
                                           name="re_password">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword1">Địa chỉ <sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" id="inputPassword1" placeholder="Địa chỉ" name="address">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword1">Số điện thoại <sup>*</sup></label>
                                <div class="controls">
                                    <input type="text" id="inputPassword1" placeholder="Số điện thoại" name="phone">
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <input class="btn btn-large btn-success" type="submit" value="Đăng ký"/>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection