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
                        <li><a href="products.html">{{ $product->category->name }}</a> <span class="divider">/</span>
                        </li>
                        <li class="active">{{ $product->name }}</li>
                    </ul>
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div id="gallery" class="span3">
                            <a href="uploads/product/thumbnail/{{ $product->thumbnail }}" title="{{ $product->name }}">
                                <img src="uploads/product/thumbnail/{{ $product->thumbnail }}" width="270" height="310"
                                     style="width:100%"
                                     alt="Error displaying pictures"/>
                            </a>
                            <div class="row">
                                <p></p>
                            </div>
                            <div id="differentview" class="moreOptopm carousel slide">
                                <div class="carousel-inner">
                                    @foreach($product->image as $key => $image)
                                        @if($key <= 2)
                                            @if($key == 0)
                                                <div class="item active">
                                                    @endif
                                                    <a href="uploads/product/images/{{ $image->name }}"> <img
                                                                style="width:29%"
                                                                src="uploads/product/images/{{ $image->name }}"
                                                                alt=""/></a>

                                                    @else
                                                        <div class="item">
                                                            <a href="uploads/product/images/{{ $image->name }}"> <img
                                                                        style="width:29%"
                                                                        src="uploads/product/images/{{ $image->name }}"
                                                                        alt=""/></a>
                                                        </div>
                                                    @endif
                                                    @endforeach
                                                </div>
                                </div>
                            </div>

                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <span class="btn"><i class="icon-envelope"></i></span>
                                    <span class="btn"><i class="icon-print"></i></span>
                                    <span class="btn"><i class="icon-zoom-in"></i></span>
                                    <span class="btn"><i class="icon-star"></i></span>
                                    <span class="btn"><i class=" icon-thumbs-up"></i></span>
                                    <span class="btn"><i class="icon-thumbs-down"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <h3>Điện thoại {{ $product->name }}</h3>
                            <hr class="soft"/>
                            <form class="form-horizontal qtyFrm" action="{{ route('add_cart', $product->id) }}"
                                  method="get">
                                <div class="control-group">
                                    @if($product->discount > 0)
                                        <label><span>Giá: {{ number_format($product->price) }}
                                                Đồng</span></label>
                                        <label style="color: red"><span>Khuyễn mãi {{ $product->discount }}
                                                %: {{ number_format($product->price - ($product->price / 100) * $product->discount) }}
                                                Đồng</span></label>
                                    @else
                                        <label style="color: red"><span>Giá: {{ number_format($product->price) }}
                                                Đồng</span></label>
                                    @endif
                                    <br class="clr"/>
                                    <div class="control-group">
                                        <label class="control-label"><span>Số lượng</span></label>
                                        <select class="form-control" name="quantity" style="width: 170px">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                        <button type="submit" class="btn btn-large btn-primary pull-right"> Thêm giỏ
                                            hàng
                                            <i class=" icon-shopping-cart"></i></button>
                                    </div>
                                </div>

                                <hr class="soft"/>

                                <div class="control-group">
                                    <label class="control-label"><span>Màu sắc</span></label>
                                    <div class="controls">
                                        <select class="span2" name="color">
                                            <option value="Màu gì cũng được">Chọn màu</option>
                                            <option value="Đen">Đen</option>
                                            <option value="Đỏ">Đỏ</option>
                                            <option value="Trắng">Trắng</option>
                                            <option value="Hồng">Hồng</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <hr class="soft clr"/>
                            <p>
                                {{ $product->description }}
                            </p>
                            <a class="btn btn-small pull-right"
                               href="{{ route('product_details', $product->id) }}#detail">Xem thêm chi tiết</a>
                            <br class="clr"/>
                            <a href="#" name="detail"></a>
                            <hr class="soft"/>
                        </div>

                        <div class="span9">
                            <ul id="productDetail" class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">Chi tiết sản phẩm</a></li>
                                <li><a href="#profile" data-toggle="tab">Những sản phẩm tương tự</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in" id="home">
                                    <h4>Thông tin sản phẩm</h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr class="techSpecRow">
                                            <th colspan="2">Cấu hình {{ $product->name }}</th>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Màn hình:</td>
                                            <td class="techSpecTD2">{{ $product->config->screen }}</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Hệ điều hành:</td>
                                            <td class="techSpecTD2">{{ $product->config->operating_system }}</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Camera trước:</td>
                                            <td class="techSpecTD2">{{ $product->config->front_camera }}</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Camera sau:</td>
                                            <td class="techSpecTD2">{{ $product->config->rear_camera }}</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">CPU:</td>
                                            <td class="techSpecTD2">{{ $product->config->cpu }}</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Bộ nhớ trong:</td>
                                            <td class="techSpecTD2">{{ $product->config->internal_memory }}</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Sim:</td>
                                            <td class="techSpecTD2">{{ $product->config->sim }}</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Dung lượng pin:</td>
                                            <td class="techSpecTD2">{{ $product->config->battery_capacity }}</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <h5>Mô tả chi tiết sản phẩm</h5>
                                    <p>
                                        {{ $product->detailed_description }}
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <div id="myTab" class="pull-right">
                                        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i
                                                        class="icon-list"></i></span></a>
                                        <a href="#blockView" data-toggle="tab"><span
                                                    class="btn btn-large btn-primary"><i
                                                        class="icon-th-large"></i></span></a>
                                    </div>
                                    <br class="clr"/>
                                    <hr class="soft"/>


                                    <div class="tab-content">
                                        <div class="tab-pane" id="listView">
                                            @foreach($relatedProducts as $item)
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
                                                            <h4 style="color: red">Giảm {{ $item->discount }}
                                                                %: {{ number_format($item->price - ($item->price / 100) * $item->discount) }}
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

                                        <div class="tab-pane active" id="blockView">
                                            <ul class="thumbnails">
                                                @foreach($relatedProducts as $item)
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
                                                                    <a class="btn"
                                                                       href="{{ route('product_details', $item->id) }}">
                                                                        <i
                                                                                class="icon-zoom-in"></i></a>
                                                                    <a class="btn btn-primary"
                                                                       href="{{ route('add_cart', $item->id) }}">Thêm
                                                                        vào
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
                                    <br class="clr">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection