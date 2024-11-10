@extends('frontend.layouts.app')

@section('content')
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
							$cart = session('cart', []);
						@endphp
                        @if(count($cart) > 0)
							@php
								$cart_sub_total = 0; 
								$eco_tax = 2; 
								$sub_total = 0;
								$total_price = 0;
							@endphp
                            @foreach($cart as $productId => $product)
								@php
									$total_price = $product['price'] * $product['quantity']; 
									$cart_sub_total += $total_price; 
									$sub_total = $cart_sub_total + $eco_tax;
								@endphp
                                <tr data-id="{{ $productId }}">
                                    <td class="cart_product">
                                        <img src="{{ asset('upload/products/' . $product['image']) }}" alt="{{ $product['name'] }}" style="width: 100px;" class="product-image">
                                    </td>

                                    <td class="cart_description">
                                        <h4 class="product-name">{{ $product['name'] }}</h4>
                                        <p>Product ID: {{ $productId }}</p>
                                    </td>
                                    <td class="cart_price">
                                        <p class="product-price">$ {{ ($product['price']) }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <a class="cart_quantity_up" href="#"> + </a>
                                            <input class="cart_quantity_input" type="text" name="quantity" value="{{ $product['quantity'] }}" autocomplete="off" size="2">
                                            <a class="cart_quantity_down" href="#"> - </a>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">$ {{ $total_price }}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="#"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="color:red;text-align: center;">Your cart is empty.</td>
                            </tr>
                        @endif

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span id="cart_sub_total">$ {{ !empty($cart) ? $cart_sub_total : 0 }}</span></li>
							<li>Eco Tax <span id="eco_tax">{{ !empty($cart) ? $eco_tax : 0 }}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span id="grand_total">$ {{ !empty($cart) ? $sub_total : 2 }}</span></li>
						</ul>
						<a class="btn btn-default update" href="">Update</a>
						<a id="checkout" class="btn btn-default check_out" href="{{ url('/frontend/cart/checkout') }}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection
@section('js')
	<script>
    	
    	$(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

			$('.cart_quantity_up').click(function(e){
                e.preventDefault();
                var row = $(this).closest('tr');
                var quantity_up = row.find('.cart_quantity_input'); 
                var qyt_val = parseInt(quantity_up.val()); 
                var tong_qty_val = qyt_val + 1; 
                quantity_up.val(tong_qty_val); 

                var price = parseFloat(row.find('.cart_price p').text().replace('$', '')); 
                var newTotal = price * tong_qty_val;

                row.find('.cart_total_price').text('$ ' + newTotal); 

                sendCartUpdate(row, 1);
                
		    });

            $('.cart_quantity_down').click(function(e){
                e.preventDefault();
                var row = $(this).closest('tr');
                var quantity_down = row.find('.cart_quantity_input');
                var qyt_val = parseInt(quantity_down.val());                            
                if(qyt_val > 1){
                    var tong_qty_val = qyt_val - 1;
                    quantity_down.val(tong_qty_val);
                    var price = parseFloat(row.find('.cart_price p').text().replace('$', ''));
                    var new_total = price * tong_qty_val;
                    row.find('.cart_total_price').text('$ ' + new_total);     
                      
                }else{                  
                    alert("không thể xoá được nữa");
                }
                sendCartUpdate(row, 2);
                
		    });

            $('.cart_quantity_delete').click(function(e){    
                e.preventDefault();
                var row = $(this).closest('tr');
                row.remove();    

                sendCartUpdate(row, 3);
            });

            function sendCartUpdate(row, x) {
                var product_id = row.data('id'); 
                var image = row.find('.product-image').attr('src').split('/').pop(); 
                var price = row.find('.product-price').text().replace('$', '');
                var name = row.find('.product-name').text();
                            // console.log(product_id);
                $.ajax({
                    url: '{{ url("/cart/update_cart/ajax") }}',
                    type: 'POST',
                    data: { 
                        id: product_id,
                         x: x
                        },
                    success: function(response) {
                        console.log(response);
						$('#cart-count').text(response.totalQty);
						$('#cart_sub_total').text('$ ' + response.sub_total);
						$('#grand_total').text('$ ' + response.grand_total);
						
                        //console.log('Cập nhật giỏ hàng thành công');
                    },
                });
            }

			var cart = @json($cart); 
			var checkoutBtn = $('#checkout');			
			if ($.isEmptyObject(cart)) {
				checkoutBtn.hide();
			} else {
				checkoutBtn.show();
			}


		});

    </script>
@endsection