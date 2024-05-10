@extends('layouts.master');
@section('banner')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">History order</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="index.html">Home</a> / <span>History order</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection
@section('content')
<div class="container">
    <div id="content">
        <div class="table-responsive">
            <!-- Shop Products Table -->
            <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-name">Product Name</th>
                        <th class="product-price">Quantity</th>
                        <th class="product-subtotal">Total</th>
                        <th class="product-dateorder">Date order</th>
                        <th class="product-payment">Payment</th>
                        <th class="product-note">Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_history as $data)
                    <tr class="cart_item">
                        <td class="product-name">
                            <div class="media">
                                <div class="media-body">
                                    <img class="pull-left" width="25%" src="/source/image/product/{{ $data['image'] }}" alt="">
                                    <p class="font-large">{{ $data['product_name'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="product-price">{{ $data['quantity'] }}</td>
                        <td class="product-subtotal">{{ $data['total'] }}</td>
                        <td class="product-dateorder">{{ $data['date_order'] }}</td>
                        <td class="product-payment">{{ $data['payment'] }}</td>
                        <td class="product-note">{{ $data['note'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
      
            
            <!-- End of Shop Table Products -->
        </div>


        <!-- Cart Collaterals -->
      
        <!-- End of Cart Collaterals -->
        <div class="clearfix"></div>

    </div><!-- .main-content -->
</div> <!-- #content -->
</div> <!-- .container -->

@endsection

<!-- include js files -->
<script src="assets/dest/js/jquery.js"></script>
<script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="assets/dest/vendors/animo/Animo.js"></script>
<script src="assets/dest/vendors/dug/dug.js"></script>
<script src="assets/dest/js/scripts.min.js"></script>
<script src="assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="assets/dest/js/waypoints.min.js"></script>
<script src="assets/dest/js/wow.min.js"></script>
<!--customjs-->
<script src="assets/dest/js/custom2.js"></script>
<script>
    $(document).ready(function($) {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 150) {
                $(".header-bottom").addClass('fixNav')
            } else {
                $(".header-bottom").removeClass('fixNav')
            }
        })
    })
</script>
</body>

</html>