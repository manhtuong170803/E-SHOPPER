@extends('frontend.layouts.app')

@section('content')
<section>
		<div class="container">
			<div class="row">
				
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Update user</h2>
                        @if(session('success'))
                                    <p style="color: green;">{{ session('success') }}</p>
                        @endif
                        @if(session('info'))
                            <div class="alert alert-info">
                                {{ session('info') }}
                            </div>
                        @endif
						<div class="signup-form"><!--sign up form-->
						<form action="{{ url('/member/account') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="name" placeholder="Name" value="{{ $userss->name }}" required>
                            @error('name')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror 
                            <input type="email" name="email" placeholder="Email" value="{{ $userss->email }}" required>
                            @error('email')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror 
                            <input type="password" name="password" placeholder="Password" value="" placeholder="******">
                            @error('password')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror 
                            <input type="text" name="address" placeholder="Address" value="{{ $userss->address }}">
                            @error('address')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror 

                            <!-- <input type="text" name="id_country" placeholder="Country" value=""> -->
                            <select name="id_country" required>
                                <option value="" disabled selected>Select your country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $country->id == $userss->id_country ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('country')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror 


                            <input type="tel" name="phone" placeholder="Phone" value="{{ $userss->phone }}">
                            @error('phone')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror 
                            @if($userss->avatar)
                                <img src="{{ asset('upload/user/avatar/' . $userss->avatar) }}" alt="User Avatar" style="width: 100px; height: 100px;">
                            @endif
                            <input type="file" name="avatar" accept="image/*" value="{{ $userss->avatar }}">
                            @error('avatar')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror 
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection