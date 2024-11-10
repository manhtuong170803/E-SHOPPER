@extends('frontend.layouts.app')

@section('content')
    <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
                        @foreach($bloglist as $value)
                            <div class="single-blog-post">
                                <h3>{{ $value->title }}</h3>
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="fa fa-user"></i> Mac Doe</li>
                                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                    </ul>
                                    <span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                    </span>
                                </div>
                                <a href="">
                                    <img src="{{ asset('/images/' . $value->image) }}" alt="Current Image" width="100">
                                </a>
                                <p>{{ $value->Description }}</p>
                                <a  class="btn btn-primary" href="{{ url('frontend/blog/detail/'.$value->id)}}">Read More</a>
                            </div>
                        @endforeach
                            <div class="pagination-area">
                                <ul class="pagination">
                                    {{ $bloglist->links('pagination::bootstrap-4') }}
                                </ul>
                            </div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection