<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    <li><a href="#"><i class="fa fa-user"></i>Tài khoản</a></li>
                    <li><a href="{{route('getsignup')}}">Đăng kí</a></li>
                    <li><a href="{{route('getlogin')}}">Đăng nhập</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="{{ route('homepage') }}" id="logo"><img src="/source/assets/dest/images/logo-cake.png" width="100px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="/">
                        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                     {{-- --------------------- --}}
                 <div class="cart">
                    <div class="beta-select"> 
                        @if(!Session::has('cart') || Session::get('cart')->totalQty == 0)
                            <a href="#"><i class="fa fa-shopping-cart"></i> Giỏ hàng (Trống)</a>
                        @else
                            <a href="#"><i class="fa fa-shopping-cart"></i> Giỏ hàng ({{ Session('cart')->totalQty }}) <i class="fa fa-chevron-down"></i></a>
                        @endif
                    </div>
                    <div class="beta-comp">
                        @if(Session::has('cart') && Session::get('cart')->totalQty > 0)
                            <div class="beta-dropdown cart-body">
                                @foreach($productCarts as $product)
                                    <div class="cart-item">
                                        <div class="cart-item">
                                            <a class="cart-item-delete" href="{{route('banhang.xoagiohang', $product['item']['id'])}}"><i class="fa fa-times"></i>
                                            </a>
                                            <div class="media">
                                                <a class="pull-left" href="#"><img src="/source/image/product/{{ $product['item']['image'] }}" alt=""></a>
                                                <div class="media-body">
                                                    <span class="cart-item-title">{{ $product['item']['name'] }}</span>
                                                    <span class="cart-item-amount">{{ $product['qty'] }}*<span>
                                                        @if($product['item']['promotion_price']==0)
                                                        {{ number_format($product['item']['unit_price']) }}@else 
                                                        {{ number_format($product['item']['promotion_price']) }}
                                                        @endif
                                                    </span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="cart-caption">
                                    <div class="cart-total text-right">
                                        Tổng tiền: <span class="cart-total-value">
                                            <?php
                                            $total = 0; // Biến đếm tổng tiền
                                            foreach ($productCarts as $product) {
                                                $subtotal = $product['qty'] * ($product['item']['promotion_price'] == 0 ? $product['item']['unit_price'] : $product['item']['promotion_price']);
                                                $total += $subtotal;
                                            }
                                            echo number_format($total);
                                            ?>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="cart-options">
                                       
                                        <div class="center">
                                            <div class="space10"></div>
                                            <a href="{{url('shop')}}" class="beta-btn primary " ><i class="fa fa-shopping-cart width-200"></i></a>
                                            <a href="{{route('banhang.getdathang')}}" class="beta-btn primary">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        @endif
                    </div>
                </div>
                



                    {{-- ------------------- --}}
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="">Trang chủ</a></li>
                    <li><a href="">Sản phẩm</a>
                        <ul class="sub-menu">
                            @if(isset($producttypes))
                            @foreach ($producttypes as $producttype)
                                <li><a href="{{ route('getProductType', $producttype->id) }}">{{$producttype->name}}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                    <li><a href="{{ route('pricing') }}">Giới thiệu</a></li>
                    <li><a href="{{ route('homepage') }}">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> 
    </div>
</div> 