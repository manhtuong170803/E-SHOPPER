@extends('frontend.layouts.app')

@section('content')
    <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="blog-post-area">
                     <h2 class="title text-center">{{ request('name') }}</h2>
                        @if($products->isEmpty())
                            <p class="text-center" style="color:red;">Không tìm thấy sản phẩm nào.</p>
                        @else		
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
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach		
                        @endif
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection


