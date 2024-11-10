@extends('frontend.layouts.app')
<style>
	.div_btn{
		/* display: flex;
    	justify-content: space-between; */
		display: flex;
        align-items: center;
		gap: 50px;
		/* justify-content: space-between;  */
	}
	.load{
		display: inline-block;
        width: 100px; 
        padding: 10px;
        text-align: center;
        /* font-size: 16px; */
        cursor: pointer;
        border: none;
        border-radius: 4px;
        text-decoration: none;
		background: #FE980F;
		color: white;
		margin-top: 23px;
	}
	

	.load:hover {
		background: #f0f0f0;
		color: white; 
	}
	.xinchao{
		display: none;
	}

	.submit-right {
		float: right;
		margin-right: 40px;
	}
</style>
@section('content')
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step1</h2>
			</div>
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Register Account</label>
					</li>
					<li>
						<label><input type="checkbox"> Guest Checkout</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<!-- <div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" placeholder="Display Name">
								<input type="text" placeholder="User Name">
								<input type="password" placeholder="Password">
								<input type="password" placeholder="Confirm password">
							</form>
							<a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="">Continue</a>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="Company Name">
									<input type="text" placeholder="Email*">
									<input type="text" placeholder="Title">
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Middle Name">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address 1 *">
									<input type="text" placeholder="Address 2">
								</form>
							</div>
							<div class="form-two">
								<form>
									<input type="text" placeholder="Zip / Postal Code *">
									<select>
										<option>-- Country --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<select>
										<option>-- State / Province / Region --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<input type="password" placeholder="Confirm password">
									<input type="text" placeholder="Phone *">
									<input type="text" placeholder="Mobile Phone">
									<input type="text" placeholder="Fax">
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
						</div>	
					</div>					
				</div>
			</div> -->

			@if(Auth::check())  
				<li class="xinchao">Xin chào</li>
				<!-- <button type="button" onclick="submitOrder()" class="load submit-right">Submit Order</button>	 -->
			@else	
				<div class="login-form"><!--login form-->
					<h2>Login to your account</h2>
					@if ($errors->has('loginError'))
						<p class="error" style="color:red;">{{ $errors->first('loginError') }}</p>
					@endif
					<form action="{{url('member/login')}}" method="POST">
						@csrf
						<input type="email" placeholder="Email" name="email"  value="{{ old('email') }}"/>
						<input type="password" placeholder="Password"  name="password"  value="{{ old('password') }}" />                         
						<span>
							<input type="checkbox" class="checkbox"> 
							Keep me signed in
						</span>
						<div class="div_btn">
							<button type="submit" class="btn btn-default">Login</button>
							<a href="{{ url('member/register') }}" class="load">Register</a>
						</div>					
					</form>
				</div>                 
			@endif
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			@php
				$cart = session('cart', []); 
			@endphp
			
				<div class="table-responsive cart_info">
					<form action="{{ url('/frontend/cart/mail') }}" method="POST">
					@csrf
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
									
										<tr>
											<td colspan="4">&nbsp;</td>
											<td colspan="2">
												<table class="table table-condensed total-result">
													<tr>
														<td>Cart Sub Total</td>
														<td>$ {{  $cart_sub_total }}</td>
													</tr>
													<tr>
														<td>Exo Tax</td>
														<td>{{ $eco_tax }}</td>
													</tr>
													<tr class="shipping-cost">
														<td>Shipping Cost</td>
														<td>Free</td>										
													</tr>
													<tr>
														<td>Total</td>
														<td><span>$ {{  $sub_total  }}</span></td>
													</tr>
												</table>
											</td>
										</tr>
										<tfoot>
											<tr>
												<td colspan="8">
													<a href="#"><button type="submit" class="load submit-right">Submit</button></a>
												</td>
											</tr>
										</tfoot>
									@else
										<tr>
											<td colspan="6" style="color:red;text-align: center;">Your cart is empty.</td>
										</tr>
									@endif
								</tbody>
							
						</table>
					</form>
				</div>
			


			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->
@endsection
@section('js')
	<script>    	
    	$(document).ready(function(){
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
			// $(".add-to-cart").click(function(e){
			// 	e.preventDefault();
            //     var productId = $(this).data('id'); 
			// 	//console.log(productId);
			// 	$.ajax({
			// 		url: '{{ url("/home/cart/ajax") }}',
			// 		method: 'POST',
			// 		data: {
			// 			id: productId
			// 		},
			// 		success: function(data) {
			// 			console.log(data);
			// 			$('#cart-count').text(data.totalQty);
			// 			alert('thành công');  				
			// 		}
			// 	});

            // });


		});
		
	</script>
@endsection
