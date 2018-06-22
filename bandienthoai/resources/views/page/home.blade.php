@extends('layouts.page')

@section('content')
    <div id="carouselBlk">
        <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
                @foreach($slide as $key => $item)
                    @if($key == 0)
                        <div class="item active">
                            <div class="container">
                                <a><img style="width:100%" height="480px" src="uploads/slide/{{ $item->name }}"
                                        alt="special offers"/></a>
                            </div>
                        </div>
                    @else
                        <div class="item">
                            <div class="container">
                                <a><img style="width:100%" height="480px" src="uploads/slide/{{ $item->name }}"
                                        alt="special offers"/></a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
    </div>
    <div id="mainBody">
        <div class="container">
            <div class="row">
                <!-- Sidebar ================================================== -->
            @include('layouts.partials_page.left_nav')
            <!-- Sidebar end=============================================== -->
                <div class="span9">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="well well-small">
                        <h4>Sản phẩm mới
                            <small class="pull-right">{{ count($newProduct) }} sản phẩm mới nhất</small>
                        </h4>
                        <div class="row-fluid">
                            <div id="featured" class="carousel slide">
                                <div class="carousel-inner">
                                    <?php $count = 0; ?>
                                    @foreach($newProduct as $key => $item)
                                        @if($key <= 3)
                                            @if($key == 0)
                                                <div class="item active">
                                                    <ul class="thumbnails">
                                                        @endif
                                                        <li class="span3">
                                                            <div class="thumbnail">
                                                                <i class="tag"></i>
                                                                <a href="{{ route('product_details', $item->id) }}"><img
                                                                            src="uploads/product/thumbnail/{{ $item->thumbnail }}"
                                                                            alt="Error displaying pictures"></a>
                                                                <div class="caption">
                                                                    <h6>{{ $item->name }}</h6>
                                                                    @if($item->discount > 0)
                                                                        <b class="discount">Giảm {{ $item->discount }}
                                                                            %</b>
                                                                        <p>
                                                                            <b style="text-decoration: line-through;">Giá: {{ number_format($item->price) }}
                                                                                Đồng</b>
                                                                        </p>
                                                                        <p style="color: red">
                                                                            <b>Giá: {{ number_format($item->price - ($item->price / 100) * $item->discount) }}
                                                                                Đồng</b>
                                                                        </p>
                                                                    @else
                                                                        <p>
                                                                            <br class="clr"/>
                                                                        </p>
                                                                        <p style="color: red">
                                                                            <b>Giá: {{ number_format($item->price - ($item->price / 100) * $item->discount) }}
                                                                                Đồng</b>
                                                                        </p>
                                                                    @endif
                                                                    <h4 style="text-align:center"><a class="btn"
                                                                                                     href="{{ route('product_details', $item->id) }}">Xem
                                                                            chi tiết</a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @if($key == 3)
                                                    </ul>
                                                </div>
                                            @endif
                                        @else
                                            <?php $count++; ?>
                                            @if($count == 1)
                                                <div class="item">
                                                    <ul class="thumbnails">
                                                        @endif
                                                        <li class="span3">
                                                            <div class="thumbnail">
                                                                <i class="tag"></i>
                                                                <a href="{{ route('product_details', $item->id) }}"><img
                                                                            src="uploads/product/thumbnail/{{ $item->thumbnail }}"
                                                                            alt="Error displaying pictures"></a>
                                                                <div class="caption">
                                                                    <h6>{{ $item->name }}</h6>
                                                                    @if($item->discount > 0)
                                                                        <b class="discount">Giảm {{ $item->discount }}
                                                                            %</b>
                                                                        <p>
                                                                            <b style="text-decoration: line-through;">Giá: {{ number_format($item->price) }}
                                                                                Đồng</b>
                                                                        </p>
                                                                        <p style="color: red">
                                                                            <b>Giá: {{ number_format($item->price - ($item->price / 100) * $item->discount) }}
                                                                                Đồng</b>
                                                                        </p>
                                                                    @else
                                                                        <p>
                                                                            <br class="clr"/>
                                                                        </p>
                                                                        <p style="color: red">
                                                                            <b>Giá: {{ number_format($item->price - ($item->price / 100) * $item->discount) }}
                                                                                Đồng</b>
                                                                        </p>
                                                                    @endif
                                                                    <h4 style="text-align:center"><a class="btn"
                                                                                                     href="{{ route('product_details', $item->id) }}">Xem
                                                                            chi tiết</a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @if($count == 4)
                                                    </ul>
                                                </div>
                                                <?php $count = 0; ?>
                                                @endif
                                                @endif
                                                @endforeach
                                                @if($count != 0)
                                                </ul>
                                </div>
                                <?php $count = 0; ?>
                                @endif
                            </div>
                            <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                            <a class="right carousel-control" href="#featured" data-slide="next">›</a>
                        </div>
                    </div>
                </div>

                <h4>Sản phẩm nổi bật</h4>
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
                                            <b>Giá: {{ number_format($item->price - ($item->price / 100) * $item->discount) }}
                                                Đồng</b>
                                        </p>
                                    @else
                                        <p>
                                            <br class="clr"/>
                                        </p>
                                        <p style="color: red">
                                            <b>Giá: {{ number_format($item->price - ($item->price / 100) * $item->discount) }}
                                                Đồng</b>
                                        </p>
                                    @endif

                                    <h4 style="text-align:center">
                                        <a class="btn" href="{{ route('product_details', $item->id) }}"> <i
                                                    class="icon-zoom-in"></i></a>
                                        <a class="btn btn-primary" href="{{ route('add_cart', $item->id) }}">Thêm
                                            vào
                                            giỏ hàng <i class="icon-shopping-cart"></i></a>
                                    </h4>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="pagination">{{ $products->links() }}</div>

            </div>
        </div>
    </div>
@endsection