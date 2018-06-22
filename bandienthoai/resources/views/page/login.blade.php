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
                        <li class="active">Đăng nhập</li>
                    </ul>
                    <h3> Đăng nhập</h3>
                    <hr class="soft"/>

                    <div class="well">
                        @if(isset($errors))
                            @foreach($errors->all() as $error)
                                <div class="alert alert-block alert-error fade in">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $error }}</strong>
                                </div>
                            @endforeach
                        @endif

                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>{{ Session::get('success') }}</strong>
                            </div>
                        @endif

                        @if(Session::has('message'))
                            <div class="alert alert-{{ Session::get('flag') }} alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <strong>{{ Session::get('message') }}</strong>
                            </div>
                        @endif

                        @if(!Auth::check())
                            <h5>Bạn đã đăng ký ?</h5>
                            <form action="{{ url('dangnhap') }}" method="post">
                                {{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label" for="inputEmail1">Email</label>
                                    <div class="controls">
                                        <input class="span3" type="text" id="inputEmail1" placeholder="Email"
                                               name="email">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputPassword1">Mật khẩu</label>
                                    <div class="controls">
                                        <input type="password" class="span3" id="inputPassword1"
                                               placeholder="Mật khẩu" name="password">
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

                        @else
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
                                                   for="inputUsername">Address: {{ Auth::user()->address }}</label>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"
                                                   for="inputUsername">Phone: {{ Auth::user()->phone }}</label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        @endif


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection