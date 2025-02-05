<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="tel:+2-950-188-821"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="mailto:info@domain.com"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="{{url('/frontend/home') }}"><img src="{{asset('frontend/images/home/logo.png') }}" alt="" /></a>
						</div>
						<div class="btn-group pull-right clearfix">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{url('/member/account') }}"><i class="fa fa-user"></i> Account</a></li>
								<li><a href="{{ url('/frontend/wishlist') }}"><i class="fa fa-star"></i> Wishlist</a></li>
								@if(Auth::check())  
									<li><a href="{{url('/frontend/cart/checkout') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>	
								@else	
									<li class='display:none'><a href="{{ url('/member/login') }}"><i class="fa fa-lock"></i> Checkout</a></li>                 
                                @endif					         
								@if(session()->has('totalQty'))
									<li><a href="{{url('/frontend/cart') }}"><i class="fa fa-shopping-cart"></i><span id="cart-count">{{ session('totalQty') }}</span></a></li>   
								@else         								 
									<li><a href="{{url('/frontend/cart') }}"><i class="fa fa-shopping-cart"></i><span id="cart-count">0</span></a></li> 
								@endif  
								
								
                                @if(Auth::check())          
                                    <li><a href="{{ url('/member/logout') }}"><i class="fa fa-lock"></i> Logout</a></li>                                                      
                                @else
                                    <li><a href="{{ url('/member/login') }}"><i class="fa fa-lock"></i> Login</a></li>                 
                                @endif
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{url('/frontend/home') }}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ url('/frontend/search/advanced') }}">Products</a></li>
										<li><a href="#">Product Details</a></li> 
										@if(Auth::check())  
											<li><a href="{{url('/frontend/cart/checkout') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>	
										@else	
											<li class='display:none'><a href="{{ url('/member/login') }}"><i class="fa fa-lock"></i> Login</a></li>                 
										@endif 
										<li><a href="cart.html">Cart</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="{{ url('/frontend/blog') }}">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ url('/frontend/blog') }}">Blog List</a></li>
										<li><a href="#">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="{{ url('/frontend/404') }}">404</a></li>
								<li><a href="{{ url('/frontend/contact') }}">Contact</a></li>
								<li><a href="{{ url('/frontend/search/advanced') }}">Search advanced</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form action="{{ url('/frontend/search/list') }}" method="GET">
								<input type="text" name="name" placeholder="Search"/>
								<button type="submit">Tìm kiếm</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
</header><!--/header-->