@extends('frontend.layouts.app')

@section('content')
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Register</h2>
            <div class="register-form">
                <form class="form-horizontal form-material" action="{{url('member/register')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-12">Full Name</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" value="{{ old('name') }}" name="name">
                            @error('name')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror   
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input type="email"  placeholder="johnathan@admin.com" class="form-control form-control-line"  name="email" id="example-email" value="{{ old('email') }}" >
                            @error('email')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Password</label>
                        <div class="col-md-12">
                            <input type="password" class="form-control form-control-line" name="password" value="{{ old('password') }}">
                            @error('password')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Phone No</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="123 456 7890" class="form-control form-control-line"  name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <p class="error" style="color:red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Select Country</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line"  name="id_country">
                                @foreach($countries as $country)                                                              
                                <option value="{{ $country->id }}">
                                    {{ $country->name }}
                                </option>
                                    
                                @endforeach
                                
                                @error('id_country')
                                    <p class="error" style="color:red">{{ $message }}</p>
                                @enderror
                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-default" type="submit" style="background:#FE980F; color: #FFFFFF;">Signup</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection