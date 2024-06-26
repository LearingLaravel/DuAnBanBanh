@extends('layouts.master');
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="index.html">Trang chủ</a> / <span>Đặt hàng</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">

		<form action="/dathang" method="post" class="beta-form-checkout">
			@csrf
			<div class="row">
				<div class="col-sm-6">
					<h4>Đặt hàng</h4>
					@if(Session::has('success'))
						<div class="alert alert-success">
							{{ Session::get('success') }}
						</div>
					@endif
					@if(Session::has('error'))
						<div class="alert alert-danger">
							{{ Session::get('error') }}
						</div>
					@endif

					<div class="space20">&nbsp;</div>

					<div class="form-block">
						<label for="name">Họ tên*</label>
						<input name="name" value="{{ old('name') }}" type="text" id="name" placeholder="Họ tên" required>
					</div>
					<div class="form-block">
						<label>Giới tính </label>
						<input value="{{ old('gender') }}" id="boy" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
						<input value="{{ old('gender') }}" id="girl" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>

					</div>

					<div class="form-block">
						<label for="email">Email*</label>
						<input value="{{ old('email') }}" name="email" type="email" id="email" required placeholder="expample@gmail.com">
					</div>

					<div class="form-block">
						<label for="adress">Địa chỉ*</label>
						<input value="{{ old('address') }}" name="address" type="text" id="adress" placeholder="Street Address" required>
					</div>


					<div class="form-block">
						<label for="phone_number">Điện thoại*</label>
						<input value="{{ old('phone_number') }}" name="phone_number" type="text" id="phone_number" required>
					</div>

					<div class="form-block">
						<label for="notes">Ghi chú</label>
						<textarea value="{{ old('notes') }}" name="notes" id="notes"></textarea>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="your-order">
						<div class="your-order-head">
							<h5>Đơn hàng của bạn</h5>
						</div>

						@if(Session::has('cart') && Session::get('cart')->totalQty > 0)
						<div class="your-order-body" style="padding: 0px 10px">
							<div class="your-order-item">
								<div>
									@foreach($productCarts as $product)
									<!--  one item	 -->
									<div class="media">
										<img width="25%" src="/source/image/product/{{ $product['item']['image'] }}" alt="" class="pull-left">
										<div class="media-body">
											<p class="font-large">{{ $product['item']['name'] }}</p>
											<span class="font-medium ">Số lượng:{{ $product['qty'] }}</span> <br />
											<span class="font-medium ">Price: @if($product['item']['promotion_price']==0)
												{{ number_format($product['item']['unit_price']) }}@else 
												{{ number_format($product['item']['promotion_price']) }}
												@endif </span>
											
										</div>
									</div>
									@endforeach
									<!-- end one item -->
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="your-order-item">
								<div class="pull-left">
									<p class="your-order-f18">Tổng tiền:</p>
								</div>
								<div class="pull-right">
									<h5 class="color-black"><span class="cart-total-value">
										<?php
										$total = 0; // Biến đếm tổng tiền
										foreach ($productCarts as $product) {
											$subtotal = $product['qty'] * ($product['item']['promotion_price'] == 0 ? $product['item']['unit_price'] : $product['item']['promotion_price']);
											$total += $subtotal;
										}
										echo number_format($total);
										?>
									</span></h5>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						@endif
						<div class="your-order-head">
							<h5>Hình thức thanh toán</h5>
						</div>

						<div class="your-order-body">
							<ul class="payment_methods methods">
								<li class="payment_method_bacs">
									<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
									<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
									<div class="payment_box payment_method_bacs" style="display: block;">
										Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
									</div>
								</li>

								<li class="payment_method_cheque">
									<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
									<label for="payment_method_cheque">Chuyển khoản </label>
									<div class="payment_box payment_method_cheque" style="display: none;">
										Chuyển tiền đến tài khoản sau:
										<br>- Số tài khoản: 123 456 789
										<br>- Chủ TK: Nguyễn A
										<br>- Ngân hàng ACB, Chi nhánh TPHCM
									</div>
								</li>

							</ul>
						</div>

						<div class="text-center">
							<button type="submit">
								<div class="beta-btn primary" href="{{route('banhang.postdathang')}}">Đặt hàng <i class="fa fa-chevron-right"></i></div>
							</button>
							
						</div>
					</div> <!-- .your-order -->
				</div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection



<!-- include js files -->
<script src="assets/dest/js/jquery.js"></script>
<script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="assets/dest/vendors/animo/Animo.js"></script>
<script src="assets/dest/vendors/dug/dug.js"></script>
<script src="assets/dest/js/scripts.min.js"></script>
<!--customjs-->
<script type="text/javascript">
	$(function() {
		// this will get the full URL at the address bar
		var url = window.location.href;

		// passes on every "a" tag
		$(".main-menu a").each(function() {
			// checks if its the same on the address bar
			if (url == (this.href)) {
				$(this).closest("li").addClass("active");
				$(this).parents('li').addClass('parent-active');
			}
		});
	});
</script>
<script>
	jQuery(document).ready(function($) {
		'use strict';

		// color box

		//color
		jQuery('#style-selector').animate({
			left: '-213px'
		});

		jQuery('#style-selector a.close').click(function(e) {
			e.preventDefault();
			var div = jQuery('#style-selector');
			if (div.css('left') === '-213px') {
				jQuery('#style-selector').animate({
					left: '0'
				});
				jQuery(this).removeClass('icon-angle-left');
				jQuery(this).addClass('icon-angle-right');
			} else {
				jQuery('#style-selector').animate({
					left: '-213px'
				});
				jQuery(this).removeClass('icon-angle-right');
				jQuery(this).addClass('icon-angle-left');
			}
		});
	});
</script>
</body>

</html>