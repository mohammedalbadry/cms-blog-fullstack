@extends('enduser.layouts.app')

@section('meta')
@include('meta::manager', [
		'title'         => $title,
		'description'   => $setting->description,

	])
@endsection

@section('content')


<!-- Feature post -->
<section class="bg0">
    <div class="container">
        <div class="row m-rl--1">
            @foreach ($posts  as $post)
                @if($loop->index == 1)
                    <div class="col-md-6 p-rl-1">
                    <div class="row m-rl--1 likeness">
                @endif

                <div class="custom-simple-grid">
                    <div class="bg-img1 img-size how1 pos-relative" style="background-image: url({{$post->image}});">
                        <a href="{{url('/' . $post->slug)}}" class="dis-block how1-child1 trans-03"></a>
    
                        <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                            <a href="category/{{$post->categories->first()->slug}}" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                {{$post->categories->first()->name}}
                            </a>
    
                            <h3 class="how1-child2 m-t-14 m-b-10">
                                <a href="{{url('/' . $post->slug)}}" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
                                    {{$post->title}}
                                </a>
                            </h3>
    
                            @if($loop->index == 0)
                                <span class="how1-child2">
                                    <span class="f1-s-4 cl11">
                                        {{$post->admin->name}}
                                    </span>
        
                                    <span class="f1-s-3 cl11 m-rl-3">
                                        -
                                    </span>
        
                                    <span class="f1-s-3 cl11">
                                        {{$post->created_at}}
                                    </span>
                                </span>
                            @endif
            
                        </div>
                    </div>
                </div>

                @if($loop->index == 3)
                    </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

<!-- Post -->
<section class="bg0 p-t-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="p-b-20">

                    @foreach($categories as $category)
                    <!-- Entertainment -->
                    <div class="tab01 p-b-20">
                        <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                            <!-- Brand tab -->
                            <h3 class="f1-m-2 cl12 tab01-title">
                                {{$category->name}}
                            </h3>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab{{$category->id}}" role="tab">الكل</a>
                                </li>

                                @foreach($sub_categories[$loop->index] as $child)
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab{{$child->id}}" role="tab">{{$child->name}}</a>
                                    </li>
                                @endforeach
                            </ul>

                            <!--  -->
                            <a href="{{url("category/". $category->slug)}}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                عرض المزيد
                                <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                            </a>
                        </div>
                            

                        <!-- Tab panes -->
                        <div class="tab-content p-t-35">

                            <div class="tab-pane fade show active" id="tab{{$category->id}}" role="tabpanel">
                                <div class="row">
                                    @foreach($category->posts->take(4)  as $item)
                                        @if($loop->index == 0 || $loop->index == 1)
                                            <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                        @endif
                                        <!-- Item post -->	
                                        <div class="{{$loop->index != 0 ? 'flex-wr-sb-s': ' ' }} m-b-30">
                                            <a href="{{url($item->slug)}}" class="{{$loop->index != 0 ? 'size-w-1 size-h2': 'size-h1' }} wrap-pic-w hov1 trans-03">
                                                <img data-src="{{$item->image}}" alt="IMG">
                                            </a>

                                            <div class="{{$loop->index != 0 ? 'size-w-2': 'p-t-20' }}">
                                                <h5 class="p-b-5">
                                                    <a href="{{url($item->slug)}}" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        {{$item->title}}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="{{url("category/". $item->categories->first()->slug)}}" class="{{$loop->index != 0 ? 'f1-s-6': 'f1-m-4' }} cl8 hov-cl10 trans-03">
                                                        {{$item->categories->first()->name}}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{$item->created_at}}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        @if($loop->index == 0 || $loop->last == 3)
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- - -->
                            @foreach($sub_categories[$loop->index] as $child)
                                <div class="tab-pane fade show" id="tab{{$child->id}}" role="tabpanel">
                                    <div class="row">
                                        @foreach($child->posts->take(4) as $item)
                                            @if($loop->index == 0 || $loop->index == 1)
                                                <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            @endif
                                            <!-- Item post -->	
                                            <div class="{{$loop->index != 0 ? 'flex-wr-sb-s': ' ' }} m-b-30">
                                                <a href="{{url($item->slug)}}" class="{{$loop->index != 0 ? 'size-w-1 size-h2': 'size-h1' }} wrap-pic-w hov1 trans-03">
                                                    <img data-src="{{$item->image}}" alt="{{$item->title}}">
                                                </a>

                                                <div class="{{$loop->index != 0 ? 'size-w-2': 'p-t-20' }}">
                                                    <h5 class="p-b-5">
                                                        <a href="{{url($item->slug)}}" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            {{$item->title}}
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="{{url("category/". $item->categories->first()->slug)}}" class="{{$loop->index != 0 ? 'f1-s-6': 'f1-m-4' }} cl8 hov-cl10 trans-03">
                                                            {{$item->categories->first()->name}}
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            {{$item->created_at}}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            @if($loop->index == 0 || $loop->last )
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>

            <div class="col-md-10 col-lg-4">
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

                                    <a href="{{$item->slug}}" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
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

<!-- Banner -->
<div class="container">
    <div class="flex-c-c">
        <a href="#" style="height: 140px; overflow: hidden;">
            <img class="max-w-full" src="https://cdn.pixabay.com/photo/2017/05/29/19/13/fire-and-water-2354583_960_720.jpg" alt="IMG">
        </a>
    </div>
</div>

<!-- Latest -->
<section class="bg0 p-t-60 p-b-35">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-12 p-b-20">
                <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
                    <h3 class="f1-m-2 cl3 tab01-title">
                        تقارير ومقالات
                    </h3>
                </div>

                <div class="row p-t-35">
                    @foreach($article as $item)
                        <div class="col-sm-6 col-md-4 p-r-25 p-r-15-sr991">
                            <!-- Item latest -->	
                            <div class="m-b-45">
                                <a href="{{$item->slug}}" class="wrap-pic-w hov1 trans-03 size-h-3">
                                    <img data-src="{{$item->image}}" alt="IMG">
                                </a>

                                <div class="p-t-16">
                                    <h5 class="p-b-5">
                                        <a href="{{$item->slug}}" class="f1-m-3 cl2 hov-cl10 trans-03">
                                            {{$item->title}}
                                        </a>
                                    </h5>

                                    <span class="cl8">
                                        <a class="f1-s-4 cl8 hov-cl10 trans-03">
                                            بواسطة {{$item->admin->name}}
                                        </a>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            {{$item->created_at}}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection