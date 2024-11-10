@extends('frontend.layouts.app')

@section('content')
<style>
    .features_items {
        text-align: center;
        margin-top: 20px;
    }
    
    .search-form {
        display: flex;
        justify-content: center;
        gap: 10px;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .search-form input[type="text"],
    .search-form select,
    .search-form button {
        padding: 10px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #ccc;
        width: 150px;
    }

    .search-form button.btn-search {
        background-color: #f39c12;
        color: white;
        border: none;
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 5px;
        width: auto;
    }

    .search-form button.btn-search:hover {
        background-color: #e67e22;
    }

</style>
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        <div class="search-form">
            <form action="{{ url('/frontend/search/advanced') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Name" value="{{ request('name') }}">

                <select name="price" width="50px">
                    <option value="">Choose price</option>
                    <option value="1000-6000" {{ request('price') == '1000-6000' ? 'selected' : '' }}>1000-6000</option>
                    <option value="7000-10000" {{ request('price') == '7000-10000' ? 'selected' : '' }}>7000-10000</option>
                </select>

                <select id="category" name="id_category">
                    <option value="" {{ request('id_category') ? '' : 'selected' }}>Category</option>
                    @foreach($categories as $category)                                                              
                        <option value="{{ $category->id }}" {{ request('id_category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>                                
                    @endforeach                                    
                </select>

                <select id="brand" name="id_brand">
                    <option value=""  {{ request('id_brand') ? '' : 'selected' }}>Brand</option>
                    @foreach($brandies as $brand)                                                              
                        <option value="{{ $brand->id }}" {{ request('id_brand') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>                                
                    @endforeach                                    
                </select>

                <select name="status" id="status">
                    <option value="">Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>New</option>
                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Sale</option>
                </select>

                <button type="submit" class="btn btn-search">Search</button>
            </form>
        </div>
    </div>
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

    <div class="ajax-products">
    </div>
						
    <ul class="pagination">
        {{ $products->links() }}
    </ul>
</div><!--features_items-->
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
@endsection



