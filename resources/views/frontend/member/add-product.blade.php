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
	<div class="col-sm-9">
		<div class="blog-post-area">
			<h2 class="title text-center">Create product</h2>
			@if(session('success'))
						<p style="color: green;">{{ session('success') }}</p>
			@endif
			<div class="signup-form"><!--sign up form-->
				<form action="{{ route('products.insert') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="text" name="name" placeholder="Name" value="" required>
					@error('name')
						<p class="error" style="color:red">{{ $message }}</p>
					@enderror 

					<input type="number" name="price" placeholder="Price"  value="" required>
					@error('Price')
						<p class="error" style="color:red">{{ $message }}</p>
					@enderror 

					<select id="category" name="id_category" required>
						<option value="" disabled selected>Please choose category</option>
						@foreach($categories as $category)                                                              
							<option value="{{ $category->id }}">{{ $category->name }}</option> 								
						@endforeach									
					</select>
					@error('id_category')
						<p class="error" style="color:red">{{ $message }}</p>
					@enderror

					<select id="brand" name="id_brand" required>
						<option value="" disabled selected>Please choose brand</option>
						@foreach($brandies as $brand)                                                              
							<option value="{{ $brand->id }}">{{ $brand->name }}</option> 								
						@endforeach									
					</select>
					@error('id_brand')
						<p class="error" style="color:red">{{ $message }}</p>
					@enderror

					<select name="status" id="status">
						<option value="1">New</option>
						<option value="2">Sale</option>
					</select>

					<div class="sales-container" style="display: none;">
						<input type="number" name="sale" value="" min="0" max="100">
						<span>%</span>
					</div>
					@error('status')
						<p class="error" style="color:red">{{ $message }}</p>
					@enderror 

					<input type="text" id="company" name="company" placeholder="Company Profile" required>
					@error('companyProfile')
						<p class="error" style="color:red">{{ $message }}</p>
					@enderror 
					
					<!-- <input type="file" id="image" name="image" accept="image/*"> -->
					<input type="file" name="img[]" multiple accept="image/*">
					@error('img[]')
						<p class="error" style="color:red">{{ $message }}</p>
					@enderror 
					<textarea id="detail" name="detail" rows="4" required></textarea>
					@error('detail')
						<p class="error" style="color:red">{{ $message }}</p>
					@enderror 
					<div class="btn-test">
						<button type="submit" class="btn btn-default">Add</button>
						<button class="btn btn-default"><a href="{{asset('member/account/my-product') }}" class="a-comeback">Come Back</a></button>
					</div>
				</form>
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

			// $('.submit-reply').click(function(e){
			// 	var checkLogin = "{{ Auth::Check() }}";
            //     //alert(123);

            //     if(checkLogin){
			// 		//alert("ok")
            //         var cmt =  $('.reply-content').val().trim();
            //         var id_blog = $('.id_blog').val();
            //         var level = $('#level').val();

			// 		if (cmt === "") {
			// 			alert("Vui lòng nhập nội dung bình luận.");
			// 			return;
			// 		}

            //         $.ajax({
            //             url: '{{ url("/blog/comment/reply") }}',
            //             method: 'POST',
            //             data: {
            //                 cmt: cmt,
            //                 id_blog: id_blog,
            //                 level: level
            //             },
            //             success: function(data) {
            //                 console.log(data);					
            //             }
            //         });
            //     }else{
			// 		alert("vui lòng login");


			// 	}
			// });



		});

</script>
@endsection