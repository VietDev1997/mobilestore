<div id="header">
    <div class="container">
        <div id="welcomeLine" class="row">
            @if(Auth::check())
                <div class="span6">Xin chào<strong> {{ Auth::user()->name }}</strong>, Chào mừng bạn đến với website của chúng tôi !
                </div>
            @else
                <div class="span6">Chào mừng bạn đến với website của chúng tôi !<strong></strong></div>
            @endif

            <div class="span6">
                <div class="pull-right">
                    <span class="btn btn-mini">{{ number_format(ShoppingCart::totalPrice()) }}</span>>

                    <a><span class="">VNĐ</span></a>
                    <a href="{{ route('cart') }}"><span class="btn btn-mini btn-primary"><i
                                    class="icon-shopping-cart icon-white"></i> [ {{ ShoppingCart::countRows() }} ] loại sản phẩm trong giỏ hàng </span                    </a>
                </div>
            </div>
        </div>
        <!-- Navbar ================================================== -->
        <div id="logoArea" class="navbar">
            <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-inner">
                <a class="brand" href="{{ route('home_page') }}"><img src="themes/images/logo.png" alt="Bootsshop"/></a>
                <form class="form-inline navbar-search" method="get" action="{{ route('search') }}">
                    <input id="srchFld" class="srchTxt" type="text" name="keyword" placeholder="Tìm kiếm theo tên"/>
                    <select class="srchTxt" name="category">
                        <option value="">Tất cả</option>
                        @foreach($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" id="submitButton" class="btn btn-primary">Tìm kiếm</button>
                </form>
                <ul id="topMenu" class="nav pull-right">
                    <li class=""><a href="{{ route('promotion') }}">Khuyến mãi</a></li>
                    <li class=""><a href="{{ route('contact') }}">Liên hệ</a></li>
                    <li class="">

                        @if(Auth::check())
                            <a href="{{ route('dang_xuat') }}" role="button" style="padding-right:0"><span
                                        class="btn btn-large btn-success">Đăng xuất</span></a>

                        @else
                            <a href="{{ route('dang_nhap') }}" role="button" style="padding-right:0"><span
                                        class="btn btn-large btn-success">Đăng nhập</span></a>
                        @endif

                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>