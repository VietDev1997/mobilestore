<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="{{ route('cart') }}"><img
                    src="themes/images/ico-cart.png" alt="cart">{{ ShoppingCart::countRows() }} loại sản phẩm <span
                    class="badge badge-warning pull-right">{{ number_format(ShoppingCart::totalPrice()) }}
                VNĐ</span></a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach($category as $key => $item)
            @if($key == 0)
                <li class="subMenu open"><a href=""> Điện thoại {{ $item->name }}</a>
                    <ul>
                        <li><a href="{{ route('search') }}?category={{ $item->id }}"><i class="icon-chevron-right"></i>Tất cả</a></li>
                        <li><a href="{{ route('search') }}?category={{ $item->id }}&price1=1000000&price2=3000000"><i class="icon-chevron-right"></i>Từ 1 - 3 triệu</a></li>
                        <li><a href="{{ route('search') }}?category={{ $item->id }}&price1=3000000&price2=7000000"><i class="icon-chevron-right"></i>Từ 3 - 7 triệu</a></li>
                        <li><a href="{{ route('search') }}?category={{ $item->id }}&price1=7000000&price2=17000000"><i class="icon-chevron-right"></i>Từ 7 - 17 triệu</a></li>
                        <li><a href="{{ route('search') }}?category={{ $item->id }}&priceBigger=15000000"><i class="icon-chevron-right"></i>Trên 15 triệu</a></li>
                    </ul>
                </li>
            @else
                <li class="subMenu"><a href=""> Điện thoại {{ $item->name }}</a>
                    <ul style="display: none">
                        <li><a href="{{ route('search') }}?category={{ $item->id }}"><i class="icon-chevron-right"></i>Tất cả</a></li>
                        <li><a href="{{ route('search') }}?category={{ $item->id }}&price1=1000000&price2=3000000"><i class="icon-chevron-right"></i>Từ 1 - 3 triệu</a></li>
                        <li><a href="{{ route('search') }}?category={{ $item->id }}&price1=3000000&price2=7000000"><i class="icon-chevron-right"></i>Từ 3 - 7 triệu</a></li>
                        <li><a href="{{ route('search') }}?category={{ $item->id }}&price1=7000000&price2=17000000"><i class="icon-chevron-right"></i>Từ 7 - 17 triệu</a></li>
                        <li><a href="{{ route('search') }}?category={{ $item->id }}&priceBigger=15000000"><i class="icon-chevron-right"></i>Trên 15 triệu</a></li>
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
    <br/>
    <div class="thumbnail">
        <img src="themes/images/payment_methods.png" title="Bootshop Payment Methods"
             alt="Payments Methods">
        <div class="caption">
            <h5>Phương thức thanh toán</h5>
        </div>
    </div>
</div>