@extends('frontend.layouts.app')
<style>
    .favorite-item {
        position: relative;
        padding-bottom: 15px;
       
    }

    .item-a{
        display: flex;
        align-items: center;
        padding: 15px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .delete-link {
        position: absolute;
        top: 7px;
        right: 7px;
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        background-color: #FE980F;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
    }

    .delete-link:hover {
        color: #fff;
    }

    .product-image {
        /* width: 80px; */
        height: 100px;
        border-radius: 5px;
        margin-right: 15px;
    }

    .product-info {
        flex-grow: 1;
        /* margin-left: 20px; */
    }

    .product-name {
        font-size: 1.2em;
        margin: 0 0 5px;
        color: #333;
    }

    .product-price {
        margin: 0;
        color: #777;
    }

</style>
@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items">
            <h2 class="title text-center">Wishlist</h2> 
                <div class="product-details">
                    <section id="favorites-list">
                        @php
							$wishlist = session('wishlist', []);
                            
						@endphp
                        @if(count($wishlist) > 0)
                            @foreach($wishlist as $productId => $product)                               
                                <div class="favorite-item" data-id="{{ $product['id'] }}">
                                    <a href="{{ route('product.detail', ['id' => $product['id']]) }}" class= "item-a">
                                        <img src="{{ asset('upload/products/' . $product['image']) }}" alt="{{ $product['name'] }}" style="width: 100px;" class="product-image">
                                        <div class="product-info">
                                            <h4 class="product-name">{{ $product['name'] }}</h4>
                                            <p class="product-price">$ {{ ($product['price']) }}</p>
                                        </div>
                                    </a>
                                    <a href="#" class="delete-link" data-id="{{ $productId }}"><i class="fa fa-times"></i></a>
                                </div>

                            @endforeach
                        @else
                            <div>
                                <p colspan="6" style="color:red;text-align: center;">Your cart is empty.</p>
                            </div>
                        @endif
                        
                    </section>
                </div>                                         
        </div>
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

			$(".delete-link").click(function(e){
				e.preventDefault();
                var productId = $(this).data('id'); 
                var row = $(this).closest('.favorite-item');
                
				$.ajax({
					url: '{{ url("/home/wishlist/remove") }}',
					method: 'POST',
					data: {
						id: productId
					},
					success: function(data) {
						//console.log(data.success);
                        row.remove();
						alert('Xoá sẩn phẩm thành công');  			
					}
				});

            });

		});
		
	</script>
@endsection