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
                        <li class="active">Tìm kiếm sản phẩm</li>
                    </ul>
                    <h4> Các sản phẩm được tìm thấy
                        <small class="pull-right"> Tìm thấy {{ count($products) }} sản phẩm</small>
                    </h4>
                    <hr class="soft"/>

                    <div id="myTab" class="pull-right">
                        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i
                                        class="icon-list"></i></span></a>
                        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i
                                        class="icon-th-large"></i></span></a>
                    </div>
                    <br class="clr"/>
                    <br class="clr"/>
                    <div class="tab-content">
                        <div class="tab-pane" id="listView">
                            @foreach($products as $item)
                                <div class="row">
                                    <div class="span2">
                                        <img src="uploads/product/thumbnail/{{ $item->thumbnail }}"
                                             width="160" height="184"
                                             alt="Error displaying pictures"/>
                                    </div>
                                    <div class="span4">
                                        <h3>Giá bán:</h3>
                                        <hr class="soft"/>
                                        <h5>{{ $item->name }}</h5>
                                        <p>
                                            {{ $item->description }}
                                        </p>
                                        <a class="btn btn-small pull-right"
                                           href="{{ route('product_details', $item->id) }}">Xem
                                            chi tiết</a>
                                        <br class="clr"/>
                                    </div>
                                    <div class="span3 alignR">
                                        @if($item->discount > 0)
                                            <h4 style="text-decoration: line-through;">{{ number_format($item->price) }}
                                                Đồng</h4>
                                            <h4 style="color: red">Giảm {{ $item->discount }}%: {{ number_format($item->price - ($item->price / 100) * $item->discount) }}
                                                Đồng</h4>
                                        @else
                                            <h3 style="color: red">{{ number_format($item->price) }}
                                                Đồng</h3>
                                        @endif

                                        <br/><br/>
                                        <div class="btn-group">
                                            <a href="product_details.html"
                                               class="btn btn-large btn-primary"> Thêm giỏ hàng <i
                                                        class=" icon-shopping-cart"></i></a>
                                            <a href="{{ route('product_details', $item->id) }}"
                                               class="btn btn-large"><i
                                                        class="icon-zoom-in"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <hr class="soft"/>
                            @endforeach
                        </div>

                        <div class="tab-pane  active" id="blockView">
                            <ul class="thumbnails">
                                @foreach($products as $item)
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <a href="{{ route('product_details', $item->id) }}"><img
                                                        src="uploads/product/thumbnail/{{ $item->thumbnail }}"
                                                        width="160" height="160"
                                                        alt="Error displaying pictures"/></a>
                                            <div class="caption">
                                                <h5>{{ $item->name }}</h5>
                                                @if($item->discount > 0)
                                                    <b class="discount">Giảm {{ $item->discount }} %</b>
                                                    <p>
                                                        <b style="text-decoration: line-through;">Giá: {{ number_format($item->price) }}
                                                            Đồng</b>
                                                    </p>
                                                    <p style="color: red">
                                                        <b>Giá: {{ number_format($item->price - ($item->price / 100) * $item->discount) }} Đồng</b>
                                                    </p>
                                                @else
                                                    <p>
                                                        <br class="clr"/>
                                                    </p>
                                                    <p style="color: red">
                                                        <b>Giá: {{ number_format($item->price - ($item->price / 100) * $item->discount) }} Đồng</b>
                                                    </p>
                                                @endif

                                                <h4 style="text-align:center">
                                                    <a class="btn" href="{{ route('product_details', $item->id) }}"> <i
                                                                class="icon-zoom-in"></i></a>
                                                    <a class="btn btn-primary" href="{{ route('add_cart', $item->id) }}">Thêm vào
                                                        giỏ hàng <i class="icon-shopping-cart"></i></a>
                                                </h4>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <hr class="soft"/>
                        </div>
                    </div>
                    <a href="{{ route('home_page') }}" class="btn btn-large pull-right">Về trang chủ</a>
                    <div class="pagination">{{ $products->links() }}</div>
                    <br class="clr"/>
                </div>
            </div>
        </div>
    </div>
@endsection