@extends('frontend.layouts.app')

@section('content')
<div class="col-sm-9 padding-right">
    <div class="features_items">
        <h2 class="title text-center">{{ $brand->name }}</h2> 
        @forelse($products as $product)
            @php
                $images = json_decode($product->image, true);
                $firstImage = isset($images[0]) ? $images[0] : null;
            @endphp
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        @if($firstImage)
                            <img src="{{ asset('upload/products/' . $firstImage) }}" alt="Product Image" style="width: 100%;">
                        @endif
                        <h2>${{ number_format($product->price) }}</h2>
                        <p>{{ $product->name }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            @if($firstImage)
                                <a href="{{ route('product.detail', $product->id) }}">
                                    <img src="{{ asset('upload/products/' . $firstImage) }}" alt="Product Image" style="width: 100%;height: 190px;">
                                </a>
                            @endif
                            <h2>${{ number_format($product->price) }}</h2>
                            <p>{{ $product->name }}</p>
                            <a href="#" class="btn btn-default add-to-cart" data-id="{{ $product->id }}">
                                <i class="fa fa-shopping-cart"></i>Add to cart
                            </a>
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
        @empty
            <p class="text-center" style="color:red;">Không tìm thấy sản phẩm nào.</p>
        @endforelse

        <!-- <div class="ajax-products">
        </div> -->
                            
        <!-- <ul class="pagination">
            $products->links() }}
        </ul> -->
    </div><!--features_items-->
</div>
@endsection

<!-- @section('js')
	<script>
    	
    	$(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

			$('.slider-track').click(function(){
                var priceRange = $(".tooltip-inner").text();
                
                $(".col-sm-4").remove();
                $(".pagination").remove();
                $(".ajax-products").empty();
				$.ajax({
                        url: '{{ url("/price-range/ajax") }}',
                        method: 'POST',
                        data: {
                            price_range: priceRange,
                        },
                        success: function(data) {
                            console.log(data.products);
                            
                            if (data.products && Array.isArray(data.products)) {
                                data.products.forEach(function(product) {
                                    var images = JSON.parse(product.image);
                                    var firstImage = images && images.length > 0 ? images[0] : '';
                                    var html = "<div class='col-sm-4'>" +
                                                    "<div class='product-image-wrapper'>" +
                                                        "<div class='single-products'>" +
                                                            "<div class='productinfo text-center'>" +
                                                                "<img src='{{ asset('upload/products/') }}/" + firstImage + "' alt='Product Image' style='width: 100%;'>" +
                                                                "<h2>" + product.price + "</h2>" +
                                                                "<p>" + product.name + "</p>" +
                                                                "<a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>" +
                                                            "</div>" +
                                                            "<div class='product-overlay'>" +
                                                                "<div class='overlay-content'>" +
                                                                    "<img src='{{ asset('upload/products/') }}/" + firstImage + "' alt='Product Image' style='width: 100%;'>" +
                                                                    "<h2>" + product.price + "</h2>" +
                                                                    "<p>" + product.name + "</p>" +
                                                                    "<a href='#' class='btn btn-default add-to-cart' data-id='" + product.id + "'><i class='fa fa-shopping-cart'></i>Add to cart</a>" +
                                                                "</div>" +
                                                            "</div>" +
                                                        "</div>" +
                                                        "<div class='choose'>" +
                                                            "<ul class='nav nav-pills nav-justified'>" +
                                                                "<li><a href='#'><i class='fa fa-plus-square'></i>Add to wishlist</a></li>" +
                                                                "<li><a href='#'><i class='fa fa-plus-square'></i>Add to compare</a></li>" +
                                                            "</ul>" +
                                                        "</div>" +
                                                    "</div>" +
                                                "</div>";
                                    
                                    $(".ajax-products").append(html);
                                });
                            }else{
                                $(".ajax-products").append("<p class='text-center' style='color:red;'>Không tìm thấy sản phẩm nào.</p>");
                            }
                        }
                    });

			});




		});

    </script>
@endsection -->



