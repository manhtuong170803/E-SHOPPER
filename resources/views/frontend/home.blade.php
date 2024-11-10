@extends('frontend.layouts.app')
	@if(session('success'))
		<!-- <div class="alert alert-success">
			{{ session('success') }}
		</div>	 -->
		@section('js')
			<script>
				alert("Đã mua hàng thành công");
			</script>
		@endsection
	@endif
@section('content')
	<div class="col-sm-9 padding-right">
		<div class="features_items"><!--features_items-->
			<h2 class="title text-center">Features Items</h2>
			
			@foreach($products as $product)
				@php
					$images = json_decode($product->image, true);
					$firstImage = isset($images[0]) ? $images[0] : null;
				@endphp
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
								<div class="productinfo text-center">
									@if($firstImage)
										<img src="{{ asset('upload/products/' . $firstImage) }}" alt="Product Image" style="width: 100;">							
									@endif											
									<h2>${{ number_format($product->price) }}</h2>
									<p>{{ $product->name }}</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								<div class="product-overlay">
									<div class="overlay-content">
										@if($firstImage)
											<a href="{{ route('product.detail', $product->id) }}"><img src="{{ asset('upload/products/' . $firstImage) }}" alt="Product Image" style="width: 100%;height: 190px;"></a>							
										@endif	
										<h2>${{ number_format($product->price) }}</h2>
										<p>{{ $product->name }}</p>
										<a href="#" class="btn btn-default add-to-cart" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
								</div>
						</div>
						<div class="choose">
							<ul class="nav nav-pills nav-justified">
								<li><a href="#" class="add-to-wishlist" data-id="{{ $product->id }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
								<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
							</ul>
						</div>
					</div>
				</div>
			@endforeach		
							
		</div><!--features_items-->
						
		<div class="category-tab"><!--category-tab-->
			<div class="col-sm-12">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
					<li><a href="#blazers" data-toggle="tab">Blazers</a></li>
					<li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
					<li><a href="#kids" data-toggle="tab">Kids</a></li>
					<li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>
				</ul>
			</div>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="tshirt" >
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery1.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery2.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery3.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery4.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="blazers" >
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery4.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery3.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery2.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery1.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="sunglass" >
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery3.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery4.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery1.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery2.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="kids" >
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery1.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery2.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery3.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery4.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="poloshirt" >
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery2.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery4.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery3.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('frontend/images/home/gallery1.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/category-tab-->
						
		<div class="recommended_items"><!--recommended_items-->
							<h2 class="title text-center">recommended items</h2>
							
							<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<div class="item active">	
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{asset('frontend/images/home/recommend1.jpg') }}" alt="" />
														<h2>$56</h2>
														<p>Easy Polo Black Edition</p>
														<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>
													
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{asset('frontend/images/home/recommend2.jpg') }}" alt="" />
														<h2>$56</h2>
														<p>Easy Polo Black Edition</p>
														<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>
													
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{asset('frontend/images/home/recommend3.jpg') }}" alt="" />
														<h2>$56</h2>
														<p>Easy Polo Black Edition</p>
														<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>
													
												</div>
											</div>
										</div>
									</div>
									<div class="item">	
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{asset('frontend/images/home/recommend1.jpg') }}" alt="" />
														<h2>$56</h2>
														<p>Easy Polo Black Edition</p>
														<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>
													
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{asset('frontend/images/home/recommend2.jpg') }}" alt="" />
														<h2>$56</h2>
														<p>Easy Polo Black Edition</p>
														<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>
													
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{asset('frontend/images/home/recommend3.jpg') }}" alt="" />
														<h2>$56</h2>
														<p>Easy Polo Black Edition</p>
														<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								</a>
								<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
									<i class="fa fa-angle-right"></i>
								</a>			
							</div>
		</div><!--/recommended_items-->
	</div>
@endsection
@section('js')
	<script>    	
    	$(document).ready(function(){
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
			$(".add-to-cart").click(function(e){
				e.preventDefault();
                var productId = $(this).data('id'); 
				//console.log(productId);
				$.ajax({
					url: '{{ url("/home/cart/ajax") }}',
					method: 'POST',
					data: {
						id: productId
					},
					success: function(data) {
						console.log(data);
						$('#cart-count').text(data.totalQty);
						alert('thành công');  				
					}
				});

            });

			$(".add-to-wishlist").click(function(e){
				e.preventDefault();
                var productId = $(this).data('id'); 
				//console.log(productId);
				$.ajax({
					url: '{{ url("/home/wishlist") }}',
					method: 'POST',
					data: {
						id: productId
					},
					success: function(data) {
						//console.log(data);
						//alert('thành công');  
						if (data.status === 'success') {
							alert('Sản phẩm đã được thêm vào mục yêu thích thành công');
						} else {
							alert('Sản phẩm đã có trong mục yêu thích');
						}				
					}
				});

            });


			// var paymentSuccessful = true; 
			// if (paymentSuccessful) {
			// 	localStorage.removeItem('cart'); 
			// 	alert("Thanh toán thành công! Giỏ hàng đã được xóa.");
			// }

		});
		
	</script>
@endsection