<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ----------------------------------------- -->
    <title>Home | E-Shopper</title>  
    <link href="{{asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{asset('frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/rate.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontend/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('frontend/images/ico/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>

	@include('frontend.layouts.header')
    <!-- ============================================================== -->


    @if (!request()->is('frontend/404') && !request()->is('404'))
        @include('frontend.layouts.slider')
    @endif
    <!-- ============================================================== -->	
	<section>
		<div class="container">
			<div class="row">
                @if (!Str::contains(request()->path(), ['cart', 'contact','404']))
                    @if (Str::is('member/account*', request()->path()))
                        @include('frontend.layouts.menu-left-sidebar-account')
                    @else
                        @include('frontend.layouts.menu-left-sidebar')
                    @endif
                @endif
                

                <!-- ============================================================== -->
				
				
					@yield('content')
                    <!-- ============================================================== -->
				
			</div>
		</div>
	</section>
     <!-- ============================================================== -->
     @include('frontend.layouts.footer')
	
  
    <script src="{{asset('frontend/js/jquery.js') }}"></script>
   
    
	<script src="{{asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{asset('frontend/js/price-range.js') }}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{asset('frontend/js/main.js') }}"></script>

    @yield('js')
</body>
</html>