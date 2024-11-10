@extends('frontend.layouts.app')

@section('content')
<style>
	button.btn.btn-primary.submit-reply {
    padding: 8px 15px;
    font-size: 13px;
}
</style>
<section>
	<div class="col-sm-9">
		<div class="blog-post-area">
			<h2 class="title text-center">Latest From our Blog</h2>
			<div class="single-blog-post">
				<h3>{{ $blog->title }}</h3>
				<div class="post-meta">
					<ul>
						<li><i class="fa fa-user"></i> Mac Doe</li>
						<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
						<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
					</ul>
				</div>
				<a href="">
					<img src="{{ asset('/images/' . $blog->image) }}" alt="Current Image" width="100">
				</a>
				<p>{{ $blog->Description}}</p> <br>

				<div class="pager-area">
					<ul class="pager pull-right">
						<!-- <li><a href="#">Pre</a></li>
						<li><a href="#">Next</a></li> -->
						@if($previous)
							<li><a href="{{ url('frontend/blog/detail/'.$previous->id)}}" >Pre</a></li>
						@endif

						@if($next)
							<li><a href="{{ url('frontend/blog/detail/'.$next->id)}}" >Next</a></li>
						@endif
					</ul>
				</div>
			</div>
		</div><!--/blog-post-area-->
		
		<div class="rating-area">
			<ul class="ratings">
				<li class="rate-this">Rate this item:</li>
				<li class="rate">
					<div class="vote">
						<div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
						<div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
						<div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
						<div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
						<div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
						<span class="rate-np">4.5</span>
						<!-- <li class="color">(6 votes)</li> -->
					</div> 
					
				</li>                           
				
			</ul>

		</div><!--/rating-area-->

		<div class="socials-share">
			<a href=""><img src="{{asset('frontend/images/blog/socials.png') }}" alt=""></a>
		</div><!--/socials-share-->
		
		<div class="response-area">
			<h2>3 RESPONSES</h2>
			<ul class="media-list">

				@foreach ($cmtt as $cmt)
					<li class="media">						
						<a class="pull-left" href="#">
							<img src="{{ asset('upload/user/avatar/' . $cmt->avatar) }}" alt="Current Image" width="100">
							
						</a>
						<div class="media-body">
							<ul class="sinlge-post-meta">
								<li><i class="fa fa-user"></i>{{ $cmt->name}}</li>
								<li><i class="fa fa-clock-o"></i> {{ $cmt->created_at->format('h:i a') }}</li>
								<li><i class="fa fa-calendar"></i>{{ $cmt->created_at->format('M d, Y') }}</li>
							</ul>
							<p>{{$cmt->cmt}}</p>
							<a class="btn btn-primary reply-btn" href=""><i class="fa fa-reply"></i>Replay</a>

							<div class="reply-form" style="display:none ;">
								<textarea class="form-control reply-content" placeholder="Write your reply here..."></textarea>
								<button class="btn btn-primary submit-reply">Submit Reply</button>
							</div>
						</div>
					</li>
				@endforeach

				@foreach ($reylys as $reyly)
				<li class="media second-media">
					<a class="pull-left" href="#">
						<img class="media-object" src="{{ asset('upload/user/avatar/' . $reyly->avatar) }}" alt="Current Image" width="100">
					</a>
					<div class="media-body">
						<ul class="sinlge-post-meta">
							<li><i class="fa fa-user"></i>{{ $reyly->name}}</li>
							<li><i class="fa fa-clock-o"></i> {{ $reyly->created_at->format('h:i a') }}</li>
							<li><i class="fa fa-calendar"></i> {{ $reyly->created_at->format('M d, Y') }}</li>
						</ul>
						<p>{{$reyly->cmt}}</p>
						<a class="btn btn-primary reply-btn" href=""><i class="fa fa-reply"></i>Replay</a>

						<div class="reply-form" style="display:none ;">
							<textarea class="form-control reply-content" placeholder="Write your reply here..."></textarea>
							<button class="btn btn-primary submit-reply">Submit Reply</button>
						</div>
					</div>
				</li>

				@endforeach

			</ul>	
							
		</div><!--/Response-area-->

		<div class="replay-box">
			<div class="row">
				<div class="col-sm-12">
					<h2>Leave a replay</h2>
					<form action="" method="POST">
						@csrf
						<input type="hidden" name="id_blog" value="{{ $blog->id }}" class="id_blog">
						<input type="hidden" id="level" value="">
						<div class="text-area">
							<div class="blank-arrow">
								<label>Your Name</label>
							</div>
							<span>*</span>
							<textarea name="message" rows="11" id="comment_content"></textarea>
							<a class="btn btn-primary comment_btn"  href="">post comment</a>
						</div>
					</form>
				</div>
			</div>
		</div><!--/Repaly Box-->

		
	</div>	
