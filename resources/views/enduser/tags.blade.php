@extends('enduser.layouts.app')

@section('meta')
@include('meta::manager', [
		'title'         => $title,
		'description'   => $setting->description,

	])
@endsection

@section('content')

	<!-- Page heading -->
	<div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2">
			{{$title}}
		</h2>
	</div>

	<!-- Post -->
	<section class="bg0 p-b-55">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8 p-b-80">
					<div class="row">

                        @foreach($tags as $tag)
                            <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                <!-- Item latest -->	
                                <div class="m-b-45">
                                    <a href="{{url('tag/' . $tag->slug)}}" class="wrap-pic-w hov1 trans-03 new-size">
                                        <img data-src="{{$tag->posts->first()->image}}" alt="{{$tag->name}}">
                                    </a>

                                    <div class="p-t-16">
                                        <h5 class="p-b-5">
                                            <a href="{{url('tag/' . $tag->slug)}}" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                {{$tag->name}}
                                            </a>
                                        </h5>

                                        <span class="cl8">
                                            <a class="f1-s-4 cl8 hov-cl10 trans-03">
                                                يوجد {{$tag->posts_count}} مقال فى هذا القسم 
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
					</div>

					<!-- Pagination -->
					{{ $tags->appends(request()->query())->links('enduser.partials.pagination') }}
				</div>

				<div class="col-md-10 col-lg-4 p-b-80">
					<div class="p-l-10 p-rl-0-sr991 p-b-20">
						<!--  -->
						<div>
							<div class="how2 how2-cl4 flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
									موضوعات هامة
								</h3>
							</div>
	
							<ul class="p-t-35">
								@foreach($popular as $item)
									<li class="flex-wr-sb-s p-b-22">
										<div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
											{{$loop->index +  1}}
										</div>
	
										<a href="{{url($item->slug)}}" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
											{{$item->title}}
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="p-l-10 p-rl-0-sr991 p-b-20">
						@include('enduser.partials.side')
					</div>
				</div>
			</div>
		</div>
    </section>
    
@endsection