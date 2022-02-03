<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@yield('meta')
	<link rel="icon" href="{{ $setting->icon_path }}">
<!--===============================================================================================-->
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600&display=swap" rel="stylesheet"> 
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/vendor/bootstrap-4.0.0-rtl-dist/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/fonts/fontawesome-free/css/all.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/vendor/toastr/toastr.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/css/util.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/css/rtl.css">
	<link rel="stylesheet" type="text/css" href="{{asset('/enduser')}}/css/custom.css">
	<style>
		[data-src] {
			display: inline-block;
			width: 100%;
			height: 100%;
			background: #ccc;
			color: transparent;
		}
	</style>
</head>
<body class="animsition">
	
	<!-- Header -->
	@include('enduser.partials.header')

	<!-- Headline -->
	<div class="container">
		<div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 size-w-0 m-tb-6 flex-wr-s-c">
				<span class="text-uppercase cl2 p-l-8">
					المحتوى الرائج :
				</span>

				<span class="dis-inline-block cl6 slide100-txt pos-relative size-w-0" data-in="fadeInDown" data-out="fadeOutDown">					
					@foreach($popular_article as $post)
						<a href="{{url('/'.$post->slug)}}" class="cl6  dis-inline-block slide100-txt-item animated visible-false">
							{{$post->title}}
						</a>
					@endforeach
				</span>
			</div>

			<div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
				<form method="GET" action="{{url("/")}}" style="height: 100%">
					<input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="ايحث هنا">
					<button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
						<i class="zmdi zmdi-search"></i>
					</button>
				</form>
			</div>
		</div>
	</div>
		
	@yield('content')

	<!-- Footer -->
	@include('enduser.partials.footer')

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>

<!--===============================================================================================-->	
	<script src="{{asset('/enduser')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('/enduser')}}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('/enduser')}}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('/enduser')}}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{asset('/enduser')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="{{asset('/enduser')}}/vendor/toastr/toastr.min.js"></script>
	<script src="{{asset('/enduser')}}/vendor/jquery.lazy-master/jquery.lazy.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('/enduser')}}/js/main.js"></script>
	<script src="{{asset('/enduser')}}/js/custom.js"></script>
 
				 
	 
	<script>
		//make notifications read 
		var url =  '{{ url('markAsRead') }}';
		$('.notifications-btn').on('click', function() {
		  //$(".notifications-dropdown").toggleClass("show");
		  $.get(url, function(res,status){
		   if(status == "success"){
			  $('.notifications-badge').hide();
		   }
		  });
		});	
	</script>
	@auth
		<script>
			//add comment and replay
			$('#add-comment, .replay-comment').on('click', function() {

				event.preventDefault();

				var parent_id = $(this).siblings('input[name="parent_id"]').val();

				if(typeof(parent_id) === "undefined"){
					var parent_id = 0;
				}

				var my_data = {
						post_id : $(this).siblings('input[name="post_id"]').val(),
						_token : "{{ csrf_token() }}",
						user_id : '{{ Auth::user()->id }}',
						parent_id: parent_id,
						body:  $(this).siblings('textarea[name="body"]').val(),
					};


				$.ajax({
					type: "POST",
					url: ' {{url('comment/') }} ',
					data: my_data,
					success: function (data) {
						if(data.status == 0){
							jQuery.each(data.message, function(index, item) {
								toastr.error(item);
							});
						} else {
							toastr.success(data.message);
							console.log(data);
							$("textarea").val("");
						}			
					},
					error: function (data, textStatus, errorThrown) {
						toastr.error("حدث خطا غير متوقع");

					},
				});

			});

			//edit comment
			$('.edit-comment').on('click', function() {


				event.preventDefault();

				var edit_url = $(this).parent().attr('action'),
					the_comment = $(this).parents('.media').find('.comment-text');

				var my_data = {
						_token : "{{ csrf_token() }}",
						body:  $(this).siblings('textarea[name="body"]').val()
					};


				$.ajax({
					type: "PUT",
					url: edit_url,
					data: my_data,
					success: function (data) {
						if(data.status == 0){
							jQuery.each(data.message, function(index, item) {
								toastr.error(item);
							});
						} else {
							toastr.success(data.message);
							the_comment.text(data.data);
							$('.comment-text').slideDown();
							$('.edit').slideUp();
						}			
					},
					error: function (data, textStatus, errorThrown) {
						toastr.error("حدث خطا غير متوقع");

					},
				});

			});

			//delete comment
			$('.delete-comment').on('click', function() {


				event.preventDefault();

				var delete_url = $(this).parent().attr('action'),
					comment_box = the_comment = $(this).closest('.media');

				var my_data = {
						_token : "{{ csrf_token() }}",
					};


				$.ajax({
					type: "DELETE",
					url: delete_url,
					data: my_data,
					success: function (data) {
						if(data.status == 0){
							toastr.error("حدث خطا غير متوقع");
						} else {
							toastr.success(data.message);
							comment_box.slideUp();
						}			
					},
					error: function (data, textStatus, errorThrown) {
						toastr.error("حدث خطا غير متوقع");

					},
				});

			});

			//add report
			$('.add-report').on('click', function() {

				event.preventDefault();

				var report_url = $(this).parent().attr('action');

				var my_data = {
						_token : "{{ csrf_token() }}",
						comment_id : $(this).siblings('input[name="comment_id"]').val(),
						reason : $(this).siblings('textarea[name="reason"]').val(),
						user_id : '{{ Auth::user()->id }}'
					};


				$.ajax({
					type: "POST",
					url: report_url,
					data: my_data,
					success: function (data) {
						if(data.status == 0){
							jQuery.each(data.message, function(index, item) {
								toastr.error(item);
							});
						} else {
							toastr.success(data.message);
							$('.report').slideUp();
						}			
					},
					error: function (data, textStatus, errorThrown) {
						toastr.error("حدث خطا غير متوقع");

					},
				});

			});


		</script>
	@endauth
	@include('enduser.partials.toster')
	
</body>
</html>