</section>
@endsection
@section('js')
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
    	
    	$(document).ready(function(){

          
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );



			$('.ratings_stars').click(function(){

                var checkLogin = "{{ Auth::Check() }}";
                //alert(checkLogin);

                if(checkLogin){
                    var rate =  $(this).find("input").val();
                    var id_blog = window.location.href.split('/').pop();
                    //console.log(id_blog);

                    //alert(values);
                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    } else {
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ url("/blog/rate/ajax") }}',
                        data: {
                            rate: rate,
                            id_blog: id_blog
                        },
                        success: function(data) {
                             console.log(data);						
	                    }
                    });

                }else{
                    alert('Vui lòng login để rate');
                }

		    });

            $('a.comment_btn').click(function(e){
				e.preventDefault();
                var checkLogin = "{{ Auth::Check() }}";
                // alert(123);

                if(checkLogin){
					// alert("ok")
                    var cmt =  $('#comment_content').val();
                    var id_blog = $('.id_blog').val();
                    var level = $('#level').val();

                    //console.log(id_blog);

                    $.ajax({
                        url: '{{ url("/blog/comment/ajax") }}',
                        method: 'POST',
                        data: {
                            cmt: cmt,
                            id_blog: id_blog,
                            level: level
                        },
                        success: function(data) {
                            console.log(data);
							var html = "<li class='media'>" +
											"<a class='pull-left' href='#'>" +  
												"<img class='media-object' src='{{ asset('upload/user/avatar/' . " data.data.avatar") }}' alt=''>" +
											"</a>" +
											"<div class='media-body'>" +
												"<ul class='sinlge-post-meta'>" +
													"<li><i class='fa fa-user'></i>" + data.data.name  + "</li>" + 
													"<li><i class='fa fa-clock-o'></i>" + new Date().toLocaleTimeString() + "</li>" + 
													"<li><i class='fa fa-calendar'></i>" + new Date().toLocaleDateString() + "</li>" + 
												"</ul>" +
												"<p>" + data.data.cmt + "</p>" + 
												"<a class='btn btn-primary' href=''><i class='fa fa-reply'></i>Reply</a>" +
											"</div>" +''
										"</li>";


							$("ul.media-list").append(html);
					
                        }
                    });
                }else{
					alert("vui lòng login");
				}
            });


			$('.reply-btn').click(function(e){
				e.preventDefault();
				$(this).next('.reply-form').toggle();
			});

			$('.submit-reply').click(function(e){
				var checkLogin = "{{ Auth::Check() }}";
                //alert(123);

                if(checkLogin){
					//alert("ok")
                    var cmt =  $('.reply-content').val().trim();
                    var id_blog = $('.id_blog').val();
                    var level = $('#level').val();

					if (cmt === "") {
						alert("Vui lòng nhập nội dung bình luận.");
						return;
					}

                    $.ajax({
                        url: '{{ url("/blog/comment/reply") }}',
                        method: 'POST',
                        data: {
                            cmt: cmt,
                            id_blog: id_blog,
                            level: level
                        },
                        success: function(data) {
                            console.log(data);
							var reply = data.reply;
							var xx = "{{ asset('upload/user/avatar/') }}" + "/" + reply.avatar;



							var html = "<li class='media second-media'>" +
											"<a class='pull-left' href='#'>" +
												"<img class='media-object' src='"+xx+"'  alt='Current Image' width='100'>" +
											"</a>" +
											"<div class='media-body'>" +
												"<ul class='sinlge-post-meta'>" +
													"<li><i class='fa fa-user'></i>" + reply.name  + "</li>" +
													"<li><i class='fa fa-clock-o'></i>" + new Date().toLocaleTimeString() + "</li>" +
													"<li><i class='fa fa-calendar'></i>" + new Date().toLocaleDateString() + "</li>" +
												"</ul>" +
												"<p>" + reply.cmt + "</p>" + 
												"<a class='btn btn-primary' href=''><i class='fa fa-reply'></i>Reply</a>" +
											"</div>" +
										"</li>";


							$("ul.media-list").append(html);

							$('.reply-form').hide(); 
							$('.submit-reply').hide(); 
					
                        }
                    });
                }else{
					alert("vui lòng login");


				}
			});



		});

    </script>
@endsection