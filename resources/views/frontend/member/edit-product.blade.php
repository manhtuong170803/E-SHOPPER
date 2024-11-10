@extends('frontend.layouts.app')

@section('content')
<style>
	.sales-container {
		display: flex;
		align-items: center;
	}

	.sales-container input[type="number"][name="sale"] {
		width: 30% !important;
		margin-right: 5px; 
	}
    .image-container {
    display: inline-block;
    text-align: center;
    margin-right: 10px; 
    margin-bottom: 20px; 
    }

    .image-container img {
        display: block;
        margin-bottom: 5px; 
    }

    .image-container label {
        display: block;
        font-size: 14px;
        color: #333;
    }
    .btn-test {
        display: flex;
        justify-content: space-between;
        /* gap: 202px; */
    }
    .a-comeback{
        color:white;
    }
</style>
<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Create product</h2>
                        @if(session('success'))
                                    <p style="color: green;">{{ session('success') }}</p>
                        @endif
                        @foreach ($errors->all() as $error)
                            <p style="color: Red;">{{ $error }}</p>
                        @endforeach
						<div class="signup-form"><!--sign up form-->
							<form action="{{ url('/member/account/edit-product/'. $editproduct->id) }}" method="POST" enctype="multipart/form-data">
								@csrf
								<input type="text" name="name" placeholder="Name" value="{{ old('name', $editproduct->name) }}" required>
								@error('name')
									<p class="error" style="color:red">{{ $message }}</p>
								@enderror 

								<input type="number" name="price" placeholder="Price"  value="{{ old('price', $editproduct->price) }}" required>
								@error('price')
									<p class="error" style="color:red">{{ $message }}</p>
								@enderror 

								<select id="category" name="id_category" required>
                                    <option value="" disabled selected>
                                        {{ old('id_category', optional($editproduct->category)->name) ?? 'Select a Category' }}
                                    </option>
                                    @foreach($categories as $category)                                                              
                                        <option value="{{ $category->id }}" {{ old('id_category', $editproduct->id_category) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach 								
								</select>
								@error('id_category')
									<p class="error" style="color:red">{{ $message }}</p>
								@enderror

								<select id="brand" name="id_brand" required>
                                    <option value="" disabled selected>
                                        {{ old('id_brand', optional($editproduct->brand)->name) ?? 'Select a Brand' }}
                                    </option>
                                    @foreach($brandies as $brand)                                                              
                                        <option value="{{ $brand->id }}" {{ old('id_brand', $editproduct->id_brand) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach 								
								</select>
								@error('id_brand')
									<p class="error" style="color:red">{{ $message }}</p>
								@enderror

								<select name="status" id="status">
                                    <option value="1" {{ old('status', $editproduct->status) == '1' ? 'selected' : '' }}>New</option>
                                    <option value="2" {{ old('status', $editproduct->status) == '2' ? 'selected' : '' }}>Sale</option>
                                </select>

                                <div class="sales-container" style="display: {{ old('status', $editproduct->status) == '2' ? 'flex' : 'none' }};">
                                    <input type="number" name="sale" value="{{ old('sale', $editproduct->sale) }}" min="0" max="100">
                                    <span>%</span>
                                </div>
								@error('status')
									<p class="error" style="color:red">{{ $message }}</p>
								@enderror 

								<input type="text" id="company" name="company" placeholder="Company Profile"  value="{{ old('company', $editproduct->company) }}" required>
								@error('company')
									<p class="error" style="color:red">{{ $message }}</p>
								@enderror 
								
								<input type="file" name="img[]" multiple accept="image/*">
                                <div class="image-preview">
                                    @if($editproduct->image)
                                        @php
                                            $images = json_decode($editproduct->image);  // Giải mã JSON từ cột image
                                        @endphp
                                        @foreach($images as $img)
                                        <div class="image-container">
                                            <img src="{{ asset('upload/products/' . $img) }}" alt="Product Image" width="100">
                                            <label>
                                                <input type="checkbox" name="delete_images[]" value="{{ $img }}"> 
                                            </label>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>

								@error('img[]')
									<p class="error" style="color:red">{{ $message }}</p>
								@enderror 
								<textarea id="detail" name="detail" rows="4"  required>{{ old('detail', $editproduct->detail) }}</textarea>
								@error('detail')
									<p class="error" style="color:red">{{ $message }}</p>
								@enderror 
                                <div class="btn-test">
                                    <button type="submit" class="btn btn-default">Update</button>
                                    <button class="btn btn-default"><a href="{{asset('member/account/my-product') }}" class="a-comeback">Come Back</a></button>
                                </div>
                                
							</form>
					</div>
            	</div>
                
			</div>
		</div>
</section>
@endsection
@section('js')
<script>
    	
    	$(document).ready(function(){

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // })

			$('#status').change(function() {
				if ($(this).val() === '2') { 
					$('.sales-container').show(); 
				} else {
					$('.sales-container').hide(); 
				}
			});

		});

</script>
@endsection