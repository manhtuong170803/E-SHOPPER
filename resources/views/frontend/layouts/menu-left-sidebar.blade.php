
<div class="col-sm-3">
    <div class="left-sidebar">
		<h2>Category</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
			<!-- <div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
							<span class="badge pull-right"><i class="fa fa-plus"></i></span>
							Sportswear
						</a>
					</h4>
				</div>
				<div id="sportswear" class="panel-collapse collapse">
					<div class="panel-body">
						<ul>
							<li><a href="#">Nike </a></li>
							<li><a href="#">Under Armour </a></li>
							<li><a href="#">Adidas </a></li>
							<li><a href="#">Puma</a></li>
							<li><a href="#">ASICS </a></li>
						</ul>
					</div>
				</div>
			</div> -->
		

            @foreach ($categories as $category)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="{{ route('category.show', $category->id) }}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            	{{$category->name }} 
                            </a>
                        </h4>
                    </div>
                </div>
            @endforeach
			
		</div><!--/category-products-->
	
		<div class="brands_products"><!--brands_products-->
			<h2>Brands</h2>
			<div class="brands-name">
				<ul class="nav nav-pills nav-stacked"> 
					@foreach ($brandies as $brand)
						<li><a href="{{ route('brand.show', $brand->id) }}"> <span class="pull-right">({{ $brandProductCounts[$brand->id] ?? 0  }})</span> {{ $brand->name }}</a></li> 
					@endforeach
				</ul>
			</div>
		</div><!--/brands_products-->
		
		<div class="price-range"><!--price-range-->
			<h2>Price Range</h2>
			<div class="well text-center">
				<input type="text" class="span2" value="" data-slider-min="{{ $minPrice }}" data-slider-max="{{ $maxPrice }}" data-slider-step="5" data-slider-value="[0,10000]" id="sl2"><br />
				<b class="pull-left">$ {{ $minPrice }}</b> <b class="pull-right">$ {{ $maxPrice }} </b> 
			</div>
		</div><!--/price-range-->
		
		<div class="shipping text-center"><!--shipping-->
			<img src="images/home/shipping.jpg" alt="" />
		</div><!--/shipping-->
    </div>                 
</div>
<!-- <input type="text" class="span2" value="" data-slider-min=" $minPrice " data-slider-max=" $maxPrice " data-slider-step="5" data-slider-value="[ $minPrice ,  $maxPrice ]" id="sl2"><br />
<b class="pull-left">$  $minPrice </b> <b class="pull-right">$  $maxPrice </b> -->
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
				console.log(priceRange);
				$.ajax({
                        url: '{{ url("/price-range/ajax") }}',
                        method: 'POST',
                        data: {
                            price_range: priceRange,
                        },
                        success: function(data) {
                            console.log(data);
					
                        }
                    });

			});




		});

    </script>
@endsection -->