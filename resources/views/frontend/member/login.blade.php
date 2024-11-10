@extends('frontend.layouts.app')
<style>
	.div_btn{
		display: flex;
        align-items: center;
		gap: 50px;
	}
	button.btn.btn-default.btn-run {
		padding: 6px 32px;
		margin-top: 32px;
		border: none;
		border-radius: 4px;
	}
	.load{
		display: inline-block;
        width: 100px;
        padding: 7px;
        text-align: center;
        cursor: pointer;
        border: none;
        border-radius: 4px;
        text-decoration: none;
		background: #FE980F;
		color: white;
	}
	
	.load{
		margin-top:32px
	}
	

	.load:hover {
		background: #f0f0f0;
		color: white; 
	}
</style>
@section('content')
	<div class="col-sm-9">
			<div class="blog-post-area">
				<h2 class="title text-center">Login</h2>
				<div class="login-form"><!--login form-->
					<!-- <h2>Login to your account</h2> -->
					@if (session('success'))
						<p class="success" style="color:green;">{{ session('success') }}</p>
					@endif
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
							<button type="submit" class="btn btn-default btn-run">Login</button>
							<a href="{{ url('member/register') }}" class="load">Register</a>
						</div>
						
					</form>
				</div>
			</div>
        </div>
    </div>

@endsection