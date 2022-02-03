@extends('enduser.layouts.app')
@section('meta')
@include('meta::manager', [
		'title'         => $post->title,
		'description'   => $post->excerpt,
	])
@endsection

@section('content')

@include('enduser.partials.toster')

	<!-- Content -->
	<section class="bg0 p-b-140 p-t-10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8 p-b-30">
					<div class="p-r-10 p-r-0-sr991">
						<!-- Blog Detail -->
						<div class="p-b-70">
							<a href="{{url("category/".$post->categories->first()->slug)}}" class="f1-s-10 cl2 hov-cl10 trans-03 text-uppercase">
								{{$post->categories->first()->name}}
							</a>

							<h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                                {{$post->title}}
                            </h3>
							
							<div class="flex-wr-s-s p-b-40">
								<span class="f1-s-3 cl8 m-r-15">
									<a class="f1-s-4 cl8 hov-cl10 trans-03">
										بواسطة {{$post->admin->first()->name}}
									</a>
								</span>

								<span class="f1-s-3 cl8 m-r-15">
									{{$post->created_at}}
								</span>

								<span class="f1-s-3 cl8 m-r-15 d-none">
									{{$post->views }} المشاهدات
								</span>

								<a href="#" class="f1-s-3 cl8 hov-cl10 trans-03 m-r-15">
									{{$post->postcomments->count() }} التعليقات
								</a>
							</div>

							<div class="wrap-pic-max-w p-b-30 max-h-450">
								<img src="{{$post->image}}" class="w-100" alt="IMG">
							</div>
                            
                            {!! $post->body !!}

							<!-- Tag -->
							<div class="flex-s-s p-t-12 p-b-15">
								<span class="f1-s-12 cl5 m-r-8">
									الوسوم :
								</span>
								
								<div class="flex-wr-s-s size-w-0">
                                    @foreach ($post->tags as $tag)
                                        <a href="tag/{{$tag->slug}}" class="f1-s-12 cl8 hov-link1 m-r-15">
                                            {{$tag->name}}
                                        </a>
                                    @endforeach
								</div>
							</div>

							<!-- Share -->
							<div class="flex-s-s">
								<span class="f1-s-12 cl5 p-t-1 m-r-15">
									شارك الان: 
								</span>
								
								<div class="flex-wr-s-s size-w-0">
									<a href="{{$shere['facebook']}}" target="_blank" class="dis-block f1-s-13 cl0 bg-facebook borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
										<i class="fab fa-facebook-f m-r-7"></i>
										Facebook
									</a>

									<a href="{{$shere['twitter']}}" class="dis-block f1-s-13 cl0 bg-twitter borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
										<i class="fab fa-twitter m-r-7"></i>
										Twitter
									</a>

									<a href="#" class="dis-block f1-s-13 cl0 bg-wa borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
										<i class="fab fa-whatsapp"></i>
										whatsapp
									</a>

									<a href="#" class="dis-block f1-s-13 cl0 bg-tel borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
										<i class="fab fa-telegram-plane"></i>
										Telegram
									</a>
								</div>
							</div>
						</div>

						<!-- Leave a comment -->
						<div class="comment-hr">
							<h4 class="f1-l-4 cl3 p-b-12">
								التعليقات
							</h4>
							@if($post->comments == "مفعل")
								@guest
									<div class="alert alert-secondary" role="alert">
										يجب تسجيل الدخول لتمتع بهذه الميزة .. سجل من <a href="{{url('/login')}}" target="_blank">هنا</a> 
									</div>
								@endguest
								

								@auth
									<form method="post" action="{{url('comment/') }}" class="mb-4">
										@csrf
										<input type="hidden" name="post_id" value="{{$post->id}}">
										<textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="body" placeholder="اترك تعليقا ...."></textarea>
										<button id="add-comment" class="size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10 btn btn-block">
											اضف تعليق
										</button>
									</form>
								@endauth
							@else
								<div class="alert alert-secondary" role="alert">
									ميزة التعليقات متوقفة لهذا الموضوع
								</div>
							@endif
						</div>
						
						<div class="show-comments mt-4">
							@foreach($post->postcomments()->orderBy('created_at', 'desc')->get() as $comment)
								<div class="media my-3">
									<img src="{{ $comment->user->image_path }}" class="mr-3" alt="...">
									<div class="media-body">
										<h3 class="mt-0 d-flex">
											<span class="font-weight-bold h5"> {{ $comment->user->name }} </span>
											<span class="text-center" style="width: 20px"> - </span>
											<span> {{ $comment->created_at }} </span>
										</h3>

										<p class="m-2 h5 comment-text">{{ $comment->body }}</p>	


										@if(Auth::user() && $comment->user_id == auth()->user()->id)
											<div class="delete">
												<form class="mb-2" method="post" action="{{url('comment/'. $comment->id) }}">
													@csrf
                                        		    @method('delete')
													<div class="alert alert-danger" role="alert">
														هل انت متاكد من حذف هذا التعليق 
													</div>
													<button class="delete-comment size-a-17 borad-3 f1-s-12 cl0  trans-03 p-rl-15 m-t-10 btn btn-block btn-danger">
														حذف التعليق
													</button>
												</form>
											</div>
											<div class="edit">
												<form class="mb-2" method="post" action="{{url('comment/'. $comment->id) }}">
													@csrf
											        @method('PUT')
													<textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="body" placeholder="اترك تعليقا ....">{{ $comment->body }}</textarea>
													<button class="edit-comment size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10 btn btn-block">
														تعديل التعليق
													</button>
												</form>
											</div>
											<button class="mx-2 delete-btn">حذف</button>
											<button class="mx-2 edit-btn">تعديل</button>
										@endif

										@auth
											@if($comment->user_id !== auth()->user()->id)
												<button class="mx-2 report-btn">ابلاغ</button>
											@endif
											<button class="mx-2 replay-btn">رد</button>

											@if($comment->user_id !== auth()->user()->id)
												<div class="report">
													<form method="post" action="{{url('report/') }}" class="mb-4">
														@csrf
														<input type="hidden" name="comment_id" value="{{$comment->id}}">
														<textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="reason" placeholder="اذكر السبب"></textarea>
														<button class="add-report size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10 btn btn-block">
															ابلغ الان
														</button>
													</form>
												</div>
											@endif

											<div class="replay">
												<form method="post" action="{{url('comment/') }}" class="mb-4">
													@csrf
													<input type="hidden" name="post_id" value="{{$post->id}}">
													<input type="hidden" name="parent_id" value="{{$comment->id}}">
													<textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="body" placeholder="اترك تعليقا ...."></textarea>
													<button class="replay-comment size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10 btn btn-block">
														اضف رد
													</button>
												</form>
											</div>
										@endauth


										@foreach($comment->replay as $replay)
											<div class="media mb-2 mt-4">
												<img src="{{ $replay->user->image_path }}" class="mr-3" alt="...">
												<div class="media-body">
												<h3 class="mt-0 d-flex">
													<span class="font-weight-bold h5"> {{ $replay->user->name }} </span>
													<span class="text-center" style="width: 20px"> - </span>
													<span> {{ $replay->created_at }} </span>
												</h3>
			
												<p class="m-2 h5 comment-text">{{ $replay->body }}</p>	
												@if(Auth::user() && $replay->user_id == auth()->user()->id)
													<div class="delete">
														<form class="mb-2" method="post" action="{{url('comment/'. $replay->id) }}">
															@csrf
															@method('delete')
															<div class="alert alert-danger" role="alert">
																هل انت متاكد من حذف هذا التعليق 
															</div>
															<button class="delete-comment size-a-17 borad-3 f1-s-12 cl0  trans-03 p-rl-15 m-t-10 btn btn-block btn-danger">
																حذف التعليق
															</button>
														</form>
													</div>
													<div class="edit">
														<form class="mb-2" method="post" action="{{url('comment/'. $replay->id) }}">
															@csrf
															@method('PUT')
															<textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="body" placeholder="اترك رد ....">{{ $replay->body }}</textarea>
															<button class="edit-comment size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10 btn btn-block">
																تعديل التعليق
															</button>
														</form>
													</div>
													<button class="mx-2 delete-btn">حذف</button>
													<button class="mx-2 edit-btn">تعديل</button>
												@endif
												</div>
											</div>
										@endforeach


									</div>
								</div>
							@endforeach	
						</div>
					</div>
				</div>
				
				<!-- Sidebar -->
				<div class="col-md-10 col-lg-4 p-b-30">
					<div class="p-l-10 p-rl-0-sr991 p-t-70">
						
						<!-- related Posts -->
						<div class="p-b-30">
							<div class="how2 how2-cl4 flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
									مقالات ذات صلة
								</h3>
							</div>

							<ul class="p-t-35">

								@foreach($related_posts as $post)
									<li class="flex-wr-sb-s p-b-30">
										<a href="{{url($post->slug)}}" class="size-w-10 wrap-pic-w hov1 trans-03 size-h2">
											<img data-src="{{$post->image}}" alt="IMG">
										</a>

										<div class="size-w-11">
											<h6 class="p-b-4">
												<a href="{{url($post->slug)}}" class="f1-s-5 cl3 hov-cl10 trans-03">
													{{$post->title}}
												</a>
											</h6>

											<span class="cl8 txt-center p-b-24">
												<a href="{{url("category/".$post->categories->first()->slug)}}" class="f1-s-6 cl8 hov-cl10 trans-03">
													{{$post->categories->first()->name}}
												</a>

												<span class="f1-s-3 m-rl-3">
													-
												</span>

												<span class="f1-s-3">
													{{$post->created_at}}
												</span>
											</span>
										</div>
									</li>
								@endforeach
								
							</ul>
						</div>

						@include('enduser.partials.side')
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection